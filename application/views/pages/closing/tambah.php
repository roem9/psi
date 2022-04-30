<?php $this->load->view("_partials/header")?>
    <div class="wrapper">
        <div class="sticky-top">
            <?php $this->load->view("_partials/navbar-header")?>
            <?php $this->load->view("_partials/navbar")?>
        </div>
        <div class="page-wrapper">
        <div class="container-xl">
                <!-- Page title -->
                <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                    <h2 class="page-title">
                        <?= $title?>
                    </h2>
                    </div>
                </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <?php if( $this->session->flashdata('pesan') ) : ?>
                        <div class="col-12">
                            <?=$this->session->flashdata('pesan')?>
                        </div>
                    <?php endif;?>
                    <div class="form-floating mb-3">
                        <textarea name="teks" class="form form-control required" data-bs-toggle="autosize"></textarea>
                        <label for="" class="col-form-label">Teks</label>
                        <small class="text-danger">Input form closing disini</small>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <button type="button" class="btn btn-warning w-100 btnGenerate">Generate</button>
                    </div>
                    <form method="post" autocomplete="off" id="formClosing">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h4><?= tablerIcon("user", "", 24)?> Data Customer</h4>
                                <div class="form-floating mb-3">
                                    <input type="date" name="tgl_closing" class="form form-control form-control-sm required">
                                    <label class="col-form-label">Tgl. Closing</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="nama_closing" class="form form-control form-control-sm required">
                                    <label class="col-form-label">Nama Lengkap</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="no_hp" class="form form-control form-control-sm required number">
                                    <label class="col-form-label">No.WA</label>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h4><?= tablerIcon("shopping-cart", "", 24)?> Data Pesanan</h4>
                                <div class="form-floating mb-3">
                                    <textarea name="produk" class="form form-control required" data-bs-toggle="autosize"></textarea>
                                    <label for="" class="col-form-label">Varian Produk</label>
                                </div>
                                <table class="table card-table table-vcenter text-dark">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Varian Produk</th>
                                            <th width="20%">QTY</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listOfClosing">
                                    </tbody>
                                </table>
                                <div class="form-floating mb-3">
                                    <input type="text" name="cari_varian" class="form-control form-control-sm">
                                    <label class="col-form-label">Input Varian Produk</label>
                                </div>

                                <?php $varian = list_varian();?>
                                <ul class="list-group mb-3" id="listOfClosingSelect" style="display:none">
                                    <?php foreach ($varian as $varian) :?>
                                    <?php endforeach;?>
                                </ul>

                                <hr style="height:5px;border:none;color:black;background-color:black;"/>

                                <div class="form-floating mb-3">
                                    <input type="text" name="nominal_transaksi" class="form form-control form-control-sm required rupiah">
                                    <label class="col-form-label">Nominal Transaksi</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="nominal_produk" class="form form-control form-control-sm required rupiah">
                                    <label class="col-form-label">Nominal Produk</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="metode_pembayaran" class="form form-control form-control-sm required">
                                        <option value="">Pilih Metode Pembayaran</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="cod">COD</option>
                                    </select>
                                    <label class="col-form-label">Pembayaran COD / Transfer</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="jenis_closing" class="form form-control form-control-sm required">
                                        <option value="">Pilih Jenis Customer</option>
                                        <option value="New">New</option>
                                        <option value="RO">RO</option>
                                        <option value="Relation">Relation</option>
                                        <option value="Cross Selling">Cross Selling</option>
                                    </select>
                                    <label class="col-form-label">Jenis Customer</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="pengirim" class="form form-control form-control-sm required">
                                        <option value="">Pilih Pengirim</option>
                                        <option value="Mengantar">Mengantar</option>
                                        <option value="Marketplace">Marketplace</option>
                                        <option value="Yubi">Yubi</option>
                                    </select>
                                    <label class="col-form-label">Dikirim Menggunakan</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="nama_gudang" class="form form-control form-control-sm required">
                                        <option value="">Pilih Gudang</option>
                                        <?php $gudang = list_gudang();?>
                                        <?php foreach ($gudang as $gudang) :?>
                                            <option value="<?= $gudang['nama_gudang']?>"><?= $gudang['nama_gudang']?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <label class="col-form-label">Pilih Gudang</label>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4><?= tablerIcon("map-pin", "", 24)?> Data Alamat</h4>
                                <div class="form-floating mb-3">
                                    <textarea name="nama_jalan" class="form form-control required" data-bs-toggle="autosize"></textarea>
                                    <label for="" class="col-form-label">Nama Jalan</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="rt_rw" class="form form-control" data-bs-toggle="autosize"></textarea>
                                    <label for="" class="col-form-label">RT/RW</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="kelurahan" class="form form-control required" data-bs-toggle="autosize"></textarea>
                                    <label for="" class="col-form-label">Kelurahan/Desa</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="kecamatan" class="form form-control required" data-bs-toggle="autosize"></textarea>
                                    <label for="" class="col-form-label">Kecamatan</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="kota_kabupaten" class="form form-control required" data-bs-toggle="autosize" readonly></textarea>
                                    <label for="" class="col-form-label">Kota/Kabupaten</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="provinsi" class="form form-control required" data-bs-toggle="autosize" readonly></textarea>
                                    <label for="" class="col-form-label">Provinsi</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="kode_pos" class="form form-control form-control-sm number" readonly>
                                    <label class="col-form-label">Kode Pos</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="rekomendasi_kode_pos" id="kode_pos" class="form form-control form-control-sm required">
                                    </select>
                                    <label class="col-form-label">Rekomendasi Kode Pos</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="patokan_rumah" class="form form-control" data-bs-toggle="autosize"></textarea>
                                    <label for="" class="col-form-label">Patokan Rumah</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="catatan" class="form form-control" data-bs-toggle="autosize"></textarea>
                                    <label for="" class="col-form-label">Catatan</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="nama_cs" class="form form-control form-control-sm required">
                                        <option value="">Pilih CS</option>
                                        <?php $cs = list_cs();?>
                                        <?php foreach ($cs as $cs) :?>
                                            <option value="<?= $cs['nama_cs']?>"><?= $cs['nama_cs']?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <label class="col-form-label">Nama CS</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <a href="javascript:void(0)" class="btn btn-md btn-primary" id="btnSimpan" style="display: none">
                                <?= tablerIcon("square-plus", "me-1")?>
                                Tambah Penjualan
                            </a>
                        </div>
                    </form>
                    
                </div>
            </div>
            <?php $this->load->view("_partials/footer-bar")?>
        </div>
    </div>

    <!-- load modal -->
    <?php 
        if(isset($modal)) :
            foreach ($modal as $i => $modal) {
                $this->load->view("_partials/modal/".$modal);
            }
        endif;
    ?>

    <script>
        $("#<?= $menu?>").addClass("active")
        $("#<?= $dropdown?>").addClass("active")
        // let urut = 0;
        // let index = 0;
    </script>

    <!-- load javascript -->
    <?php  
        if(isset($js)) :
            foreach ($js as $i => $js) :?>
                <script src="<?= base_url()?>assets/myjs/<?= $js?>"></script>
                <?php 
            endforeach;
        endif;    
    ?>

<?php $this->load->view("_partials/footer")?>