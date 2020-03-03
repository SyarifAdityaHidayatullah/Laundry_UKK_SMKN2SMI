<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Riwayat extends CI_Controller
{
    public function index()
    {
        $data['judul'] = 'Data Riwayat';
        $this->load->view('layout/header', $data);
        $this->load->view('riwayat/index', $data);
        $this->load->view('layout/footer');
    }
}
