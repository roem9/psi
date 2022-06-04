<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
defined('BASEPATH') OR exit('No direct script access allowed');

class Closing extends MY_Controller {
    public function bayar(){
        $data['title'] = 'Bayar Closing';
        $data['menu'] = 'Closing';
        $data['dropdown'] = 'bayarClosing';

        $data['modal'] = ["modal_closing"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/closing_bayar_reload.js",
            "modules/closing.js",
        ];

        $this->load->view("pages/closing/bayar", $data);
    }

    public function list(){
        $data['title'] = 'List Closing';
        $data['menu'] = 'Closing';
        $data['dropdown'] = 'listClosing';

        $data['modal'] = ["modal_closing"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/closing_reload.js",
            "modules/closing.js",
        ];

        $this->load->view("pages/closing/list", $data);
    }

    public function pendingPickup(){
        $data['title'] = 'List Closing Pending Pickup';
        $data['menu'] = 'Closing';
        $data['dropdown'] = 'pendingPickup';

        $data['modal'] = ["modal_closing"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/closing_reload_pending_pickup.js",
            "modules/closing.js",
        ];

        $this->load->view("pages/closing/list", $data);
    }

    public function perluPerhatian(){
        $data['title'] = 'List Closing Perlu Perhatian';
        $data['menu'] = 'Closing';
        $data['dropdown'] = 'perluPerhatian';

        $data['modal'] = ["modal_closing"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/closing_reload_perlu_perhatian.js",
            "modules/closing.js",
        ];

        $this->load->view("pages/closing/list", $data);
    }
    
    public function arsip(){
        $data['title'] = 'List Arsip Closing';
        $data['menu'] = 'Closing';
        $data['dropdown'] = 'arsipClosing';

        $data['modal'] = ["modal_laporan"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/closing_reload.js",
            "modules/closing.js",
        ];

        $this->load->view("pages/closing/list", $data);
    }

    public function load_closing($status = ""){
        header('Content-Type: application/json');
        $output = $this->closing->load_closing($status);
        echo $output;
    }

    public function load_closing_perhatian($table){
        header('Content-Type: application/json');
        $output = $this->closing->load_closing_perhatian($table);
        echo $output;
    }

    public function load_bayar_closing(){
        header('Content-Type: application/json');
        $output = $this->closing->load_bayar_closing();
        echo $output;
    }

    public function add_closing(){
        $data = $this->closing->add_closing();
        echo json_encode($data);
    }

    public function detail_closing(){
        $data = $this->closing->detail_closing();
        echo json_encode($data);
    }

    public function edit_closing(){
        $data = $this->closing->edit_closing();
        echo json_encode($data);
    }

    public function get_closing(){
        $data = $this->closing->get_closing();
        echo json_encode($data);
    }

    public function edit_status_closing(){
        $data = $this->closing->edit_status_closing();
        echo json_encode($data);
    }

    public function get_kode_pos(){
        $data = $this->closing->get_kode_pos();
        echo json_encode($data);
    }

    public function get_rekomendasi_kode_pos(){
        $data = $this->closing->get_rekomendasi_kode_pos();
        echo json_encode($data);
    }

    public function detail($id_closing){
        $data['title'] = 'Detail Closing';
        $data['menu'] = 'Closing';

        // $data['modal'] = ["modal_laporan"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "modules/closing.js",
        ];

        $data['closing'] = $this->closing->get_one("closing", ["md5(id_closing)" => $id_closing]);
        $data['detail_closing'] = $this->closing->get_all("detail_closing", ["md5(id_closing)" => $id_closing]);

