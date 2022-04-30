<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Closing_model extends MY_Model {

    public function add_closing(){
        $tgl_closing = trim($this->input->post("tgl_closing"));
        $nama_closing = trim($this->input->post("nama_closing"));
        $no_hp = trim($this->input->post("no_hp"));
        $jenis_closing = trim($this->input->post("jenis_closing"));
        $nama_jalan = trim($this->input->post("nama_jalan"));
        $rt_rw = trim($this->input->post("rt_rw"));
        $kelurahan = trim($this->input->post("kelurahan"));
        $kecamatan = trim($this->input->post("kecamatan"));
        $kota_kabupaten = trim($this->input->post("kota_kabupaten"));
        $provinsi = trim($this->input->post("provinsi"));
        $kode_pos = trim($this->input->post("kode_pos"));
        $patokan_rumah = trim($this->input->post("patokan_rumah"));
        $produk = trim($this->input->post("produk"));
        $jumlah = trim($this->input->post("jumlah"));
        $nominal_transaksi = trim(rupiah_to_int($this->input->post("nominal_transaksi")));
        $nominal_produk = trim(rupiah_to_int($this->input->post("nominal_produk")));
        $metode_pembayaran = trim($this->input->post("metode_pembayaran"));
        $pengirim = trim($this->input->post("pengirim"));
        $nama_cs = trim($this->input->post("nama_cs"));
        $catatan = trim($this->input->post("catatan"));
        $nama_gudang = trim($this->input->post("nama_gudang"));
        $tipe_closing = trim($this->input->post("tipe_closing"));

        $cs = $this->get_one("cs", ["nama_cs" => $nama_cs]);
        $gudang = $this->get_one("gudang", ["nama_gudang" => $nama_gudang]);
        
        $data = [
            "tipe_closing" => $tipe_closing,
            "tgl_closing" => $tgl_closing,
            "nama_closing" => $nama_closing,
            "no_hp" => $no_hp,
            "jenis_closing" => $jenis_closing,
            "alamat" => $nama_jalan . " RT/RW " . $rt_rw . " Prov. " . $provinsi ." Kota/Kab. " . $kota_kabupaten . " Kec. " . $kecamatan . " Kel. " . $kelurahan . " " . $kode_pos . " (" . $patokan_rumah . ")",
            "nama_jalan" => $nama_jalan,
            "rt_rw" => $rt_rw,
            "kecamatan" => $kecamatan,
            "kelurahan" => $kelurahan,
            "kota_kabupaten" => $kota_kabupaten,
            "provinsi" => $provinsi,
            "kode_pos" => $kode_pos,
            "patokan_rumah" => $patokan_rumah,
            "nominal_transaksi" => $nominal_transaksi,
            "nominal_produk" => $nominal_produk,
            "produk" => $produk,
            "pengirim" => $pengirim,
            "metode_pembayaran" => $metode_pembayaran,
            "nama_cs" => $nama_cs,
            "id_cs" => $cs['id_cs'],
            "catatan" => $catatan,
            "nama_gudang" => $nama_gudang,
            "id_gudang" => $gudang['id_gudang'],
        ];

        $duplikat = $this->get_one("closing", ["no_hp" => $no_hp, "produk" => $produk, "nominal_transaksi" => $nominal_transaksi, "nama_closing" => $nama_closing, "tgl_closing" => $tgl_closing]);
        if($duplikat){
            return 0;
        } else {
            $id_closing = $this->add_data("closing", $data);
            
            $id_varian = $this->input->post("id_varian");
            $qty = $this->input->post("qty");
            foreach ($id_varian as $i => $id_varian) {
                $varian = $this->get_one("varian_produk", ["id_varian" => $id_varian]);
                $data = [
                    "id_closing" => $id_closing,
                    "id_varian" => $id_varian,
                    "kode_varian" => $varian['kode_varian'],
                    "nama_varian" => $varian['nama_varian'],
                    "produk" => $varian['produk'],
                    "qty" => $qty[$i],
                    "komisi" => $varian['komisi'],
                ];
    
                $query = $this->add_data("detail_closing", $data);
            }
            
            if($query) return 1;
            else return 0;
        }
    }

    public function detail_closing(){
        $id_closing = $this->input->post("id_closing");

        $data['closing'] = $this->get_one("closing", ["id_closing" => $id_closing]);
        $data['detail_closing'] = $this->get_all("detail_closing", ["id_closing" => $id_closing]);

        return $data;
    }

    public function edit_closing(){
        $id_closing = $this->input->post("id_closing");
        $tgl_closing = trim($this->input->post("tgl_closing"));
        $nama_closing = trim($this->input->post("nama_closing"));
        $no_hp = trim($this->input->post("no_hp"));
        $jenis_closing = trim($this->input->post("jenis_closing"));
        $nama_jalan = trim($this->input->post("nama_jalan"));
        $rt_rw = trim($this->input->post("rt_rw"));
        $kelurahan = trim($this->input->post("kelurahan"));
        $kecamatan = trim($this->input->post("kecamatan"));
        $kota_kabupaten = trim($this->input->post("kota_kabupaten"));
        $provinsi = trim($this->input->post("provinsi"));
        $kode_pos = trim($this->input->post("kode_pos"));
        $patokan_rumah = trim($this->input->post("patokan_rumah"));
        $produk = trim($this->input->post("produk"));
        $jumlah = trim($this->input->post("jumlah"));
        $nominal_transaksi = trim(rupiah_to_int($this->input->post("nominal_transaksi")));
        $nominal_produk = trim(rupiah_to_int($this->input->post("nominal_produk")));
        $metode_pembayaran = trim($this->input->post("metode_pembayaran"));
        $pengirim = trim($this->input->post("pengirim"));
        $nama_cs = trim($this->input->post("nama_cs"));
        $catatan = trim($this->input->post("catatan"));
        $nama_gudang = trim($this->input->post("nama_gudang"));
        $tipe_closing = trim($this->input->post("tipe_closing"));
        $kesalahan_data = trim($this->input->post("kesalahan_data"));
        
        $cs = $this->get_one("cs", ["nama_cs" => $nama_cs]);
        $gudang = $this->get_one("gudang", ["nama_gudang" => $nama_gudang]);

        $data = [
            "tipe_closing" => $tipe_closing,
            "kesalahan_data" => $kesalahan_data,
            "tgl_closing" => $tgl_closing,
            "nama_closing" => $nama_closing,
            "no_hp" => $no_hp,
            "jenis_closing" => $jenis_closing,
            "alamat" => $nama_jalan . " RT/RW " . $rt_rw . " Prov. " . $provinsi ." Kota/Kab. " . $kota_kabupaten . " Kec. " . $kecamatan . " Kel. " . $kelurahan . " " . $kode_pos . " (" . $patokan_rumah . ")",
            "nama_jalan" => $nama_jalan,
            "rt_rw" => $rt_rw,
            "kecamatan" => $kecamatan,
            "kelurahan" => $kelurahan,
            "kota_kabupaten" => $kota_kabupaten,
            "provinsi" => $provinsi,
            "kode_pos" => $kode_pos,
            "patokan_rumah" => $patokan_rumah,
            "nominal_transaksi" => $nominal_transaksi,
            "nominal_produk" => $nominal_produk,
            "produk" => $produk,
            "pengirim" => $pengirim,
            "metode_pembayaran" => $metode_pembayaran,
            "nama_cs" => $nama_cs,
            "id_cs" => $cs['id_cs'],
            "catatan" => $catatan,
            "nama_gudang" => $nama_gudang,
            "id_gudang" => $gudang['id_gudang'],
        ];

        // edit data closing 
        $this->edit_data("closing", ["id_closing" => $id_closing], $data);
        
        // hapus detail closing
        $this->delete_data("detail_closing", ["id_closing" => $id_closing]);

        $id_varian = $this->input->post("id_varian");
        $qty = $this->input->post("qty");
        $harga = $this->input->post("harga");
        foreach ($id_varian as $i => $id_varian) {
            $varian = $this->get_one("varian_produk", ["id_varian" => $id_varian]);
            $data = [
                "id_closing" => $id_closing,
                "id_varian" => $id_varian,
                "kode_varian" => $varian['kode_varian'],
                "nama_varian" => $varian['nama_varian'],
                "produk" => $varian['produk'],
                "qty" => $qty[$i],
                "komisi" => $varian['komisi'],
            ];

            $query = $this->add_data("detail_closing", $data);
        }
        
        if($query) return 1;
        else return 0;
    }

    public function get_kode_pos(){
        $kecamatan = $this->input->post("kecamatan");
        $kelurahan = $this->input->post("kelurahan");

        $data = $this->get_one("kode_pos", ["kelurahan" => $kelurahan, "kecamatan" => $kecamatan]);
        return $data;
    }

    public function get_rekomendasi_kode_pos(){
        $data = [];
        $data_kecamatan = [];
        $data_kelurahan = [];

        $kecamatan = $this->input->post("kecamatan");
        $kelurahan = $this->input->post("kelurahan");

        if($kecamatan != "" && $kelurahan != ""){
            $this->db->from("kode_pos");
            $this->db->like("kelurahan", $kelurahan);
            $this->db->like("kecamatan", $kecamatan);
            $data_kecamatan = $this->db->get()->result_array();
        } else if($kecamatan != "" && $kelurahan == ""){
            $data_kecamatan = $this->get_all_like("kode_pos", "kecamatan", "$kecamatan", "", "kecamatan", "");
        } else if($kecamatan == "" && $kelurahan != ""){
            $data_kelurahan = $this->get_all_like("kode_pos", "kelurahan", "$kelurahan", "", "kecamatan", "");
        }

        $data = $data_kecamatan + $data_kelurahan;

        return $data;
    }

    public function arsip_closing(){
        $id_closing = $this->input->post("id_closing");

        $data = $this->edit_data("closing", ["id_closing" => $id_closing], ["hapus" => 1]);
        $data = $this->edit_data("detail_closing", ["id_closing" => $id_closing], ["hapus" => 1]);
        
        if($data) return 1;
        else return 0;
    }

    public function buka_arsip_closing(){
        $id_closing = $this->input->post("id_closing");

        $data = $this->edit_data("closing", ["id_closing" => $id_closing], ["hapus" => 0]);
        $data = $this->edit_data("detail_closing", ["id_closing" => $id_closing], ["hapus" => 0]);

        if($data) return 1;
        else return 0;
    }

    public function load_closing($status){
        $this->datatables->select('id_closing, tgl_closing, catatan, jenis_closing, nama_closing, nominal_transaksi, nama_cs, nama_gudang, status, tgl_input, tgl_delivery, tgl_ubah_status, tgl_retur_cancel');
        $this->datatables->from('closing');
        $this->db->order_by("tgl_closing", "desc");

        if($status == "arsip") $this->datatables->where("hapus", "1");
        else $this->datatables->where("hapus", "0");

        $this->datatables->edit_column("status", "<a href='#statusClosing' data-id='$3' data-bs-toggle='modal' class='badge statusClosing' style='background-color: $2'>$1</a>", "status, warna_status(status), id_closing");
        $this->datatables->add_column("stok", "$1", "stok_varian(id_closing)");
        $this->datatables->add_column("produk_closing", "$1", "produk_closing(id_closing)");
        $this->datatables->add_column("durasi", "$1", "durasi(tgl_input, tgl_closing, tgl_delivery, tgl_ubah_status, tgl_retur_cancel)");
        $this->datatables->add_column("status_input", "$1", "status_input(tgl_input, tgl_closing)");
        $this->datatables->add_column("status_delivered", "$1", "status_delivered(tgl_delivery, tgl_ubah_status)");

        
        if($status == "arsip"){
            $this->datatables->add_column('menu','
                        <span class="dropdown">
                        <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                            '.tablerIcon("settings", "").'
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item detailClosing" data-bs-toggle="modal" href="#detailClosing" data-id="$1">
                                '.tablerIcon("info-circle", "me-1").'
                                Detail Closing
                            </a>
                            <a class="dropdown-item komenClosing" data-bs-toggle="modal" href="#komenClosing" data-id="$1">
                                '.tablerIcon("message-circle", "me-1").'
                                Komen
                            </a>
                            <a class="dropdown-item bukaArsipClosing" href="javascript:void(0)" data-id="$1">
                                '.tablerIcon("archive", "me-1").'
                                Buka Arsip
                            </a>
                        </div>
                        </span>', 'id_closing, md5(id_closing)');
        } else {
            $this->datatables->add_column('menu','
                        <span class="dropdown">
                        <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                            '.tablerIcon("settings", "").'
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item detailClosing" data-bs-toggle="modal" href="#detailClosing" data-id="$1">
                                '.tablerIcon("info-circle", "me-1").'
                                Detail Closing
                            </a>
                            <a class="dropdown-item komenClosing" data-bs-toggle="modal" href="#komenClosing" data-id="$1">
                                '.tablerIcon("message-circle", "me-1").'
                                Komen
                            </a>
                            <a class="dropdown-item arsipClosing" href="javascript:void(0)" data-id="$1">
                                '.tablerIcon("archive", "me-1").'
                                Arsipkan
                            </a>
                        </div>
                        </span>', 'id_closing, md5(id_closing)');
        }

        return $this->datatables->generate();
    }

    public function load_closing_perhatian($table){
        $this->datatables->select('id_closing, tgl_closing, catatan, jenis_closing, nama_closing, nominal_transaksi, nama_cs, nama_gudang, status, tgl_input, tgl_delivery, tgl_ubah_status');
        $this->datatables->from($table);
        $this->db->order_by("tgl_closing", "desc");

        $this->datatables->where("hapus", "0");

        $this->datatables->edit_column("status", "<a href='#statusClosing' data-id='$3' data-bs-toggle='modal' class='badge statusClosing' style='background-color: $2'>$1</a>", "status, warna_status(status), id_closing");
        $this->datatables->add_column("stok", "$1", "stok_varian(id_closing)");
        $this->datatables->add_column("produk_closing", "$1", "produk_closing(id_closing)");
        $this->datatables->add_column("durasi", "$1", "durasi(tgl_input, tgl_closing, tgl_delivery, tgl_ubah_status)");
        $this->datatables->add_column("status_input", "$1", "status_input(tgl_input, tgl_closing)");
        $this->datatables->add_column("status_delivered", "$1", "status_delivered(tgl_delivery, tgl_ubah_status)");

        
        $this->datatables->add_column('menu','
                    <span class="dropdown">
                    <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                        '.tablerIcon("settings", "").'
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" target="_blank" href="'.base_url().'closing/detail/$2" data-id="$1">
                            '.tablerIcon("info-circle", "me-1").'
                            Detail Closing
                        </a>
                        <a class="dropdown-item komenClosing" data-bs-toggle="modal" href="#komenClosing" data-id="$1">
                            '.tablerIcon("message-circle", "me-1").'
                            Komen
                        </a>
                        <a class="dropdown-item arsipClosing" href="javascript:void(0)" data-id="$1">
                            '.tablerIcon("archive", "me-1").'
                            Arsipkan
                        </a>
                    </div>
                    </span>', 'id_closing, md5(id_closing)');

        return $this->datatables->generate();
    }

    public function get_closing(){
        $id_closing = $this->input->post("id_closing");

        $data = $this->get_one("closing", ["id_closing" => $id_closing]);
        return $data;
    }

    public function edit_status_closing(){
        $id_closing = $this->input->post("id_closing");
        $status = $this->input->post("status");

        if($status == "Delivered"){
            $data = [
                "tgl_delivery" => $this->input->post("tgl_delivery"),
                "tgl_ubah_status" => date("Y-m-d"),
                "tgl_retur_cancel" => NULL,
                "status" => $status
            ];

            // ubah status detail closing menjadi tampil untuk penghitungan stok
            $this->edit_data("detail_closing", ["id_closing" => $id_closing], ["hapus" => 0]);
        } else if($status == "Returned" || $status == "Canceled") {
            $data = [
                "tgl_delivery" => NULL,
                "tgl_ubah_status" => NULL,
                "tgl_retur_cancel" => $this->input->post("tgl_retur_cancel"),
                "status" => $status,
                "catatan" => $this->input->post("catatan"),
            ];

            // ubah status detail closing menjadi terhapus untuk penghitungan stok
            $this->edit_data("detail_closing", ["id_closing" => $id_closing], ["hapus" => 1]);
        } else {
            $data = [
                "status" => $status,
                "tgl_delivery" => NULL,
                "tgl_ubah_status" => NULL,
                "tgl_retur_cancel" => NULL,
            ];

            // ubah status detail closing menjadi tampil untuk penghitungan stok
            $this->edit_data("detail_closing", ["id_closing" => $id_closing], ["hapus" => 0]);
        }

        $query = $this->edit_data("closing", ["id_closing" => $id_closing], $data);

        if($query) return 1;
        else return 0;
    }

    public function add_komen(){
        $id_closing = $this->input->post("id_closing");
        $komen = $this->input->post("komen");
        $id_admin = $this->session->userdata('id_admin');
        $table = "admin";

        $data = [
            "id_closing" => $id_closing,
            "id_user" => $id_admin,
            "nama_user" => "Admin",
            "table_user" => $table,
            "komen" => $komen
        ];

        $query = $this->add_data("komen_closing", $data);

        if($query) return 1;
        else return 0;
    }

    public function list_komen(){
        $id_closing = $this->input->post("id_closing");

        $komen = $this->get_all("komen_closing", ["id_closing" => $id_closing]);

        $data['komen'] = [];
        foreach ($komen as $i => $komen) {
            $data['komen'][$i] = $komen;
            $data['komen'][$i]['tgl_input'] = date("d-m-y h:i", strtotime($komen['tgl_input']));
        }

        $data['closing'] = $this->get_one("closing", ["id_closing" => $id_closing]);
        $data['closing']['produk_closing'] = produk_closing($data['closing']['id_closing']);

        return $data;
    }

}

/* End of file Closing_model.php */
