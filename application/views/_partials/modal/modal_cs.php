<div class="modal modal-blur fade" id="addCs" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah CS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formAddCs">
                    <div class="form-floating mb-3">
                        <input type="text" name="nama_cs" class="form form-control form-control-sm required">
                        <label class="col-form-label">Nama CS</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form form-control form-control-sm required">
                        <label class="col-form-label">Username</label>
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

<div class="modal modal-blur fade" id="detailCs" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Cs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_cs" class="form required">
                <div class="form-floating mb-3">
                    <input type="text" name="nama_cs" class="form form-control form-control-sm required">
                    <label class="col-form-label">Nama CS</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form form-control form-control-sm required">
                    <label class="col-form-label">Username</label>
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

<div class="modal modal-blur fade" id="addPencairan" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pencairan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formAddPencairan">
                    <input type="hidden" name="id_cs" class="form required">
                    <div class="form-floating mb-3">
                        <input type="date" name="tgl_pencairan" class="form form-control form-control-sm required">
                        <label class="col-form-label">Tgl Pencairan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nominal" class="form form-control form-control-sm rupiah required">
                        <label class="col-form-label">Nominal</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Periode</label>
                        <div class="row g-2">
                            <div class="col">
                                <select name="periode_bulan" class="form form-select required">
                                    <option value="">Bulan</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col">
                                <select name="periode_tahun" class="form form-select required">
                                    <option value="">Tahun</option>
                                    <?php
                                        $year = date("Y");

                                        for ($i=2022; $i < $year+1; $i++) :?>
                                            <option value="<?= $i?>"><?= $i?></option>
                                    <?php endfor;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="catatan" class="form form-control required" data-bs-toggle="autosize"></textarea>
                        <label for="" class="col-form-label">Catatan</label>
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

<div class="modal modal-blur fade" id="detailPencairan" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pencairan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formDetailPencairan">
                    <input type="text" name="id_cs" class="form required" value="<?= $cs['id_cs']?>">
                    <input type="text" name="id_pencairan" class="form">
                    <div class="form-floating mb-3">
                        <input type="date" name="tgl_pencairan" class="form form-control form-control-sm required">
                        <label class="col-form-label">Tgl Pencairan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nominal" class="form form-control form-control-sm rupiah required">
                        <label class="col-form-label">Nominal</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Periode</label>
                        <div class="row g-2">
                            <div class="col">
                                <select name="periode_bulan" class="form form-select required">
                                    <option value="">Bulan</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col">
                                <select name="periode_tahun" class="form form-select required">
                                    <option value="">Tahun</option>
                                    <?php
                                        $year = date("Y");

                                        for ($i=2022; $i < $year+1; $i++) :?>
                                            <option value="<?= $i?>"><?= $i?></option>
                                    <?php endfor;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="catatan" class="form form-control required" data-bs-toggle="autosize"></textarea>
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