<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php if (session()->get('akses') != 3) : ?>
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2><?= session()->getFlashdata('halo'); ?>
                        <?= (session()->get('akses') == 1) ? 'Ketua Departemen Statistika <br>' : ''; ?>
                        <?= session()->get('ses_nama'); ?>
                    </h2>
                    <hr />
                </div>
            </div>
        <?php else : ?>
            <main>
                <h2><?= session()->getFlashdata('halo'); ?>
                    <?= session()->get('ses_nama'); ?>
                </h2>
                <hr />
            <?php endif; ?>


            <div class="row">
                <div class="col-md-12">

                    <!-- Advanced Tables -->
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            Daftar Dosen Departemen Statistika UNDIP
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr id="tengah">
                                            <th> No </th>
                                            <th> NIP </th>
                                            <th> Nama </th>
                                            <th> Aksi </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($list_dosen as $dosen) :
                                        ?>
                                            <tr>
                                                <td id="tengah"><?= $i++; ?></td>
                                                <td><?= $dosen['nip']; ?></td>
                                                <td><?= $dosen['nama']; ?></td>
                                                <td width=290px id="tengah">
                                                    <a data-toggle="tooltip" title="Jadwal" class="btn btn-warning" href="#"><i class="fa fa-calendar"></i></a>
                                                    <a data-toggle="tooltip" title="Profil" class="btn btn-primary" href="/profildetail/<?= $dosen['nip']; ?>"><i class="fa fa-user"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
            <?php if (session()->get('akses') != 3) : ?>
        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
<?php else : ?>
    </main>
<?php endif; ?>

<?= $this->endSection(); ?>