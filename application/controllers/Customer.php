<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_role_id')) {
            redirect(site_url('auth'));
        };

        $this->load->model('CustomerModel', 'customer');
        $this->load->model('RoleModel', 'role');
    }

    public function index()
    {
        $this->form_validation->set_rules('type', 'Type', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Customer';
            $data['customers'] = $this->customer->getCustomer();
            $data['roles'] = $this->role->getRole();

            $data['datable'] = true;
            $data['customer'] = true;

            $this->load->view('layout/dashboard/header', $data);
            $this->load->view('admin/customer/index');
            $this->load->view('layout/dashboard/footer');
        } else {
            $type = $this->input->post('type', true);
            $user_id = $this->input->post('user_id', true);

            if ($type === 'delete') {
                $this->customer->deleteCustomer($user_id);
            }
        }
    }

    public function show()
    {
        echo json_encode($this->customer->getCustomer($this->input->post('user_id'))->row());
    }
}
