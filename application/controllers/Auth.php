<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    protected $required = '{field} harus di isi!';

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AuthModel', 'auth');
    }

    public function index()
    {
        // Form Validation
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => $this->required
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => $this->required
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Form Login';

            $this->load->view('layout/auth/header', $data);
            $this->load->view('admin/auth/login');
            $this->load->view('layout/auth/footer');
        } else {
            $username = htmlspecialchars($this->input->post('username', true));
            $password = htmlspecialchars($this->input->post('password', true));

            $this->auth->proses($username, $password);
        }
    }


    public function logout()
    {
        $this->auth->logout();
    }
}
