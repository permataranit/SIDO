<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div id="page-wrapper">
    <div id="page-inner">

        <div class="row">
            <div class="col-md-12">
                <h2><?= session()->getFlashdata('halo'),
                        session()->get('ses_nama'); ?></h2>


                <hr />

                <a href="/dosen/jadwal/create" class="btn btn-outline btn-default" style="margin-bottom: 10px"><i class="fa fa-plus fa-fw"></i> Tambah Jadwal</a>

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

        <div class="row">
            <div class="col-md-12">

                <!-- Advanced Tables -->
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <?= $title; ?>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr id="tengah">
                                        <th> No </th>
                                        <th> Agenda </th>
                                        <th> Waktu</th>
                                        <th> Tempat </th>
                                        <th> Keterangan </th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($jadwal as $row) :
                                    ?>
                                        <tr>
                                            <td id="tengah"><?= $i++; ?></td>
                                            <td><?= $row['nama_acara']; ?></td>
                                            <td id="tengah"><?= date('H:i', strtotime($row['waktu_mulai'])) . '-' . date('H:i', strtotime($row['waktu_selesai'])); ?></td>
                                            <td><?= $row['tempat']; ?></td>
                                            <td><?= $row['keterangan']; ?></td>
                                            <td width=220px id="tengah">
                                                <!-- <a class="btn btn-success" href="#"> <i class="fa fa-refresh"></i> Reset </a> -->
                                                <a class="btn btn-primary" href="#<?= $row['id_jadwal']; ?>"> <i class="fa fa-edit"></i> Edit </a>
                                                <form action="#/<?= $row['id_jadwal']; ?>" method="post" style="display:inline">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin?')"> <i class="fa fa-trash-o"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
                <a href="#" class="btn btn-outline btn-danger"><i class="fa fa-arrow-circle-left fa-fw"></i> Kembali</a>
                <!--End Advanced Tables -->
            </div>
        </div>

    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?= $this->endSection(); ?>