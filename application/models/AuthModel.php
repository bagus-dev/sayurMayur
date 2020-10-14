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

                    if (isset($_GET["checkout"])) {
                        redirect(site_url("checkout"));
                    } else {
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

    function proses_register($nama, $alamat, $nohp, $email, $username, $password, $repassword)
    {
        $cek_nohp = $this->db->get_where('tbl_user', array("user_nohp" => $nohp))->num_rows();

        if ($cek_nohp == 0) {
            $cek_email = $this->db->get_where('tbl_user', array("user_email" => $email))->num_rows();

            if ($cek_email == 0) {
                $cek_username = $this->db->get_where('tbl_user', array("user_username" => $username))->num_rows();

                if ($cek_username == 0) {
                    $data = array(
                        "user_nama" => $nama,
                        "user_alamat" => $alamat,
                        "user_nohp" => $nohp,
                        "user_email" => $email,
                        "user_username" => $username,
                        "user_password" => password_hash($password, PASSWORD_DEFAULT),
                        "user_role_id" => 4
                    );

                    if ($this->db->insert('tbl_user', $data)) {
                        $this->session->set_flashdata('message', $this->_alert('Akun Berhasil Didaftarkan', 'success'));

                        redirect(site_url('auth'));
                    } else {
                        $this->session->set_flashdata('message', $this->_alert('Akun Gagal Didaftarkan, Kesalahan Server!', 'danger'));

                        redirect(site_url('auth'));
                    }
                } else {
                    $this->session->set_flashdata('message', $this->_alert('Username sudah terdaftar!', 'danger'));

                    redirect(site_url('auth/register'));
                }
            } else {
                $this->session->set_flashdata('message', $this->_alert('Alamat Email sudah terdaftar!', 'danger'));

                redirect(site_url('auth/register'));
            }
        } else {
            $this->session->set_flashdata('message', $this->_alert('Nomor HP sudah terdaftar!', 'danger'));

            redirect(site_url('auth/register'));
        }
    }

    function get_ongkir()
    {
        return $this->db->get("tbl_ongkir");
    }

    public function logout()
    {
        $this->session->sess_destroy();

        $this->session->set_flashdata('message', $this->_alert('Berhasil Logout!', 'success'));

        redirect(site_url('auth'));
    }

    function delete_cart_date()
    {
        date_default_timezone_set("Asia/Jakarta");

        $get_keranjang = $this->db->get("tbl_keranjang");
        $date2 = date_create();

        foreach ($get_keranjang->result() as $k) {
            $date1 = date_create($k->waktu_ditambahkan);
            $diff = date_diff($date1, $date2);

            if ($diff->format("%a") >= 1) {
                $this->db->delete("tbl_keranjang", array("id" => $k->id));
            }
        }
    }

    function cancel_invoice()
    {
        date_default_timezone_set("Asia/Jakarta");

        $invoice = $this->db->get("tbl_invoice");
        $date2 = date_create();

        foreach ($invoice->result() as $i) {
            if ($i->status == 1 and $i->cara_bayar == 1 and $i->jenis_bayar == 2) {
                $tgl_validasi = date("d", strtotime($i->waktu_validasi));
                $bln_validasi = date("m", strtotime($i->waktu_validasi));
                $thn_validasi = date("Y", strtotime($i->waktu_validasi));
                $waktu_validasi = $thn_validasi . "-" . $bln_validasi . "-" . $tgl_validasi;

                $waktu = $this->db->get_where("tbl_waktu", array("waktu_id" => $i->waktu_kirim))->row();
                $waktu_kirim = $waktu->waktu_akhir . ":00";
                $date = $waktu_validasi . " " . $waktu_kirim;

                $date1 = date_create($date);
                $diff = date_diff($date1, $date2);

                if ($diff->format("%a") >= 1) {
                    $data = array(
                        "status" => 2,
                        "waktu_batal" => date("Y-m-d H:i:s")
                    );

                    $this->db->update("tbl_invoice", $data, array("no_invoice" => $i->no_invoice));
                }
            }
        }
    }
}
