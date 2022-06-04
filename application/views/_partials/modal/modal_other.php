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
                        <input type="text" name="no_wa" class="form form-control form-control-sm required">
                        <label class="col-form-label">No. WA</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form form-control form-control-sm required">
                        <label class="col-form-label">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="alamat" class="form form-control" data-bs-toggle="autosize"></textarea>
                        <label for="" class="col-form-label">Alamat</label>
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
                <h5 class="modal-title">Detail CS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_cs" class="form required">
                <div class="form-floating mb-3">
                    <input type="text" name="nama_cs" class="form form-control form-control-sm required">
                    <label class="col-form-label">Nama CS</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="no_wa" class="form form-control form-control-sm required">
                    <label class="col-form-label">No. WA</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form form-control form-control-sm required">
                    <label class="col-form-label">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="alamat" class="form form-control" data-bs-toggle="autosize"></textarea>
                    <label for="" class="col-form-label">Alamat</label>
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

<div class="modal modal-blur fade" id="addGudang" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Gudang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formAddGudang">
                    <div class="form-floating mb-3">
                        <input type="text" name="nama_gudang" class="form form-control form-control-sm required">
                        <label class="col-form-label">Nama Gudang</label>
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

<div class="modal modal-blur fade" id="detailGudang" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Gudang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_gudang" class="form required">
                <div class="form-floating mb-3">
                    <input type="text" name="nama_gudang" class="form form-control form-control-sm required">
                    <label class="col-form-label">Nama Gudang</label>
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

<div class="modal modal-blur fade" id="addKpi" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Key Performance Indicator (KPI)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formAddKpi">
                    <div class="form-floating mb-3">
                        <input type="date" name="tgl_kpi" class="form form-control form-control-sm required">
                        <label class="col-form-label">Tgl KPI</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="leads" class="form form-control form-control-sm required number">
                        <label class="col-form-label">Jumlah Kustomer Yang Dilayani</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="closing" class="form form-control form-control-sm required number">
                        <label class="col-form-label">Jumlah Penjualan Yang Dilakukan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="delivered_closing" class="form form-control form-control-sm required number">
                        <label class="col-form-label">Persentase Paket Sukses</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="customer_retensi" class="form form-control form-control-sm required number">
                        <label class="col-form-label">Tingkat Kustomer Retensi (RO,dll)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="referal" class="form form-control form-control-sm required number">
                        <label class="col-form-label">Tingkat Kustomer Referal</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="kesalahan_data" class="form form-control form-control-sm required number">
                        <label class="col-form-label">Jumlah Kesalahan Data</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="komplain" class="form form-control form-control-sm required number">
                        <label class="col-form-label">Jumlah Pelanggan Komplain</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="rapel_laporan" class="form form-control form-control-sm required number">
                        <label class="col-form-label">Jumlah Rapel Laporan CS</label>
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

<div class="modal modal-blur fade" id="detailKpi" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Key Performance Indicator (KPI)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_kpi" class="form required">
                <div class="form-floating mb-3">
                    <input type="date" name="tgl_kpi" class="form form-control form-control-sm required">
                    <label class="col-form-label">Tgl KPI</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="leads" class="form form-control form-control-sm required number">
                    <label class="col-form-label">Jumlah Kustomer Yang Dilayani</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="closing" class="form form-control form-control-sm required number">
                    <label class="col-form-label">Jumlah Penjualan Yang Dilakukan</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="delivered_closing" class="form form-control form-control-sm required number">
                    <label class="col-form-label">Persentase Paket Sukses</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="customer_retensi" class="form form-control form-control-sm required number">
                    <label class="col-form-label">Tingkat Kustomer Retensi (RO,dll)</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="referal" class="form form-control form-control-sm required number">
                    <label class="col-form-label">Tingkat Kustomer Referal</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="kesalahan_data" class="form form-control form-control-sm required number">
                    <label class="col-form-label">Jumlah Kesalahan Data</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="komplain" class="form form-control form-control-sm required number">
                    <label class="col-form-label">Jumlah Pelanggan Komplain</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="rapel_laporan" class="form form-control form-control-sm required number">
                    <label class="col-form-label">Jumlah Rapel Laporan CS</label>
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
                    <div class="form-floating mb-3">
                        <input type="date" name="tgl_pencairan" class="form form-control form-control-sm required">
                        <label class="col-form-label">Tgl Pencairan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="id_cs" class="form form-control form-control-sm required">
                            <option value="">Pilih CS</option>
                            <?php $cs = list_cs();?>
                            <?php foreach ($cs as $cs) :?>
                                <option value="<?= $cs['id_cs']?>"><?= $cs['nama_cs']?></option>
                            <?php endforeach;?>
                        </select>
                        <label class="col-form-label">Nama CS</label>
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
                    <input type="hidden" name="id_pencairan" class="form">
                    <div class="form-floating mb-3">
                        <input type="date" name="tgl_pencairan" class="form form-control form-control-sm required">
                        <label class="col-form-label">Tgl Pencairan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="id_cs" class="form form-control form-control-sm required">
                            <option value="">Pilih CS</option>
                            <?php $cs = list_cs();?>
                            <?php foreach ($cs as $cs) :?>
                                <option value="<?= $cs['id_cs']?>"><?= $cs['nama_cs']?></option>
                            <?php endforeach;?>
                        </select>
                        <label class="col-form-label">Nama CS</label>
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