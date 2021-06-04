<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php if (session()->get('akses') != 3) : ?>

    <div id="page-wrapper">
        <div id="page-inner">
        <?php else : ?>
            <main>
            <?php endif; ?>

            <h2 class="page-header">Profil Dosen</h2>

            <div class="row">
                <div class="col-md-12">
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php elseif (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- /. ROW -->

            <div class="row">
                <div class="col-md-5">
                    <div class="thumbnail">
                        <?php if ($dosen['foto']) : ?>
                            <img class="img-responsive" src="/foto/<?= $dosen['foto']; ?>" width="300px" height="300px" height="300px">
                        <?php else : ?>
                            <img class="img-responsive" style="border:0" src="/foto/find_user.png" width="300px" height="300px">
                        <?php endif; ?>
                    </div>
                </div>
                <!-- /. COL MD 5 -->

                <div class="col-md-7">
                    <div class="panel panel-primary">

                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                            <br>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tr>
                                        <th>NIP</th>
                                        <td>:</td>
                                        <td><?= $dosen['nip']; ?></td>
                                    </tr>
                                    <?php if ($sama) : ?>
                                        <tr>
                                            <th>NIDN</th>
                                            <td>:</td>
                                            <td><?= $dosen['nidn']; ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th>Nama</th>
                                        <td>:</td>
                                        <td><?= $dosen['nama']; ?></td>
                                    </tr>
                                    <?php if ($sama) : ?>
                                        <tr>
                                            <th>TTL</th>
                                            <td>:</td>
                                            <td><?= $dosen['tempat_lahir']; ?>, <?= $dosen['tanggal_lahir']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>:</td>
                                            <td><?= $dosen['alamat_rumah']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nomor HP</th>
                                            <td>:</td>
                                            <td><?= $dosen['no_hp']; ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th>Email</th>
                                        <td>:</td>
                                        <td><?= $dosen['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Link Scopus</th>
                                        <td>:</td>
                                        <td><?= $dosen['scopus_id']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <!--End Tabel Responsif-->

                        </div><!-- /. Panel Body-->

                    </div><!-- /. Panel-->
                    <?php if ($sama) : ?>
                        <a class="btn btn-outline btn-primary" href="/dosen/profile/edit/<?= session()->get('ses_id'); ?>"><i class="fa fa-edit fa-fw"></i> Edit</a>
                    <?php endif; ?>
                    <div class="pull-right">
                        <?php (session()->get('akses') == 3) ? $action = "/mahasiswa" : $action = previous_url(); ?>
                        <a class="btn btn-outline btn-danger" href="<?= $action; ?>"><i class="fa fa-arrow-circle-left fa-fw"></i> Kembali</a>
                    </div>
                </div>
                <!-- /. COL MD 7-->

            </div>
            <!-- /. ROW -->

            <?php if ((!$sama) && (session()->get('akses') != 4)) : ?>

                <div class="row">
                    <div class="col-md-12">
                        <!-- PANEL COLLAPSE -->
                        <div class="panel-group" id="accordion">
                            <!-- PANEL 1 -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">Daftar Penelitian</a></h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr id="tengah">
                                                        <th>No</th>
                                                        <th>Judul Penelitian</th>
                                                        <th>SKIM</th>
                                                        <!-- <th> Aksi </th> -->
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach ($penelitian as $row) :
                                                    ?>
                                                        <tr>
                                                            <td id=" tengah"><?= $i++; ?></td>
                                                            <td><?= $row['judul']; ?></td>
                                                            <td><?= $row['skim']; ?></td>
                                                            <!-- <td id="tengah"><a class="btn btn-info" href="/dosen/penelitian/< //$row['id_penelitian']; ?>"><i class="fa fa-info-circle"></i> Detail </a></td> -->
                                                        </tr>
                                                    <?php endforeach; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- PANEL 2 -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">Daftar Pengabdian</a></h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr id="tengah">
                                                        <th>No</th>
                                                        <th>Judul Pengabdian</th>
                                                        <th>SKIM</th>
                                                        <!-- <th>Aksi</th> -->
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach ($pengabdian as $row) :
                                                    ?>
                                                        <tr>
                                                            <td id="tengah"><?= $i++; ?></td>
                                                            <td><?= $row['judul']; ?></td>
                                                            <td><?= $row['skim']; ?></td>
                                                            <!-- <td id="tengah"><a class="btn btn-info" href="/dosen/pengabdian/< //$row['id_pengabdian']; ?>"><i class="fa fa-info-circle"></i> Detail </a></td> -->
                                                        </tr>
                                                    <?php endforeach; ?>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /. END PANEL COLLAPSE-->
                    </div>
                    <!-- /. COL MD 12-->
                </div>
                <!-- /. ROW -->
            <?php endif; ?>

            <?php if (session()->get('akses') != 3) : ?>
        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
<?php else : ?>
    </main>
<?php endif; ?>

<?= $this->endSection(); ?>