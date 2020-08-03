<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Suplier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_role_id')) {
            redirect(site_url('auth'));
        };

        $this->load->model('SuplierModel', 'suplier');
    }

    public function index()
    {
        $this->form_validation->set_rules('type', 'Type', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Suplier';
            $data['supliers'] = $this->suplier->getSuplier();

            $data['datable'] = true;
            $data['suplier'] = true;

            $this->load->view('layout/dashboard/header', $data);
            $this->load->view('admin/suplier/index');
            $this->load->view('layout/dashboard/footer');
        } else {
            $type = $this->input->post('type', true);
            $suplier_id = $this->input->post('suplier_id', true);
            $suplier_nama = $this->input->post('suplier_nama', true);
            $suplier_alamat = $this->input->post('suplier_alamat', true);
            $suplier_notelp = $this->input->post('suplier_notelp', true);

            if ($type === 'add') {
                $this->suplier->addSuplier($suplier_nama, $suplier_alamat, $suplier_notelp);
            } else if ($type === 'edit') {
                $this->suplier->editSuplier($suplier_id, $suplier_nama, $suplier_alamat, $suplier_notelp);
            } else if ($type === 'delete') {
                $this->suplier->deleteSuplier($suplier_id);
            }
        }
    }

    public function show()
    {
        echo json_encode($this->suplier->getSuplier($this->input->post('suplier_id'))->row());
    }
}
