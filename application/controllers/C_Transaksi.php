<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Transaksi extends CI_Controller
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
        $data['judul'] = 'Data Transaksi';
        $this->load->view('layout/header', $data);
        $this->load->view('transaksi/index', $data);
        $this->load->view('layout/footer');
    }
}
