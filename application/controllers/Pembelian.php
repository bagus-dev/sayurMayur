<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_role_id')) {
            redirect(site_url('auth'));
        };

        $this->load->model('PembelianModel', 'pembelian');
        $this->load->model('SuplierModel', 'suplier');
        $this->load->model('BarangModel', 'barang');
    }

    public function index()
    {
        $data['title'] = 'Transaksi Pembelian';
        $data['nofak'] = $this->pembelian->_nofak();
        $data['carts'] = $this->pembelian->getCart();
        $data['supliers'] = $this->suplier->getAllSuplier();
        $data['barangs'] = $this->barang->getBarang();

        $data['select2'] = true;
        $data['datable'] = true;
        $data['pembelian'] = true;

        $this->load->view('layout/dashboard/header', $data);
        $this->load->view('admin/pembelian/index');
        $this->load->view('layout/dashboard/footer');
    }

    public function laporan()
    {
        $this->form_validation->set_rules('beli_id', 'Beli ID', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Laporan Pembelian';
            $data['pembelians'] = $this->pembelian->getPembelian();

            $data['datable'] = true;
            $data['pembelian_laporan'] = true;

            $this->load->view('layout/dashboard/header', $data);
            $this->load->view('admin/pembelian/laporan');
            $this->load->view('layout/dashboard/footer');
        } else {
            $beli_nofak = $this->input->post('beli_id', true);
            $this->pembelian->deletePembelian($beli_nofak);
        }
    }

    public function laporan_detail($beli_nofak)
    {
        $data['title'] = 'Detail Pembelian';
        $data['pembelian'] = $this->pembelian->getPembelian($beli_nofak)->row();
        $data['details'] = $this->pembelian->getPembelianDetail($beli_nofak);

        $data['datable'] = true;

        $this->load->view('layout/dashboard/header', $data);
        $this->load->view('admin/pembelian/laporan_detail');
        $this->load->view('layout/dashboard/footer');
    }

    public function struk_print($beli_nofak)
    {
        $data = [
            'pembelian' => $this->pembelian->getPembelian($beli_nofak)->row(),
            'pembelianDetails' => $this->pembelian->getPembelianDetail($beli_nofak)->result()
        ];
        $this->load->view('admin/pembelian/struk', $data);
    }


    // Utility
    public function show()
    {
        echo json_encode($this->pembelian->getCart($this->input->post('c_beli_barang_id'))->row());
    }

    public function show2()
    {
        echo json_encode($this->pembelian->getPembelian($this->input->post('beli_id'))->row());
    }

    public function destroy()
    {
        $c_beli_id = $this->input->post('c_beli_id');
        $this->pembelian->deleteCart($c_beli_id);

        if ($this->db->affected_rows() > 0) {
            $params = ['success' => true];
        } else {
            $params = ['success' => false];
        }

        echo json_encode($params);
    }

    public function proses()
    {
        $data = $this->input->post(null, true);

        if (isset($_POST['add_cart'])) {

            $c_beli_barang_id = $this->input->post('c_beli_barang_id');
            $check_cart = $this->pembelian->getCart($c_beli_barang_id)->num_rows();

            if ($check_cart > 0) {
                $this->pembelian->_updateCart($data);
            } else {
                $this->pembelian->addCart($data);
            }

            if ($this->db->affected_rows() > 0) {
                $params = ['success' => true];
            } else {
                $params = ['success' => false];
            }
        }

        if (isset($_POST['edit_cart'])) {
            $this->pembelian->editCart($data);
            if ($this->db->affected_rows() > 0) {
                $params = ['success' => true];
            } else {
                $params = ['success' => false];
            }
        }

        if (isset($_POST['proses_payment'])) {
            $beli_nofak = $this->pembelian->addPembelian($data);

            $carts = $this->pembelian->getCart()->result();
            $row = [];
            foreach ($carts as $cart) {
                array_push($row, [
                    'd_beli_nofak' => $beli_nofak,
                    'd_beli_barang_id' => $cart->c_beli_barang_id,
                    'd_beli_barang_nama' => $cart->c_beli_barang_nama,
                    'd_beli_barang_satuan' => $cart->c_beli_barang_satuan,
                    'd_beli_barang_harpok' => $cart->c_beli_barang_harpok,
                    'd_beli_barang_harjul' => $cart->c_beli_barang_harjul,
                    'd_beli_qty' => $cart->c_beli_qty,
                    'd_beli_diskon' => $cart->c_beli_diskon,
                    'd_beli_total' => $cart->c_beli_total
                ]);
            };

            $this->pembelian->addPembelianDetail($row);
            $this->pembelian->deleteCart(null, $this->session->userdata('user_id'));

            if ($this->db->affected_rows() > 0) {
                $params = ['success' => true, 'beli_nofak' => $beli_nofak];
            } else {
                $params = ['success' => false];
            }
        }

        echo json_encode($params);
    }

    public function cart_data()
    {
        $data['carts'] = $this->pembelian->getCart();
        $this->load->view('admin/pembelian/cart_data', $data);
    }

    function cetak_laporan()
    {
        if ($this->session->userdata("user_role_id") == '1') {
            $tgl_awal = $this->input->get("tgl_mulai", true);
            $tgl_akhir = $this->input->get("tgl_akhir", true);
            $date_awal = substr($tgl_awal, 6) . "-" . substr($tgl_awal, 3, 2) . "-" . substr($tgl_awal, 0, 2) . " 00:00:00";
            $date_akhir = substr($tgl_akhir, 6) . "-" . substr($tgl_akhir, 3, 2) . "-" . substr($tgl_akhir, 0, 2) . " 23:59:59";

            $data['detail_invoice'] = $this->pembelian->get_detail_invoice_by_tgl($date_awal, $date_akhir);
            $data['tgl_awal'] = $date_awal;
            $data['tgl_akhir'] = $date_akhir;

            $this->load->view('admin/pembelian/cetak_laporan', $data);
        } else {
            redirect(site_url('auth'));
        }
    }
}
