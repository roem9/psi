<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cs extends MY_Controller {
    public function index(){
        $data['title'] = 'List Cs';
        $data['menu'] = "Other";
        $data['dropdown'] = "listCs";
        $data['modal'] = ["modal_cs"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/cs_reload.js",
            "modules/cs.js",
        ];

        $this->load->view("pages/cs/list_cs", $data);
    }
    
    public function add_cs(){
        $data = $this->cs->add_cs();
        echo json_encode($data);
    }

    public function edit_cs(){
        $data = $this->cs->edit_cs();
        echo json_encode($data);
    }
    
    public function get_cs(){
        $data = $this->cs->get_cs();
        echo json_encode($data);
    }

    public function load_cs(){
        header('Content-Type: application/json');
        $output = $this->cs->load_cs();
        echo $output;
    }

    public function reset_password_cs(){
        $data = $this->cs->reset_password_cs();
        echo json_encode($data);
    }

    public function tagihan($id_cs){
        $cs = $this->cs->get_one("cs", ["md5(id_cs)" => $id_cs]);

        $data['cs'] = $cs;
        $data['title'] = 'Tagihan CS ' . $cs['nama_cs'];
        $data['modal'] = ["modal_cs"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "modules/pembayaran_cs.js",
        ];

        $data['pembayaran'] = $this->cs->pembayaran($id_cs);
        $data['pencairan'] = $this->cs->get_all("pencairan_cs", ["md5(id_cs)" => $id_cs], "tgl_input", "DESC");

        $this->load->view("pages/cs/pembayaran", $data);

    }

    public function add_pencairan(){
        $data = $this->cs->add_pencairan();
        echo json_encode($data);
    }

    public function get_pencairan(){
        $data = $this->cs->get_pencairan();
        echo json_encode($data);
    }

    public function edit_pencairan(){
        $data = $this->cs->edit_pencairan();
        echo json_encode($data);
    }

    public function load_pencairan(){
        $id_cs = $this->input->post("id_cs");

        $data['pembayaran'] = $this->cs->pembayaran(md5($id_cs));
        $data['pencairan'] = $this->cs->get_all("pencairan_cs", ["id_cs" => $id_cs]);

        echo json_encode($data);
    }

    public function listPenjualan($id_cs){
        $cs = $this->cs->get_one("cs", ["md5(id_cs)" => $id_cs]);
        $data['cs'] = $cs;
        $data['title'] = 'List Semua Penjualan ' . $cs['nama_cs'];

        $data['modal'] = ["modal_closing"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/closing_cs_reload.js",
            "modules/closing.js",
        ];

        $this->load->view("pages/cs/closing-list", $data);
    }

    public function load_closing(){
        header('Content-Type: application/json');
        $output = $this->cs->load_closing();
        echo $output;
    }

    public function pendingPickup($id_cs){
        $cs = $this->cs->get_one("cs", ["md5(id_cs)" => $id_cs]);
        $data['cs'] = $cs;
        $data['title'] = 'List Closing Pending Pickup ' . $cs['nama_cs'];

        $data['modal'] = ["modal_closing"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/closing_cs_reload_pending_pickup.js",
            "modules/closing.js",
        ];

        $this->load->view("pages/cs/list_pending_perhatian", $data);
    }

    public function load_pending_pickup(){
        header('Content-Type: application/json');
        $output = $this->cs->load_pending_pickup();
        echo $output;
    }

    public function perluPerhatian($id_cs){
        $cs = $this->cs->get_one("cs", ["md5(id_cs)" => $id_cs]);
        $data['cs'] = $cs;
        $data['title'] = 'List Closing Perlu Perhatian ' . $cs['nama_cs'];

        $data['modal'] = ["modal_closing"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/closing_cs_reload_perlu_perhatian.js",
            "modules/closing.js",
        ];

        $this->load->view("pages/cs/list_pending_perhatian", $data);
    }

    public function load_perlu_perhatian(){
        header('Content-Type: application/json');
        $output = $this->cs->load_perlu_perhatian();
        echo $output;
    }

    public function returCancel($id_cs){
        $cs = $this->cs->get_one("cs", ["md5(id_cs)" => $id_cs]);
        $data['cs'] = $cs;
        $data['title'] = 'List Closing Retur & Cancel ' . $cs['nama_cs'];

        $data['modal'] = ["modal_closing"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/closing_cs_retur_cancel_reload.js",
            "modules/closing.js",
        ];

        $this->load->view("pages/cs/list_retur", $data);
    }

    public function load_retur_cancel(){
        header('Content-Type: application/json');
        $output = $this->cs->load_retur_cancel();
        echo $output;
    }
}

/* End of file Produk.php */
