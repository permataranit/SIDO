<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div id="page-wrapper">
    <div id="page-inner">

        <div class="row">
            <div class="col-md-12">
                <h2><?= session()->getFlashdata('halo'),
                        session()->get('ses_nama'); ?></h2>


                <hr />

                <a href="/admin/dosen/create" class="btn btn-outline btn-default" style="margin-bottom: 10px"><i class="fa fa-plus fa-fw"></i> Tambah Dosen</a>

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
                        Daftar Dosen Departemen Statistika UNDIP
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th style="text-align:center"> No </th>
                                        <th style="text-align:center"> NIP </th>
                                        <th style="text-align:center"> Nama </th>
                                        <th style="text-align:center"> Aksi </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($dosen as $row) :
                                    ?>
                                        <tr>
                                            <td style="text-align:center"><?= $i++; ?></td>
                                            <td><?= $row['nip']; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td width=290px style="text-align:center">
                                                <!-- <a class="btn btn-success" href="#"> <i class="fa fa-refresh"></i> Reset </a> -->
                                                <a class="btn btn-info" href="dosen/<?= $row['nip']; ?>"> <i class="fa fa-user"></i> Detail Profil </a>
                                                <a class="btn btn-warning" href="dosen/edit/<?= $row['nip']; ?>"> <i class="fa fa-edit"></i> Edit </a>
                                                <form action="dosen/<?= $row['nip']; ?>" method="post" style="display:inline">
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
                <!--End Advanced Tables -->
            </div>
        </div>

    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?= $this->endSection(); ?>