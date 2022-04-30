<div class="modal modal-blur fade" id="addProduk" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formAddProduk">
                    <div class="form-floating mb-3">
                        <input type="text" name="produk" class="form form-control form-control-sm required">
                        <label class="col-form-label">Nama Produk</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btnTambah">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="addVarian" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Varian Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formAddVarian">
                    <div class="form-floating mb-3">
                        <input type="text" name="kode_varian" class="form form-control form-control-sm required">
                        <label class="col-form-label">Kode Varian</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nama_varian" class="form form-control form-control-sm required">
                        <label class="col-form-label">Nama Varian</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="produk" class="form form-control form-control-sm required">
                            <option value="">Pilih Produk</option>
                            <?php
                                $produk = produk();
                                foreach ($produk as $produk) :?>
                                <option value="<?= $produk['produk']?>"><?= $produk['produk']?></option>
                            <?php endforeach;?>
                        </select>
                        <label for="">Produk</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="harga" class="form form-control form-control-sm required rupiah">
                        <label class="col-form-label">Harga</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="komisi" class="form form-control form-control-sm required rupiah">
                        <label class="col-form-label">Komisi</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btnTambah">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="detailVarian" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Varian Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_varian" class="form required">
                <div class="form-floating mb-3">
                    <input type="text" name="kode_varian" class="form form-control form-control-sm required">
                    <label class="col-form-label">Kode Varian</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="nama_varian" class="form form-control form-control-sm required">
                    <label class="col-form-label">Nama Varian</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="produk" class="form form-control form-control-sm required">
                        <option value="">Pilih Produk</option>
                        <?php
                            $produk = produk();
                            foreach ($produk as $produk) :?>
                            <option value="<?= $produk['produk']?>"><?= $produk['produk']?></option>
                        <?php endforeach;?>
                    </select>
                    <label for="">Produk</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="harga" class="form form-control form-control-sm required rupiah">
                    <label class="col-form-label">Harga</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="komisi" class="form form-control form-control-sm required rupiah">
                    <label class="col-form-label">Komisi</label>
                </div>
                <label class="form-check">
                    <input class="form-check-input" type="checkbox" name="checkbox" value="yes">
                    <span class="form-check-label">Terapkan komisi untuk semua produk yang sama</span>
                </label>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btnEdit">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="detailProduk" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_produk" class="form required">
                <div class="form-floating mb-3">
                    <input type="text" name="produk" class="form form-control form-control-sm required">
                    <label class="col-form-label">Nama Produk</label>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btnEdit">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>