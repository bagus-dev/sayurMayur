<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Penjualanonline extends CI_Controller {
        function __construct() {
            parent::__construct();
            $this->load->model('OnlineModel', 'online');
        }

        function index() {
            if($this->session->userdata("user_role_id") == '1') {
                $data['title'] = 'Transaksi Penjualan';
                $data['detail_invoice_selesai'] = $this->online->get_detail_invoice_selesai();
                $data['detail_invoice_valid'] = $this->online->get_detail_invoice_valid();
                $data['detail_invoice_invalid'] = $this->online->get_detail_invoice_invalid();
                $data['detail_invoice_belum_bayar'] = $this->online->get_detail_invoice_belum_bayar();
                $data['detail_invoice_batal'] = $this->online->get_detail_invoice_batal();

                $data['datable'] = true;

                $this->load->view('layout/dashboard/header', $data);
                $this->load->view('admin/penjualan_online/index');
                $this->load->view('layout/dashboard/footer');
            }
            else {
                redirect(site_url('auth'));
            }
        }
    }
?>