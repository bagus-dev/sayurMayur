<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KategoriModel extends CI_Model
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

    public function getKategori($kategori_id = null)
    {
        if ($kategori_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_kategori ORDER BY kategori_id DESC");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_kategori WHERE kategori_id = '$kategori_id'");
        }

        return $hsl;
    }

    function addKategori($kategori_nama)
    {
        $this->db->query("INSERT INTO tbl_kategori(kategori_nama) VALUES ('$kategori_nama')");

        $this->session->set_flashdata('message', $this->_alert('Kategori berhasil disimpan!'));

        redirect(site_url('kategori'));
    }

    function editKategori($kategori_id, $kategori_nama)
    {
        $this->db->query("UPDATE tbl_kategori SET kategori_nama='$kategori_nama' WHERE kategori_id='$kategori_id'");

        $this->session->set_flashdata('message', $this->_alert('Kategori berhasil diedit!'));

        redirect(site_url('kategori'));
    }

    function deleteKategori($kategori_id)
    {
        $hsl = $this->db->query("DELETE FROM tbl_kategori WHERE kategori_id='$kategori_id'");

        $this->session->set_flashdata('message', $this->_alert('Kategori berhasil dihapus!'));

        redirect(site_url('kategori'));
    }
}
