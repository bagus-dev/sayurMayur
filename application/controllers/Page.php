<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
    protected $required = '{field} harus diisi!';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('BarangModel', 'barang');
        $this->load->helper("security");
    }

    public function index()
    {
        $data['title'] = 'Beranda';
        $data['barangs_sayur'] = $this->barang->getBarangSayur();
        $data["keranjang"] = $this->barang->get_keranjang();
        $data["total_harga_keranjang"] = $this->barang->total_harga_cart();

        $data['page'] = true;

        $this->barang->delete_cart_date();
        $this->barang->cancel_invoice();

        $this->load->view('layout/page/header', $data);
        $this->load->view('customer/page/index');
        $this->load->view('layout/dashboard/footer');
    }

    function bumbu()
    {
        $data['title'] = 'Beranda';
        $data['barangs_bumbu'] = $this->barang->getBarangBumbu();
        $data["keranjang"] = $this->barang->get_keranjang();
        $data["total_harga_keranjang"] = $this->barang->total_harga_cart();

        $data['page'] = true;

        $this->barang->delete_cart_date();
        $this->barang->cancel_invoice();

        $this->load->view('layout/page/header', $data);
        $this->load->view('customer/page/bumbu');
        $this->load->view('layout/dashboard/footer');
    }

    function update_stock()
    {
        $barang_kategori_id = $this->input->post('barang_kategori_id', true);

        $this->barang->update_stock($barang_kategori_id);
    }

    function insert_cart()
    {
        $barang_id = $this->input->post("barang_id", TRUE);
        $total_kuantitas = $this->input->post("total_kuantitas", TRUE);
        $total_harga = $this->input->post("total_harga", TRUE);

        date_default_timezone_set("Asia/Jakarta");

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
        $waktu_ditambahkan = date("Y-m-d H:i:s");

        $data = array(
            "barang_id" => $barang_id,
            "total_kuantitas" => $total_kuantitas,
            "total_harga" => $total_harga,
            "ip_address" => $ip_address,
            "waktu_ditambahkan" => $waktu_ditambahkan
        );

        if ($this->db->insert("tbl_keranjang", $data)) {
            $get_barang = $this->db->get_where("tbl_keranjang", array("barang_id" => $barang_id, "total_kuantitas" => $total_kuantitas, "total_harga" => $total_harga, "ip_address" => $ip_address, "waktu_ditambahkan" => $waktu_ditambahkan))->row();
            $get_num_rows = $this->db->get_where("tbl_keranjang", array("ip_address" => $ip_address))->num_rows();
            $barang = $this->db->get_where("tbl_barang", array("barang_id" => $barang_id))->row();

            $response["status"] = 1;
            $response["id"] = $get_barang->id;
            $response["num_rows"] = $get_num_rows;

            $data["id"] = $get_barang->id;
            $data["kuantitas"] = $total_kuantitas;
            $data["subtotal"] = $total_harga;
            $data["nama_barang"] = $barang->barang_nama;
        } else {
            $response["status"] = 0;
        }

        echo json_encode($response);
    }

    function change_kuantitas()
    {
        $total_kuantitas = htmlentities(strip_tags(trim($this->input->post("total_kuantitas", TRUE))));
        $id = $this->input->post("id");

        $get_barang_id = $this->db->get_where("tbl_keranjang", array("id" => $id))->row();
        $cek_harga = $this->db->get_where("tbl_barang", array("barang_id" => $get_barang_id->barang_id))->row();

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

        if ($total_kuantitas <= $cek_harga->barang_stok) {
            $fix_harga = $cek_harga->barang_harjul * $total_kuantitas;

            $data = array(
                "total_kuantitas" => $total_kuantitas,
                "total_harga" => $fix_harga
            );

            if ($this->db->update("tbl_keranjang", $data, array("id" => $id))) {
                $total_harga = $this->db->query("SELECT SUM(`total_harga`) AS total_harga FROM `tbl_keranjang` WHERE `ip_address` = '$ip_address'")->row();

                $response["status"] = 1;
                $response["subtotal"] = $fix_harga;
                $response["total_harga"] = $total_harga->total_harga;
            } else {
                $response["status"] = 0;
            }
        } else {
            $data = array(
                "total_kuantitas" => $cek_harga->barang_stok,
                "total_harga" => $cek_harga->barang_harjul * $cek_harga->barang_stok
            );

            if ($this->db->update("tbl_keranjang", $data, array("id" => $id))) {
                $total_harga = $this->db->query("SELECT SUM(`total_harga`) AS total_harga FROM `tbl_keranjang` WHERE `ip_address` = '$ip_address'")->row();

                $response["subtotal"] = $cek_harga->barang_harjul * $cek_harga->barang_stok;
                $response["status"] = 2;
                $response["stok"] = $cek_harga->barang_stok;
                $response["total_harga"] = $total_harga->total_harga;
            } else {
                $response["status"] = 0;
            }
        }

        echo json_encode($response);
    }

    function change_kuantitas2()
    {
        $id = $this->uri->segment(3);
        $qty = $this->uri->segment(4);

        $keranjang = $this->db->get_where("tbl_keranjang", array("id" => $id))->row();
        $barang = $this->db->get_where("tbl_barang", array("barang_id" => $keranjang->barang_id))->row();
        $total = $barang->barang_harjul * $qty;

        $data = array(
            "total_kuantitas" => $qty,
            "total_harga" => $total
        );

        if ($this->db->update("tbl_keranjang", $data, array("id" => $id))) {
            $response["ok"] = "ok";
        } else {
            $response["error"] = "error";
        }

        echo json_encode($response);
    }

    function get_value()
    {
        $id = $this->input->post("id", true);
        $keranjang = $this->db->get_where("tbl_keranjang", array("id" => $id))->row();

        $response["value"] = $keranjang->total_kuantitas;
        $response["total_harga"] = $keranjang->total_harga;

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
        $total_harga_keranjang = $this->db->query("SELECT SUM(`total_harga`) AS total_harga FROM `tbl_keranjang` WHERE `ip_address` = '$ip_address'")->row();
        $response["total_harga_keranjang"] = $total_harga_keranjang->total_harga;

        echo json_encode($response);
    }

    function cek_kuantitas()
    {
        $id = $this->input->post("id", true);
        $keranjang = $this->db->get_where("tbl_keranjang", array("id" => $id))->row();
        $barang = $this->db->get_where("tbl_barang", array("barang_id" => $keranjang->barang_id))->row();

        $response["total_kuantitas"] = $barang->barang_stok;

        echo json_encode($response);
    }

    function delete_cart($id)
    {
        if ($this->barang->delete_cart($id)) {
            $ip_address = get_client_ip();

            $total_harga = $this->db->query("SELECT SUM(`total_harga`) AS total_harga FROM `tbl_keranjang` WHERE `ip_address` = '$ip_address'")->row();
            $num_rows = $this->db->get_where("tbl_keranjang", array("ip_address" => $ip_address))->num_rows();

            $response["ok"] = "OK";
            $response["total_harga"] = (int)$total_harga->total_harga;
            $response["num_rows"] = $num_rows;
        } else {
            $response["status"] = 0;
        }

        echo json_encode($response);
    }

    function cart()
    {
        $data['title'] = 'Keranjang';
        $data["keranjangs"] = $this->barang->get_keranjang();
        $data["total_harga_keranjang"] = $this->barang->total_harga_cart();
        $this->barang->delete_cart_date();
        $this->barang->cancel_invoice();

        $this->load->view('layout/page/header', $data);
        $this->load->view('customer/page/cart');
        $this->load->view('layout/dashboard/footer');
    }

    function profile()
    {
        if (isset($_SESSION["user_id"])) {
            $data['title'] = 'Profil';
            $data["user"] = $this->barang->get_user();
            $data["invoice"] = $this->barang->get_invoice();
            $data["keranjang"] = $this->barang->get_keranjang();
            $this->barang->delete_cart_date();
            $this->barang->cancel_invoice();

            $this->load->view('layout/page/header', $data);
            $this->load->view('customer/page/profile');
            $this->load->view('layout/dashboard/footer');
        } else {
            redirect(site_url());
        }
    }

    function check_invoice()
    {
        if (isset($_SESSION["user_id"])) {
            if (isset($_GET["no_invoice"])) {
                $no_invoice = $this->input->get("no_invoice", true);

                $data['title'] = 'Detail Invoice';
                $data['detail_invoice'] = $this->barang->get_detail_invoice($no_invoice);
                $data['user'] = $this->barang->get_user();
                $data['checkout'] = $this->barang->get_checkout($no_invoice);
                $data["keranjang"] = $this->barang->get_keranjang();
                $data["ongkir"] = $this->barang->get_ongkir($no_invoice);
                $data["waktu"] = $this->barang->get_waktu($no_invoice);
                $this->barang->delete_cart_date();
                $this->barang->cancel_invoice();

                $this->load->view('layout/page/header', $data);
                $this->load->view('customer/page/check_invoice');
                $this->load->view('layout/dashboard/footer');
            } else {
                redirect(site_url("page/profile"));
            }
        } else {
            redirect(site_url());
        }
    }

    function get_bukti_trf()
    {
        $no_invoice = $this->input->post("no_invoice", true);

        $this->barang->get_bukti_trf($no_invoice);
    }
}
