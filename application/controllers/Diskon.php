<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diskon extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_role_id')) {
            redirect(site_url('auth'));
        };

        $this->load->model('DiskonModel', 'diskon');
    }

    public function index()
    {
        $this->form_validation->set_rules('type', 'Type', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Diskon';
            $data['diskons'] = $this->diskon->getDiskon();

            $data['datable'] = true;
            $data['concurency'] = true;
            $data['diskon'] = true;

            $this->load->view('layout/dashboard/header', $data);
            $this->load->view('admin/diskon/index');
            $this->load->view('layout/dashboard/footer');
        } else {
            $type = $this->input->post('type', true);
            $diskon_id = htmlspecialchars($this->input->post('diskon_id', true));
            $diskon_harga = htmlspecialchars(str_replace(',', '', $this->input->post('diskon_harga', true)));
            $diskon_persen = htmlspecialchars(str_replace(',', '', $this->input->post('diskon_persen', true)));

            if ($type === 'add') {
                $this->diskon->addDiskon($diskon_harga, $diskon_persen);
            } else if ($type === 'edit') {
                $this->diskon->editDiskon($diskon_id, $diskon_harga, $diskon_persen);
            } else if ($type === 'delete') {
                $this->diskon->deleteDiskon($diskon_id);
            }
        }
    }

    public function show()
    {
        echo json_encode($this->diskon->getDiskon($this->input->post('diskon_id'))->row());
    }
}
