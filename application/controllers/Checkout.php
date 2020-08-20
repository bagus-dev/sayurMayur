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
                $data["title"] = "Checkout Barang";
                $data["keranjang"] = $this->check->get_keranjang();
                $data["total_harga_keranjang"] = $this->check->total_harga_cart();
                $data["user"] = $this->check->get_user();
                $data["ongkir"] = $this->check->get_ongkir();
                $this->check->delete_cart_date();

                $this->load->view('layout/checkout/header', $data);
                $this->load->view('customer/checkout/index');
                $this->load->view('layout/checkout/footer');
            }
            else {
                $this->session->set_flashdata('message', $this->_alert('Harap Login Terlebih Dahulu!', 'danger'));

                redirect(site_url("auth?checkout"));
            }
        }
    }
?>