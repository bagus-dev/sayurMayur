<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Penjualanonline extends CI_Controller {
        function __construct() {
            parent::__construct();
            $this->load->model('OnlineModel', 'online');
        }

        function index() {
            if($this->session->userdata("user_role_id") == '1') {
                $data['title'] = 'Transaksi Penjualan Online';
                $data['detail_invoice_selesai'] = $this->online->get_detail_invoice_selesai();
                $data['detail_invoice_valid'] = $this->online->get_detail_invoice_valid();
                $data['detail_invoice_invalid'] = $this->online->get_detail_invoice_invalid();
                $data['detail_invoice_belum_bayar'] = $this->online->get_detail_invoice_belum_bayar();
                $data['detail_invoice_batal'] = $this->online->get_detail_invoice_batal();
                $this->online->delete_cart_date();
                $this->online->cancel_invoice();

                $data['datable'] = true;
                $data['penjualanonline'] = true;

                $this->load->view('layout/dashboard/header', $data);
                $this->load->view('admin/penjualan_online/index');
                $this->load->view('layout/dashboard/footer');
            }
            else {
                redirect(site_url('auth'));
            }
        }

        function detail_invoice($no_invoice) {
            if($this->session->userdata("user_role_id") == '1') {
                $data['title'] = 'Detail Invoice';
                $data['detail_invoice'] = $this->online->get_detail_invoice($no_invoice);
                $data['checkout'] = $this->online->get_checkout($no_invoice);
                $data['user'] = $this->online->get_user_invoice($no_invoice);

                $data['detailinvoice'] = true;

                $this->load->view('layout/dashboard/header', $data);
                $this->load->view('admin/penjualan_online/detail_invoice');
                $this->load->view('layout/dashboard/footer');
            }
            else {
                redirect(site_url('auth'));
            }
        }

        function cek_status() {
            if($this->online->cek_status()) {
                echo "OK";
            }
            else {
                echo "gagal";
            }
        }

        function change_status() {
            if($this->online->change_status()) {
                echo "OK";
            }
            else {
                echo "gagal";
            }
        }

        function laporan() {
            if($this->session->userdata("user_role_id") == '1') {
                $data['title'] = 'Laporan Penjualan Online';
                $data['invoice_laporan'] = $this->online->get_invoice();

                $data['datable'] = true;
                $data['laporanpenjualanonline'] = true;

                $this->load->view('layout/dashboard/header', $data);
                $this->load->view('admin/penjualan_online/laporan');
                $this->load->view('layout/dashboard/footer');
            }
            else {
                redirect(site_url('auth'));
            }
        }

        function cetak_struk($no_invoice) {
            if($this->session->userdata("user_role_id") == '1') {
                $data['detail_invoice'] = $this->online->get_detail_invoice($no_invoice);
                $data['checkout'] = $this->online->get_checkout($no_invoice);
                $data['user'] = $this->online->get_user_invoice($no_invoice);

                $this->load->view('admin/penjualan_online/cetak_struk',$data);
            }
            else {
                redirect(site_url('auth'));
            }
        }
    }
?>