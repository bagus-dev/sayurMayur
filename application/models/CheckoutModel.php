<?php
class CheckoutModel extends CI_Model
{
    // Mengambil data Keranjang
    function get_keranjang($ip_address)
    {
        $this->db->select("tbl_barang.barang_nama,tbl_keranjang.total_kuantitas,tbl_keranjang.total_harga,tbl_keranjang.id,tbl_satuan.satuan_nama,tbl_barang.barang_gambar");
        $this->db->from("tbl_keranjang");
        $this->db->where(array("ip_address" => $ip_address));
        $this->db->join("tbl_barang", "tbl_barang.barang_id = tbl_keranjang.barang_id");
        $this->db->join("tbl_satuan", "tbl_satuan.satuan_id = tbl_barang.barang_satuan_id");

        return $this->db->get();
    }

    // Mengambil total harga Keranjang
    function total_harga_cart($ip_address)
    {
        return $this->db->query("SELECT SUM(`total_harga`) AS total_harga FROM `tbl_keranjang` WHERE `ip_address` = '$ip_address'");
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

    function get_user()
    {
        return $this->db->get_where("tbl_user", array("user_id" => $this->session->userdata("user_id")));
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

    function get_ongkir_1()
    {
        return $this->db->get("tbl_ongkir", 1);
    }

    function get_ongkir_2()
    {
        return $this->db->get("tbl_ongkir", 10, 1);
    }

    function get_waktu()
    {
        return $this->db->get("tbl_waktu");
    }

    function cek_trf()
    {
        $config["upload_path"] = "./assets/source/images/bukti_transfer/";
        $config["allowed_types"] = "jpg|jpeg|png";
        $config["max_size"] = 512;

        $this->load->library("upload", $config);

        if (!$this->upload->do_upload("bukti_trf")) {
            $response["status"] = 0;
            $response["pesan"] = $this->upload->display_errors();
        } else {
            $response["status"] = 1;
            $response["foto"] = $this->upload->data("file_name");
        }

        echo json_encode($response);
    }
}
