<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('BarangModel', 'barang');
        $this->load->model('KategoriModel', 'kategori');
        $this->load->model('SatuanModel', 'satuan');

        if (!$this->session->userdata('user_role_id')) {
            redirect(site_url('auth'));
        };
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['barangs'] = $this->barang->getBarang(null, 10);

        $this->load->view('layout/dashboard/header', $data);
        $this->load->view('admin/dashboard/index');
        $this->load->view('layout/dashboard/footer');
    }
}
