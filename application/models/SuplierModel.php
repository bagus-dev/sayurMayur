<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuplierModel extends CI_Model
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

    public function getSuplier($suplier_id = null)
    {
        if ($suplier_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_suplier WHERE suplier_id != '1' ORDER BY suplier_id DESC");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_suplier WHERE suplier_id != '1' AND suplier_id = '$suplier_id'");
        }

        return $hsl;
    }

    public function getAllSuplier()
    {
        $hsl = $this->db->query("SELECT * FROM tbl_suplier");

        return $hsl;
    }

    function addSuplier($suplier_nama, $suplier_alamat, $suplier_notelp)
    {
        $this->db->query("INSERT INTO tbl_suplier(suplier_nama,suplier_alamat,suplier_notelp) VALUES ('$suplier_nama','$suplier_alamat','$suplier_notelp')");

        $this->session->set_flashdata('message', $this->_alert('Suplier berhasil disimpan!'));

        redirect(site_url('suplier'));
    }

    function editSuplier($suplier_id, $suplier_nama, $suplier_alamat, $suplier_notelp)
    {
        $this->db->query("UPDATE tbl_suplier SET suplier_nama='$suplier_nama',suplier_alamat='$suplier_alamat',suplier_notelp='$suplier_notelp' WHERE suplier_id='$suplier_id'");

        $this->session->set_flashdata('message', $this->_alert('Suplier berhasil diedit!'));

        redirect(site_url('suplier'));
    }


    function deleteSuplier($suplier_id)
    {
        $this->db->query("DELETE FROM tbl_suplier where suplier_id='$suplier_id'");

        $this->session->set_flashdata('message', $this->_alert('Suplier berhasil dihapus!'));

        redirect(site_url('suplier'));
    }
}
