<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Pelanggan extends CI_Controller
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
        $data['judul'] = 'Data Member #LaundryAja';
        if ($this->session->userdata('level') == 'admin') {
            $data['pelanggan'] = $this->M_crud->tampiljoin('pelanggan', 'outlet', 'id_outlet');
        } else {
            $data['pelanggan'] = $this->M_crud->tampiljoin_where('pelanggan', 'outlet', 'id_outlet', ['pelanggan.id_outlet' => $this->session->userdata('id_outlet')]);
        }
        $this->load->view('layout/header', $data);
        $this->load->view('pelanggan/index', $data);
        $this->load->view('layout/footer');
    }
    public function formtambahpelanggan()
    {
        $this->_tambahpelanggan();
    }

    function _tambahpelanggan()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('jk', 'Jk', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('no_hp', 'No_hp', 'trim|required|numeric', [
            'required' => 'harus diisi',
            'numeric' => 'harus diisi dengan angka'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Form Tambah Member';
            $this->load->view('layout/header', $data);
            $this->load->view('pelanggan/formtambah', $data);
            $this->load->view('layout/footer');
        } else {
            $nama = htmlspecialchars($this->input->post('nama', true), ENT_QUOTES);
            $alamat = htmlspecialchars($this->input->post('alamat', true), ENT_QUOTES);
            $no_hp = htmlspecialchars($this->input->post('no_hp', true), ENT_QUOTES);
            $jk = htmlspecialchars($this->input->post('jk', true), ENT_QUOTES);

            $data = [
                'id_outlet' => $this->session->userdata('id_outlet'),
                'nama' => $nama,
                'alamat' => $alamat,
                'no_hp' => $no_hp,
                'jk' => $jk
            ];
            $this->M_crud->tambahdata('pelanggan', $data);
            $this->session->set_flashdata('pesanberhasil', 'Data Berhasil Ditambah');
            redirect('C_Pelanggan');
        }
    }
    public function formeditpelanggan($id)
    {
        $this->_editpelanggan($id);
    }
    private function _editpelanggan($id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('jk', 'Jk', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('no_hp', 'No_hp', 'trim|required|numeric', [
            'required' => 'harus diisi',
            'numeric' => 'harus diisi dengan angka'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Form Edit Member';
            $data['pelanggan'] = $this->M_crud->formeditdata('pelanggan', 'id_pelanggan', $id);
            if ($data['pelanggan']->id_pelanggan) {
                $this->load->view('layout/header', $data);
                $this->load->view('pelanggan/formedit', $data);
                $this->load->view('layout/footer');
            } else {
                $this->session->set_flashdata('pesan', 'ID Tidak Ditemukan');
                redirect('C_Pelanggan');
            }
        } else {
            $nama = htmlspecialchars($this->input->post('nama', true), ENT_QUOTES);
            $alamat = htmlspecialchars($this->input->post('alamat', true), ENT_QUOTES);
            $no_hp = htmlspecialchars($this->input->post('no_hp', true), ENT_QUOTES);
            $jk = htmlspecialchars($this->input->post('jk', true), ENT_QUOTES);

            $data = [
                'nama' => $nama,
                'alamat' => $alamat,
                'no_hp' => $no_hp,
                'jk' => $jk
            ];
            $this->M_crud->editdata('pelanggan', 'id_pelanggan', $id, $data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit');
            redirect('C_pelanggan');
        }
    }
    public function hapuspelanggan($id)
    {
        $this->M_crud->hapusdata('pelanggan', 'id_pelanggan', $id);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus');
        redirect('C_pelanggan');
    }
}
