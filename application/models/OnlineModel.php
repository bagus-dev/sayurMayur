<?php
class OnlineModel extends CI_Model
{
    function get_detail_invoice_selesai()
    {
        $this->db->select("*");
        $this->db->from("tbl_invoice");
        $this->db->where(array("status" => 3));
        $this->db->order_by("waktu_ditambahkan", "DESC");
        $this->db->join("tbl_user", "tbl_user.user_id = tbl_invoice.user_id");

        return $this->db->get();
    }

    function get_detail_invoice_valid()
    {
        $this->db->select("*");
        $this->db->from("tbl_invoice");
        $this->db->where(array("status" => 1));
        $this->db->order_by("waktu_ditambahkan", "DESC");
        $this->db->join("tbl_user", "tbl_user.user_id = tbl_invoice.user_id");

        return $this->db->get();
    }

    function get_detail_invoice_invalid()
    {
        $this->db->select("*");
        $this->db->from("tbl_invoice");
        $this->db->where(array("status" => 0));
        $this->db->order_by("waktu_ditambahkan", "DESC");
        $this->db->join("tbl_user", "tbl_user.user_id = tbl_invoice.user_id");

        return $this->db->get();
    }

    function get_detail_invoice_batal()
    {
        $this->db->select("*");
        $this->db->from("tbl_invoice");
        $this->db->where(array("status" => 2));
        $this->db->order_by("waktu_ditambahkan", "DESC");
        $this->db->join("tbl_user", "tbl_user.user_id = tbl_invoice.user_id");

        return $this->db->get();
    }

    function get_detail_invoice($no_invoice)
    {
        $this->db->select("*");
        $this->db->from("tbl_invoice");
        $this->db->where(array("no_invoice" => $no_invoice));
        $this->db->join("tbl_user", "tbl_user.user_id = tbl_invoice.user_id");

        return $this->db->get();
    }

    function get_checkout($no_invoice)
    {
        $this->db->select("tbl_checkout.barang_id,tbl_checkout.kuantitas,tbl_checkout.subtotal,tbl_barang.barang_nama,tbl_barang.barang_harjul,tbl_satuan.satuan_nama");
        $this->db->from("tbl_checkout");
        $this->db->where(array("no_invoice" => $no_invoice));
        $this->db->join("tbl_barang", "tbl_barang.barang_id = tbl_checkout.barang_id");
        $this->db->join("tbl_satuan", "tbl_satuan.satuan_id = tbl_barang.barang_satuan_id");

        return $this->db->get();
    }

    function get_user_invoice($no_invoice)
    {
        $get_invoice = $this->db->get_where("tbl_invoice", array("no_invoice" => $no_invoice))->row();

        $this->db->select("tbl_user.user_nama,tbl_user.user_nohp,tbl_user.user_email");
        $this->db->from("tbl_user");
        $this->db->where(array("user_id" => $get_invoice->user_id));

        return $this->db->get();
    }

    function cek_status()
    {
        $get_invoice = $this->db->get_where("tbl_invoice", array("no_invoice" => $this->input->post("no_invoice", true)))->row();
        $status = $this->input->post("status", true);

        if ($get_invoice->status == $status) {
            return false;
        } else {
            return true;
        }
    }

    function change_status()
    {
        date_default_timezone_set("Asia/Jakarta");
        $status = $this->input->post("status", true);
        $dibayar = $this->input->post("dibayar", true);

        if (isset($_POST["dibayar"])) {
            if ($status == "1") {
                $data = array(
                    "waktu_validasi" => date("Y-m-d H:i:s"),
                    "status" => $status,
                    "dibayar" => $dibayar
                );
            } else {
                $data = array(
                    "status" => $status,
                    "dibayar" => $dibayar
                );
            }
        } else {
            if ($status == "1") {
                $data = array(
                    "waktu_validasi" => date("Y-m-d H:i:s"),
                    "status" => $status
                );
            } else {
                $data = array(
                    "status" => $status
                );
            }
        }

        if ($this->db->update("tbl_invoice", $data, array("no_invoice" => $this->input->post("no_invoice", true)))) {
            return true;
        } else {
            return false;
        }
    }

    function get_invoice()
    {
        $this->db->select("*");
        $this->db->from("tbl_invoice");
        $this->db->order_by("waktu_ditambahkan", "DESC");
        $this->db->join("tbl_user", "tbl_user.user_id = tbl_invoice.user_id");

        return $this->db->get();
    }

    function delete_cart_date()
    {
        date_default_timezone_set("Asia/Jakarta");

        $get_keranjang = $this->db->get("tbl_keranjang");
        $date2 = date_create();

        foreach ($get_keranjang->result() as $k) {
            $date1 = date_create($k->waktu_ditambahkan);
            $diff = date_diff($date1, $date2);

            if ($diff->format("%a") >= 1) {
                $this->db->delete("tbl_keranjang", array("id" => $k->id));
            }
        }
    }

    function cancel_invoice()
    {
        date_default_timezone_set("Asia/Jakarta");

        $invoice = $this->db->get("tbl_invoice");
        $date2 = date_create();

        foreach ($invoice->result() as $i) {
            if ($i->status == 1 and $i->cara_bayar == 1 and $i->jenis_bayar == 2) {
                $tgl_validasi = date("d", strtotime($i->waktu_validasi));
                $bln_validasi = date("m", strtotime($i->waktu_validasi));
                $thn_validasi = date("Y", strtotime($i->waktu_validasi));
                $waktu_validasi = $thn_validasi . "-" . $bln_validasi . "-" . $tgl_validasi;

                $waktu = $this->db->get_where("tbl_waktu", array("waktu_id" => $i->waktu_kirim))->row();
                $waktu_kirim = $waktu->waktu_akhir . ":00";
                $date = $waktu_validasi . " " . $waktu_kirim;

                $date1 = date_create($date);
                $diff = date_diff($date1, $date2);

                if ($diff->format("%a") >= 1) {
                    $data = array(
                        "status" => 2,
                        "waktu_batal" => date("Y-m-d H:i:s")
                    );

                    $this->db->update("tbl_invoice", $data, array("no_invoice" => $i->no_invoice));
                }
            }
        }
    }

    function get_waktu($no_invoice)
    {
        $invoice = $this->db->get_where("tbl_invoice", array("no_invoice" => $no_invoice))->row();
        return $this->db->get_where("tbl_waktu", array("waktu_id" => $invoice->waktu_kirim));
    }

    function get_ongkir($no_invoice)
    {
        $invoice = $this->db->get_where("tbl_invoice", array("no_invoice" => $no_invoice))->row();
        return $this->db->get_where("tbl_ongkir", array("ongkir_id" => $invoice->tempat_kirim));
    }

    function get_detail_invoice_by_tgl($tgl_awal, $tgl_akhir)
    {
        $this->db->select("*");
        $this->db->from("tbl_invoice");
        $this->db->where(array("waktu_ditambahkan >=" => $tgl_awal, "waktu_ditambahkan <=" => $tgl_akhir));
        $this->db->join("tbl_user", "tbl_user.user_id = tbl_invoice.user_id");
        $this->db->order_by("tbl_invoice.no_invoice", "ASC");

        return $this->db->get();
    }
}
