<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {
    public function laporan_advertiser(){
        $produk = $this->input->post("produk");
        $tgl_awal = $this->input->post("tgl_awal");
        $tgl_akhir = $this->input->post("tgl_akhir");

        $tgl1 = new DateTime($tgl_awal);
        $tgl2 = new DateTime($tgl_akhir);
        $durasi = date_diff($tgl1, $tgl2);

        $data['title'] = 'Laporan Harian CS Produk ' . $produk . ' ' . date("d-m-Y", strtotime($tgl_awal)) . " s.d " . date("d-m-Y", strtotime($tgl_akhir));

        $data['modal'] = ["modal_laporan"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/closing_reload.js",
            "modules/closing.js",
        ];

        $cs = $this->laporan->get_all("cs");

        $tgl = [];
        for ($i=0; $i <= $durasi->d; $i++) { 
            $tgl[$i] = date('Y-m-d', strtotime('+'.$i.' days', strtotime($tgl_awal)));
        }

        foreach ($tgl as $i => $tgl) {
            $data['laporan_harian'][$i]['tgl'] = $tgl;

            $closingan = $this->laporan->get_all("closing", ["tgl_closing" => $tgl]);

            $id_closingan = [];
            foreach ($closingan as $k => $closingan) {
                $id_closingan[$k] = $closingan['id_closing'];
            }

            $this->db->select("nama_varian, SUM(qty) as qty");
            $this->db->from("detail_closing");
            $this->db->where("produk", $produk);
            $this->db->where_in("id_closing", $id_closingan);
            $this->db->group_by("id_varian");
            $data['laporan_harian'][$i]['closingan'] = $this->db->get()->result_array();

            foreach ($cs as $key => $data_cs) {
                $data['laporan_harian'][$i]['cs'][$key]['data_cs'] = $data_cs;
                
                // laporan leads 
                $leads = $this->laporan->get_one("laporan_harian", ["id_cs" => $data_cs['id_cs'], "produk" => $produk, "tgl_laporan" => $tgl]);
                if($leads) $leads = $leads['leads_iklan'];
                else $leads = 0;
                $data['laporan_harian'][$i]['cs'][$key]['laporan']['leads'] = $leads;
    
                // laporan closing langsung
                $data_closing_langsung = 0;
                $closing = $this->laporan->get_all("closing", ["id_cs" => $data_cs['id_cs'], "tipe_closing" => "Langsung", "tgl_closing" => $tgl]);
                if($closing){
                    foreach ($closing as $closing) {
                        $detail = $this->laporan->get_one("detail_closing", ["id_closing" => $closing['id_closing'], "produk" => $produk]);
                        if($detail) $data_closing_langsung ++;
                    }
                }
                $data['laporan_harian'][$i]['cs'][$key]['laporan']['closing_langsung'] = $data_closing_langsung;
    
                // laporan closing susulan
                $data_closing_susulan = 0;
                $closing = $this->laporan->get_all("closing", ["id_cs" => $data_cs['id_cs'], "tipe_closing" => "Susulan", "tgl_closing" => $tgl]);
                if($closing){
                    foreach ($closing as $closing) {
                        $detail = $this->laporan->get_one("detail_closing", ["id_closing" => $closing['id_closing'], "produk" => $produk]);
                        if($detail) $data_closing_susulan ++;
                    }
                }
                $data['laporan_harian'][$i]['cs'][$key]['laporan']['closing_susulan'] = $data_closing_susulan;
    
                if($data_closing_langsung + $data_closing_susulan == 0){
                    $data['laporan_harian'][$i]['cs'][$key]['konversi'] = 0;
                } else {
                    $data['laporan_harian'][$i]['cs'][$key]['konversi'] = round((($data_closing_langsung + $data_closing_susulan) / $leads) * 100);
                }
            }
        }

        // var_dump($data);
        $this->load->view("pages/laporan/laporan_advertiser", $data);
    }
}

/* End of file Laporan.php */