        $this->load->view("pages/closing/detail", $data);
    }

    public function arsip_closing(){
        $data = $this->closing->arsip_closing();
        echo json_encode($data);
    }
    
    public function buka_arsip_closing(){
        $data = $this->closing->buka_arsip_closing();
        echo json_encode($data);
    }

    public function add_komen(){
        $data = $this->closing->add_komen();
        echo json_encode($data);
    }

    public function list_komen(){
        $data = $this->closing->list_komen();
        echo json_encode($data);
    }

    public function list_komplain(){
        $data = $this->closing->list_komplain();
        echo json_encode($data);
    }

    public function downloadLaporan(){
        $spreadsheet = new Spreadsheet;

        $nama_gudang = $this->input->post("nama_gudang");
        $tgl_awal = $this->input->post("tgl_awal");
        $tgl_akhir = $this->input->post("tgl_akhir");

        $file_data = $tgl_awal . " s.d " . $tgl_akhir;

        // $semua_closing = $this->closing->get_all("closing", "tgl_closing BETWEEN '$tgl_awal' AND '$tgl_akhir'");
        $this->db->from("closing");
        $this->db->where("tgl_closing BETWEEN '$tgl_awal' AND '$tgl_akhir'");
        $this->db->where("nama_gudang", $nama_gudang);
        $this->db->where("hapus", 0);
        $semua_closing = $this->db->get()->result_array();

        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'List Closing ' . date("d-m-Y", strtotime($tgl_awal)) . ' s.d ' . date("d-m-Y", strtotime($tgl_akhir)) . '')
                    ->setCellValue('A2', 'No')
                    ->setCellValue('B2', 'Tgl. Input')
                    ->setCellValue('C2', 'Tgl. Closing')
                    ->setCellValue('D2', 'Jenis Customer')
                    ->setCellValue('E2', 'Nama Penerima')
                    ->setCellValue('F2', 'Alamat Penerima')
                    ->setCellValue('G2', 'No Telepon')
                    ->setCellValue('H2', 'Kode POS')
                    ->setCellValue('I2', 'Berat')
                    ->setCellValue('J2', 'Transfer')
                    ->setCellValue('K2', 'Nominal COD')
                    ->setCellValue('L2', 'Nama Produk')
                    ->setCellValue('M2', 'Kelurahan')
                    ->setCellValue('N2', 'Quantity')
                    ->setCellValue('O2', 'Warna')
                    ->setCellValue('P2', 'Ukuran')
                    ->setCellValue('Q2', 'Nominal Produk')
                    ->setCellValue('R2', 'Catatan')
                    ->setCellValue('S2', 'Dikirm Menggunakan')
                    ->setCellValue('T2', 'Nama CS')
                    ->setCellValue('U2', 'Stok')
                    ->setCellValue('V2', 'Gudang')
                    ->setCellValue('W2', 'Status Pengiriman');

        $spreadsheet->getActiveSheet()->mergeCells('A1:W1');
        
        $kolom = 3;
        $nomor = 1;
        foreach($semua_closing as $closing) {
            if($closing['metode_pembayaran'] == "transfer"){
                $nominal_trf = $closing['nominal_transaksi'];
                $nominal_cod = "";
            } else {
                $nominal_trf = "";
                $nominal_cod = $closing['nominal_transaksi'];
            }

            $this->db->select("SUM(qty) as qty");
            $this->db->from("detail_closing");
            $this->db->where("id_closing", $closing['id_closing']);
            $qty = $this->db->get()->row_array();

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $nomor)
                ->setCellValue('B' . $kolom, date("d-m-Y", strtotime($closing['tgl_closing'])))
                ->setCellValue('C' . $kolom, date("d-m-Y", strtotime($closing['tgl_input'])))
                ->setCellValue('D' . $kolom, $closing['jenis_closing'])
                ->setCellValue('E' . $kolom, $closing['nama_closing'])
                ->setCellValue('F' . $kolom, $closing['alamat'])
                ->setCellValue('G' . $kolom, $closing['no_hp'])
                ->setCellValue('H' . $kolom, $closing['kode_pos'])
                ->setCellValue('I' . $kolom, "1")
                ->setCellValue('J' . $kolom, $nominal_trf)
                ->setCellValue('K' . $kolom, $nominal_cod)
                ->setCellValue('L' . $kolom, produk_closing($closing['id_closing']))
                // ->setCellValue('L' . $kolom, $closing['produk'])
                ->setCellValue('M' . $kolom, $closing['kelurahan'])
                ->setCellValue('N' . $kolom, $qty['qty'])
                ->setCellValue('O' . $kolom, "")
                ->setCellValue('P' . $kolom, "")
                ->setCellValue('Q' . $kolom, $closing['nominal_produk'])
                ->setCellValue('R' . $kolom, $closing['catatan'])
                ->setCellValue('S' . $kolom, $closing['pengirim'])
                ->setCellValue('T' . $kolom, $closing['nama_cs'])
                ->setCellValue('U' . $kolom, "")
                ->setCellValue('V' . $kolom, $closing['nama_gudang'])
                ->setCellValue('W' . $kolom, $closing['status']);

            $kolom++;
            $nomor++;

        }
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$nama_gudang.' data_closing_'.$file_data.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function view(){
        $data['title'] = "Laporan Data Closing";

        $this->db->from("closing");
        $this->db->where("hapus", 0);
        $closing = $this->db->get()->result_array();

        // $closing = $this->closing->get_all("closing", "", "id_closing", "DESC");
        foreach ($closing as $i => $closing) {
            $data['closing'][$i] = $closing;

            $this->db->select("SUM(qty) as qty");
            $this->db->from("detail_closing");
            $this->db->where("id_closing", $closing['id_closing']);
            $qty = $this->db->get()->row_array();

            $data['closing'][$i]['qty'] = $qty['qty'];
        }
        $this->load->view("pages/closing/view", $data);
    }
}

/* End of file Closing.php */
