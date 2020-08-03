<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_role_id')) {
            redirect(site_url('auth'));
        };

        $this->load->model('SatuanModel', 'satuan');
    }

    public function index()
    {
        $this->form_validation->set_rules('type', 'Type', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Satuan';
            $data['satuans'] = $this->satuan->getSatuan();

            $data['datable'] = true;
            $data['satuan'] = true;

            $this->load->view('layout/dashboard/header', $data);
            $this->load->view('admin/satuan/index');
            $this->load->view('layout/dashboard/footer');
        } else {
            $type = $this->input->post('type', true);
            $satuan_nama = htmlspecialchars($this->input->post('satuan_nama', true));
            $satuan_id = htmlspecialchars($this->input->post('satuan_id', true));

            if ($type === 'add') {
                $this->satuan->addSatuan($satuan_nama);
            } else if ($type === 'edit') {
                $this->satuan->editSatuan($satuan_id, $satuan_nama);
            } else if ($type === 'delete') {
                $this->satuan->deleteSatuan($satuan_id);
            }
        }
    }

    public function show()
    {
        echo json_encode($this->satuan->getSatuan($this->input->post('satuan_id'))->row());
    }
}
