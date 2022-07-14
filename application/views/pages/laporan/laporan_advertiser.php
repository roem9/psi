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
                    
                    <div class="card shadow mb-4 overflow-auto">
                        <div class="card-body">
                            
                            <?php foreach ($laporan_harian as $laporan_harian) :?>
                                <div class="mb-5">
                                    <h4><?= date("d-M-Y", strtotime($laporan_harian['tgl']))?></h4>
                                    <table class="table" border=1>
                                        <tr>
                                            <td><b>NAMA CS</b></td>
                                            <?php foreach ($laporan_harian['cs'] as $data_cs) :?>
                                                <td><b><?= $data_cs['data_cs']['nama_cs']?></b></td>
                                            <?php endforeach;?>
                                            <td><b>TOTAL</b></td>
                                        </tr>
                                        <tr>
                                            <td><b>JUMLAH LEADS</b></td>
                                            <?php 
                                                $total = 0;
                                                foreach ($laporan_harian['cs'] as $data_cs) :?>
                                                <?php $total += $data_cs['laporan']['leads'];?>
                                                <td><?= $data_cs['laporan']['leads']?></td>
                                            <?php endforeach;?>
                                            <td><?= $total?></td>
                                        </tr>
                                        <tr>
                                            <td><b>CLOSING HARIAN</b></td>
                                            <?php 
                                                $total = 0;
                                                foreach ($laporan_harian['cs'] as $data_cs) :?>
                                                <?php $total += $data_cs['laporan']['closing_langsung'];?>
                                                <td><?= $data_cs['laporan']['closing_langsung']?></td>
                                            <?php endforeach;?>
                                            <td><?= $total?></td>
                                        </tr>
                                        <tr>
                                            <td><b>SUSULAN</b></td>
                                            <?php 
                                                $total = 0;
                                                foreach ($laporan_harian['cs'] as $data_cs) :?>
                                                <?php $total += $data_cs['laporan']['closing_susulan'];?>
                                                <td><?= $data_cs['laporan']['closing_susulan']?></td>
                                            <?php endforeach;?>
                                            <td><?= $total?></td>
                                        </tr>
                                        <tr>
                                            <td><b>KONVERSI</b></td>
                                            <?php 
                                                $total = 0;
                                                foreach ($laporan_harian['cs'] as $data_cs) :?>
                                                <?php $total += $data_cs['konversi'];?>
                                                <td><?= $data_cs['konversi']?>%</td>
                                            <?php endforeach;?>
                                            <td><?= $total / COUNT($laporan_harian['cs'])?>%</td>
                                        </tr>
                                    </table>

                                    <?php foreach ($laporan_harian['closingan'] as $data) :?>
                                        <?= $data['nama_varian'] . " = " . $data['qty'] . ", ";?>
                                    <?php endforeach;?>
                                    
                                </div>
                            <?php endforeach;?>

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