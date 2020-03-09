<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Riwayat extends CI_Controller
{
    public function index()
    {
        $data['judul'] = 'Data Riwayat';
        if ($this->session->userdata('level') == 'admin') {
            $data['riwayat'] = $this->M_crud->join4_where([
                'dibayar' => 'dibayar'
            ]);
        } else {
            $data['riwayat'] = $this->M_crud->join4_where([
                'dibayar' => 'dibayar',
                'outlet_id' => $this->session->userdata('id_outlet')
            ]);
        }
        $this->load->view('layout/header', $data);
        $this->load->view('riwayat/index', $data);
        $this->load->view('layout/footer');
    }
}
