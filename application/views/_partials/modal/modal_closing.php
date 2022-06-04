<div class="modal modal-blur fade" id="statusClosing" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Status Closing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formStatusClosing">
                    <input type="hidden" name="id_closing" class="form">
                    <div class="form-floating mb-3">
                        <input type="text" name="nama_closing" class="form form-control form-control-sm required">
                        <label class="col-form-label">Nama Customer</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="status" class="form form-control form-control-sm required">
                            <option value="">Pilih Status</option>
                            <option value="Canceled">Canceled</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Produksi">Produksi</option>
                            <option value="Returned">Returned</option>
                            <option value="Shipping">Shipping</option>
                            <option value="Waiting">Waiting</option>
                        </select>
                        <label for="">Status</label>
                    </div>
                    <div class="form-floating mb-3" id="tgl_delivery">
                        <input type="date" name="tgl_delivery" class="form form-control form-control-sm">
                        <label class="col-form-label">Tgl. Delivery</label>
                    </div>
                    <div class="form-floating mb-3" id="tgl_retur_cancel">
                        <input type="date" name="tgl_retur_cancel" class="form form-control form-control-sm">
                        <label class="col-form-label">Tgl. Return / Tgl. Cancel</label>
                    </div>
                    <div class="form-floating mb-3" id="catatan">
                        <textarea name="catatan" class="form form-control" data-bs-toggle="autosize"></textarea>
                        <label for="" class="col-form-label">Catatan</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success btnEdit">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="addClosing" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Closing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <textarea name="teks" class="form form-control required" data-bs-toggle="autosize"></textarea>
                    <label for="" class="col-form-label">Teks</label>
                    <small class="text-danger">Input form closing disini</small>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-warning w-100 btnGenerate">Generate</button>
                </div>
                <form id="formClosing">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4><?= tablerIcon("user", "", 24)?> Data Customer</h4>
                            <div class="form-floating mb-3">
                                <select name="tipe_closing" class="form form-control form-control-sm required">
                                    <option value="">Pilih Tipe Closing</option>
                                    <option value="Langsung">Langsung</option>
                                    <option value="Susulan">Susulan</option>
                                </select>
                                <label class="col-form-label">Tipe Closing</label>
                            </div>
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
                            <ul class="list-group mb-3 listOfClosingSelect" style="display:none">
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
                                    <!-- <option value="Relation">Relation</option> -->
                                    <option value="Referal">Referal</option>
                                    <option value="Cross Selling">Cross Selling</option>
                                </select>
                                <label class="col-form-label">Jenis Customer</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="pengirim" class="form form-control form-control-sm required">
                                    <option value="">Pilih Pengirim</option>
                                    <option value="Mengantar">Mengantar</option>
                                    <option value="Bos COD">Bos COD</option>
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

                </form>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btnSimpan" style="display:none">Tambah Closing</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="detailClosing" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Closing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDetailClosing">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4><?= tablerIcon("user", "", 24)?> Data Customer</h4>
                            <input type="hidden" name="id_closing" class="form">
                            <div class="form-floating mb-3">
                                <select name="kesalahan_data" class="form form-control form-control-sm required">
                                    <option value="">Pilih Jawaban</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                                <label class="col-form-label">Apakah terjadi kesalahan data?</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="tipe_closing" class="form form-control form-control-sm required">
                                    <option value="">Pilih Tipe Closing</option>
                                    <option value="Langsung">Langsung</option>
                                    <option value="Susulan">Susulan</option>
                                </select>
                                <label class="col-form-label">Tipe Closing</label>
                            </div>
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
                                <tbody id="listOfClosingDetail">
                                </tbody>
                            </table>
                            <div class="form-floating mb-3">
                                <input type="text" name="cari_varian" class="form-control form-control-sm">
                                <label class="col-form-label">Input Varian Produk</label>
                            </div>

                            <?php $varian = list_varian();?>
                            <ul class="list-group mb-3 listOfClosingSelect" style="display:none">
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
                                    <!-- <option value="Relation">Relation</option> -->
                                    <option value="Referal">Referal</option>
                                    <option value="Cross Selling">Cross Selling</option>
                                </select>
                                <label class="col-form-label">Jenis Customer</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="pengirim" class="form form-control form-control-sm required">
                                    <option value="">Pilih Pengirim</option>
                                    <option value="Mengantar">Mengantar</option>
                                    <option value="Bos COD">Bos COD</option>
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
                                <select name="rekomendasi_kode_pos" id="kode_pos" class="form form-control form-control-sm">
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
                </form>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success" id="btnEdit" style="display:none">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="komenClosing" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Komen Closing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_closing" class="form">
                <div class="card mb-3">
                    <div class="card-body">
                        <h3>Data Closing</h3>
                        <p>Customer : <span id="nama_closing"></span></p>
                        <p>Pesanan Customer : <span id="produk_closing"></span></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3>Komen</h3>
                        <div id="list_komen"></div>
                    </div>
                </div>

                <div class="form-floating mb-3 mt-3">
                    <textarea name="komen" class="form form-control required" data-bs-toggle="autosize"></textarea>
                    <label for="" class="col-form-label">Teks Komen</label>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-success w-100" id="btnKirimKomen">Kirim</button>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="komplainClosing" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Komplain Closing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_closing" class="form">
                <div class="card mb-3">
                    <div class="card-body">
                        <h3>Data Closing</h3>
                        <p>Customer : <span id="nama_closing"></span></p>
                        <p>Pesanan Customer : <span id="produk_closing"></span></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3>Komplain</h3>
                        <div id="list_komplain"></div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>