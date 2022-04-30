<div class="modal modal-blur fade" id="addPenyetokan" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Penyetokan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formPenyetokan">
                    <!-- <h5>List Varian</h5> -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <table class="table card-table table-vcenter text-dark">
                                <thead>
                                    <tr>
                                        <th class="w-1">No</th>
                                        <th>Varian</th>
                                        <th style="width : 30%">QTY</th>
                                    </tr>
                                </thead>
                                <tbody id="listOfVarian">
                                </tbody>
                            </table>
                            <div class="form-floating mt-3">
                                <input type="text" name="cari_varian" class="form-control form-control-sm">
                                <label class="col-form-label">Input Varian</label>
                            </div>

                            <?php $varian = list_varian();?>
                            <ul class="list-group listOfVarianSelect" style="display:none">
                            </ul>
                        </div>
                    </div>

                    
                    <!-- <div class="form-floating mb-3">
                        <input type="datetime-local" name="tgl_penyetokan" class="form form-control form-control-sm required">
                        <label class="col-form-label">Tgl. Penyetokan</label>
                    </div> -->
                    <div class="form-floating mb-3">
                        <textarea name="keterangan" class="form form-control form-control-sm required" data-bs-toggle="autosize"></textarea>
                        <label class="col-form-label">Keterangan</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btnSimpan" style="display:none">Tambah Penyetokan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="detailPenyetokan" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Penyetokan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDetailPenyetokan">
                        <!-- <h5>List Varian</h5> -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <table class="table card-table table-vcenter text-dark">
                                    <thead>
                                        <tr>
                                            <th class="w-1">No</th>
                                            <th>Varian</th>
                                            <th style="width : 30%">QTY</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listOfVarianDetail">
                                    </tbody>
                                </table>
                                
                                <div class="form-floating mt-3">
                                    <input type="text" name="cari_varian" class="form-control form-control-sm">
                                    <label class="col-form-label">Input Varian Produk</label>
                                </div>

                                <?php $varian = list_varian();?>
                                <ul class="list-group listOfVarianSelect" style="display:none">
                                </ul>
                            </div>
                        </div>

                        <input type="hidden" name="id_penyetokan" class="form">
                        <div class="form-floating mb-3">
                            <input type="datetime-local" name="tgl_penyetokan" class="form form-control form-control-sm required" style="background-color: white">
                            <label class="col-form-label">Tgl. Penyetokan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="keterangan" class="form form-control form-control-sm required" data-bs-toggle="autosize"></textarea>
                            <label class="col-form-label">Keterangan</label>
                        </div>
                    </form>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btnEdit"><?= tablerIcon("device-floppy", "me-1")?> Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
</div>