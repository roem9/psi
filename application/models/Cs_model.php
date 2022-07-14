<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Cs_model extends MY_Model {
    public function add_cs(){
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $data["password"] = md5($_POST['username']);

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

        $this->datatables->add_column("utang", "$1", "utang_cs(id_cs)");
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
                        <a class="dropdown-item" target="_blank" href="'.base_url().'cs/tagihan/$2">
                            '.tablerIcon("coin", "me-1").'
                            Tagihan CS
                        </a>
                        <a class="dropdown-item resetPassword" href="javascript:void(0)" data-id="$1">
                            '.tablerIcon("refresh-alert", "me-1").'
                            Reset Password
                        </a>
                    </div>
                    </span>', 'id_cs, md5(id_cs)');

        return $this->datatables->generate();
    }

    public function reset_password_cs(){
        $id_cs = $this->input->post("id_cs");
        $cs= $this->get_one("cs", ["id_cs" => $id_cs]);

        $query = $this->edit_data("cs", ["id_cs" => $id_cs], ["password" => md5($cs['username'])]);

        if($query) return 1;
        else return 0;
    }

    public function pembayaran($id_cs){
        $this->db->select("id_closing, tgl_closing, DATE_FORMAT(tgl_closing, '%M %Y') as periode")->from("closing")->where("md5(id_cs) = '$id_cs' AND status = 'Delivered' AND hapus = 0")->group_by('MONTH(tgl_closing), YEAR(tgl_closing)');
        $periode = $this->db->get()->result_array();

        $data = [];
        
        foreach ($periode as $i => $periode) {
            $pembayaran = 0;

            $data['periode'][$i] = $periode;
            $closing = $this->get_all("closing", ["MONTH(tgl_closing)" => date("m", strtotime($periode['tgl_closing'])), "YEAR(tgl_closing)" => date("Y", strtotime($periode['tgl_closing'])), "status" => "Delivered", "md5(id_cs)" => $id_cs, "hapus" => 0]);
            foreach ($closing as $closing) {
                $detail_closing = $this->get_all("detail_closing",["id_closing" => $closing['id_closing']]);
                foreach ($detail_closing as $detail_closing) {
                    $pembayaran += ($detail_closing['qty'] * $detail_closing['komisi']);
                }
            }

            $data['periode'][$i]['pembayaran'] = $pembayaran;

            // pencairan 
            $this->db->select("SUM(nominal) as pencairan")->from("pencairan_cs")->where(["md5(id_cs)" => $id_cs, "MONTH(periode)" => date("m", strtotime($periode['tgl_closing'])), "YEAR(periode)" => date("Y", strtotime($periode['tgl_closing']))]);
            $pencairan = $this->db->get()->row_array();

            if($pencairan['pencairan'] != null){
                $data['periode'][$i]['pencairan'] = $pencairan['pencairan'];
            } else {
                $data['periode'][$i]['pencairan'] = 0;
            }
        }

        return $data;

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
            "catatan" => $this->input->post("catatan"),
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
            "catatan" => $this->input->post("catatan"),
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
        $this->datatables->select('id_pencairan, id_cs, nama_cs, tgl_pencairan, periode, nominal, tgl_input, catatan');
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

    public function load_closing(){
        $id_cs = $this->input->post("id_cs");

        $this->datatables->select('id_closing, tgl_closing, catatan, jenis_closing, nama_closing, nominal_transaksi, nama_cs, nama_gudang, status, tgl_input, tgl_delivery, tgl_ubah_status, tgl_retur_cancel, no_hp, id_cs');
        $this->datatables->from('closing');
        $this->datatables->where("hapus = 0 AND md5(id_cs) = '$id_cs'");
        $this->db->order_by("tgl_closing", "desc");


        $this->datatables->edit_column("status", "<a href='#statusClosing' data-id='$3' data-bs-toggle='modal' class='badge statusClosing' style='background-color: $2'>$1</a>", "status, warna_status(status), id_closing");
        $this->datatables->add_column("stok", "$1", "stok_varian(id_closing)");
        $this->datatables->add_column("produk_closing", "$1", "produk_closing(id_closing)");
        $this->datatables->add_column("durasi", "$1", "durasi(tgl_input, tgl_closing, tgl_delivery, tgl_ubah_status, tgl_retur_cancel)");
        $this->datatables->add_column("status_input", "$1", "status_input(tgl_input, tgl_closing)");
        $this->datatables->add_column("status_delivered", "$1", "status_delivered(tgl_delivery, tgl_ubah_status)");

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
                        <a class="dropdown-item resend" data-bs-toggle="modal" href="#addClosing" data-id="$1">
                            '.tablerIcon("repeat", "me-1").'
                            Resend
                        </a>
                        <a class="dropdown-item komenClosing" data-bs-toggle="modal" href="#komenClosing" data-id="$1">
                            '.tablerIcon("message-circle", "me-1").'
                            Komen
                        </a>
                        <a class="dropdown-item komplainClosing" data-bs-toggle="modal" href="#komplainClosing" data-id="$1">
                            '.tablerIcon("alert-octagon", "me-1").'
                            Komplain
                        </a>
                        <a class="dropdown-item arsipClosing" href="javascript:void(0)" data-id="$1">
                            '.tablerIcon("archive", "me-1").'
                            Arsipkan
                        </a>
                    </div>
                    </span>', 'id_closing, md5(id_closing), nama_closing');

        return $this->datatables->generate();
    }

    public function load_pending_pickup(){
        $id_cs = $this->input->post("id_cs");

        $this->datatables->select('id_closing, tgl_closing, catatan, jenis_closing, nama_closing, nominal_transaksi, nama_cs, nama_gudang, status, tgl_input, tgl_delivery, tgl_ubah_status, no_hp, status_stok');
        $this->datatables->from("closing");
        $this->datatables->where("hapus = 0 AND md5(id_cs) = '$id_cs' AND (status = 'Waiting' OR status = 'Produksi')");
        // $this->datatables->where("hapus", "0");
        $this->db->order_by("tgl_closing", "desc");

        $this->datatables->edit_column("status_stok", "$1", "status_stok(status_stok)");
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
                        <a class="dropdown-item detailClosing" data-bs-toggle="modal" href="#detailClosing" data-id="$1">
                            '.tablerIcon("info-circle", "me-1").'
                            Detail Closing
                        </a>
                        <a class="dropdown-item resend" data-bs-toggle="modal" href="#addClosing" data-id="$1">
                            '.tablerIcon("repeat", "me-1").'
                            Resend
                        </a>
                        <a class="dropdown-item komenClosing" data-bs-toggle="modal" href="#komenClosing" data-id="$1">
                            '.tablerIcon("message-circle", "me-1").'
                            Komen
                        </a>
                        <a class="dropdown-item komplainClosing" data-bs-toggle="modal" href="#komplainClosing" data-id="$1">
                            '.tablerIcon("alert-octagon", "me-1").'
                            Komplain
                        </a>
                        <a class="dropdown-item arsipClosing" href="javascript:void(0)" data-id="$1">
                            '.tablerIcon("archive", "me-1").'
                            Arsipkan
                        </a>
                    </div>
                    </span>', 'id_closing, md5(id_closing)');

        return $this->datatables->generate();
    }
    
    public function load_perlu_perhatian(){
        $id_cs = $this->input->post("id_cs");

        $this->datatables->select('a.id_closing, tgl_closing, catatan, jenis_closing, nama_closing, nominal_transaksi, nama_cs, nama_gudang, a.status, a.tgl_input, tgl_delivery, tgl_ubah_status, no_hp, status_stok');
        $this->datatables->from("closing as a");
        $this->datatables->join("komen_closing as b", "a.id_closing = b.id_closing");
        // $this->datatables->join("komplain_closing as c", "a.id_closing = c.id_closing");
        $this->datatables->where("hapus = 0 AND md5(id_cs) = '$id_cs' AND a.status != 'Delivered' AND a.status != 'Canceled' AND a.status != 'Returned'");
        // $this->datatables->where("hapus", "0");
        $this->db->group_by("a.id_closing");
        $this->db->order_by("tgl_closing", "desc");

        $this->datatables->edit_column("status_stok", "$1", "status_stok(status_stok)");
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
                        <a class="dropdown-item detailClosing" data-bs-toggle="modal" href="#detailClosing" data-id="$1">
                            '.tablerIcon("info-circle", "me-1").'
                            Detail Closing
                        </a>
                        <a class="dropdown-item resend" data-bs-toggle="modal" href="#addClosing" data-id="$1">
                            '.tablerIcon("repeat", "me-1").'
                            Resend
                        </a>
                        <a class="dropdown-item komenClosing" data-bs-toggle="modal" href="#komenClosing" data-id="$1">
                            '.tablerIcon("message-circle", "me-1").'
                            Komen
                        </a>
                        <a class="dropdown-item komplainClosing" data-bs-toggle="modal" href="#komplainClosing" data-id="$1">
                            '.tablerIcon("alert-octagon", "me-1").'
                            Komplain
                        </a>
                        <a class="dropdown-item arsipClosing" href="javascript:void(0)" data-id="$1">
                            '.tablerIcon("archive", "me-1").'
                            Arsipkan
                        </a>
                    </div>
                    </span>', 'id_closing, md5(id_closing)');

        return $this->datatables->generate();
    }

    public function load_retur_cancel(){
        $id_cs = $this->input->post("id_cs");
        
        $this->datatables->select('id_closing, tgl_closing, catatan, jenis_closing, nama_closing, nominal_transaksi, nama_cs, nama_gudang, status, tgl_input, tgl_delivery, tgl_ubah_status, tgl_retur_cancel, no_hp, status_retur');
        $this->datatables->from('closing');
        $this->datatables->where("hapus = 0 AND md5(id_cs) = '$id_cs' AND (status = 'Returned' OR status = 'Canceled')");
        $this->db->order_by("tgl_closing", "desc");

        $this->datatables->edit_column("status_retur", "$1", "status_retur(status, status_retur)");
        $this->datatables->edit_column("status", "<a href='#statusClosing' data-id='$3' data-bs-toggle='modal' class='badge statusClosing' style='background-color: $2'>$1</a>", "status, warna_status(status), id_closing");
        $this->datatables->add_column("stok", "$1", "stok_varian(id_closing)");
        $this->datatables->add_column("produk_closing", "$1", "produk_closing(id_closing)");
        $this->datatables->add_column("durasi", "$1", "durasi(tgl_input, tgl_closing, tgl_delivery, tgl_ubah_status, tgl_retur_cancel)");
        $this->datatables->add_column("status_input", "$1", "status_input(tgl_input, tgl_closing)");
        $this->datatables->add_column("status_delivered", "$1", "status_delivered(tgl_delivery, tgl_ubah_status)");

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
                        <a class="dropdown-item resend" data-bs-toggle="modal" href="#addClosing" data-id="$1">
                            '.tablerIcon("repeat", "me-1").'
                            Resend
                        </a>
                        <a class="dropdown-item komenClosing" data-bs-toggle="modal" href="#komenClosing" data-id="$1">
                            '.tablerIcon("message-circle", "me-1").'
                            Komen
                        </a>
                        <a class="dropdown-item komplainClosing" data-bs-toggle="modal" href="#komplainClosing" data-id="$1">
                            '.tablerIcon("alert-octagon", "me-1").'
                            Komplain
                        </a>
                        <a class="dropdown-item arsipClosing" href="javascript:void(0)" data-id="$1">
                            '.tablerIcon("archive", "me-1").'
                            Arsipkan
                        </a>
                    </div>
                    </span>', 'id_closing, md5(id_closing), nama_closing');

        return $this->datatables->generate();
    }
}

/* End of file Artikel_model.php */
