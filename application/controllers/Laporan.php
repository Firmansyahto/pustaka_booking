<?php
defined('BASEPATH') or exit('No Direct script access allowed');
class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    //==================Laporanbuku==============================
    public function laporan_buku()
    {
        $data['judul'] = 'Laporan Data Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('buku/laporan_buku', $data);
        $this->load->view('templates/footer');
    }

    //==================Cetaklaporanbuku==============================
    public function cetak_laporan_buku()
    {
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();

        $this->load->view('buku/laporan_print_buku', $data);
    }

    //==================laporanbukupdf==============================

    public function laporan_buku_pdf()
    {
        $this->load->library('pdf');

        $data['buku'] = $this->ModelBuku->getBuku()->result_array();

        $this->load->view('buku/laporan_pdf_buku', $data);

        $paper_size = 'A4'; //ukuran kertas
        $orientation = 'landscape'; //tipe format
        // $html = $this->output->get_output();

        // $this->dompdf->set_paper($paper_size, $orientation);

        // //convert to PDF
        // $this->dompdf->load_html($html);
        // $this->dompdf->render();
        // $this->dompdf->stream("laporan_data_buku.pdf", array('Attachment' => 0));
        //nama file pdf yang dihasilkan
    }

    //==================Exportexcel==============================

    public function export_excel()
    {
        $data = array('title' => 'Laporan Buku', 'buku' => $this->ModelBuku->getBuku()->result_array());
        $this->load->view('buku/export_excel_buku', $data);
    }

    //==================LaporanPinjam==============================

    public function laporan_pinjam()
    {
        $data['judul'] = 'Laporan Data Peminjaman';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d,buku b,user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('pinjam/laporan-pinjam', $data);
        $this->load->view('templates/footer');
    }

    //==================Cetaklaporanpinjam==============================

    public function cetak_laporan_pinjam()
    {
        $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d, buku b,user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array();
        $this->load->view('pinjam/laporan-print-pinjam', $data);
    }

    //==================laporanpinjampdf==============================
    public function laporan_pinjam_pdf()
    { {
            $this->load->library('pdf');

            $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d, buku b,user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array();

            $this->load->view('pinjam/laporan-pdf-pinjam', $data);

            $paper_size = 'A4'; // ukuran kertas
            $orientation = 'landscape'; //tipe format kertas potrait atau landscape
            // $html = $this->output->get_output();

            // $this->dompdf->set_paper($paper_size, $orientation);
            // //Convert to PDF
            // $this->dompdf->load_html($html);
            // $this->dompdf->render();
            // $this->dompdf->stream("laporan data peminjaman.pdf", array('Attachment' => 0));
            // nama file pdf yang di hasilkan
        }
    }

    public function export_excel_pinjam()
    {
        $data = array('title' => 'Laporan Data Peminjaman Buku', 'laporan' => $this->db->query("select * from pinjam p,detail_pinjam d, buku b,user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array());
        $this->load->view('pinjam/export-excel-pinjam', $data);
    }

    public function index()
    {
        $this->load->library('pdf');
        $this->pdf->generate('laporan/dompdf');
    }
}
