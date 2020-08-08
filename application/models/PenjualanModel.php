<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenjualanModel extends CI_Model
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
        $query = $this->db->query("SELECT MAX(MID(jual_nofak,9,4)) AS faktur 
                                    FROM tbl_jual
                                    WHERE MID(jual_nofak,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')");

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
        $this->db->query("UPDATE tbl_cart_jual 
                                    SET
                                c_jual_barang_harjul = '$data[c_jual_barang_harjul]',
                                c_jual_qty = c_jual_qty + '$data[c_jual_qty]',
                                c_jual_total = '$data[c_jual_barang_harjul]' * c_jual_qty 
                                    WHERE 
                                c_jual_barang_id = '$data[c_jual_barang_id]'");
    }

    public function _getTotalCart()
    {
        $c_jual_user_id = $this->session->userdata('user_id');
        $hsl = $this->db->query("SELECT SUM(c_jual_total) as total FROM tbl_cart_jual JOIN tbl_user ON c_jual_user_id=user_id WHERE c_jual_user_id='$c_jual_user_id'");

        return $hsl;
    }

    public function _getCustomerOfflineById($customer_id)
    {
        $hsl = $this->db->query("SELECT * FROM tbl_customer WHERE customer_id = '$customer_id'");

        return $hsl;
    }

    public function getPenjualan($jual_nofak = null)
    {
        if ($jual_nofak === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_jual JOIN tbl_user ON jual_user_id=user_id ORDER BY jual_nofak ASC");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_jual JOIN tbl_user ON jual_user_id=user_id WHERE jual_nofak='$jual_nofak' ORDER BY jual_nofak ASC");
        }

        return $hsl;
    }

    public function addPenjualan($data)
    {
        $customer = $this->_getCustomerOfflineById($data['jual_customer_id'])->row();

        $params = [
            'jual_nofak' => $data['jual_nofak'],
            'jual_tanggal' => $data['jual_tanggal'],
            'jual_diskon' => $data['jual_diskon'],
            'jual_total' => $data['jual_total'],
            'jual_jml_uang' => $data['jual_jml_uang'],
            'jual_kembalian' => $data['jual_kembalian'],
            'jual_user_id' => $this->session->userdata('user_id'),
            'jual_customer_id' => $data['jual_customer_id'],
            'jual_customer_nama' => $customer->customer_nama,
            'jual_keterangan' => $data['jual_keterangan'],
        ];

        $this->db->insert('tbl_jual', $params);
        return $data['jual_nofak'];
    }

    function deletePenjualan($jual_nofak)
    {
        $hsl = $this->db->query("DELETE FROM tbl_jual WHERE jual_nofak='$jual_nofak'");

        $this->session->set_flashdata('message', $this->_alert('Laporan Penjualan berhasil dihapus!'));

        redirect(site_url('penjualan/laporan'));
    }

    public function getPenjualanDetail($jual_nofak = null)
    {
        if ($jual_nofak === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_detail_jual ORDER BY d_jual_nofak ASC");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_detail_jual WHERE d_jual_nofak='$jual_nofak' ORDER BY d_jual_nofak ASC");
        }

        return $hsl;
    }

    public function addPenjualanDetail($params)
    {
        $this->db->insert_batch('tbl_detail_jual', $params);
    }

    public function getCart($c_jual_barang_id = null)
    {
        $c_jual_user_id = $this->session->userdata('user_id');
        if ($c_jual_barang_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_cart_jual JOIN tbl_user ON c_jual_user_id=user_id JOIN tbl_barang ON c_jual_barang_id=barang_id WHERE c_jual_user_id='$c_jual_user_id'");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_cart_jual JOIN tbl_user ON c_jual_user_id=user_id JOIN tbl_barang ON c_jual_barang_id=barang_id WHERE c_jual_barang_id='$c_jual_barang_id' AND c_jual_user_id='$c_jual_user_id'");
        }

        return $hsl;
    }

    public function addCart($data)
    {
        $query = $this->db->query("SELECT MAX(c_jual_id) AS cart_no FROM tbl_cart_jual");
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $car_no = ((int)$row->cart_no) + 1;
        } else {
            $car_no = "1";
        }

        $params = [
            'c_jual_id' => $car_no,
            'c_jual_user_id' => $this->session->userdata('user_id'),
            'c_jual_barang_id' => $data['c_jual_barang_id'],
            'c_jual_barang_nama' => $data['c_jual_barang_nama'],
            'c_jual_barang_satuan' => $data['c_jual_barang_satuan'],
            'c_jual_barang_harpok' => $data['c_jual_barang_harpok'],
            'c_jual_barang_harjul' => $data['c_jual_barang_harjul'],
            'c_jual_qty' => $data['c_jual_qty'],
            'c_jual_diskon' => 0,
            'c_jual_total' => $data['c_jual_qty'] *  $data['c_jual_barang_harjul']
        ];

        $this->db->insert('tbl_cart_jual', $params);
    }

    public function editCart($data)
    {
        $params = [
            'c_jual_barang_harjul' => $data['c_jual_barang_harjul'],
            'c_jual_qty' => $data['c_jual_qty'],
            'c_jual_diskon' => $data['c_jual_diskon'],
            'c_jual_total' => $data['c_jual_total'],
        ];

        $this->db->where('c_jual_barang_id', $data['c_jual_barang_id']);
        $this->db->update('tbl_cart_jual', $params);
    }

    public function deleteCart($c_jual_id, $c_jual_user_id = null)
    {
        if ($c_jual_user_id == null) {
            $this->db->query("DELETE FROM tbl_cart_jual WHERE c_jual_id='$c_jual_id'");
        } else {
            $this->db->query("DELETE FROM tbl_cart_jual WHERE c_jual_user_id='$c_jual_user_id'");
        }
    }
}
