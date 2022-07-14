<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller {

    public function index(){
        $data['title'] = 'List Produk';
        $data['menu'] = "Produk";
        $data['dropdown'] = "produk";
        $data['modal'] = ["modal_produk", "modal_laporan"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/produk_reload.js",
            "modules/produk.js",
        ];

        $this->load->view("pages/artikel/produk", $data);
    }

    public function add_produk(){
        $data = $this->produk->add_produk();
        echo json_encode($data);
    }

    public function edit_produk(){
        $data = $this->produk->edit_produk();
        echo json_encode($data);
    }
    
    public function get_produk(){
        $data = $this->produk->get_produk();
        echo json_encode($data);
    }

    public function load_produk(){
        header('Content-Type: application/json');
        $output = $this->produk->load_produk();
        echo $output;
    }

    public function varian(){
        $data['title'] = 'List Varian Produk';
        $data['menu'] = "Produk";
        $data['dropdown'] = "listVarian"; 
        $data['modal'] = ["modal_produk", "modal_laporan"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/varian_reload.js",
            "modules/produk.js",
        ];

        $this->load->view("pages/produk/list-varian", $data);
    }

    public function arsipvarian(){
        $data['title'] = 'List Arsip Varian Produk';
        $data['menu'] = "Produk";
        $data['dropdown'] = "arsipVarian"; 
        $data['modal'] = ["modal_produk", "modal_laporan"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/varian_reload.js",
            "modules/produk.js",
        ];

        $this->load->view("pages/produk/list-varian", $data);
    }

    public function load_varian($status = ""){
        header('Content-Type: application/json');
        $output = $this->produk->load_varian($status);
        echo $output;
    }

    public function add_varian(){
        $data = $this->produk->add_varian();
        echo json_encode($data);
    }

    public function get_varian(){
        $data = $this->produk->get_varian();
        echo json_encode($data);
    }

    public function edit_varian(){
        $data = $this->produk->edit_varian();
        echo json_encode($data);
    }

    public function arsip_varian(){
        $data = $this->produk->arsip_varian();
        echo json_encode($data);
    }

    public function buka_arsip_varian(){
        $data = $this->produk->buka_arsip_varian();
        echo json_encode($data);
    }

    public function get_all_varian(){
        $data = $this->produk->get_all_varian();
        echo json_encode($data);
    }

    public function arsip_produk(){
        $data = $this->artikel->arsip_produk();
        echo json_encode($data);
    }

    public function add_harga_suplier(){
        $this->db->select("*");
        $this->db->from("detail_closing");
        $this->db->group_by("id_varian");
        $data = $this->db->get()->result_array();
        
        foreach ($data as $data) {
            $varian = $this->produk->get_one("varian_produk", ["id_varian" => $data['id_varian']]);
            $this->produk->edit_data("detail_closing", ["id_varian" => $data['id_varian']], ["harga_suplier" => $varian['harga_suplier']]);
        }

        echo "sukses";
    }
}

/* End of file Produk.php */
