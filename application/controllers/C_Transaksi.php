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
        $data['judul'] = 'Transaksi';
        if ($this->session->userdata('level') == 'admin') {
            $data['paket'] = $this->M_crud->tampildata('paket');
        } else {
            $data['paket'] = $this->db->get_where('paket', ['id_outlet' => $this->session->userdata('id_outlet')])->result();
        }
        $this->load->view('layout/header', $data);
        $this->load->view('transaksi/index', $data);
        $this->load->view('layout/footer');
    }
    public function transaksi()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('status_pembayaran', 'Status', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('diskon', 'Diskon', 'trim|required|numeric', [
            'numeric' => 'harus diisi dengan angka',
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('pajak', 'Pajak', 'trim|required|numeric', [
            'required' => 'harus diisi',
            'numeric' => 'harus diisi dengan angka'
        ]);
        $this->form_validation->set_rules('ket', 'Ket', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Data Paket';
            if ($this->session->userdata('level') == 'admin') {
                $data['paket'] = $this->M_crud->tampildata('paket');
            } else {
                $data['paket'] = $this->db->get_where('paket', ['id_outlet' => $this->session->userdata('id_outlet')])->result();
            }
            $this->load->view('layout/header', $data);
            $this->load->view('transaksi/index', $data);
            $this->load->view('layout/footer');
        } else {
            $pelanggan = htmlspecialchars($this->input->post('id_pelanggan'));
            $status = htmlspecialchars($this->input->post('status_pembayaran'));
            $diskon = htmlspecialchars($this->input->post('diskon'));
            $pajak = htmlspecialchars($this->input->post('pajak'));
            $ket = htmlspecialchars($this->input->post('ket'));
            $id_paket = $this->input->post('id_paket');
            // $qty = htmlspecialchars($this->input->post('qty'));

            if ($this->cart->contents()) {

                $trs = [
                    'id_transaksi' => 'TRS' . date('dmyhis'),
                    'outlet_id' => $this->session->userdata('id_outlet'),
                    'id_pelanggan' => $pelanggan,
                    'id_user' => $this->session->userdata('id_user'),
                    'kode_invoice' => 'LNRY' . date('dmyhis'),
                    'tgl' => date('y-m-d'),
                    'dibayar' => $status,
                    'diskon' => $diskon,
                    'pajak' => $pajak,
                    'status' => 'baru'
                ];
                $this->M_crud->tambahdata('transaksi', $trs);
                $dtrs = [];
                foreach ($id_paket as $key => $value) {
                    $dtrs[] = [
                        'transaksi_id' => 'TRS' . date('dmyhis'),
                        'id_paket' => $_POST['id_paket'][$key],
                        'qty' => $_POST['qty'][$key],
                        'keterangan' => $ket
                    ];
                }
                $this->db->insert_batch('detail_transaksi', $dtrs);
                $this->cart->destroy();
                $this->session->set_flashdata('pesan', 'Data Berhasil Ditambah');
                redirect('C_Laporan');
            } else {
                $this->session->set_flashdata('pesan', 'Paket tidak ada di keranjang');
                redirect('C_paket');
            }
        }
    }

    // keranjang
    public function simpan_keranjang()
    {
        $data = [
            'id' => $this->input->post('id_paket'),
            'name' => $this->input->post('nama_paket'),
            'price' => $this->input->post('harga'),
            'qty' => $this->input->post('qty'),
        ];
        $this->cart->insert($data);
        echo $this->tampil_keranjang();
    }
    public function load_keranjang()
    {
        echo $this->tampil_keranjang();
    }
    public function tampil_keranjang()
    {
        $output = '';
        foreach ($this->cart->contents() as $items) {
            $output .= '
                <tr>
                    <td><input type="hidden" value="' . $items['id'] . '" name="id_paket[]">' . $items['name'] . '</td>
                    <td>' . number_format($items['price'], 0, '.', '.') . '</td>
                    <td><input type="hidden" value="' . $items['qty'] . '"name="qty[]">' . $items['qty'] . '</td>
                    <td>' . number_format($items['subtotal'], 0, '.', '.') . '</td>
                    <td><button type="button" id="' . $items['rowid'] . '" class="hapus_cart btn btn-danger btn-xs">Hapus</button></td>
                </tr>
            ';
        }
        $output .= '
            <tr>
                <th colspan="3">Total</th>
                <th colspan="2"><input type=hidden value="' . $this->cart->total() . '" name="total">' . 'Rp ' . number_format($this->cart->total(), 0, '.', '.') . '</th>
            </tr>
        ';
        return $output;
    }
    public function hapus_keranjang()
    {
        $data = [
            'rowid' => $this->input->post('row_id'),
            'qty' => 0
        ];
        $this->cart->update($data);
        echo $this->tampil_keranjang();
    }
    public function autocomplete()
    {
        if (isset($_GET['term'])) {
            $result = $this->M_crud->autocomplete($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = [
                        'label' => $row->nama . '  -  ' . $row->alamat . ' - ' . $row->no_hp . ' - ' . $row->jk,
                        'id' => $row->id_pelanggan
                    ];
                echo json_encode($arr_result);
            }
        }
    }
}
