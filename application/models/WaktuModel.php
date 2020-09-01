<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WaktuModel extends CI_Model
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

    public function getWaktu($waktu_id = null)
    {
        if ($waktu_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_waktu ORDER BY waktu_id DESC");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_waktu WHERE waktu_id = '$waktu_id'");
        }

        return $hsl;
    }

    function addWaktu($waktu_nama, $waktu_awal, $waktu_akhir)
    {
        $this->db->query("INSERT INTO tbl_waktu(waktu_nama, waktu_awal, waktu_akhir) VALUES ('$waktu_nama', '$waktu_awal', '$waktu_akhir')");

        $this->session->set_flashdata('message', $this->_alert('Waktu berhasil disimpan!'));

        redirect(site_url('waktu'));
    }

    function editWaktu($waktu_id, $waktu_nama, $waktu_awal, $waktu_akhir)
    {
        $this->db->query("UPDATE tbl_waktu SET waktu_nama='$waktu_nama', waktu_awal='$waktu_awal', waktu_akhir='$waktu_akhir' WHERE waktu_id='$waktu_id'");

        $this->session->set_flashdata('message', $this->_alert('waktu berhasil diedit!'));

        redirect(site_url('waktu'));
    }

    function deleteWaktu($waktu_id)
    {
        $hsl = $this->db->query("DELETE FROM tbl_waktu WHERE waktu_id='$waktu_id'");

        $this->session->set_flashdata('message', $this->_alert('Waktu berhasil dihapus!'));

        redirect(site_url('waktu'));
    }
}
