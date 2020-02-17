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
        $data['judul'] = 'Data Laporan';
        $this->load->view('layout/header', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('layout/footer');
    }
}
