<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangModel extends CI_Model
{
    // Menampilkan Alert Pada Model ini
    protected function _alert($message, $type = 'success')
    {
        return '<div class="alert alert-' . $type . ' alert-dismissible show" role="alert">'
            . $message .
            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }

    // Generate barang_id/kode barang unuk di insert kedalam table barang
    public function _barid()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(barang_id,6)) AS kd_max FROM tbl_barang");
        $kd = "";

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }

        return "BR" . $kd;
    }

    // Upload gambar baik untuk add atau edit
    public function _uploadImage($type, $barang_gambar = null)
    {
        $config['upload_path']          = './assets/source/images/barang';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = ($barang_gambar !== null) ? $barang_gambar : $this->_barid();
        $config['overwrite']            = true;
        $config['max_size']             = 16384;

        $this->load->library('upload', $config);

        // Jika add
        if ($type === 'add') {
            if ($this->upload->do_upload('barang_gambar')) {
                return $this->upload->data("file_name");
            } else {
                $this->session->set_flashdata('message', $this->_alert($this->upload->display_errors()));
            }

            return "default.png";

            // Jika Edit
        } else if ($type === 'edit') {
            if ($this->upload->do_upload('barang_gambar')) {
                if ($barang_gambar != 'default.png') {
                    unlink(FCPATH . 'assets/images/barang' . $barang_gambar);
                }

                return $this->upload->data("file_name");
            } else {
                $this->session->set_flashdata('message', $this->_alert($this->upload->display_errors()));
            }
        }
    }

    // Menampilkan semua barang dan juga bisa menampilkan barang dengan barang_id/kode barang
    public function getBarang($barang_id = null)
    {
        if ($barang_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_barang JOIN tbl_kategori ON barang_kategori_id=kategori_id JOIN tbl_satuan ON barang_satuan_id=satuan_id ORDER BY barang_id ASC");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_barang JOIN tbl_kategori ON barang_kategori_id=kategori_id JOIN tbl_satuan ON barang_satuan_id=satuan_id WHERE barang_id = '$barang_id'");
        }

        return $hsl;
    }

    // Menambah Barang
    function addBarang($barang_id, $barang_gambar, $barang_nama, $barang_harpok, $barang_harjul, $barang_harjul_grosir, $barang_stok, $barang_kategori_id, $barang_satuan_id)
    {
        $barang_user_id = $this->session->userdata('user_id');

        $this->db->query("INSERT INTO tbl_barang (barang_id, barang_gambar, barang_nama, barang_harpok, barang_harjul, barang_harjul_grosir, barang_stok, barang_kategori_id, barang_satuan_id, barang_user_id) VALUES ('$barang_id', '$barang_gambar', ' $barang_nama','$barang_harpok','$barang_harjul','$barang_harjul_grosir','$barang_stok','$barang_kategori_id','$barang_satuan_id', '$barang_user_id')");

        $this->session->set_flashdata('message', $this->_alert('Barang berhasil disimpan!'));

        redirect(site_url('barang'));
    }

    // Mengubah Barang
    function editBarang($barang_id, $barang_gambar, $barang_nama, $barang_harpok, $barang_harjul, $barang_harjul_grosir, $barang_stok, $barang_kategori_id, $barang_satuan_id)
    {
        $barang_user_id = $this->session->userdata('user_id');

        $this->db->query("UPDATE tbl_barang SET barang_gambar='$barang_gambar',barang_nama='$barang_nama',barang_harpok='$barang_harpok',barang_harjul='$barang_harjul',barang_harjul_grosir='$barang_harjul_grosir',barang_stok='$barang_stok',barang_tgl_last_update=NOW(),barang_kategori_id='$barang_kategori_id',barang_satuan_id='$barang_satuan_id',barang_user_id='$barang_user_id' WHERE barang_id='$barang_id'");

        $this->session->set_flashdata('message', $this->_alert('Barang berhasil diedit!'));

        redirect(site_url('barang'));
    }

    // Menghapus Barang
    function deletebarang($barang_id, $barang_gambar)
    {
        if ($barang_gambar !== 'default.png') {
            $barang_gambar = explode(".", $barang_gambar)[0];
            array_map('unlink', glob(FCPATH . "assets/source/images/barang/$barang_gambar.*"));
        }

        $this->db->query("DELETE FROM tbl_barang where barang_id='$barang_id'");

        $this->session->set_flashdata('message', $this->_alert('Barang berhasil dihapus!'));

        redirect(site_url('barang'));
    }
}