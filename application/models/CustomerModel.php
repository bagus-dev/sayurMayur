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
}
