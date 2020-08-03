<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    protected $required = '{field} harus di isi!';

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_role_id')) {
            redirect(site_url('auth'));
        };

        $this->load->model('BarangModel', 'barang');
        $this->load->model('KategoriModel', 'kategori');
        $this->load->model('SatuanModel', 'satuan');
    }

    public function index()
    {
        $this->form_validation->set_rules('type', 'Type', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Barang';
            $data['barangs'] = $this->barang->getBarang();
            $data['kategoris'] = $this->kategori->getKategori();
            $data['satuans'] = $this->satuan->getSatuan();

            $data['datable'] = true;
            $data['concurency'] = true;
            $data['barang'] = true;

            $this->load->view('layout/dashboard/header', $data);
            $this->load->view('admin/barang/index');
            $this->load->view('layout/dashboard/footer');
        } else {
            $type = $this->input->post('type', true);

            $barang_nama = htmlspecialchars($this->input->post('barang_nama', true));
            $barang_harpok = htmlspecialchars(str_replace(',', '', $this->input->post('barang_harpok', true)));
            $barang_harjul = htmlspecialchars(str_replace(',', '', $this->input->post('barang_harjul', true)));
            $barang_harjul_grosir = htmlspecialchars(str_replace(',', '', $this->input->post('barang_harjul_grosir', true)));
            $barang_stok = htmlspecialchars($this->input->post('barang_stok', true));
            $barang_kategori_id = htmlspecialchars($this->input->post('barang_kategori_id', true));
            $barang_satuan_id = htmlspecialchars($this->input->post('barang_satuan_id', true));

            if ($type === 'add') {
                $barang_gambar = $this->barang->_uploadImage($type);
                $barang_id = $this->barang->_barid();
                $this->barang->addBarang($barang_id, $barang_gambar, $barang_nama, $barang_harpok, $barang_harjul, $barang_harjul_grosir, $barang_stok, $barang_kategori_id, $barang_satuan_id);
            } else if ($type === 'edit') {
                if (!empty($_FILES['barang_gambar']['name'])) {
                    $barang_gambar = $this->barang->_uploadImage($type, $this->input->post('kobar'));
                } else {
                    $barang_gambar = $this->input->post('barang_gambar_hidden');
                }

                $barang_id = $this->input->post('barang_id');

                $this->barang->editBarang($barang_id, $barang_gambar, $barang_nama, $barang_harpok, $barang_harjul, $barang_harjul_grosir, $barang_stok, $barang_kategori_id, $barang_satuan_id);
            } else if ($type === 'delete') {
                $barang_id = $this->input->post('barang_id');
                $barang_gambar = $this->input->post('barang_gambar_hidden');

                $this->barang->deletebarang($barang_id, $barang_gambar);
            }
        }
    }

    public function show()
    {
        echo json_encode($this->barang->getBarang($this->input->post('barang_id'))->row());
    }
}
