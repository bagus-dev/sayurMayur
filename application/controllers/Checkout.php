<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Checkout extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->model('CheckoutModel', 'check');
        }

        protected function _alert($message, $type = 'success')
        {
            return '<div class="alert alert-' . $type . ' alert-dismissible show" role="alert">'
                . $message .
                '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }

        public function index() {
            if(isset($_SESSION["user_id"])) {
                function get_client_ip() {
                    $ipaddress = '';
                    if (isset($_SERVER['HTTP_CLIENT_IP']))
                        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    else if(isset($_SERVER['HTTP_X_FORWARDED']))
                        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                    else if(isset($_SERVER['HTTP_FORWARDED']))
                        $ipaddress = $_SERVER['HTTP_FORWARDED'];
                    else if(isset($_SERVER['REMOTE_ADDR']))
                        $ipaddress = $_SERVER['REMOTE_ADDR'];
                    else
                        $ipaddress = 'UNKNOWN';
                    return $ipaddress;
                }
                $ip_address = get_client_ip();

                $get_keranjang = $this->db->get_where("tbl_keranjang",array("ip_address" => $ip_address))->num_rows();

                if($get_keranjang > 0) {
                    $data["title"] = "Checkout Barang";
                    $data["keranjang"] = $this->check->get_keranjang($ip_address);
                    $data["total_harga_keranjang"] = $this->check->total_harga_cart($ip_address);
                    $data["user"] = $this->check->get_user();
                    $data["ongkir_1"] = $this->check->get_ongkir_1();
                    $data["ongkir_2"] = $this->check->get_ongkir_2();
                    $data["waktu"] = $this->check->get_waktu();
                    $this->check->delete_cart_date();
                    $this->check->cancel_invoice();

                    $this->load->view('layout/checkout/header', $data);
                    $this->load->view('customer/checkout/index');
                    $this->load->view('layout/checkout/footer');
                }
                else {
                    redirect(site_url());
                }
            }
            else {
                $this->session->set_flashdata('message', $this->_alert('Harap Login Terlebih Dahulu!', 'danger'));

                redirect(site_url("auth?checkout"));
            }
        }

        function insert_invoice() {
            date_default_timezone_set("Asia/Jakarta");

            function get_client_ip() {
                $ipaddress = '';
                if (isset($_SERVER['HTTP_CLIENT_IP']))
                    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                else if(isset($_SERVER['HTTP_X_FORWARDED']))
                    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                else if(isset($_SERVER['HTTP_FORWARDED']))
                    $ipaddress = $_SERVER['HTTP_FORWARDED'];
                else if(isset($_SERVER['REMOTE_ADDR']))
                    $ipaddress = $_SERVER['REMOTE_ADDR'];
                else
                    $ipaddress = 'UNKNOWN';
                return $ipaddress;
            }
            $ip_address = get_client_ip();

            $get_invoice = $this->db->get('tbl_invoice');

            if($get_invoice->num_rows() == 0) {
                $no_invoice = "SM000001";
            }
            else {
                $query_invoice = $this->db->query("SELECT MAX(RIGHT(no_invoice,6)) AS invoice_max FROM tbl_invoice")->row();

                $last_invoice = ((int)$query_invoice->invoice_max) + 1;
                $kode = sprintf("%06s",$last_invoice);
                $no_invoice = "SM".$kode;
            }

            $get_keranjang = $this->db->get_where('tbl_keranjang', array("ip_address" => $ip_address))->result();

            foreach($get_keranjang as $k) {
                $data = array(
                    "no_invoice" => $no_invoice,
                    "barang_id" => $k->barang_id,
                    "kuantitas" => $k->total_kuantitas,
                    "subtotal" => $k->total_harga
                );

                if($this->db->insert("tbl_checkout",$data)) {
                    $barang = $this->db->get_where("tbl_barang",array("barang_id" => $k->barang_id))->row();
                    $stok = $barang->barang_stok - $k->total_kuantitas;

                    $update = array(
                        "barang_stok" => $stok
                    );

                    $this->db->update("tbl_barang",$update,array("barang_id" => $k->barang_id));
                }
            }

            $cara_bayar = $this->input->get("cara_bayar",true);
            $total_harga = $this->db->query("SELECT SUM(`total_harga`) AS total_harga FROM `tbl_keranjang` WHERE `ip_address` = '$ip_address'")->row();
            $jenis_bayar = $this->input->get("jenis_bayar",true);

            if($cara_bayar == 1) {
                if($jenis_bayar == "1") {
                    $data2 = array(
                        "no_invoice" => $no_invoice,
                        "user_id" => $this->session->userdata("user_id"),
                        "cara_bayar" => $cara_bayar,
                        "waktu_kirim" => $this->input->get("waktu_kirim",true),
                        "jenis_bayar" => $this->input->get("jenis_bayar",true),
                        "total_bayar" => $total_harga->total_harga,
                        "bukti_transfer" => $this->input->get("bukti_trf",true),
                        "status" => 0,
                        "waktu_ditambahkan" => date("Y-m-d H:i:s")
                    );
                }
                else {
                    $data2 = array(
                        "no_invoice" => $no_invoice,
                        "user_id" => $this->session->userdata("user_id"),
                        "cara_bayar" => $cara_bayar,
                        "waktu_kirim" => $this->input->get("waktu_kirim",true),
                        "jenis_bayar" => $this->input->get("jenis_bayar",true),
                        "total_bayar" => $total_harga->total_harga,
                        "status" => 0,
                        "waktu_ditambahkan" => date("Y-m-d H:i:s")
                    );
                }
            }
            else if($cara_bayar == 2) {
                $ongkir = $this->db->get_where("tbl_ongkir", array("ongkir_id" => $this->input->get("tempat_kirim")))->row();
                $fix_total = $total_harga->total_harga + $ongkir->ongkir_harga;

                if($jenis_bayar == "1") {
                    $data2 = array(
                        "no_invoice" => $no_invoice,
                        "user_id" => $this->session->userdata("user_id"),
                        "cara_bayar" => $cara_bayar,
                        "tempat_kirim" => $this->input->get("tempat_kirim",true),
                        "waktu_kirim" => $this->input->get("waktu_kirim",true),
                        "detail_kirim" => $this->input->get("detail_kirim",true),
                        "jenis_bayar" => $this->input->get("jenis_bayar",true),
                        "total_bayar" => $fix_total,
                        "bukti_transfer" => $this->input->get("bukti_trf",true),
                        "status" => 0,
                        "waktu_ditambahkan" => date("Y-m-d H:i:s")
                    );
                }
                else {
                    $data2 = array(
                        "no_invoice" => $no_invoice,
                        "user_id" => $this->session->userdata("user_id"),
                        "cara_bayar" => $cara_bayar,
                        "tempat_kirim" => $this->input->get("tempat_kirim",true),
                        "waktu_kirim" => $this->input->get("waktu_kirim",true),
                        "detail_kirim" => $this->input->get("detail_kirim",true),
                        "jenis_bayar" => $this->input->get("jenis_bayar",true),
                        "total_bayar" => $fix_total,
                        "status" => 0,
                        "waktu_ditambahkan" => date("Y-m-d H:i:s")
                    );
                }
            }

            if($this->db->insert("tbl_invoice",$data2)) {
                if($this->db->delete("tbl_keranjang", array("ip_address" => $ip_address))) {
                    $response["ok"] = "OK";
                    $response["no_invoice"] = $no_invoice;
                }
                else {
                    $response["status"] = 0;
                }
            }
            else {
                $response["status"] = 0;
            }

            echo json_encode($response);
        }

        function cek_trf() {
            $this->check->cek_trf();
        }

        function delete_trf() {
            $gambar_trf = $this->input->get("gambar_trf");

            $file = "./assets/source/images/bukti_transfer/".$gambar_trf;

            if(unlink($file)) {
                $response["ok"] = "oke";
            }
            else {
                $response["status"] = 0;
            }

            echo json_encode($response);
        }
    }
?>