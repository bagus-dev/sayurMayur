<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ongkir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_role_id')) {
            redirect(site_url('auth'));
        };

        $this->load->model('OngkirModel', 'ongkir');
    }

    public function index()
    {
        $this->form_validation->set_rules('type', 'Type', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Ongkos Kirim';
            $data['ongkirs'] = $this->ongkir->getOngkir();

            $data['datable'] = true;
            $data['concurency'] = true;
            $data['ongkir'] = true;

            $this->load->view('layout/dashboard/header', $data);
            $this->load->view('admin/ongkir/index');
            $this->load->view('layout/dashboard/footer');
        } else {
            $type = $this->input->post('type', true);
            $ongkir_id = htmlspecialchars($this->input->post('ongkir_id', true));
            $ongkir_lokasi = htmlspecialchars($this->input->post('ongkir_lokasi', true));
            $ongkir_harga = htmlspecialchars(str_replace(',', '', $this->input->post('ongkir_harga', true)));

            if ($type === 'add') {
                $this->ongkir->addOngkir($ongkir_lokasi, $ongkir_harga);
            } else if ($type === 'edit') {
                $this->ongkir->editOngkir($ongkir_id, $ongkir_lokasi, $ongkir_harga);
            } else if ($type === 'delete') {
                $this->ongkir->deleteOngkir($ongkir_id);
            }
        }
    }

    public function show()
    {
        echo json_encode($this->ongkir->getOngkir($this->input->post('ongkir_id'))->row());
    }
}
