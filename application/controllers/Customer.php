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
            $data['customerOfflines'] = $this->customer->getCustomerOffline();
            $data['roles'] = $this->role->getRole();

            $data['datable'] = true;
            $data['customer'] = true;

            $this->load->view('layout/dashboard/header', $data);
            $this->load->view('admin/customer/index');
            $this->load->view('layout/dashboard/footer');
        } else {
            $type = $this->input->post('type', true);
            $user_id = $this->input->post('user_id', true);
            $customer_id = $this->input->post('customer_id', true);
            $customer_nama = $this->input->post('customer_nama', true);
            $customer_alamat = $this->input->post('customer_alamat', true);
            $customer_notelp = $this->input->post('customer_notelp', true);

            if ($type === 'delete') {
                $this->customer->deleteCustomer($user_id);
            } else if ($type === 'add2') {
                $this->customer->addCustomerOffline($customer_nama, $customer_alamat, $customer_notelp);
            } else if ($type === 'edit2') {
                $this->customer->editCustomerOffline($customer_id, $customer_nama, $customer_alamat, $customer_notelp);
            } else if ($type === 'delete2') {
                $this->customer->deleteCustomerOffline($customer_id);
            }
        }
    }

    public function show()
    {
        echo json_encode($this->customer->getCustomer($this->input->post('user_id'))->row());
    }

    public function show2()
    {
        echo json_encode($this->customer->getCustomerOffline($this->input->post('customer_id'))->row());
    }
}
