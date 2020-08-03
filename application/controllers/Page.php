<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BarangModel', 'barang');
    }

    public function index()
    {
        $data['title'] = 'Beranda';
        $data['barangs'] = $this->barang->getBarang();

        $this->load->view('layout/page/header', $data);
        $this->load->view('customer/page/index');
        $this->load->view('layout/dashboard/footer');
    }
}
