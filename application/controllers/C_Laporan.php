<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if (!$this->session->userdata('username')) {
            redirect('C_Auth');
        }
    }
    public function index()
    {
        $data['lapor'] = $this->input->post('pdf');
        if ($this->session->userdata('level') == 'admin') {
            $data['judul'] = ' Data Laporan #LaundryAja';
            $data['laporan'] = $this->M_crud->join4_where(['dibayar' => 'dibayar']);
            $this->load->view('layout/header', $data);
            $this->load->view('laporan/index', $data);
            $this->load->view('layout/footer');
        } else {
            $data['judul'] = 'Data Laporan #LaundryAja';
            $data['laporan'] = $this->M_crud->join4_where(
                [
                    'transaksi.id_outlet' => $this->session->userdata('id_outlet'),
                    'dibayar' => 'dibayar'
                ]
            );

            $this->load->view('layout/header', $data);
            $this->load->view('laporan/index', $data);
            $this->load->view('layout/footer');
        }
    }
    public function cari()
    {
        $this->form_validation->set_rules('tgl_awal', 'Tgl_awal', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('tgl_akhir', 'Tgl_akhir', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $tgl_awal = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');

            if ($this->session->userdata('level') == 'admin') {
                $data['laporan'] = $this->M_crud->join4_where(
                    [
                        'dibayar' => 'dibayar',
                        'tgl >=' => $tgl_awal,
                        'tgl <=' => $tgl_akhir
                    ]
                );
            } else {

                $data['laporan'] = $this->M_crud->join4_where(
                    [
                        'transaksi.id_outlet' => $this->session->userdata('id_outlet'),
                        'dibayar' => 'dibayar',
                        'tgl >=' => $tgl_awal,
                        'tgl <=' => $tgl_akhir
                    ]
                );
            }
            $data['judul'] = 'Data Laporan #LaundryAja';
            $this->load->view('layout/header', $data);
            $this->load->view('laporan/index', $data);
            $this->load->view('layout/footer');
        }
    }
    public function pdf()
    {
        $this->form_validation->set_rules('tgl_awal', 'Tgl_awal', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('tgl_akhir', 'Tgl_akhir', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $tgl_awal = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');

            if ($this->session->userdata('level') == 'admin') {
                $laporan = $this->M_crud->join4_where(
                    [
                        'dibayar' => 'dibayar',
                        'tgl >=' => $tgl_awal,
                        'tgl <=' => $tgl_akhir
                    ]
                );
            } else {

                $laporan = $this->M_crud->join4_where(
                    [
                        'transaksi.id_outlet' => $this->session->userdata('id_outlet'),
                        'dibayar' => 'dibayar',
                        'tgl >=' => $tgl_awal,
                        'tgl <=' => $tgl_akhir
                    ]
                );
            }
            $no = 1;
            $a = 0;
            include_once APPPATH . '/third_party/fpdf/fpdf.php';
            $pdf = new FPDF('l', 'mm', 'A4');
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(300, 8, '', 0, 1, 'C');
            $pdf->Cell(300, 10, 'UKK Laundry Report Pdf', 0, 1, 'C');
            $pdf->Cell(10, 7, '', 0, 1);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 15, 'Tanggal : ' . $tgl_awal . ' / ' . $tgl_akhir, 0, 1, 'R');
            $pdf->Cell(8, 6, 'No', 1, 0, 'C');
            $pdf->Cell(55, 6, 'Nama Pelanggan', 1, 0, 'C');
            $pdf->Cell(42, 6, 'Tanggal Transaksi', 1, 0, 'C');
            $pdf->Cell(42, 6, 'Tanggal Bayar', 1, 0, 'C');
            $pdf->Cell(30, 6, 'Batas Waktu', 1, 0, 'C');
            $pdf->Cell(30, 6, 'Invoice', 1, 0, 'C');
            $pdf->Cell(30, 6, 'status cucian', 1, 0, 'C');
            $pdf->Cell(40, 6, 'Total harga', 1, 1, 'C');
            $pdf->SetFont('Arial', '', 12);
            foreach ($laporan as $row) {
                $pdf->Cell(8, 6, $no++, 1, 0, 'C');
                $pdf->Cell(55, 6, $row->nama, 1, 0, 'C');
                $pdf->Cell(42, 6, $row->tgl, 1, 0, 'C');
                $pdf->Cell(42, 6, $row->tgl_bayar, 1, 0, 'C');
                $pdf->Cell(30, 6, $row->batas_waktu, 1, 0, 'C');
                $pdf->Cell(30, 6, $row->kode_invoice, 1, 0, 'C');
                $pdf->Cell(30, 6, $row->status, 1, 0, 'C');
                $pdf->Cell(40, 6, 'Rp ' . number_format($row->total_harga, 0, '.', '.'), 1, 1, 'C');

                $a = $a + $row->total_harga;
            }
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(70, 8, 'Total Pemasukan adalah Rp. ' . number_format($a, 0, '.', '.'), 0, 0, 'C');
            $pdf->Output();
        }
    }
    public function excel()
    {
        $this->form_validation->set_rules('tgl_awal', 'Tgl_awal', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        $this->form_validation->set_rules('tgl_akhir', 'Tgl_akhir', 'trim|required', [
            'required' => 'harus diisi'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $tgl_awal = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');

            if ($this->session->userdata('level') == 'admin') {
                $laporan = $this->M_crud->join4_where(
                    [
                        'dibayar' => 'dibayar',
                        'tgl >=' => $tgl_awal,
                        'tgl <=' => $tgl_akhir
                    ]
                );
            } else {

                $laporan = $this->M_crud->join4_where(
                    [
                        'transaksi.id_outlet' => $this->session->userdata('id_outlet'),
                        'dibayar' => 'dibayar',
                        'tgl >=' => $tgl_awal,
                        'tgl <=' => $tgl_akhir
                    ]
                );
            }
            include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
            $excel = new PHPExcel();

            $style_col = array(
                'font' => array('bold' => true),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                ),
                'borders' => array(
                    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
                )
            );

            $style_row = array(
                'alignment' => array(
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                ),
                'borders' => array(
                    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
                )
            );

            $excel->setActiveSheetIndex(0)->setCellValue('A1', "UKK Laundry Report Excel");
            $excel->getActiveSheet()->mergeCells('A1:H1');
            $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
            $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
            $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $excel->setActiveSheetIndex(0)->setCellValue('H3', 'Tanggal : ' . $tgl_awal . ' / ' . $tgl_akhir);
            $excel->getActiveSheet()->getStyle('H3')->getFont()->setBold(TRUE);

            $excel->setActiveSheetIndex(0)->setCellValue('A4', "No");
            $excel->setActiveSheetIndex(0)->setCellValue('B4', "Nama Pelanggan");
            $excel->setActiveSheetIndex(0)->setCellValue('C4', "Tanggal Transaksi");
            $excel->setActiveSheetIndex(0)->setCellValue('D4', "Tanggal Bayar");
            $excel->setActiveSheetIndex(0)->setCellValue('E4', "Batas Waktu");
            $excel->setActiveSheetIndex(0)->setCellValue('F4', "Kode Invoice");
            $excel->setActiveSheetIndex(0)->setCellValue('G4', "Status Cucian");
            $excel->setActiveSheetIndex(0)->setCellValue('H4', "Total Harga");

            $excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('H4')->applyFromArray($style_col);

            $no = 1;
            $numrow = 5;
            $a = 0;
            foreach ($laporan as $l) {
                $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no++);
                $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $l->nama);
                $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $l->tgl);
                $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $l->tgl_bayar);
                $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $l->batas_waktu);
                $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $l->kode_invoice);
                $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $l->status);
                $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, 'Rp. ' . number_format($l->total_harga, 0, '.', '.'));

                $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);

                $a = $a + $l->total_harga;
                $numrow++;
            }
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, 'Total Pemasukan anda adalah : Rp. ' . number_format($a, 0, '.', '.'));

            $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
            $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
            $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
            $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);

            $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
            $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            $excel->getActiveSheet(0)->setTitle("Laporan Laundry Excel");
            $excel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Report laundry.xlsx"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');

            $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
            $write->save('php://output');
        }
    }
}
