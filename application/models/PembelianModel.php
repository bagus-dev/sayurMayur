<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PembelianModel extends CI_Model
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

    public function _nofak()
    {
        $query = $this->db->query("SELECT MAX(MID(beli_nofak,9,4)) AS faktur 
                                    FROM tbl_beli
                                    WHERE MID(beli_nofak,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')");

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->faktur) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }

        $invoice = "SM" . date('ymd') . $no;

        return $invoice;
    }

    public function _updateCart($data)
    {
        $this->db->query("UPDATE tbl_cart_beli 
                                    SET
                                c_beli_barang_harjul = '$data[c_beli_barang_harjul]',
                                c_beli_qty = c_beli_qty + '$data[c_beli_qty]',
                                c_beli_total = '$data[c_beli_barang_harjul]' * c_beli_qty 
                                    WHERE 
                                c_beli_barang_id = '$data[c_beli_barang_id]'");
    }

    public function _getTotalCart()
    {
        $c_beli_user_id = $this->session->userdata('user_id');
        $hsl = $this->db->query("SELECT SUM(c_beli_total) as total FROM tbl_cart_beli JOIN tbl_user ON c_beli_user_id=user_id WHERE c_beli_user_id='$c_beli_user_id'");

        return $hsl;
    }

    public function _getSuplierById($suplier_id)
    {
        $hsl = $this->db->query("SELECT * FROM tbl_suplier WHERE suplier_id = '$suplier_id'");

        return $hsl;
    }

    public function getPembelian($beli_nofak = null)
    {
        if ($beli_nofak === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_beli JOIN tbl_user ON beli_user_id=user_id ORDER BY beli_nofak ASC");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_beli JOIN tbl_user ON beli_user_id=user_id WHERE beli_nofak='$beli_nofak' ORDER BY beli_nofak ASC");
        }

        return $hsl;
    }

    public function addPembelian($data)
    {
        $suplier = $this->_getSuplierById($data['beli_suplier_id'])->row();

        $params = [
            'beli_nofak' => $data['beli_nofak'],
            'beli_tanggal' => date("Y-m-d h:i:s"),
            'beli_diskon' => $data['beli_diskon'],
            'beli_total' => $data['beli_total'],
            'beli_jml_uang' => $data['beli_jml_uang'],
            'beli_kembalian' => $data['beli_kembalian'],
            'beli_user_id' => $this->session->userdata('user_id'),
            'beli_suplier_id' => $data['beli_suplier_id'],
            'beli_suplier_nama' => $suplier->suplier_nama,
            'beli_keterangan' => $data['beli_keterangan'],
        ];

        $this->db->insert('tbl_beli', $params);
        return $data['beli_nofak'];
    }

    function deletePembelian($beli_nofak)
    {
        $hsl = $this->db->query("DELETE FROM tbl_beli WHERE beli_nofak='$beli_nofak'");

        $this->session->set_flashdata('message', $this->_alert('Laporan Pembelian berhasil dihapus!'));

        redirect(site_url('pembelian/laporan'));
    }

    public function getPembelianDetail($beli_nofak = null)
    {
        if ($beli_nofak === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_detail_beli ORDER BY d_beli_nofak ASC");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_detail_beli WHERE d_beli_nofak='$beli_nofak' ORDER BY d_beli_nofak ASC");
        }

        return $hsl;
    }

    public function addPembelianDetail($params)
    {
        $this->db->insert_batch('tbl_detail_beli', $params);
    }

    public function getCart($c_beli_barang_id = null)
    {
        $c_beli_user_id = $this->session->userdata('user_id');
        if ($c_beli_barang_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_cart_beli JOIN tbl_user ON c_beli_user_id=user_id JOIN tbl_barang ON c_beli_barang_id=barang_id WHERE c_beli_user_id='$c_beli_user_id'");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_cart_beli JOIN tbl_user ON c_beli_user_id=user_id JOIN tbl_barang ON c_beli_barang_id=barang_id WHERE c_beli_barang_id='$c_beli_barang_id' AND c_beli_user_id='$c_beli_user_id'");
        }

        return $hsl;
    }

    public function addCart($data)
    {
        $query = $this->db->query("SELECT MAX(c_beli_id) AS cart_no FROM tbl_cart_beli");
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $car_no = ((int)$row->cart_no) + 1;
        } else {
            $car_no = "1";
        }

        $params = [
            'c_beli_id' => $car_no,
            'c_beli_user_id' => $this->session->userdata('user_id'),
            'c_beli_barang_id' => $data['c_beli_barang_id'],
            'c_beli_barang_nama' => $data['c_beli_barang_nama'],
            'c_beli_barang_satuan' => $data['c_beli_barang_satuan'],
            'c_beli_barang_harpok' => $data['c_beli_barang_harpok'],
            'c_beli_barang_harjul' => $data['c_beli_barang_harjul'],
            'c_beli_qty' => $data['c_beli_qty'],
            'c_beli_diskon' => 0,
            'c_beli_total' => $data['c_beli_qty'] *  $data['c_beli_barang_harjul']
        ];

        $this->db->insert('tbl_cart_beli', $params);
    }

    public function editCart($data)
    {
        $params = [
            'c_beli_barang_harjul' => $data['c_beli_barang_harjul'],
            'c_beli_qty' => $data['c_beli_qty'],
            'c_beli_diskon' => $data['c_beli_diskon'],
            'c_beli_total' => $data['c_beli_total'],
        ];

        $this->db->where('c_beli_barang_id', $data['c_beli_barang_id']);
        $this->db->update('tbl_cart_beli', $params);
    }

    public function deleteCart($c_beli_id, $c_beli_user_id = null)
    {
        if ($c_beli_user_id == null) {
            $this->db->query("DELETE FROM tbl_cart_beli WHERE c_beli_id='$c_beli_id'");
        } else {
            $this->db->query("DELETE FROM tbl_cart_beli WHERE c_beli_user_id='$c_beli_user_id'");
        }
    }

    function get_detail_invoice_by_tgl($tgl_awal, $tgl_akhir)
    {
        $this->db->select("*");
        $this->db->from("tbl_beli");
        $this->db->where(array("beli_tanggal >=" => $tgl_awal, "beli_tanggal <=" => $tgl_akhir));
        $this->db->join("tbl_user", "tbl_user.user_id = tbl_beli.beli_user_id");
        $this->db->order_by("tbl_beli.beli_nofak", "ASC");

        return $this->db->get();
    }
}
