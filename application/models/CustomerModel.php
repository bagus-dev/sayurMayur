<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerModel extends CI_Model
{
    public function _alert($message, $type = 'success')
    {
        return '<div class="alert alert-' . $type . ' alert-dismissible show" role="alert">'
            . $message .
            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }

    public function getCustomer($user_id = null)
    {
        if ($user_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_user JOIN tbl_role ON user_role_id=role_id WHERE role_id = 4");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_user JOIN tbl_role ON user_role_id=role_id WHERE user_id = '$user_id' AND role_id = 4");
        }

        return $hsl;
    }

    function deleteCustomer($user_id)
    {
        $hsl = $this->db->query("DELETE FROM tbl_user WHERE user_id='$user_id'");

        $this->session->set_flashdata('message', $this->_alert('Customer berhasil dihapus!'));

        redirect(site_url('customer'));
    }

    public function getCustomerOffline($customer_id = null)
    {
        if ($customer_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_customer WHERE customer_id != '1'");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_customer WHERE customer_id = '$customer_id' AND customer_id != '1'");
        }

        return $hsl;
    }

    public function getAllCustomerOffline()
    {
        $hsl = $this->db->query("SELECT * FROM tbl_customer");

        return $hsl;
    }

    function addCustomerOffline($customer_nama, $customer_alamat, $customer_notelp)
    {
        $this->db->query("INSERT INTO tbl_customer(customer_nama, customer_alamat, customer_notelp) VALUES ('$customer_nama', '$customer_alamat', '$customer_notelp')");

        $this->session->set_flashdata('message2', $this->_alert('Customer berhasil disimpan!'));

        redirect(site_url('customer'));
    }

    function editCustomerOffline($customer_id, $customer_nama, $customer_alamat, $customer_notelp)
    {
        $this->db->query("UPDATE tbl_customer SET customer_nama='$customer_nama',customer_alamat='$customer_alamat',customer_notelp='$customer_notelp' WHERE customer_id='$customer_id'");

        $this->session->set_flashdata('message2', $this->_alert('Customer berhasil diedit!'));

        redirect(site_url('customer'));
    }

    function deleteCustomerOffline($customer_id)
    {
        $hsl = $this->db->query("DELETE FROM tbl_customer WHERE customer_id='$customer_id'");

        $this->session->set_flashdata('message2', $this->_alert('Customer berhasil dihapus!'));

        redirect(site_url('customer'));
    }
}
