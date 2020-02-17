<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Paket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('C_Auth');
        }
        if ($this->session->userdata('level') == 'owner') {
            redirect('C_Laporan');
        }
    }
    public function index()
    {
        $data['judul'] = 'Data Paket';
        if ($this->session->userdata('level') == 'admin') {
            $data['paket'] = $this->M_crud->tampildata('paket');
        } else {
            $data['paket'] = $this->db->get_where('paket', ['id_outlet' => $this->session->userdata('id_outlet')])->result();
        }
        $this->load->view('layout/header', $data);
        $this->load->view('paket/index', $data);
        $this->load->view('layout/footer');
    }
    public function tampil()
    {
        $data['judul'] = 'Data Paket';
        $data['paket'] = $this->M_crud->tampiljoin('outlet', 'paket', 'id_outlet', 'id_paket');
        $this->load->view('layout/header', $data);
        $this->load->view('paket/admin/index', $data);
        $this->load->view('layout/footer');
    }
    public function formtambahpaket()
    {
        $this->_tambahpaket();
    }
    private function _tambahpaket()
    {
        $this->form_validation->set_rules('nama_paket', 'Nama_paket', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('jenis', 'Jenis', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('outlet', 'outlet', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric', [
            'required' => 'harus diisi',
            'numeric' => 'harus diisi dengan angka'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Form Tambah Paket';
            $data['jenis'] = ['kiloan', 'selimut', 'bed_cover', 'kaos', 'lain'];
            $data['outlet'] =  $this->M_crud->tampildata('outlet');
            $this->load->view('layout/header', $data);
            $this->load->view('paket/admin/formtambah', $data);
            $this->load->view('layout/footer');
        } else {
            $nama = htmlspecialchars($this->input->post('nama_paket'));
            $harga = htmlspecialchars($this->input->post('harga'));
            $jenis = htmlspecialchars($this->input->post('jenis'));
            $outlet = htmlspecialchars($this->input->post('outlet'));

            $data = [
                'nama_paket' => $nama,
                'harga' => $harga,
                'jenis' => $jenis,
                'id_outlet' => $outlet
            ];
            $this->M_crud->tambahdata('paket', $data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambah');
            redirect('C_Paket/tampil');
        }
    }
    public function formeditpaket($id)
    {
        $this->_editpaket($id);
    }
    private function _editpaket($id)
    {
        $this->form_validation->set_rules('nama_paket', 'Nama_paket', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('jenis', 'Jenis', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('outlet', 'outlet', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric', [
            'required' => 'harus diisi',
            'numeric' => 'harus diisi dengan angka'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Form Edit Paket';
            $data['jenis'] = ['kiloan', 'selimut', 'bed_cover', 'kaos', 'lain'];
            $data['outlet'] =  $this->M_crud->tampildata('outlet');
            $data['paket'] =  $this->M_crud->formeditdata('paket', 'id_paket', $id);
            $this->load->view('layout/header', $data);
            $this->load->view('paket/admin/formedit', $data);
            $this->load->view('layout/footer');
        } else {
            $nama = htmlspecialchars($this->input->post('nama_paket'));
            $harga = htmlspecialchars($this->input->post('harga'));
            $jenis = htmlspecialchars($this->input->post('jenis'));
            $outlet = htmlspecialchars($this->input->post('outlet'));

            $data = [
                'nama_paket' => $nama,
                'harga' => $harga,
                'jenis' => $jenis,
                'id_outlet' => $outlet
            ];
            $this->M_crud->editdata('paket', 'id_paket', $data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit');
            redirect('C_Paket/tampil');
        }
    }
    public function hapuspaket($id)
    {
        $this->M_crud->hapusdata('paket', 'id_paket', $id);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus');
        redirect('C_Paket/tampil');
    }
}
