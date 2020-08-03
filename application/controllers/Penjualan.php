<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_role_id')) {
            redirect(site_url('auth'));
        };

        $this->load->model('PenjualanModel', 'penjualan');
    }

    public function laporan()
    {
        $data['title'] = 'Laporan Penjualan';
        $data['penjualans'] = $this->penjualan->getPenjualan();

        $data['datable'] = true;

        $this->load->view('layout/dashboard/header', $data);
        $this->load->view('admin/penjualan/laporan');
        $this->load->view('layout/dashboard/footer');
    }

    public function laporan_detail($jual_nofak)
    {
        $data['title'] = 'Detail Penjualan';
        $data['penjualan'] = $this->penjualan->getPenjualan($jual_nofak)->row();
        $data['details'] = $this->penjualan->getPenjualan($jual_nofak);

        $data['datable'] = true;

        $this->load->view('layout/dashboard/header', $data);
        $this->load->view('admin/penjualan/laporan_detail');
        $this->load->view('layout/dashboard/footer');
    }
}
