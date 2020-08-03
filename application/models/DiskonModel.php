<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DiskonModel extends CI_Model
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

    public function getDiskon($diskon_id = null)
    {
        if ($diskon_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_diskon ORDER BY diskon_harga ASC");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_diskon WHERE diskon_id = '$diskon_id'");
        }

        return $hsl;
    }

    function addDiskon($diskon_harga, $diskon_persen)
    {
        $this->db->query("INSERT INTO tbl_diskon(diskon_harga, diskon_persen) VALUES ('$diskon_harga', '$diskon_persen')");

        $this->session->set_flashdata('message', $this->_alert('Diskon berhasil disimpan!'));

        redirect(site_url('diskon'));
    }

    function editDiskon($diskon_id, $diskon_harga, $diskon_persen)
    {
        $this->db->query("UPDATE tbl_diskon SET diskon_harga='$diskon_harga', diskon_persen= '$diskon_persen' WHERE diskon_id='$diskon_id'");

        $this->session->set_flashdata('message', $this->_alert('diskon berhasil diedit!'));

        redirect(site_url('diskon'));
    }

    function deleteDiskon($diskon_id)
    {
        $hsl = $this->db->query("DELETE FROM tbl_diskon WHERE diskon_id='$diskon_id'");

        $this->session->set_flashdata('message', $this->_alert('diskon berhasil dihapus!'));

        redirect(site_url('diskon'));
    }
}
