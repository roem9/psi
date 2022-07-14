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
                        
                        <span class="dropdown">
                            <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                                <?= tablerIcon("menu-2", "me-2")?> Menu
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="<?= base_url()?>cs/tagihan/<?= md5($cs['id_cs'])?>">
                                    <?= tablerIcon("info-circle", "me-1")?>
                                    Tagihan
                                </a>
                                <a class="dropdown-item" href="<?= base_url()?>cs/listpenjualan/<?= md5($cs['id_cs'])?>">
                                    <?= tablerIcon("coin", "me-1")?>
                                    Semua Closing
                                </a>
                                <a class="dropdown-item" href="<?= base_url()?>cs/pendingpickup/<?= md5($cs['id_cs'])?>">
                                    <?= tablerIcon("clock", "me-1")?>
                                    Pending Pickup
                                </a>
                                <a class="dropdown-item" href="<?= base_url()?>cs/perluPerhatian/<?= md5($cs['id_cs'])?>">
                                    <?= tablerIcon("alert-circle", "me-1")?>
                                    Perlu Perhatian
                                </a>
                                <a class="dropdown-item" href="<?= base_url()?>cs/returCancel/<?= md5($cs['id_cs'])?>">
                                    <?= tablerIcon("truck-return", "me-1")?>
                                    Retur & Cancel
                                </a>
                            </div>
                        </span>

                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="javascript:void(0)" class="btn btn-primary d-none d-sm-inline-block btnAddPencairan" data-bs-toggle="modal" data-bs-target="#addPencairan" data-id_cs="<?= $cs['id_cs']?>">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            Tambahkan Pembayaran
                            </a>
                            <a href="javascript:void(0)" class="btn btn-primary d-sm-none btn-icon btnAddPencairan" data-bs-toggle="modal" data-bs-target="#addPencairan" data-id_cs="<?= $cs['id_cs']?>" aria-label="Create new report">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <div class="card shadow mb-4 overflow-auto">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                
                                <?php 
                                    $sisa_pembayaran = 0;
                                    if($pembayaran){
                                        foreach ($pembayaran['periode'] as $data_pembayaran){
                                            $sisa_pembayaran += ($data_pembayaran['pembayaran'] - $data_pembayaran['pencairan']);
                                        }
                                    }
                                ?>

                                <h3>Rekapan Pembayaran</h3>
                                <h3>Sisa pembayaran <span id="sisa_pembayaran"><?= rupiah($sisa_pembayaran)?></span></h3>
                            </div>
                            <table id="dataTable" class="table card-table table-vcenter text-dark">
                                <thead>
                                    <tr>
                                        <th class="text-dark desktop" style="font-size: 11px">Periode</th>
                                        <th class="text-dark desktop" style="font-size: 11px"><center>Total pembayaran</center></th>
                                        <th class="text-dark desktop" style="font-size: 11px"><center>pembayaran Cair</center></th>
                                        <th class="text-dark desktop" style="font-size: 11px"><center>Sisa pembayaran</center></th>
                                        <th class="text-dark desktop w-1 text-nowrap" style="font-size: 11px"><center>Status pembayaran</center></th>
                                    </tr>
                                </thead>
                                <tbody id="tablePembayaran">
                                    <?php if($pembayaran) :?>
                                        <?php
                                            foreach ($pembayaran['periode'] as $pembayaran) :?>
                                            <tr>
                                                <td><?= $pembayaran['periode']?></td>
                                                <td><center><?= rupiah($pembayaran['pembayaran'])?></center></td>
                                                <td><center><?= rupiah($pembayaran['pencairan'])?></center></td>
                                                <td><center><?= rupiah($pembayaran['pembayaran'] - $pembayaran['pencairan'])?></center></td>
                                                <?php if($pembayaran['pencairan'] == 0) :?>
                                                    <td class="text-nowrap bg-danger text-light"><center>Belum Cair</center></td>
                                                <?php elseif($pembayaran['pembayaran'] - $pembayaran['pencairan'] == 0):?>
                                                    <td class="text-nowrap bg-success text-light"><center>Cair Seluruhnya</center></td>
                                                <?php else :?>
                                                    <td class="text-nowrap bg-warning text-light"><center>Cair Sebagian</center></td>
                                                <?php endif;?>
                                            </tr>
                                            <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card shadow mb-4 overflow-auto">
                        <div class="card-body">
                            <h3>Riwayat Pencairan</h3>
                            <table id="dataTable" class="table card-table table-vcenter text-dark">
                                <thead>
                                    <tr>
                                        <th class="text-dark desktop w-1 text-nowrap" style="font-size: 11px">Tgl Pencairan</th>
                                        <th class="text-dark desktop w-1 text-nowrap" style="font-size: 11px">Periode</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Nominal</th>
                                        <th class="text-dark desktop" style="font-size: 11px">Catatan</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody id="tablePencairan">
                                    <?php if($pencairan) :?>
                                        <?php
                                            foreach ($pencairan as $pencairan) :?>
                                            <tr>
                                                <td><?= date("d M Y", strtotime($pencairan['tgl_pencairan']))?></td>
                                                <td class="text-nowrap"><?= periode($pencairan['periode'])?></td>
                                                <td class="text-nowrap"><?= rupiah($pencairan['nominal'])?></td>
                                                <td><?= $pencairan['catatan']?></td>
                                                <td><a href="#detailPencairan" data-bs-toggle="modal" data-id="<?= $pencairan['id_pencairan']?>" class="btn btn-info btnEditPencairan"><?= tablerIcon("settings", "")?></a></td>
                                            </tr>
                                            <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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