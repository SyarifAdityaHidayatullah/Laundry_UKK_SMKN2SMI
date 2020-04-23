<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Outlet extends CI_Controller
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
        if ($this->session->userdata('level') == 'kasir') {
            redirect('C_Pelanggan');
        }
    }
    public function index()
    {
        $data['judul'] = 'Data Outlet #LaundryAja';
        $data['outlet'] = $this->M_crud->tampildata('outlet');
        $this->load->view('layout/header', $data);
        $this->load->view('outlet/index', $data);
        $this->load->view('layout/footer');
    }
    public function formtambahoutlet()
    {
        $this->_tambahoutlet();
    }
    private function _tambahoutlet()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('tlp', 'Tlp', 'trim|required|numeric', [
            'required' => 'harus diisi',
            'numeric' => 'harus diisi dengan angka'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Form Tambah Outlet';
            $this->load->view('layout/header', $data);
            $this->load->view('outlet/formtambah', $data);
            $this->load->view('layout/footer');
        } else {
            $nama = htmlspecialchars($this->input->post('nama'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $no_hp = htmlspecialchars($this->input->post('tlp'));

            $data = [
                'nama_outlet' => $nama,
                'alamat_outlet' => $alamat,
                'tlp' => $no_hp
            ];
            $this->M_crud->tambahdata('outlet', $data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambah');
            redirect('C_Outlet');
        }
    }
    public function formeditoutlet($id)
    {
        $this->_editoutlet($id);
    }
    private function _editoutlet($id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('tlp', 'Tlp', 'trim|required|numeric', [
            'required' => 'harus diisi',
            'numeric' => 'harus diisi dengan angka'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Form Edit Outlet';
            $data['outlet'] = $this->M_crud->formeditdata('outlet', 'id_outlet', $id);
            if ($data['outlet']->id_outlet) {
                $this->load->view('layout/header', $data);
                $this->load->view('outlet/formedit', $data);
                $this->load->view('layout/footer');
            } else {
                $this->session->set_flashdata('pesan', 'ID Tidak Ditemukan');
                redirect('C_outlet');
            }
        } else {
            $nama = htmlspecialchars($this->input->post('nama'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $no_hp = htmlspecialchars($this->input->post('tlp'));

            $data = [
                'nama_outlet' => $nama,
                'alamat_outlet' => $alamat,
                'tlp' => $no_hp
            ];
            $this->M_crud->editdata('outlet', 'id_outlet', $id, $data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit');
            redirect('C_Outlet');
        }
    }
    public function hapusoutlet($id)
    {
        $this->M_crud->hapusdata('outlet', 'id_outlet', $id);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus');
        redirect('C_Outlet');
    }
}
