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
                if (password_verify($password, $user['user_password'])) {
                    // Jika ada maka akan set session ke dalam server
                    $data = [
                        'user_id' => $user['user_id'],
                        'user_nama' => $user['user_nama'],
                        'user_role_id' => $user['user_role_id']
                    ];
                    $this->session->set_userdata($data);

                    if(isset($_GET["checkout"])) {
                        redirect(site_url("checkout"));
                    }
                    else {
                        redirect(site_url());
                    }
                } else {
                    $this->session->set_flashdata('message', $this->_alert('Password yang dimasukan salah!', 'danger'));

                    // redirect ke controller auth
                    redirect(site_url('auth'));
                }
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

    function proses_register($nama,$nohp,$email,$username,$password,$repassword) {
        $cek_nohp = $this->db->get_where('tbl_user', array("user_nohp" => $nohp))->num_rows();

        if($cek_nohp == 0) {
            $cek_email = $this->db->get_where('tbl_user', array("user_email" => $email))->num_rows();

            if($cek_email == 0) {
                $cek_username = $this->db->get_where('tbl_user', array("user_username" => $username))->num_rows();

                if($cek_username == 0) {
                    $data = array(
                        "user_nama" => $nama,
                        "user_nohp" => $nohp,
                        "user_email" => $email,
                        "user_username" => $username,
                        "user_password" => password_hash($password, PASSWORD_DEFAULT),
                        "user_role_id" => 4
                    );

                    if($this->db->insert('tbl_user', $data)) {
                        $this->session->set_flashdata('message', $this->_alert('Akun Berhasil Didaftarkan', 'success'));

                        redirect(site_url('auth'));
                    }
                    else {
                        $this->session->set_flashdata('message', $this->_alert('Akun Gagal Didaftarkan, Kesalahan Server!', 'danger'));

                        redirect(site_url('auth'));
                    }
                }
                else {
                    $this->session->set_flashdata('message', $this->_alert('Username sudah terdaftar!', 'danger'));

                    redirect(site_url('auth/register'));
                }
            }
            else {
                $this->session->set_flashdata('message', $this->_alert('Alamat Email sudah terdaftar!', 'danger'));

                redirect(site_url('auth/register'));
            }
        }
        else {
            $this->session->set_flashdata('message', $this->_alert('Nomor HP sudah terdaftar!', 'danger'));

            redirect(site_url('auth/register'));
        }
    }

    function get_ongkir() {
        return $this->db->get("tbl_ongkir");
    }

    public function logout()
    {
        $this->session->sess_destroy();

        $this->session->set_flashdata('message', $this->_alert('Berhasil Logout!', 'success'));

        redirect(site_url('auth'));
    }

    function delete_cart_date() {
        date_default_timezone_set("Asia/Jakarta");

        $get_keranjang = $this->db->get("tbl_keranjang");
        $date2 = date_create();

        foreach($get_keranjang->result() as $k) {
            $date1 = date_create($k->waktu_ditambahkan);
            $diff = date_diff($date1,$date2);

            if($diff->format("%a") >= 1) {
                $this->db->delete("tbl_keranjang", array("id" => $k->id));
            }
        }
    }

    function cancel_invoice() {
        date_default_timezone_set("Asia/Jakarta");
        
        $get1 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 2 AND jenis_bayar = 2 AND status = 1");

        if ($get1->num_rows() > 0) {
            $date2_get1 = date_create();
            foreach ($get1->result() as $g1) {
                $date1_get1 = date_create($g1->waktu_ditambahkan);
                $diff_1 = date_diff($date1_get1,$date2_get1);

                if($diff_1->format("%a") >= 1) {
                    $data1 = array(
                        "status" => 2
                    );

                    $this->db->update('tbl_invoice',$data1,array("no_invoice" => $g1->no_invoice));
                }
            }

            $get2 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 2 AND jenis_bayar = 1 AND bukti_transfer = ''");

            if ($get2->num_rows() > 0) {
                $date2_get2 = date_create();
                foreach ($get2->result() as $g2) {
                    $date1_get2 = date_create($g2->waktu_ditambahkan);
                    $diff_2 = date_diff($date1_get2,$date2_get2);

                    if($diff_2->format("%a") >= 1) {
                        $data2 = array(
                            "status" => 2
                        );

                        $this->db->update('tbl_invoice',$data2,array("no_invoice" => $g2->no_invoice));
                    }
                }

                $get3 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = ''");

                if ($get3->num_rows() > 0) {
                    $date2_get3 = date_create();
                    foreach ($get3->result() as $g3) {
                        $date1_get3 = date_create($g3->waktu_ditambahkan);
                        $diff_3 = date_diff($date1_get3,$date2_get3);

                        if($diff_3->format("%a") >= 1) {
                            $data3 = array(
                                "status" => 2
                            );

                            $this->db->update('tbl_invoice',$data3,array("no_invoice" => $g3->no_invoice));
                        }
                    }
                }
            } else {
                $get3 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = ''");

                if ($get3->num_rows() > 0) {
                    $date2_get3 = date_create();
                    foreach ($get3->result() as $g3) {
                        $date1_get3 = date_create($g3->waktu_ditambahkan);
                        $diff_3 = date_diff($date1_get3,$date2_get3);

                        if($diff_3->format("%a") >= 1) {
                            $data3 = array(
                                "status" => 2
                            );

                            $this->db->update('tbl_invoice',$data3,array("no_invoice" => $g3->no_invoice));
                        }
                    }
                }
            }
        } else {
            $get2 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 2 AND jenis_bayar = 1 AND bukti_transfer = ''");

            if ($get2->num_rows() > 0) {
                $date2_get2 = date_create();
                foreach ($get2->result() as $g2) {
                    $date1_get2 = date_create($g2->waktu_ditambahkan);
                    $diff_2 = date_diff($date1_get2,$date2_get2);

                    if($diff_2->format("%a") >= 1) {
                        $data2 = array(
                            "status" => 2
                        );

                        $this->db->update('tbl_invoice',$data2,array("no_invoice" => $g2->no_invoice));
                    }
                }

                $get3 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = ''");

                if ($get3->num_rows() > 0) {
                    $date2_get3 = date_create();
                    foreach ($get3->result() as $g3) {
                        $date1_get3 = date_create($g3->waktu_ditambahkan);
                        $diff_3 = date_diff($date1_get3,$date2_get3);

                        if($diff_3->format("%a") >= 1) {
                            $data3 = array(
                                "status" => 2
                            );

                            $this->db->update('tbl_invoice',$data3,array("no_invoice" => $g3->no_invoice));
                        }
                    }
                }
            } else {
                $get3 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = '' AND status = 0");

                if ($get3->num_rows() > 0) {
                    $date2_get3 = date_create();
                    foreach ($get3->result() as $g3) {
                        $date1_get3 = date_create($g3->waktu_ditambahkan);
                        $diff_3 = date_diff($date1_get3,$date2_get3);

                        if($diff_3->format("%a") >= 1) {
                            $data3 = array(
                                "status" => 2
                            );

                            $this->db->update('tbl_invoice',$data3,array("no_invoice" => $g3->no_invoice));
                        }
                    }
                }
            }
        }
    }
}
