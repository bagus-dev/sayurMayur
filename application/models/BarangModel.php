<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangModel extends CI_Model
{
    // Menampilkan Alert Pada Model ini
    protected function _alert($message, $type = 'success')
    {
        return '<div class="alert alert-' . $type . ' alert-dismissible show" role="alert">'
            . $message .
            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }

    // Generate barang_id/kode barang unuk di insert kedalam table barang
    public function _barid()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(barang_id,6)) AS kd_max FROM tbl_barang");
        $kd = "";

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }

        return "BR" . $kd;
    }

    // Upload gambar baik untuk add atau edit
    public function _uploadImage($type, $barang_gambar = null)
    {
        $config['upload_path']          = './assets/source/images/barang';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = ($barang_gambar !== null) ? $barang_gambar : $this->_barid();
        $config['overwrite']            = true;
        $config['max_size']             = 16384;

        $this->load->library('upload', $config);

        // Jika add
        if ($type === 'add') {
            if ($this->upload->do_upload('barang_gambar')) {
                return $this->upload->data("file_name");
            } else {
                $this->session->set_flashdata('message', $this->_alert($this->upload->display_errors()));
            }

            return "default.png";

            // Jika Edit
        } else if ($type === 'edit') {
            if ($this->upload->do_upload('barang_gambar')) {
                if ($barang_gambar != 'default.png') {
                    unlink(FCPATH . 'assets/images/barang' . $barang_gambar);
                }

                return $this->upload->data("file_name");
            } else {
                $this->session->set_flashdata('message', $this->_alert($this->upload->display_errors()));
            }
        }
    }

    // Menampilkan semua barang dan juga bisa menampilkan barang dengan barang_id/kode barang
    public function getBarang($barang_id = null, $qty = null)
    {
        if ($qty !== null) {
            $hsl = $this->db->query("SELECT * FROM tbl_barang JOIN tbl_kategori ON barang_kategori_id=kategori_id JOIN tbl_satuan ON barang_satuan_id=satuan_id WHERE barang_stok <= $qty");
        } else if ($barang_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_barang JOIN tbl_kategori ON barang_kategori_id=kategori_id JOIN tbl_satuan ON barang_satuan_id=satuan_id ORDER BY barang_stok ASC");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_barang JOIN tbl_kategori ON barang_kategori_id=kategori_id JOIN tbl_satuan ON barang_satuan_id=satuan_id WHERE barang_id = '$barang_id'");
        }

        return $hsl;
    }

    public function getBarangSayur($barang_id = null)
    {
        if ($barang_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_barang JOIN tbl_kategori ON barang_kategori_id=kategori_id JOIN tbl_satuan ON barang_satuan_id=satuan_id WHERE barang_kategori_id = 1 ORDER BY barang_id ASC");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_barang JOIN tbl_kategori ON barang_kategori_id=kategori_id JOIN tbl_satuan ON barang_satuan_id=satuan_id WHERE barang_id = '$barang_id' AND barang_kategori_id = 1");
        }

        return $hsl;
    }

    public function getBarangBumbu($barang_id = null)
    {
        if ($barang_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_barang JOIN tbl_kategori ON barang_kategori_id=kategori_id JOIN tbl_satuan ON barang_satuan_id=satuan_id WHERE barang_kategori_id = 2 ORDER BY barang_id ASC");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_barang JOIN tbl_kategori ON barang_kategori_id=kategori_id JOIN tbl_satuan ON barang_satuan_id=satuan_id WHERE barang_id = '$barang_id' AND barang_kategori_id = 2");
        }

        return $hsl;
    }

    // Menambah Barang
    function addBarang($barang_id, $barang_gambar, $barang_nama, $barang_harpok, $barang_harjul, $barang_harjul_grosir, $barang_stok, $barang_kategori_id, $barang_satuan_id)
    {
        $barang_user_id = $this->session->userdata('user_id');

        $this->db->query("INSERT INTO tbl_barang (barang_id, barang_gambar, barang_nama, barang_harpok, barang_harjul, barang_harjul_grosir, barang_stok, barang_kategori_id, barang_satuan_id, barang_user_id) VALUES ('$barang_id', '$barang_gambar', ' $barang_nama','$barang_harpok','$barang_harjul','$barang_harjul_grosir','$barang_stok','$barang_kategori_id','$barang_satuan_id', '$barang_user_id')");

        $this->session->set_flashdata('message', $this->_alert('Barang berhasil disimpan!'));

        redirect(site_url('barang'));
    }

    // Mengubah Barang
    function editBarang($barang_id, $barang_gambar, $barang_nama, $barang_harpok, $barang_harjul, $barang_harjul_grosir, $barang_stok, $barang_kategori_id, $barang_satuan_id)
    {
        $barang_user_id = $this->session->userdata('user_id');

        $this->db->query("UPDATE tbl_barang SET barang_gambar='$barang_gambar',barang_nama='$barang_nama',barang_harpok='$barang_harpok',barang_harjul='$barang_harjul',barang_harjul_grosir='$barang_harjul_grosir',barang_stok='$barang_stok',barang_tgl_last_update=NOW(),barang_kategori_id='$barang_kategori_id',barang_satuan_id='$barang_satuan_id',barang_user_id='$barang_user_id' WHERE barang_id='$barang_id'");

        $this->session->set_flashdata('message', $this->_alert('Barang berhasil diedit!'));

        redirect(site_url('barang'));
    }

    // Menghapus Barang
    function deletebarang($barang_id, $barang_gambar)
    {
        if ($barang_gambar !== 'default.png') {
            $barang_gambar = explode(".", $barang_gambar)[0];
            array_map('unlink', glob(FCPATH . "assets/source/images/barang/$barang_gambar.*"));
        }

        $this->db->query("DELETE FROM tbl_barang where barang_id='$barang_id'");

        $this->session->set_flashdata('message', $this->_alert('Barang berhasil dihapus!'));

        redirect(site_url('barang'));
    }

    // Mengambil data Keranjang
    function get_keranjang()
    {
        function get_client_ip()
        {
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if (isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if (isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if (isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }
        $ip_address = get_client_ip();

        $this->db->select("tbl_barang.barang_nama,tbl_keranjang.total_kuantitas,tbl_keranjang.total_harga,tbl_keranjang.id");
        $this->db->from("tbl_keranjang");
        $this->db->where(array("ip_address" => $ip_address));
        $this->db->join("tbl_barang", "tbl_barang.barang_id = tbl_keranjang.barang_id");

        return $this->db->get();
    }

    // Mengambil total harga Keranjang
    function total_harga_cart()
    {
        $ip_address = get_client_ip();

        return $this->db->query("SELECT SUM(`total_harga`) AS total_harga FROM `tbl_keranjang` WHERE `ip_address` = '$ip_address'");
    }

    // Menghapus barang di Keranjang
    function delete_cart($id)
    {
        function get_client_ip()
        {
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if (isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if (isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if (isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }
        $ip_address = get_client_ip();

        if ($this->db->delete("tbl_keranjang", array("id" => $id, "ip_address" => $ip_address))) {
            return true;
        } else {
            return false;
        }
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
            if($i->status == 1) {
                $tgl_validasi = date("d",strtotime($i->waktu_validasi));
                $bln_validasi = date("m",strtotime($i->waktu_validasi));
                $thn_validasi = date("Y",strtotime($i->waktu_validasi));
                $waktu_validasi = $thn_validasi."-".$bln_validasi."-".$tgl_validasi;

                $waktu = $this->db->get_where("tbl_waktu",array("waktu_id" => $i->waktu_kirim))->row();
                $waktu_kirim = $waktu->waktu_akhir.":00";
                $date = $waktu_validasi." ".$waktu_kirim;

                $date1 = date_create($date);
                $diff = date_diff($date1,$date2);

                if($diff->format("%a") >= 1) {
                    $data = array(
                        "status" => 2
                    );

                    $this->db->update("tbl_invoice",$data,array("no_invoice" => $i->no_invoice));
                }
            }
        }
    }

    function get_user()
    {
        return $this->db->get_where("tbl_user", array("user_id" => $this->session->userdata("user_id")));
    }

    function get_invoice()
    {
        $this->db->select("*");
        $this->db->from("tbl_invoice");
        $this->db->where(array("user_id" => $this->session->userdata("user_id")));
        $this->db->order_by("waktu_ditambahkan", "DESC");

        return $this->db->get();
    }

    function get_detail_invoice($no_invoice)
    {
        return $this->db->get_where("tbl_invoice", array("no_invoice" => $no_invoice));
    }

    function get_checkout($no_invoice)
    {
        $this->db->select("tbl_checkout.barang_id,tbl_checkout.kuantitas,tbl_checkout.subtotal,tbl_barang.barang_nama,tbl_barang.barang_harjul");
        $this->db->from("tbl_checkout");
        $this->db->where(array("no_invoice" => $no_invoice));
        $this->db->join("tbl_barang", "tbl_barang.barang_id = tbl_checkout.barang_id");

        return $this->db->get();
    }

    function upload_trf()
    {
        $no_invoice = $this->input->get("no_invoice", true);

        $config['upload_path'] = './assets/source/images/bukti_transfer/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 500;

        $this->load->library("upload", $config);

        if (!$this->upload->do_upload("bukti_trf")) {
            $this->session->set_flashdata('message', $this->_alert($this->upload->display_errors(), 'danger'));

            redirect(site_url('page/upload_trf?no_invoice=' . $no_invoice));
        } else {
            $bukti_transfer = $this->upload->data("file_name");

            $data = array(
                "bukti_transfer" => $bukti_transfer
            );

            if ($this->db->update("tbl_invoice", $data, array("no_invoice" => $no_invoice))) {
                redirect(site_url('page/profile?upload_trf'));
            }
        }
    }

    function get_bukti_trf($no_invoice)
    {
        $get_invoice = $this->db->get_where("tbl_invoice", array("no_invoice" => $no_invoice))->row();

        echo '
            <div class="modal-header">
                <h4 class="modal-title">Bukti Transfer No. Invoice ' . $no_invoice . '</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <img src="' . base_url() . 'assets/source/images/bukti_transfer/' . $get_invoice->bukti_transfer . '" alt="Bukti Transfer" class="img-fluid img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        ';
    }

    function update_stock($barang_kategori_id)
    {
        $get_barang = $this->db->get_where("tbl_barang", array("barang_kategori_id" => $barang_kategori_id));
        $json["data"] = array();

        foreach ($get_barang->result() as $b) {
            $data["stok"] = $b->barang_stok;

            array_push($json["data"], $data);
        }

        echo json_encode($json);
    }

    function get_ongkir($no_invoice) {
        $invoice = $this->db->get_where("tbl_invoice",array("no_invoice" => $no_invoice))->row();
        return $this->db->get_where("tbl_ongkir",array("ongkir_id" => $invoice->tempat_kirim));
    }

    function get_waktu($no_invoice) {
        $invoice = $this->db->get_where("tbl_invoice",array("no_invoice" => $no_invoice))->row();
        return $this->db->get_where("tbl_waktu",array("waktu_id" => $invoice->waktu_kirim));
    }
}
