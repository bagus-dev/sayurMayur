<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SatuanModel extends CI_Model
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

    public function getSatuan($satuan_id = null)
    {
        if ($satuan_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_satuan ORDER BY satuan_id DESC");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_satuan WHERE satuan_id = '$satuan_id'");
        }

        return $hsl;
    }

    function addSatuan($satuan_nama)
    {
        $this->db->query("INSERT INTO tbl_satuan(satuan_nama) VALUES ('$satuan_nama')");

        $this->session->set_flashdata('message', $this->_alert('Satuan berhasil disimpan!'));

        redirect(site_url('satuan'));
    }

    function editSatuan($satuan_id, $satuan_nama)
    {
        $this->db->query("UPDATE tbl_satuan SET satuan_nama='$satuan_nama' WHERE satuan_id='$satuan_id'");

        $this->session->set_flashdata('message', $this->_alert('satuan berhasil diedit!'));

        redirect(site_url('satuan'));
    }

    function deleteSatuan($satuan_id)
    {
        $hsl = $this->db->query("DELETE FROM tbl_satuan WHERE satuan_id='$satuan_id'");

        $this->session->set_flashdata('message', $this->_alert('Satuan berhasil dihapus!'));

        redirect(site_url('satuan'));
    }
}
