<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('C_Auth');
        }
    }
    public function index()
    {
        if ($this->session->userdata('level') == 'admin') {
            $data['judul'] = 'Data Laporan';
            $data['laporan'] = $this->M_crud->join4();
            $this->load->view('layout/header', $data);
            $this->load->view('laporan/index', $data);
            $this->load->view('layout/footer');
        } else {
            $data['judul'] = 'Data Laporan';
            $data['laporan'] = $this->M_crud->join4_where(['outlet_id' => $this->session->userdata('id_outlet')]);
            $this->load->view('layout/header', $data);
            $this->load->view('laporan/index', $data);
            $this->load->view('layout/footer');
        }
    }
    public function detail($id)
    {
        $data['judul'] = 'Detail';
        $data['pelanggan'] = $this->M_crud->join4_where(['id_transaksi' => $id]);
        $data['detail'] = $this->M_crud->join3($id);
        $this->load->view('layout/header', $data);
        $this->load->view('laporan/detail', $data);
        $this->load->view('layout/footer');
    }
}
