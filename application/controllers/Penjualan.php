<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_role_id')) {
            redirect(site_url('auth'));
        };

        $this->load->model('PenjualanModel', 'penjualan');
        $this->load->model('CustomerModel', 'customer');
        $this->load->model('BarangModel', 'barang');
    }

    public function index()
    {
        $data['title'] = 'Transaksi Penjualan';
        $data['nofak'] = $this->penjualan->_nofak();
        $data['carts'] = $this->penjualan->getCart();
        $data['customers'] = $this->customer->getAllCustomerOffline();
        $data['barangs'] = $this->barang->getBarang();

        $data['select2'] = true;
        $data['datable'] = true;
        $data['penjualan'] = true;

        $this->load->view('layout/dashboard/header', $data);
        $this->load->view('admin/penjualan/index');
        $this->load->view('layout/dashboard/footer');
    }

    public function laporan()
    {
        $this->form_validation->set_rules('jual_id', 'Jual ID', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Laporan Penjualan';
            $data['penjualans'] = $this->penjualan->getPenjualan();

            $data['datable'] = true;
            $data['penjualan_laporan'] = true;

            $this->load->view('layout/dashboard/header', $data);
            $this->load->view('admin/penjualan/laporan');
            $this->load->view('layout/dashboard/footer');
        } else {
            $jual_nofak = $this->input->post('jual_id', true);
            $this->penjualan->deletePenjualan($jual_nofak);
        }
    }

    public function laporan_detail($jual_nofak)
    {
        $data['title'] = 'Detail Penjualan';
        $data['penjualan'] = $this->penjualan->getPenjualan($jual_nofak)->row();
        $data['details'] = $this->penjualan->getPenjualanDetail($jual_nofak);

        $data['datable'] = true;

        $this->load->view('layout/dashboard/header', $data);
        $this->load->view('admin/penjualan/laporan_detail');
        $this->load->view('layout/dashboard/footer');
    }

    public function struk_print($jual_nofak)
    {
        $data = [
            'penjualan' => $this->penjualan->getPenjualan($jual_nofak)->row(),
            'penjualanDetails' => $this->penjualan->getPenjualanDetail($jual_nofak)->result()
        ];
        $this->load->view('admin/penjualan/struk', $data);
    }


    // Utility
    public function show()
    {
        echo json_encode($this->penjualan->getCart($this->input->post('c_jual_barang_id'))->row());
    }

    public function show2()
    {
        echo json_encode($this->penjualan->getPenjualan($this->input->post('jual_id'))->row());
    }

    public function destroy()
    {
        $c_jual_id = $this->input->post('c_jual_id');
        $this->penjualan->deleteCart($c_jual_id);

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

            $c_jual_barang_id = $this->input->post('c_jual_barang_id');
            $check_cart = $this->penjualan->getCart($c_jual_barang_id)->num_rows();

            if ($check_cart > 0) {
                $this->penjualan->_updateCart($data);
            } else {
                $this->penjualan->addCart($data);
            }

            if ($this->db->affected_rows() > 0) {
                $params = ['success' => true];
            } else {
                $params = ['success' => false];
            }
        }

        if (isset($_POST['edit_cart'])) {
            $this->penjualan->editCart($data);
            if ($this->db->affected_rows() > 0) {
                $params = ['success' => true];
            } else {
                $params = ['success' => false];
            }
        }

        if (isset($_POST['proses_payment'])) {
            $jual_nofak = $this->penjualan->addPenjualan($data);

            $carts = $this->penjualan->getCart()->result();
            $row = [];
            foreach ($carts as $cart) {
                array_push($row, [
                    'd_jual_nofak' => $jual_nofak,
                    'd_jual_barang_id' => $cart->c_jual_barang_id,
                    'd_jual_barang_nama' => $cart->c_jual_barang_nama,
                    'd_jual_barang_satuan' => $cart->c_jual_barang_satuan,
                    'd_jual_barang_harpok' => $cart->c_jual_barang_harpok,
                    'd_jual_barang_harjul' => $cart->c_jual_barang_harjul,
                    'd_jual_qty' => $cart->c_jual_qty,
                    'd_jual_diskon' => $cart->c_jual_diskon,
                    'd_jual_total' => $cart->c_jual_total
                ]);
            };

            $this->penjualan->addPenjualanDetail($row);
            $this->penjualan->deleteCart(null, $this->session->userdata('user_id'));

            if ($this->db->affected_rows() > 0) {
                $params = ['success' => true, 'jual_nofak' => $jual_nofak];
            } else {
                $params = ['success' => false];
            }
        }

        echo json_encode($params);
    }

    public function cart_data()
    {
        $data['carts'] = $this->penjualan->getCart();
        $this->load->view('admin/penjualan/cart_data', $data);
    }
}
