<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    protected $required = '{field} harus diisi!';
    protected $matches = '{field} tidak sama dengan Password!';
    protected $numeric = '{field} hanya diisi dengan angka!';
    protected $valid_email = '{field} tidak sesuai format!';
    protected $min_length = '%s minimal diisi %s karakter!';
    protected $max_length = '%s maksimal diisi %s karakter!';

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
            $this->auth->delete_cart_date();
            $this->auth->cancel_invoice();

            $this->load->view('layout/auth/header', $data);
            $this->load->view('admin/auth/login');
            $this->load->view('layout/auth/footer');
        } else {
            $username = htmlspecialchars($this->input->post('username', true));
            $password = htmlspecialchars($this->input->post('password', true));

            $this->auth->proses($username, $password);
        }
    }

    function register()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => $this->required
        ]);

        $this->form_validation->set_rules('nohp', 'Nomor HP', 'required|trim|numeric|min_length[10]|max_length[13]', [
            'required' => $this->required,
            'numeric' => $this->numeric,
            'min_length' => $this->min_length,
            'max_length' => $this->max_length
        ]);

        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email', [
            'required' => $this->required,
            'valid_email' => $this->valid_email
        ]);

        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => $this->required
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => $this->required
        ]);

        $this->form_validation->set_rules('repassword', 'Ulangi Password', 'required|trim|matches[password]', [
            'required' => $this->required,
            'matches' => $this->matches
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Form Register';
            $data['ongkir'] = $this->auth->get_ongkir();
            $this->auth->delete_cart_date();
            $this->auth->cancel_invoice();

            $this->load->view('layout/auth/header', $data);
            $this->load->view('admin/auth/register_customer');
            $this->load->view('layout/auth/footer');
        } else {
            $nama = htmlspecialchars($this->input->post('nama', true));
            $nohp = htmlspecialchars($this->input->post('nohp', true));
            $email = htmlspecialchars($this->input->post('email', true));
            $username = htmlspecialchars($this->input->post('username', true));
            $password = htmlspecialchars($this->input->post('password', true));
            $repassword = htmlspecialchars($this->input->post('repassword', true));

            $this->auth->proses_register($nama, $nohp, $email, $username, $password, $repassword);
        }
    }

    public function logout()
    {
        $this->auth->logout();
    }
}
