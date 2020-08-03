<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenggunaModel extends CI_Model
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

    public function getPengguna($user_id = null)
    {
        if ($user_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_user JOIN tbl_role ON user_role_id=role_id WHERE role_id != 4");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_user JOIN tbl_role ON user_role_id=role_id WHERE user_id = '$user_id' AND role_id != 4");
        }

        return $hsl;
    }


    function addPengguna($user_nama, $user_alamat, $user_username, $user_password, $user_role_id)
    {
        $hsl = $this->db->query("INSERT INTO tbl_user(user_nama, user_alamat, user_username,user_password, user_role_id) VALUES ('$user_nama', '$user_alamat','$user_username',md5('$user_password'),'$user_role_id')");

        $this->session->set_flashdata('message', $this->_alert('Pengguna berhasil disimpan!'));

        redirect(site_url('pengguna'));
    }

    function editPengguna($user_id, $user_alamat, $user_nama, $user_username, $user_password = null, $user_role_id)
    {
        if ($user_password === '') {
            $hsl = $this->db->query("UPDATE tbl_user SET user_nama='$user_nama',user_alamat='$user_alamat', user_username='$user_username',user_role_id='$user_role_id' WHERE user_id='$user_id'");
        } else {
            if ($user_role_id === null) {
                $user_role_id = '1';
            }

            $hsl = $this->db->query("UPDATE tbl_user SET user_nama='$user_nama',user_alamat='$user_alamat', user_username='$user_username', user_password='$user_password',user_role_id='$user_role_id' WHERE user_id='$user_id'");
        }

        $this->session->set_flashdata('message', $this->_alert('Pengguna berhasil diedit!'));

        redirect(site_url('pengguna'));
    }

    function deletePengguna($user_id)
    {
        $hsl = $this->db->query("DELETE FROM tbl_user WHERE user_id='$user_id'");

        $this->session->set_flashdata('message', $this->_alert('Pengguna berhasil disimpan!'));

        redirect(site_url('pengguna'));
    }
}
