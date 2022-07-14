<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends MY_Controller {
    public function index(){
        $data['title'] = 'List Gudang';
        $data['menu'] = "Other";
        $data['dropdown'] = "listGudang";
        $data['modal'] = ["modal_gudang"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/gudang_reload.js",
            "modules/gudang.js",
        ];

        $this->load->view("pages/gudang/list_gudang", $data);
    }
    
    public function add_gudang(){
        $data = $this->gudang->add_gudang();
        echo json_encode($data);
    }

    public function edit_gudang(){
        $data = $this->gudang->edit_gudang();
        echo json_encode($data);
    }
    
    public function get_gudang(){
        $data = $this->gudang->get_gudang();
        echo json_encode($data);
    }

    public function load_gudang(){
        header('Content-Type: application/json');
        $output = $this->gudang->load_gudang();
        echo $output;
    }

    public function reset_password_gudang(){
        $data = $this->gudang->reset_password_gudang();
        echo json_encode($data);
    }

    public function tagihan($id_gudang){
        $gudang = $this->gudang->get_one("gudang", ["md5(id_gudang)" => $id_gudang]);

        $data['gudang'] = $gudang;
        $data['title'] = 'Tagihan Gudang ' . $gudang['nama_gudang'];
        $data['modal'] = ["modal_gudang"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "modules/pembayaran.js",
        ];

        $data['pembayaran'] = $this->gudang->pembayaran($id_gudang);
        $data['pencairan'] = $this->gudang->get_all("pencairan_gudang", ["md5(id_gudang)" => $id_gudang], "tgl_input", "DESC");

        $this->load->view("pages/gudang/pembayaran", $data);

    }

    public function add_pencairan(){
        $data = $this->gudang->add_pencairan();
        echo json_encode($data);
    }

    public function get_pencairan(){
        $data = $this->gudang->get_pencairan();
        echo json_encode($data);
    }

    public function edit_pencairan(){
        $data = $this->gudang->edit_pencairan();
        echo json_encode($data);
    }

    public function load_pencairan(){
        $id_gudang = $this->input->post("id_gudang");

        $data['pembayaran'] = $this->gudang->pembayaran(md5($id_gudang));
        $data['pencairan'] = $this->gudang->get_all("pencairan_gudang", ["id_gudang" => $id_gudang]);

        echo json_encode($data);
    }

    public function listPenjualan($id_gudang){
        $gudang = $this->gudang->get_one("gudang", ["md5(id_gudang)" => $id_gudang]);
        $data['gudang'] = $gudang;
        $data['title'] = 'List Semua Penjualan ' . $gudang['nama_gudang'];

        $data['modal'] = ["modal_closing"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/closing_gudang_reload.js",
            "modules/closing.js",
        ];

        $this->load->view("pages/gudang/closing-list", $data);
    }

    public function load_closing(){
        header('Content-Type: application/json');
        $output = $this->gudang->load_closing();
        echo $output;
    }

    public function pendingPickup($id_gudang){
        $gudang = $this->gudang->get_one("gudang", ["md5(id_gudang)" => $id_gudang]);
        $data['gudang'] = $gudang;
        $data['title'] = 'List Closing Pending Pickup ' . $gudang['nama_gudang'];

        $data['modal'] = ["modal_closing"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/closing_gudang_reload_pending_pickup.js",
            "modules/closing.js",
        ];

        $this->load->view("pages/gudang/list_pending_perhatian", $data);
    }

    public function load_pending_pickup(){
        header('Content-Type: application/json');
        $output = $this->gudang->load_pending_pickup();
        echo $output;
    }

    public function perluPerhatian($id_gudang){
        $gudang = $this->gudang->get_one("gudang", ["md5(id_gudang)" => $id_gudang]);
        $data['gudang'] = $gudang;
        $data['title'] = 'List Closing Perlu Perhatian ' . $gudang['nama_gudang'];

        $data['modal'] = ["modal_closing"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/closing_gudang_reload_perlu_perhatian.js",
            "modules/closing.js",
        ];

        $this->load->view("pages/gudang/list_pending_perhatian", $data);
    }

    public function load_perlu_perhatian(){
        header('Content-Type: application/json');
        $output = $this->gudang->load_perlu_perhatian();
        echo $output;
    }

    public function returCancel($id_gudang){
        $gudang = $this->gudang->get_one("gudang", ["md5(id_gudang)" => $id_gudang]);
        $data['gudang'] = $gudang;
        $data['title'] = 'List Closing Retur & Cancel ' . $gudang['nama_gudang'];

        $data['modal'] = ["modal_closing"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/closing_gudang_retur_cancel_reload.js",
            "modules/closing.js",
        ];

        $this->load->view("pages/gudang/list_retur", $data);
    }

    public function load_retur_cancel(){
        header('Content-Type: application/json');
        $output = $this->gudang->load_retur_cancel();
        echo $output;
    }

    public function load_belum_lunas(){
        $output = $this->gudang->load_belum_lunas();
        echo json_encode($output);
    }
}

/* End of file Produk.php */
