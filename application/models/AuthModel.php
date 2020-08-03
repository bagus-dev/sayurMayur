<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
    protected function _alert($message, $type = 'success')
    {
        return '<div class="alert alert-' . $type . ' alert-dismissible show" role="alert">'
            . $message .
            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }

    public function proses($username, $password)
    {
        // Ambil data user sesuai dari username
        $user = $this->db->get_where('tbl_user', ['user_username' => $username])->row_array();
        // Jika username yang dinput ada dalama database
        if ($user) {
            // Jika user yang masuk adalah admin atau level 1
            if ($user['user_role_id'] === '4') {
            } else {
                // Bandingkan password yang diinput dengan password yang ada di database
                if (password_verify($password, $user['user_password'])) {
                    // Jika ada maka akan set session ke dalam server
                    $data = [
                        'user_id' => $user['user_id'],
                        'user_nama' => $user['user_nama'],
                        'user_role_id' => $user['user_role_id']
                    ];
                    $this->session->set_userdata($data);

                    // redirect ke controller admin
                    redirect(site_url('dashboard'));
                } else {
                    $this->session->set_flashdata('message', $this->_alert('Password yang dimasukan salah!', 'danger'));

                    // redirect ke controller auth
                    redirect(site_url('auth'));
                }
            }
        } else {
            $this->session->set_flashdata('message', $this->_alert('Username belum terdaftar!', 'danger'));

            // redirect ke controller auth
            redirect(site_url('auth'));
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_nama');
        $this->session->unset_userdata('user_role_id');
        $this->session->sess_destroy();

        $this->session->set_flashdata('message', $this->_alert('Berhasil Logout!'));

        redirect(site_url('auth'));
    }
}
