<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div id="page-wrapper">
    <div id="page-inner">

        <div class="row">
            <div class="col-md-12">
                <h2>Tambah Jadwal</h2>
                <h5 class="error"> * wajib diisi </h5>


                <hr />


                <!-- Form  -->
                <form action="/dosen/jadwal/add" method="post" />

                <?= csrf_field(); ?>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Kategori Kegiatan</label>
                    <div class="col-sm-3">
                        <select class="form-control" name="jenis_keg" id="jenis_keg">
                            <option value="">---Jenis Kegiatan---</option>
                            <option value="1">Pendidikan</option>
                            <option value="2">Penelitian</option>
                            <option value="3">Pengabdian</option>
                        </select>
                        <span class="error">* <?= ($validation->hasError('jenis_keg')) ? $validation->getError('jenis_keg') : ''; ?></span>
                    </div>
                </div>
                <div style="clear: both;"> </div>

                <div class="form-group" id="list">
                    <label class="col-sm-2 col-sm-2 control-label">Untuk Agenda</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="keg_apa" id="keg_apa">
                        </select>
                        <span class="error">* <?= ($validation->hasError('keg_apa')) ? $validation->getError('keg_apa') : ''; ?></span>
                    </div>
                </div>
                <div style="clear: both;"> </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"> Nama Jadwal </label>
                    <div class="col-sm-6">
                        <input type="text" name="judul_agenda" class="form-control" size="30" maxlength="50" value="<?= old('judul_agenda'); ?>">
                        <span class="error">* <?= ($validation->hasError('judul_agenda')) ? $validation->getError('judul_agenda') : ''; ?>
                    </div>
                </div>
                <div style="clear: both;"> </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"> Tanggal </label>
                    <div class="col-sm-3">
                        <input type="date" name="tanggal" class="form-control" size="30" maxlength="50" value="<?= old('tanggal'); ?>">
                        <span class="error">* <?= ($validation->hasError('tanggal')) ? $validation->getError('tanggal') : ''; ?>
                    </div>
                </div>
                <div style="clear: both;"> </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"> Waktu Mulai </label>
                    <div class="col-sm-3">
                        <input type="time" name="w_start" class="form-control" size="30" maxlength="50" value="<?= old('w_start'); ?>">
                        <span class="error">* <?= ($validation->hasError('w_start')) ? $validation->getError('w_start') : ''; ?>
                    </div>
                </div>
                <div style="clear: both;"> </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"> Waktu Selesai </label>
                    <div class="col-sm-3">
                        <input type="time" name="w_end" class="form-control" size="30" maxlength="50" value="<?= old('w_end'); ?>">
                        <span class="error" style="padding : 10px"> <?= ($validation->hasError('w_end')) ? $validation->getError('w_end') : ''; ?>
                    </div>
                </div>
                <div style="clear: both;"> </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"> Tempat </label>
                    <div class="col-sm-4">
                        <textarea class="form-control" rows="2" name="lokasi" maxlength="100"><?= old('lokasi'); ?></textarea></td>
                        <span class="error" style="padding : 10px"> <?= ($validation->hasError('lokasi')) ? $validation->getError('lokasi') : ''; ?>
                    </div>
                </div>
                <div style="clear: both;"> </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Keterangan</label>
                    <div class="col-sm-4">
                        <textarea class="form-control" rows="3" name="ket" maxlength="300"><?= old('ket'); ?></textarea></td>
                        <span class="error" style="padding : 10px"></span>
                    </div>
                </div>
                <div style="clear: both;"></div>

                <br>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="/bulan" class="btn btn-danger"><i class="fa fa-arrow-circle-left fa-fw"></i> Kembali </a>
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

<script>
    $(document).ready(function() {

        $('#list').hide();

        $("#jenis_keg").change(function() {
            $('#keg_apa').html('');
            var jenisKeg = $(this).children('option:selected').val(); //cari id jenis_keg dan ambil valuenya

            if (jenisKeg == 1) {

                let pendidikan = <?= json_encode($pendidikan); ?>;
                // console.log(pendidikan);

                $.each(pendidikan, function(i, result) {
                    $('#keg_apa').append(`<option value="` + result.id_pendidikan + `" >` + result.kategori + `</option>`);
                });

                $('#list').show();

            } else if (jenisKeg == 2) {

                let penelitian = <?= json_encode($penelitian); ?>;
                // console.log(penelitian);

                $.each(penelitian, function(i, result) {

                    $('#keg_apa').append(`<option value="` + result.id_penelitian + `" >` + result.judul + `</option>`);
                });

                $('#list').show();

            } else if (jenisKeg == 3) {

                let pengabdian = <?= json_encode($pengabdian); ?>;
                // console.log(pengabdian);

                $.each(pengabdian, function(i, result) {

                    $('#keg_apa').append(`<option value="` + result.id_pengabdian + `" >` + result.judul + `</option>`);
                });

                $('#list').show();

            } else {
                $("#list").hide();
            }
        });
    });
</script>

<?= $this->endSection(); ?>