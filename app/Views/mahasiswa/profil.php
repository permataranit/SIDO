<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div id="page-wrapper">
    <div id="page-inner">

        <h2 class="page-header">Profil Mahasiswa</h2>

        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-primary">

                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <br>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tr>
                                    <th>NIM</th>
                                    <td>:</td>
                                    <td><?= $mahasiswa['nim']; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>:</td>
                                    <td><?= $mahasiswa['nama']; ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>:</td>
                                    <td><?= $mahasiswa['alamat']; ?></td>
                                </tr>
                                <tr>
                                    <th>Nomor HP</th>
                                    <td>:</td>
                                    <td><?= $mahasiswa['no_telp']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td><?= $mahasiswa['email']; ?></td>
                                </tr>
                            </table>
                        </div>
                        <!--End Tabel Responsif-->

                    </div><!-- /. Panel Body-->

                </div><!-- /. Panel-->
                <div class="pull-right">
                    <a class="btn btn-outline btn-danger" href="/admin/mahasiswa/"><i class="fa fa-arrow-circle-left fa-fw"></i> Kembali</a>
                </div>
            </div>
            <!-- /. COL MD 7-->

        </div>
        <!-- /. ROW -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->

<?= $this->endSection(); ?>