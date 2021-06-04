<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div id="page-wrapper">
    <div id="page-inner">

        <h2 class="page-header">
            <?= session()->get('ses_nama'); ?>
        </h2>

        <div class="row">
            <div class="col-md-5">
                <div class="thumbnail">
                    <img class="img-responsive" style="border:0" src="/foto/find_user.png" width="300px" height="300px">
                </div>
            </div>
            <!-- /. COL MD 5 -->

            <div class="col-md-6">
                <div class="panel panel-primary">

                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <br>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tr>
                                    <th>Judul</th>
                                    <td>:</td>
                                    <td><?= $penelitian['judul']; ?></td>
                                </tr>
                                <tr>
                                    <th>SKIM</th>
                                    <td>:</td>
                                    <td><?= $penelitian['skim']; ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Mulai</th>
                                    <td>:</td>
                                    <td><?= $penelitian['tgl_mulai']; ?> </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Selesai</th>
                                    <td>:</td>
                                    <td><?= ((!$penelitian['tgl_selesai']) || ($penelitian['tgl_selesai'] == "0000-00-00")) ? '-' : $penelitian['tgl_selesai']; ?></td>
                                </tr>
                                <tr>
                                    <th>Sumber Dana</th>
                                    <td>:</td>
                                    <td><?= $penelitian['sumber_dana']; ?></td>
                                </tr>
                                <tr>
                                    <th>Output</th>
                                    <td>:</td>
                                    <td><?= ($penelitian['output']) ? $penelitian['output'] : '-'; ?></td>
                                </tr>
                            </table>
                        </div>
                        <!--End Tabel Responsif-->

                    </div><!-- /. Panel Body-->

                </div><!-- /. Panel-->
                <div class="pull-right">
                    <a class="btn btn-outline btn-danger" href="/dosen/penelitian"><i class="fa fa-arrow-circle-left fa-fw"></i> Kembali</a>
                    <a style="margin-right:5px; margin-top:3px; margin-bottom:3px" class="btn btn-primary" href="/dosen/penelitian/edit/<?= $penelitian['id_penelitian']; ?>"><i class="fa fa-edit"></i> Edit </a>
                </div>
            </div>
            <!-- /. COL MD 6-->

        </div>
        <!-- /. ROW -->

    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?= $this->endSection(); ?>