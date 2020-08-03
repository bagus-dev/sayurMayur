<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OngkirModel extends CI_Model
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

    public function getOngkir($ongkir_id = null)
    {
        if ($ongkir_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_ongkir ORDER BY ongkir_harga ASC");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_ongkir WHERE ongkir_id = '$ongkir_id'");
        }

        return $hsl;
    }

    function addOngkir($ongkir_lokasi, $ongkir_harga)
    {
        $this->db->query("INSERT INTO tbl_ongkir(ongkir_lokasi,ongkir_harga) VALUES ('$ongkir_lokasi','$ongkir_harga')");

        $this->session->set_flashdata('message', $this->_alert('Ongkir berhasil disimpan!'));

        redirect(site_url('ongkir'));
    }

    function editOngkir($ongkir_id, $ongkir_lokasi, $ongkir_harga)
    {
        $this->db->query("UPDATE tbl_ongkir SET ongkir_lokasi='$ongkir_lokasi', ongkir_harga='$ongkir_harga' WHERE ongkir_id='$ongkir_id'");

        $this->session->set_flashdata('message', $this->_alert('Ongkir berhasil diedit!'));

        redirect(site_url('ongkir'));
    }

    function deleteOngkir($ongkir_id)
    {
        $hsl = $this->db->query("DELETE FROM tbl_ongkir WHERE ongkir_id='$ongkir_id'");

        $this->session->set_flashdata('message', $this->_alert('Ongkir berhasil dihapus!'));

        redirect(site_url('ongkir'));
    }
}
