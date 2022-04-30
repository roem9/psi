<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Penyetokan extends MY_Controller {
    public function list(){
        $data['title'] = 'List Penyetokan';
        $data['menu'] = 'Penyetokan';
        $data['dropdown'] = 'listPenyetokan';

        $data['modal'] = ["modal_laporan", "modal_penyetokan"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "modules/penyetokan.js",
            "load_data/penyetokan_reload.js",
        ];

        $this->load->view("pages/penyetokan/list", $data);
    }

    public function arsip(){
        $data['title'] = 'List Arsip Penyetokan';
        $data['menu'] = 'Penyetokan';
        $data['dropdown'] = 'arsipPenyetokan';

        $data['modal'] = ["modal_laporan"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/penyetokan_reload.js",
            "modules/penyetokan.js",
        ];

        $this->load->view("pages/penyetokan/list", $data);
    }

    public function detail($id_penyetokan){
        $data['title'] = 'Detail Penyetokan';
        $data['menu'] = 'Penyetokan';

        $data['modal'] = ["modal_laporan"];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "modules/penyetokan.js",
        ];

        $data['penyetokan'] = $this->penyetokan->get_one("penyetokan", ["md5(id_penyetokan)" => $id_penyetokan]);
        $data['detail_penyetokan'] = $this->penyetokan->get_all("detail_penyetokan", ["md5(id_penyetokan)" => $id_penyetokan]);

        $this->load->view("pages/penyetokan/detail", $data);

    }

    public function detail_penyetokan(){
        $data = $this->penyetokan->detail_penyetokan();
        echo json_encode($data);
    }

    public function add_penyetokan(){
        $data = $this->penyetokan->add_penyetokan();
        echo json_encode($data);
    }

    public function load_penyetokan($status = ""){
        header('Content-Type: application/json');
        $output = $this->penyetokan->load_penyetokan($status);
        echo $output;
    }

    public function arsip_penyetokan(){
        $data = $this->penyetokan->arsip_penyetokan();
        echo json_encode($data);
    }
    
    public function buka_arsip_penyetokan(){
        $data = $this->penyetokan->buka_arsip_penyetokan();
        echo json_encode($data);
    }

    public function edit_penyetokan(){
        $data = $this->penyetokan->edit_penyetokan();
        echo json_encode($data);
    }
}

/* End of file Penyetokan.php */
