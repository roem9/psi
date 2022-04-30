<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends MY_Model {

    public function add_produk(){
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->add_data("produk", $data);
        if($query) return 1;
        else return 0;
    }

    public function edit_produk(){
        $id_produk = $this->input->post("id_produk");
        unset($_POST['id_produk']);

        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $produk = $this->get_one("produk", ["id_produk" => $id_produk]);
        // ubah produk pada varian produk 
        $this->edit_data("varian_produk", ["produk" => $produk['produk']], ["produk" => $data['produk']]);

        // ubah produk pada detail closing 
        $this->edit_data("detail_closing", ["produk" => $produk['produk']], ["produk" => $data['produk']]);

        $query = $this->edit_data("produk", ["id_produk" => $id_produk], $data);
        if($query) return 1;
        else return 0;
    }

    public function get_produk(){
        $id_produk = $this->input->post("id_produk");
        $data = $this->get_one("produk", ["id_produk" => $id_produk]);
        return $data;
    }

    public function arsip_produk(){
        $id_produk = $this->input->post("id_produk");

        $data = $this->edit_data("produk", ["id_produk" => $id_produk], ["hapus" => 1]);
        if($data) return 1;
        else return 0;
    }

    public function load_produk(){
        $this->datatables->select('id_produk, produk');
        $this->datatables->from('produk');
        $this->datatables->where("hapus", "0");
        $this->datatables->add_column('menu','
                    <span class="dropdown">
                    <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                        '.tablerIcon("settings", "").'
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item detailProduk" data-bs-toggle="modal" href="#detailProduk" data-id="$1">
                            '.tablerIcon("info-circle", "me-1").'
                            Detail Produk
                        </a>
                        <a class="dropdown-item arsipProduk" href="javascript:void(0)" data-id="$1">
                            '.tablerIcon("trash", "me-1").'
                            Hapus
                        </a>
                    </div>
                    </span>', 'id_produk');

        return $this->datatables->generate();
    }

    public function load_varian($status){
        $this->datatables->select('id_varian, kode_varian, nama_varian, produk, harga, komisi, tgl_input, hapus');
        $this->datatables->from('varian_produk');

        $this->datatables->add_column('stok','$1', 'stok_varian(id_varian)');

        if($status == "arsip") $this->datatables->where("hapus", "1");
        else $this->datatables->where("hapus", "0");

        if($status == "arsip"){
            $this->datatables->add_column('menu','
                        <span class="dropdown">
                        <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                            '.tablerIcon("settings", "").'
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item detailVarian" data-bs-toggle="modal" href="#detailVarian" data-id="$1">
                                '.tablerIcon("info-circle", "me-1").'
                                Detail Varian
                            </a>
                            <a class="dropdown-item bukaArsipVarian" href="javascript:void(0)" data-id="$1">
                                '.tablerIcon("archive", "me-1").'
                                Buka Arsip
                            </a>
                        </div>
                        </span>', 'id_varian');
        } else {
            $this->datatables->add_column('menu','
                        <span class="dropdown">
                        <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                            '.tablerIcon("settings", "").'
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item detailVarian" data-bs-toggle="modal" href="#detailVarian" data-id="$1">
                                '.tablerIcon("info-circle", "me-1").'
                                Detail Varian
                            </a>
                            <a class="dropdown-item arsipVarian" href="javascript:void(0)" data-id="$1">
                                '.tablerIcon("archive", "me-1").'
                                Arsipkan
                            </a>
                        </div>
                        </span>', 'id_varian');
        }

        return $this->datatables->generate();
    }

    public function add_varian(){
        $_POST['harga'] = rupiah_to_int($_POST['harga']);
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }
        
        $query = $this->add_data("varian_produk", $data);

        if($query) return 1;
        else return 0;
    }

    public function get_varian(){
        $id_varian = $this->input->post("id_varian");
        $data = $this->get_one("varian_produk", ["id_varian" => $id_varian]);
        return $data;
    }

    public function edit_varian(){
        // edit seluruh artikel dengan kondisi memiliki nama artikel dan produk yang sama
        $id_varian = $this->input->post("id_varian");
        $all_komisi = $this->input->post("all_komisi");
        
        unset($_POST['all_komisi']);
        unset($_POST['id_varian']);


        $_POST['harga'] = rupiah_to_int($_POST['harga']);
        $_POST['komisi'] = rupiah_to_int($_POST['komisi']);

        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }
        
        // jika all_komisi = Yes ubah semua komisi jika produknya sama 
        if($all_komisi == "Yes"){
            $this->edit_data("varian_produk", ["produk" => $data['produk']], ["komisi" => $data['komisi']]);
        }

        // ubah semua data varian pada detail closing
        $detail = [
            "kode_varian" => $data['kode_varian'],
            "nama_varian" => $data['nama_varian'],
            "produk" => $data['produk'],
        ];
        $this->edit_data("detail_closing", ["id_varian" => $id_varian], $detail);

        $query = $this->edit_data("varian_produk", ["id_varian" => $id_varian], $data);
        // if($query) return 1;
        // else return 0;
        return 1;
    }
    
    public function arsip_varian(){
        $id_varian = $this->input->post("id_varian");

        $data = $this->edit_data("varian_produk", ["id_varian" => $id_varian], ["hapus" => 1]);
        if($data) return 1;
        else return 0;
    }

    public function buka_arsip_varian(){
        $id_varian = $this->input->post("id_varian");

        $data = $this->edit_data("varian_produk", ["id_varian" => $id_varian], ["hapus" => 0]);
        if($data) return 1;
        else return 0;
    }

    public function get_all_varian(){
        $varian = $this->get_all("varian_produk", ["hapus" => 0], "nama_varian");
        
        $data = [];
        foreach ($varian as $i => $varian) {
            $data[$i] = $varian;
            $data[$i]['stok'] = stok_varian($varian['id_varian']);
        }

        return $data;
    }
}

/* End of file Artikel_model.php */
