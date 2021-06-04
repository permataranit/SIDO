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
        <a href="/dosen/pengabdian/create" class="btn btn-outline btn-default" style="margin-bottom: 10px"><i class="fa fa-plus fa-fw"></i> Tambah Pengabdian</a>

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php elseif (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12">

                <!-- Advanced Tables -->
                <div class="panel panel-default">

                    <div class="panel-heading">
                        Daftar Pengabdian
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr id="tengah">
                                        <th width="68px">No</th>
                                        <th>Judul Pengabdian</th>
                                        <th width="290px"> Aksi </th>
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
                                            <td id="tengah">
                                                <a class="btn btn-outline btn-default" href="/dosen/pengabdian/agenda/<?= $row['id_pengabdian']; ?>"> Agenda </a>
                                                <a class="btn btn-info" href="/dosen/pengabdian/<?= $row['id_pengabdian']; ?>"><i class="fa fa-info-circle"></i> Detail </a>
                                                <form action="/dosen/pengabdian/<?= $row['id_pengabdian']; ?>" method="post" style="display:inline">
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