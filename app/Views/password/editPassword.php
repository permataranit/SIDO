<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Ganti Password</h2>
                <h5 class="error"> * wajib diisi </h5>

                <hr />
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php elseif (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <?php
                if (session()->get('akses') == 1) {
                    $aksi = "/kadep";
                } else if (session()->get('akses') == 2) {
                    $aksi = "/dosen";
                } else if (session()->get('akses') == 3) {
                    $aksi = "/mahasiswa";
                } else {
                    $aksi = "/admin";
                }
                ?>
                <form action="<?= $aksi . '/password/'; ?>" method="post">

                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="PATCH">

                    <div class="form-group">
                        <label class="col-sm-3 col-sm-3 control-label">Masukkan Password Lama</label>
                        <div class="col-sm-4">
                            <!-- ifelse but in 1 line -->
                            <input type="password" name="lama" class="form-control <?= ($validation->hasError('lama')) ? 'is-invalid' : ''; ?>" size="120" maxlength="50" placeholder=""></td>
                            <span class="error">* <?= ($validation->hasError('lama')) ? $validation->getError('lama') : ''; ?> </span>
                        </div>
                    </div>
                    <div style="clear: both;"></div>

                    <div class="form-group">
                        <label class="col-sm-3 col-sm-3 control-label">Masukkan Password Baru</label>
                        <div class="col-sm-4">
                            <input type="password" name="baru" class="form-control <?= ($validation->hasError('baru')) ? 'is-invalid' : ''; ?>" size="120" maxlength="50" placeholder=""></td>
                            <span class="error">* <?= ($validation->hasError('baru')) ? $validation->getError('baru') : ''; ?> </span>
                        </div>
                    </div>
                    <div style="clear: both;"></div>

                    <div class="form-group">
                        <label class="col-sm-3 col-sm-3 control-label">Konfirmasi Password Baru</label>
                        <div class="col-sm-4">
                            <input type="password" name="ulang" class="form-control <?= ($validation->hasError('ulang')) ? 'is-invalid' : ''; ?>" size="120" maxlength="50" placeholder=""></td>
                            <span class="error">* <?= ($validation->hasError('ulang')) ? $validation->getError('ulang') : ''; ?> </span>
                        </div>
                    </div>
                    <div style="clear: both;"></div>

                    <div class="form-group">
                        <label class="col-sm-3 col-sm-3 control-label"></label>
                        <div class="col-sm-4">
                            <input type="submit" class="btn btn-outline btn-primary" name="submit" value="Simpan" /></td>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?= $this->endSection(); ?>