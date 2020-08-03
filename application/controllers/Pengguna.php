<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_role_id')) {
            redirect(site_url('auth'));
        };

        $this->load->model('PenggunaModel', 'pengguna');
        $this->load->model('RoleModel', 'role');
    }

    public function index()
    {
        $this->form_validation->set_rules('type', 'Type', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pengguna';
            $data['penggunas'] = $this->pengguna->getPengguna();
            $data['roles'] = $this->role->getRole();

            $data['datable'] = true;
            $data['pengguna'] = true;

            $this->load->view('layout/dashboard/header', $data);
            $this->load->view('admin/pengguna/index');
            $this->load->view('layout/dashboard/footer');
        } else {
            $type = $this->input->post('type', true);
            $user_id = $this->input->post('user_id', true);
            $user_nama = $this->input->post('user_nama', true);
            $user_alamat = $this->input->post('user_alamat', true);
            $user_username = $this->input->post('user_username', true);
            $user_password = htmlspecialchars($this->input->post('user_password', true));
            $user_password_repeat = htmlspecialchars($this->input->post('user_password_repeat', true));
            $user_role_id = $this->input->post('user_role_id', true);

            $password_hash = password_hash($user_password, PASSWORD_DEFAULT);

            if ($type === 'add') {
                if ($user_password === '' || $user_password_repeat === '') {
                    $alert = $this->pengguna->_alert('Password dan ulangi Password harus di isi!', 'danger');
                    $this->session->set_flashdata('message', $alert);
                    redirect(site_url('pengguna'));
                } else if ($user_password <> $user_password_repeat) {
                    $alert = $this->pengguna->_alert('Password dan ulangi Password tidak sama!', 'danger');
                    $this->session->set_flashdata('message', $alert);
                    redirect(site_url('pengguna'));
                } else {
                    $this->pengguna->addPengguna($user_nama, $user_alamat, $user_username, $password_hash, $user_role_id);
                }
            } else if ($type === 'edit') {
                if ($user_password === '' || $user_password_repeat === '') {
                    $this->pengguna->editPengguna($user_id, $user_alamat, $user_nama, $user_username, null, $user_role_id);
                } else if ($user_password <> $user_password_repeat) {
                    $alert = $this->pengguna->_alert('Password dan ulangi Password tidak sama!', 'danger');
                    $this->session->set_flashdata('message', $alert);
                    redirect(site_url('pengguna'));
                } else {
                    $this->pengguna->editPengguna($user_id, $user_alamat, $user_nama, $user_username, $password_hash, $user_role_id);
                }
            } else if ($type === 'delete') {
                $this->pengguna->deletePengguna($user_id);
            }
        }
    }

    public function show()
    {
        echo json_encode($this->pengguna->getPengguna($this->input->post('user_id'))->row());
    }
}
