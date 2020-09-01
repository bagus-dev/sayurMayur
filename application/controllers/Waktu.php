<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Waktu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_role_id')) {
            redirect(site_url('auth'));
        };

        $this->load->model('WaktuModel', 'waktu');
    }

    public function index()
    {
        $this->form_validation->set_rules('type', 'Type', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Waktu';
            $data['waktus'] = $this->waktu->getWaktu();

            $data['datable'] = true;
            $data['waktu'] = true;

            $this->load->view('layout/dashboard/header', $data);
            $this->load->view('admin/waktu/index');
            $this->load->view('layout/dashboard/footer');
        } else {
            $type = $this->input->post('type', true);
            $waktu_id = htmlspecialchars($this->input->post('waktu_id', true));
            $waktu_nama = htmlspecialchars($this->input->post('waktu_nama', true));
            $waktu_awal = htmlspecialchars($this->input->post('waktu_awal', true));
            $waktu_akhir = htmlspecialchars($this->input->post('waktu_akhir', true));

            if ($type === 'add') {
                $this->waktu->addWaktu($waktu_nama, $waktu_awal, $waktu_akhir);
            } else if ($type === 'edit') {
                $this->waktu->editWaktu($waktu_id, $waktu_nama, $waktu_awal, $waktu_akhir);
            } else if ($type === 'delete') {
                $this->waktu->deleteWaktu($waktu_id);
            }
        }
    }

    public function show()
    {
        echo json_encode($this->waktu->getWaktu($this->input->post('waktu_id'))->row());
    }
}
