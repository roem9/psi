<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Other_model extends MY_Model {

    public function add_cs(){
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->add_data("cs", $data);
        if($query) return 1;
        else return 0;
    }

    public function edit_cs(){
        $id_cs = $this->input->post("id_cs");
        unset($_POST['id_cs']);

        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->edit_data("cs", ["id_cs" => $id_cs], $data);

        // edit data closing 
        $this->edit_data("closing", ["id_cs" => $id_cs], ["nama_cs" => $data['nama_cs']]);

        if($query) return 1;
        else return 0;
    }

    public function get_cs(){
        $id_cs = $this->input->post("id_cs");
        $data = $this->get_one("cs", ["id_cs" => $id_cs]);
        return $data;
    }

    public function load_cs(){
        $this->datatables->select('id_cs, nama_cs, no_wa, username, alamat');
        $this->datatables->from('cs');
        // $this->datatables->where("hapus", "0");
        $this->datatables->add_column('menu','
                    <span class="dropdown">
                    <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                        '.tablerIcon("settings", "").'
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item detailCs" data-bs-toggle="modal" href="#detailCs" data-id="$1">
                            '.tablerIcon("info-circle", "me-1").'
                            Detail CS
                        </a>
                    </div>
                    </span>', 'id_cs');

        return $this->datatables->generate();
    }

    public function add_gudang(){
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->add_data("gudang", $data);
        if($query) return 1;
        else return 0;
    }

    public function edit_gudang(){
        $id_gudang = $this->input->post("id_gudang");
        unset($_POST['id_gudang']);

        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->edit_data("gudang", ["id_gudang" => $id_gudang], $data);

        // edit data closing 
        $this->edit_data("closing", ["id_gudang" => $id_gudang], ["nama_gudang" => $data['nama_gudang']]);

        if($query) return 1;
        else return 0;
    }

    public function get_gudang(){
        $id_gudang = $this->input->post("id_gudang");
        $data = $this->get_one("gudang", ["id_gudang" => $id_gudang]);
        return $data;
    }

    public function load_gudang(){
        $this->datatables->select('id_gudang, nama_gudang');
        $this->datatables->from('gudang');
        // $this->datatables->where("hapus", "0");
        $this->datatables->add_column('menu','
                    <span class="dropdown">
                    <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                        '.tablerIcon("settings", "").'
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item detailGudang" data-bs-toggle="modal" href="#detailGudang" data-id="$1">
                            '.tablerIcon("info-circle", "me-1").'
                            Detail Gudang
                        </a>
                    </div>
                    </span>', 'id_gudang');

        return $this->datatables->generate();
    }

    public function add_kpi(){
        $tgl_kpi = $this->input->post("tgl_kpi");
        $month_kpi = date("m", strtotime($tgl_kpi));
        $year_kpi = date("Y", strtotime($tgl_kpi));

        $kpi = $this->get_one("kpi_cs", "MONTH(tgl_kpi) = '$month_kpi' && YEAR(tgl_kpi) = '$year_kpi'");

        if(!$kpi){
            $data = [];
            foreach ($_POST as $key => $value) {
                $data[$key] = $this->input->post($key);
            }
    
            $query = $this->add_data("kpi_cs", $data);
            if($query) return 1;
            else return 0;
        } else {
            return 2;
        }
    }

    public function edit_kpi(){
        $id_kpi = $this->input->post("id_kpi");
        unset($_POST['id_kpi']);

        
        $tgl_kpi = $this->input->post("tgl_kpi");
        $month_kpi = date("m", strtotime($tgl_kpi));
        $year_kpi = date("Y", strtotime($tgl_kpi));

        $kpi = $this->get_one("kpi_cs", "MONTH(tgl_kpi) = '$month_kpi' && YEAR(tgl_kpi) = '$year_kpi'");

        if(!$kpi){
            $data = [];
            foreach ($_POST as $key => $value) {
                $data[$key] = $this->input->post($key);
            }
    
            $query = $this->edit_data("kpi_cs", ["id_kpi" => $id_kpi], $data);
    
            if($query) return 1;
            else return 0;
        } else {
            return 2;
        }
    }

    public function get_kpi(){
        $id_kpi = $this->input->post("id_kpi");
        $data = $this->get_one("kpi_cs", ["id_kpi" => $id_kpi]);
        return $data;
    }

    public function load_kpi(){
        $this->datatables->select('id_kpi, tgl_kpi, leads, closing, delivered_closing, customer_retensi, referal, kesalahan_data, komplain, rapel_laporan, tgl_input');
        $this->datatables->from('kpi_cs');
        // $this->datatables->where("hapus", "0");
        $this->datatables->add_column('periode', '$1', 'periode(tgl_kpi)');
        $this->datatables->add_column('menu','
                    <span class="dropdown">
                    <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                        '.tablerIcon("settings", "").'
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item detailKpi" data-bs-toggle="modal" href="#detailKpi" data-id="$1">
                            '.tablerIcon("info-circle", "me-1").'
                            Detail KPI
                        </a>
                    </div>
                    </span>', 'id_kpi');

        return $this->datatables->generate();
    }

    public function add_pencairan(){
        $id_cs = $this->input->post("id_cs");
        $cs = $this->get_one("cs", ["id_cs" => $id_cs]);

        $periode_tahun = $this->input->post("periode_tahun");
        $periode_bulan = $this->input->post("periode_bulan");
        $periode = $periode_tahun . "-" . $periode_bulan . "-01";

        $data = [
            "id_cs" => $id_cs,
            "nama_cs" => $cs['nama_cs'],
            "tgl_pencairan" => $this->input->post("tgl_pencairan"),
            "periode" => $periode,
            "nominal" => rupiah_to_int($this->input->post("nominal"))
        ];

        $query = $this->add_data("pencairan_cs", $data);
        if($query) return 1;
        else return 0;
    }

    public function edit_pencairan(){
        $id_pencairan = $this->input->post("id_pencairan");
        unset($_POST['id_pencairan']);
        
        $id_cs = $this->input->post("id_cs");
        $cs = $this->get_one("cs", ["id_cs" => $id_cs]);

        $periode_tahun = $this->input->post("periode_tahun");
        $periode_bulan = $this->input->post("periode_bulan");
        $periode = $periode_tahun . "-" . $periode_bulan . "-01";

        $data = [
            "id_cs" => $id_cs,
            "nama_cs" => $cs['nama_cs'],
            "tgl_pencairan" => $this->input->post("tgl_pencairan"),
            "periode" => $periode,
            "nominal" => rupiah_to_int($this->input->post("nominal"))
        ];

        $query = $this->edit_data("pencairan_cs", ["id_pencairan" => $id_pencairan], $data);

        if($query) return 1;
        else return 0;
    }

    public function get_pencairan(){
        $id_pencairan = $this->input->post("id_pencairan");
        
        $data = $this->get_one("pencairan_cs", ["id_pencairan" => $id_pencairan]);
        $data['periode_bulan'] = date("m", strtotime($data['periode']));
        $data['periode_tahun'] = date("Y", strtotime($data['periode']));
        
        return $data;
    }

    public function load_pencairan(){
        $this->datatables->select('id_pencairan, id_cs, nama_cs, tgl_pencairan, periode, nominal, tgl_input');
        $this->datatables->from('pencairan_cs');
        $this->datatables->add_column('periode_pencairan', '$1', 'periode(periode)');
        $this->datatables->add_column('menu','
                    <span class="dropdown">
                    <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                        '.tablerIcon("settings", "").'
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item detailPencairan" data-bs-toggle="modal" href="#detailPencairan" data-id="$1">
                            '.tablerIcon("info-circle", "me-1").'
                            Detail Pencairan
                        </a>
                    </div>
                    </span>', 'id_pencairan');

        return $this->datatables->generate();
    }
}

/* End of file Artikel_model.php */
