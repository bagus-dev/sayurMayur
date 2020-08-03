<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_role_id')) {
            redirect(site_url('auth'));
        };

        $this->load->model('KategoriModel', 'kategori');
    }

    public function index()
    {
        $this->form_validation->set_rules('type', 'Type', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Kategori';
            $data['kategoris'] = $this->kategori->getKategori();

            $data['datable'] = true;
            $data['kategori'] = true;

            $this->load->view('layout/dashboard/header', $data);
            $this->load->view('admin/kategori/index');
            $this->load->view('layout/dashboard/footer');
        } else {
            $type = $this->input->post('type', true);
            $kategori_nama = htmlspecialchars($this->input->post('kategori_nama', true));
            $kategori_id = htmlspecialchars($this->input->post('kategori_id', true));

            if ($type === 'add') {
                $this->kategori->addKategori($kategori_nama);
            } else if ($type === 'edit') {
                $this->kategori->editKategori($kategori_id, $kategori_nama);
            } else if ($type === 'delete') {
                $this->kategori->deleteKategori($kategori_id);
            }
        }
    }

    public function show()
    {
        echo json_encode($this->kategori->getKategori($this->input->post('kategori_id'))->row());
    }
}
