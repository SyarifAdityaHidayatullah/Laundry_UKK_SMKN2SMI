<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('level') == 'kasir') {
            redirect('C_Pelanggan');
        }
        if ($this->session->userdata('level') == 'owner') {
            redirect('C_Laporan');
        }
        if (!$this->session->userdata('username')) {
            redirect('C_Auth');
        }
    }
    public function index()
    {
        $data['judul'] = 'Data User';
        $data['user'] = $this->M_crud->tampiljoin('outlet', 'user', 'id_outlet', 'id_user');
        $this->load->view('layout/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('layout/footer');
    }
    public function formtambahuser()
    {
        $this->_tambahuser();
    }
    private function _tambahuser()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]', [
            'required' => 'harus diisi',
            'is_unique' =>  'username sudah ada'
        ]);
        $this->form_validation->set_rules('level', 'Level', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[password1]', [
            'required' => 'harus diisi',
            'matches' => 'Password tidak sama'
        ]);
        $this->form_validation->set_rules('password1', 'Password1', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('outlet', 'Outlet', 'trim|required', [
            'required' => 'harus diisi'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Form Tambah User';
            $data['level'] = ['admin', 'kasir', 'owner'];
            $data['outlet'] = $this->M_crud->tampildata('outlet');
            $this->load->view('layout/header', $data);
            $this->load->view('user/formtambah', $data);
            $this->load->view('layout/footer');
        } else {
            $user = htmlspecialchars($this->input->post('username'), true);
            $pass = htmlspecialchars($this->input->post('password'), true);
            $level = htmlspecialchars($this->input->post('level'), true);
            $outlet = htmlspecialchars($this->input->post('outlet'), true);
            $nama = htmlspecialchars($this->input->post('nama'), true);
            $data = [
                'username' => $user,
                'password' => password_hash($pass, PASSWORD_DEFAULT),
                'level' => $level,
                'nama_user' => $nama,
                'id_outlet' => $outlet
            ];
            $this->M_crud->tambahdata('user', $data);
            $this->session->set_flashdata('pesan', 'User Berhasil Ditambah');
            redirect('C_User');
        }
    }
    public function formedituser($id)
    {
        $this->_edituser($id);
    }
    private function _edituser($id)
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('level', 'Level', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('outlet', 'Outlet', 'trim|required', [
            'required' => 'harus diisi'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Form Edit User';
            $data['level'] = ['admin', 'kasir', 'owner'];
            $data['outlet'] = $this->M_crud->tampildata('outlet');
            $data['user'] = $this->M_crud->formeditdata('user', 'id_user', $id);
            if ($data['user']->id_user) {
                $this->load->view('layout/header', $data);
                $this->load->view('user/formedit', $data);
                $this->load->view('layout/footer');
            } else {
                $this->session->set_flashdata('pesan', 'ID Tidak Ditemukan');
                redirect('C_user');
            }
        } else {
            $user = htmlspecialchars($this->input->post('username'), true);
            $level = htmlspecialchars($this->input->post('level'), true);
            $outlet = htmlspecialchars($this->input->post('outlet'), true);
            $nama = htmlspecialchars($this->input->post('nama'), true);

            $data = [
                'username' => $user,
                'level' => $level,
                'nama_user' => $nama,
                'id_outlet' => $outlet
            ];
            $this->M_crud->editdata('user', 'id_user', $id, $data);
            $this->session->set_flashdata('pesan', 'Data User Berhasil Diedit');
            redirect('C_User');
        }
    }
    public function hapususer($id)
    {
        $this->M_crud->hapusdata('user', 'id_user', $id);
        $this->session->set_flashdata('pesan', 'User Berhasil Dihapus');
        redirect('C_User');
    }
    public function resetpass($id)
    {
        $data = [
            'password' => password_hash('123', PASSWORD_DEFAULT)
        ];
        $this->M_crud->editdata('user', 'id_user', $id, $data);
        $this->session->set_flashdata('pesan', 'Password User Berhasil Direset');
        redirect('C_User');
    }
}
