<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if (!$this->session->userdata('username')) {
            redirect('C_Auth');
        }
        if ($this->session->userdata('level') == 'owner') {
            redirect('C_Laporan');
        }
    }
    public function index()
    {
        $data['judul'] = 'Transaksi #LaundryAja';
        if ($this->session->userdata('level') == 'admin') {
            $data['paket'] = $this->M_crud->tampildata('paket');
        } else {
            $data['paket'] = $this->db->get_where('paket', ['id_outlet' => $this->session->userdata('id_outlet')])->result();
        }
        $this->load->view('layout/header', $data);
        $this->load->view('transaksi/index', $data);
        $this->load->view('layout/footer');
    }
    public function data_transaksi()
    {
        $data['judul'] = 'Data Transaksi #LaundryAja';
        if ($this->session->userdata('level') == 'admin') {
            $data['laporan'] = $this->M_crud->join4();
            $this->load->view('layout/header', $data);
            $this->load->view('transaksi/data_transaksi', $data);
            $this->load->view('layout/footer');
        } elseif ($this->session->userdata('level') == 'kasir') {
            $data['laporan'] = $this->M_crud->join4_where(['transaksi.id_outlet' => $this->session->userdata('id_outlet')]);
            $this->load->view('layout/header', $data);
            $this->load->view('transaksi/data_transaksi', $data);
            $this->load->view('layout/footer');
        }
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
        $this->form_validation->set_rules('batas_waktu', 'Batas', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('biaya', 'Biaya', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Data Transaksi';
            if ($this->session->userdata('level') == 'admin') {
                $data['paket'] = $this->M_crud->tampildata('paket');
            } else {
                $data['paket'] = $this->db->get_where('paket', ['id_outlet' => $this->session->userdata('id_outlet')])->result();
            }
            $this->load->view('layout/header', $data);
            $this->load->view('transaksi/index', $data);
            $this->load->view('layout/footer');
        } else {
            $pelanggan = htmlspecialchars($this->input->post('id_pelanggan'), ENT_QUOTES);
            $status = htmlspecialchars($this->input->post('status_pembayaran'), ENT_QUOTES);
            $diskon = htmlspecialchars($this->input->post('diskon'), ENT_QUOTES);
            $pajak = htmlspecialchars($this->input->post('pajak'), ENT_QUOTES);
            $ket = htmlspecialchars($this->input->post('ket'), ENT_QUOTES);
            $id_paket = $this->input->post('id_paket');
            $batas_waktu = htmlspecialchars($this->input->post('batas_waktu'), ENT_QUOTES);
            $biaya = htmlspecialchars($this->input->post('biaya'), ENT_QUOTES);
            $jum_total = $this->input->post('total');
            $jum_diskon = $jum_total * $diskon / 100;
            $jum_pajak = $jum_total * $pajak / 100;
            $total_harga = $jum_total - $jum_diskon + $jum_pajak + $biaya;
            if ($pelanggan) {
                if ($this->cart->contents()) {
                    if ($status == 'dibayar') {
                        $trs = [
                            'id_transaksi' => 'TRS' . date('dmyhis'),
                            'id_outlet' => $this->session->userdata('id_outlet'),
                            'id_pelanggan' => $pelanggan,
                            'id_user' => $this->session->userdata('id_user'),
                            'kode_invoice' => date('dmyhis'),
                            'tgl' => date('y-m-d'),
                            'tgl_bayar' => date('Y-m-d H-i-s'),
                            'batas_waktu' => $batas_waktu,
                            'dibayar' => $status,
                            'diskon' => $diskon,
                            'pajak' => $pajak,
                            'biaya_tambahan' => $biaya,
                            'status' => 'proses',
                            'total_harga' => $total_harga
                        ];
                    } else {
                        $trs = [
                            'id_transaksi' => 'TRS' . date('dmyHis'),
                            'id_outlet' => $this->session->userdata('id_outlet'),
                            'id_pelanggan' => $pelanggan,
                            'id_user' => $this->session->userdata('id_user'),
                            'kode_invoice' => date('dmyhis'),
                            'tgl' => date('y-m-d'),
                            'batas_waktu' => $batas_waktu,
                            'dibayar' => $status,
                            'diskon' => $diskon,
                            'pajak' => $pajak,
                            'biaya_tambahan' => $biaya,
                            'status' => 'proses',
                            'total_harga' => $total_harga
                        ];
                    }
                    $this->M_crud->tambahdata('transaksi', $trs);
                    $dtrs = [];
                    foreach ($id_paket as $key => $value) {
                        $dtrs[] = [
                            'id_transaksi' => 'TRS' . date('dmyHis'),
                            'id_paket' => $_POST['id_paket'][$key],
                            'qty' => $_POST['qty'][$key],
                            'keterangan' => $ket
                        ];
                    }
                    $this->db->insert_batch('detail_transaksi', $dtrs);
                    $this->cart->destroy();
                    $this->session->set_flashdata('pesan', 'Transaksi Berhasil');
                    redirect('C_Transaksi/data_transaksi');
                } else {
                    $this->session->set_flashdata('gagal', 'Paket tidak ada di keranjang');
                    redirect('C_transaksi');
                }
            } else {
                $this->session->set_flashdata('gagal', 'ID Tidak Ditemukan');
                redirect('C_transaksi');
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
            $where = ['id_outlet' => $this->session->userdata('id_outlet')];
            $result = $this->M_crud->search('pelanggan', $where, 'nama', 'alamat', 'no_hp', $_GET['term']);
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
    public function detail($id)
    {
        $data['judul'] = 'Detail';
        $data['pelanggan'] = $this->M_crud->join4_where(['id_transaksi' => $id]);
        $data['detail'] = $this->M_crud->join3($id);
        $this->load->view('layout/header', $data);
        $this->load->view('transaksi/detail', $data);
        $this->load->view('layout/footer');
    }
    public function bayar($id)
    {
        $data = [
            'tgl_bayar' => date('Y-m-d H-i-s'),
            'dibayar' => 'dibayar'
        ];
        $this->M_crud->editdata('transaksi', 'id_transaksi', $id, $data);
        $this->session->set_flashdata('pesan', 'Berhasil Dibayar');
        redirect('C_Transaksi/detail/' . $id);
    }
    public function selesai($id)
    {
        $data = [
            'status' => 'selesai'
        ];
        $this->M_crud->editdata('transaksi', 'id_transaksi', $id, $data);
        $this->session->set_flashdata('pesan', 'Data Berhasil diperbarui');
        redirect('C_Transaksi/data_transaksi');
    }
    public function ambil($id)
    {
        $data = [
            'status' => 'diambil'
        ];
        $this->M_crud->editdata('transaksi', 'id_transaksi', $id, $data);
        $this->session->set_flashdata('pesan', 'Berhasil Diambil');
        redirect('C_Transaksi/data_transaksi');
    }
    public function hapus($id)
    {
        $this->M_crud->hapusdata('transaksi', 'id_transaksi', $id);
        $this->session->set_flashdata('pesan', 'Transaksi Berhasil Dihapus');
        redirect('C_Transaksi/data_transaksi');
    }
}
