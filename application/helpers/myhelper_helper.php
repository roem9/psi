<?php
    function tablerIcon($icon, $margin = ""){
        return '
            <svg width="24" height="24" class="'.$margin.'">
                <use xlink:href="'.base_url().'assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-'.$icon.'" />
            </svg>';
    }

    function hari_indo($hari){
        switch($hari){
            case 'Sun':
                $hari_ini = "Minggu";
            break;

            case 'Mon':			
                $hari_ini = "Senin";
            break;
    
            case 'Tue':
                $hari_ini = "Selasa";
            break;
    
            case 'Wed':
                $hari_ini = "Rabu";
            break;
    
            case 'Thu':
                $hari_ini = "Kamis";
            break;
    
            case 'Fri':
                $hari_ini = "Jumat";
            break;
    
            case 'Sat':
                $hari_ini = "Sabtu";
            break;
            
            default:
                $hari_ini = "Tidak di ketahui";
            break;
        }
        return $hari_ini;
    }

    function tgl_indo($tgl, $day = ""){
        $data = explode("-", $tgl);
        $hari = $data[2];
        $bulan = $data[1];
        $tahun = $data[0];

        if($bulan == "01") $bulan = "Januari";
        if($bulan == "02") $bulan = "Februari";
        if($bulan == "03") $bulan = "Maret";
        if($bulan == "04") $bulan = "April";
        if($bulan == "05") $bulan = "Mei";
        if($bulan == "06") $bulan = "Juni";
        if($bulan == "07") $bulan = "Juli";
        if($bulan == "08") $bulan = "Agustus";
        if($bulan == "09") $bulan = "September";
        if($bulan == "10") $bulan = "Oktober";
        if($bulan == "11") $bulan = "November";
        if($bulan == "12") $bulan = "Desember";

        if($day == TRUE){
            $hari_indo = hari_indo(date("D", strtotime($tgl)));

            return $hari_indo . ", " . $hari . " " . $bulan . " " . $tahun;
        } else {
            return $hari . " " . $bulan . " " . $tahun;
        }
    }

    function tgl_waktu($tgl, $day = ""){
        
        $tgl = date("Y-m-d-H-i", strtotime($tgl));
        $data = explode("-", $tgl);
        $hari = $data[2];
        $bulan = $data[1];
        $tahun = $data[0];
        $jam = $data[3];
        $menit = $data[4];

        if($bulan == "01") $bulan = "Januari";
        if($bulan == "02") $bulan = "Februari";
        if($bulan == "03") $bulan = "Maret";
        if($bulan == "04") $bulan = "April";
        if($bulan == "05") $bulan = "Mei";
        if($bulan == "06") $bulan = "Juni";
        if($bulan == "07") $bulan = "Juli";
        if($bulan == "08") $bulan = "Agustus";
        if($bulan == "09") $bulan = "September";
        if($bulan == "10") $bulan = "Oktober";
        if($bulan == "11") $bulan = "November";
        if($bulan == "12") $bulan = "Desember";

        if($day == TRUE){
            $hari_indo = hari_indo(date("D", strtotime($tgl)));

            return $hari_indo . ", " . $hari . " " . $bulan . " " . $tahun . " " . $jam . ":" . $menit;
        } else {
            return $hari . " " . $bulan . " " . $tahun . " " . $jam . ":" . $menit;
        }
    }

    function stok_varian($id_varian){
        $CI =& get_instance();

        $CI->db->select("SUM(qty) as stok");
        $CI->db->from("detail_penyetokan");
        $CI->db->where(["id_varian" => $id_varian]);
        $CI->db->where(["hapus" => 0]);
        $penyetokan = $CI->db->get()->row_array();
        
        $CI->db->select("SUM(qty) as stok");
        $CI->db->from("detail_closing");
        $CI->db->where(["id_varian" => $id_varian]);
        $CI->db->where(["hapus" => 0]);
        $penjualan = $CI->db->get()->row_array();


        return $penyetokan['stok'] - $penjualan['stok'];
    }

    function produk(){
        $CI =& get_instance();
        $CI->db->from("produk");
        $CI->db->where("hapus", "0");
        $CI->db->order_by("produk");
        return $CI->db->get()->result_array();
    }

    function list_varian(){
        $CI =& get_instance();
        $CI->db->from("varian_produk");
        $CI->db->where("hapus", "0");
        $CI->db->order_by("nama_varian");
        return $CI->db->get()->result_array();
    }

    function list_gudang(){
        $CI =& get_instance();
        $CI->db->from("gudang");
        $CI->db->order_by("nama_gudang");
        return $CI->db->get()->result_array();
    }

    function list_cs(){
        $CI =& get_instance();
        $CI->db->from("cs");
        $CI->db->order_by("nama_cs");
        return $CI->db->get()->result_array();
    }

    function rupiah_to_int($data){
        $data = str_replace("Rp. ", "", $data);
        $data = str_replace(".", "", $data);
        return $data;
    }

    function rupiah($angka){
        $hasil_rupiah = "Rp. " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }

    function item_penyetokan($id_penyetokan){
        $CI =& get_instance();
        $CI->db->select("SUM(qty) as stok");
        $CI->db->from("detail_penyetokan");
        $CI->db->where(["id_penyetokan" => $id_penyetokan]);
        
        $stok = $CI->db->get()->row_array();

        if($stok) return $stok['stok'];
        else return 0;
    }

    function item_penjualan($id_penjualan){
        $CI =& get_instance();
        $CI->db->select("SUM(qty) as stok");
        $CI->db->from("detail_closing");
        $CI->db->where(["id_penjualan" => $id_penjualan]);
        
        $stok = $CI->db->get()->row_array();

        if($stok) return $stok['stok'];
        else return 0;
    }

    function produk_closing($id_closing){
        $CI =& get_instance();
        $CI->db->from("detail_closing");
        $CI->db->where(["id_closing" => $id_closing]);
        
        $data = $CI->db->get()->result_array();
        
        // $produk = "<span>";
        $produk = "";
        foreach ($data as $data) {
            $produk .= $data['kode_varian'] . " (" . $data['qty'] . "),";
        }
        $produk = substr($produk, 0, -1);
        // $produk .= "</span>";

        return $produk;
    }

    function durasi($tgl_input = "", $tgl_closing = "", $tgl_delivery = "", $tgl_ubah_status = "", $tgl_retur_cancel = ""){
        if($tgl_delivery == NULL && $tgl_retur_cancel == NULL){
            $tgl1 = new DateTime($tgl_closing);
            $tgl2 = new DateTime('NOW');
            $durasi = date_diff($tgl1, $tgl2);

            return $durasi->d . " hari";
        } else if($tgl_retur_cancel != NULL){
            $tgl1 = new DateTime($tgl_closing);
            $tgl2 = new DateTime($tgl_retur_cancel);
            $durasi = date_diff($tgl1, $tgl2);

            return $durasi->d . " hari";
        } else {
            $tgl1 = new DateTime($tgl_delivery);
            $tgl2 = new DateTime($tgl_ubah_status);
            $durasi = date_diff($tgl1, $tgl2);

            return $durasi->d . " hari";
        }
    }

    function status_input($tgl_input, $tgl_closing){
        $tgl1 = new DateTime($tgl_input);
        $tgl2 = new DateTime($tgl_closing);
        $durasi = date_diff($tgl1, $tgl2);

        if($durasi->d > 2){
            return '<a data-bs-toggle="tooltip" data-bs-placement="top" title="telat menginput data closing">'.tablerIcon("alert-circle", "text-warning").'</a>';
        } else {
            return "";
        }
    }

    function status_delivered($tgl_delivery, $tgl_ubah_status){
        $tgl1 = new DateTime($tgl_delivery);
        $tgl2 = new DateTime($tgl_ubah_status);
        $durasi = date_diff($tgl1, $tgl2);

        if($durasi->d > 3){
            return '<a data-bs-toggle="tooltip" data-bs-placement="top" title="telat mengupdate status pengiriman">'.tablerIcon("alert-circle", "text-warning").'</a>';
        } else {
            return "";
        }
    }

    function warna_status($status){
        if($status == "Waiting") return "#620000";
        elseif($status == "Shipping") return "#E4CD05";
        elseif($status == "Delivered") return "skyblue";
        elseif($status == "Returned") return "red";
        elseif($status == "Canceled") return "grey";
        elseif($status == "Produksi") return "green";
    }

    function periode($tgl){
        $data = explode("-", $tgl);
        $hari = $data[2];
        $bulan = $data[1];
        $tahun = $data[0];

        if($bulan == "01") $bulan = "Januari";
        if($bulan == "02") $bulan = "Februari";
        if($bulan == "03") $bulan = "Maret";
        if($bulan == "04") $bulan = "April";
        if($bulan == "05") $bulan = "Mei";
        if($bulan == "06") $bulan = "Juni";
        if($bulan == "07") $bulan = "Juli";
        if($bulan == "08") $bulan = "Agustus";
        if($bulan == "09") $bulan = "September";
        if($bulan == "10") $bulan = "Oktober";
        if($bulan == "11") $bulan = "November";
        if($bulan == "12") $bulan = "Desember";

        return $bulan." ".$tahun;
    }