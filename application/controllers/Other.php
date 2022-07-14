<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Other extends MY_Controller {

    public function cs(){
        $data['title'] = 'List CS';
        $data['menu'] = "Other";
        $data['dropdown'] = "listCs";
        $data['modal'] = ["modal_other"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/cs_reload.js",
            "modules/cs.js",
        ];

        $this->load->view("pages/other/list_cs", $data);
    }

    public function add_cs(){
        $data = $this->other->add_cs();
        echo json_encode($data);
    }

    public function edit_cs(){
        $data = $this->other->edit_cs();
        echo json_encode($data);
    }
    
    public function get_cs(){
        $data = $this->other->get_cs();
        echo json_encode($data);
    }

    public function load_cs(){
        header('Content-Type: application/json');
        $output = $this->other->load_cs();
        echo $output;
    }

    public function reset_password_cs(){
        $data = $this->other->reset_password_cs();
        echo json_encode($data);
    }

    public function gudang(){
        $data['title'] = 'List Gudang';
        $data['menu'] = "Other";
        $data['dropdown'] = "listGudang";
        $data['modal'] = ["modal_other"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/gudang_reload.js",
            "modules/gudang.js",
        ];

        $this->load->view("pages/other/list_gudang", $data);
    }

    public function add_gudang(){
        $data = $this->other->add_gudang();
        echo json_encode($data);
    }

    public function edit_gudang(){
        $data = $this->other->edit_gudang();
        echo json_encode($data);
    }
    
    public function get_gudang(){
        $data = $this->other->get_gudang();
        echo json_encode($data);
    }

    public function load_gudang(){
        header('Content-Type: application/json');
        $output = $this->other->load_gudang();
        echo $output;
    }

    public function reset_password_gudang(){
        $data = $this->other->reset_password_gudang();
        echo json_encode($data);
    }

    public function tagihan_gudang(){
        $data['title'] = 'Tagihan Gudang';
        $data['menu'] = "";
        $data['modal'] = ["modal_other"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/gudang_reload.js",
            "modules/gudang.js",
        ];

        $this->load->view("pages/other/list_gudang", $data);

    }

    public function kpi(){
        $data['title'] = 'List KPI';
        $data['menu'] = "Other";
        $data['dropdown'] = "listKpi";
        $data['modal'] = ["modal_other"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/kpi_reload.js",
            "modules/kpi.js",
        ];

        $this->load->view("pages/other/list_kpi", $data);
    }

    public function add_kpi(){
        $data = $this->other->add_kpi();
        echo json_encode($data);
    }

    public function edit_kpi(){
        $data = $this->other->edit_kpi();
        echo json_encode($data);
    }
    
    public function get_kpi(){
        $data = $this->other->get_kpi();
        echo json_encode($data);
    }

    public function load_kpi(){
        header('Content-Type: application/json');
        $output = $this->other->load_kpi();
        echo $output;
    }

    public function pencairan(){
        $data['title'] = 'List Pencairan';
        $data['menu'] = "pencairan";
        $data['modal'] = ["modal_other"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/pencairan_reload.js",
            "modules/pencairan.js",
        ];

        $this->load->view("pages/other/list_pencairan", $data);
    }

    public function add_pencairan(){
        $data = $this->other->add_pencairan();
        echo json_encode($data);
    }

    public function edit_pencairan(){
        $data = $this->other->edit_pencairan();
        echo json_encode($data);
    }
    
    public function get_pencairan(){
        $data = $this->other->get_pencairan();
        echo json_encode($data);
    }

    public function load_pencairan(){
        header('Content-Type: application/json');
        $output = $this->other->load_pencairan();
        echo $output;
    }
}

/* End of file Produk.php */
