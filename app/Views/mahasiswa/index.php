<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div id="page-wrapper">
    <div id="page-inner">

        <div class="row">
            <div class="col-md-12">
                <h2><?= session()->getFlashdata('halo'),
                        session()->get('ses_nama'); ?></h2>
            </div>
        </div>
        <!-- /. ROW -->

        <hr />
        <a href="/admin/mahasiswa/sinkron" class="btn btn-outline btn-success" style="margin-bottom: 10px"><i class="fa fa-refresh fa-fw"></i> Sinkronkan Data</a>

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php elseif (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php elseif (session()->getFlashdata('info')) : ?>
            <div class="alert alert-info" role="alert">
                <?= session()->getFlashdata('info'); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12">

                <!-- Advanced Tables -->
                <div class="panel panel-default">

                    <div class="panel-heading">
                        Daftar Mahasiswa
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr id="tengah">
                                        <th style="text-align:center"> No </th>
                                        <th style="text-align:center"> NIM </th>
                                        <th style="text-align:center"> Nama </th>
                                        <th style="text-align:center"> Aksi </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($mahasiswa as $row) :
                                    ?>
                                        <tr>
                                            <td style="text-align:center"><?= $i++; ?></td>
                                            <td><?= $row['nim']; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td width=220px style="text-align:center">
                                                <!-- <a class="btn btn-success" href="#"> <i class="fa fa-refresh"></i> Reset </a> -->
                                                <a class="btn btn-info" href="/admin/mahasiswa/<?= $row['nim']; ?>"> <i class="fa fa-user"></i> Detail Profil </a>
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

    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?= $this->endSection(); ?>