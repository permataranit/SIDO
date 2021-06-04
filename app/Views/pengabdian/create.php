<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div id="page-wrapper">
    <div id="page-inner">

        <div class="row">
            <div class="col-md-12">
                <h2>Tambah Data Pengabdian</h2>
                <h5 class="error"> * wajib diisi </h5>


                <hr />


                <!-- Form  -->
                <form action="/dosen/pengabdian/add" method="post" />

                <?= csrf_field(); ?>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"> Judul Pengabdian </label>
                    <div class="col-sm-8">
                        <input type="text" name="judul" class="form-control" size="30" maxlength="200" value="<?= old('judul'); ?>">
                        <span class="error">* <?= ($validation->hasError('judul')) ? $validation->getError('judul') : ''; ?></span>
                    </div>
                </div>
                <div style="clear: both;" />

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"> SKIM </label>
                    <div class="col-sm-8">
                        <input type="text" name="skim" class="form-control" size="30" maxlength="50" value="<?= old('skim'); ?>">
                        <span class="error">* <?= ($validation->hasError('skim')) ? $validation->getError('skim') : ''; ?>
                    </div>
                </div>
                <div style="clear: both;" />

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"> Tanggal Mulai </label>
                    <div class="col-sm-3">
                        <input type="date" name="tgl_mulai" class="form-control" size="30" maxlength="50" value="<?= old('tgl_mulai'); ?>">
                        <span class="error">* <?= ($validation->hasError('tgl_mulai')) ? $validation->getError('tgl_mulai') : ''; ?>
                    </div>
                </div>
                <div style="clear: both;" />

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"> Sumber dana </label>
                    <div class="col-sm-3">
                        <input type="text" name="sumber_dana" class="form-control" size="30" maxlength="50" placeholder="" value="<?= old('sumber_dana'); ?>">
                        <span class="error">* <?= ($validation->hasError('sumber_dana')) ? $validation->getError('sumber_dana') : ''; ?>
                    </div>
                </div>
                <div style="clear: both;" />


                <br>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="/dosen/pengabdian" class="btn btn-danger"><i class="fa fa-arrow-circle-left fa-fw"></i> Kembali </a>
                        <input type="submit" class="btn btn-outline btn-primary" name="submit" value="Simpan" />
                    </div>
                </div>
                </form>
                <!--End Form -->
            </div>
        </div>

    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?= $this->endSection(); ?>