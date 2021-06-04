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

                <!-- Table Jadwal -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" style="border : 0px solid #000000;">
                        <tr>
                            <!--Untuk tombol prev-->
                            <td id="tengah" colspan="7">
                                <a href="/bulan/<?= $bulanTgl - 1; ?>" class="btn btn-default btn-md">&lt;</a>
                                <!--Untuk nama bulan-->
                                <input type="button" name="jadwal" id="jadwal" class="date-picker btn btn-primary btn-md" value="<?= $bulanTahun; ?>" />
                                <!-- <strong class="btn btn-primary btn-md disabled" id="demo"></strong> -->
                                <!--Untuk tombol next-->
                                <a href="/bulan/<?= $bulanTgl + 1; ?>" class="btn btn-default btn-md">&gt;</a>
                            </td>
                        </tr>

                        <tr id="tengah" style="background-color : #4682B4;color : #FFFFFF;">
                            <th width=150>Minggu</th>
                            <th width=150>Senin</th>
                            <th width=150>Selasa</th>
                            <th width=150>Rabu</th>
                            <th width=150>Kamis</th>
                            <th width=150>Jum'at</th>
                            <th width=150>Sabtu</th>
                        </tr>

                        <?php
                        for ($i = 0; $i < ($maxday + $startday); $i++) :

                            //cek awal minggu
                            if (($i % 7) == 0) {
                                echo "<tr>";
                            }

                            if ($i < $startday) :
                                echo "<td></td>";
                            else :
                                //Kasih angka untuk tanggal
                                echo "<td valign='top' height='130px'>" . ($i - $startday + 1) . "<br>";

                                foreach ($jadwal as $jdw) :
                                    $date = DateTime::createFromFormat("Y-m-d", $jdw['tanggal']);
                                    if ($i == $date->format("d")) :

                        ?>
                                        <div><a href='#' style='font-size:1'><?= $jdw['nama_acara']; ?></a></div>
                        <?php
                                    endif;

                                endforeach;

                                //tutup kotak
                                echo "</td>";

                                //cek untuk tutup per row
                                if (($i % 7) == 6) {
                                    echo "</tr>";
                                }
                            endif;
                        endfor;
                        ?>


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

<!-- untuk datepicker -->
<script type="text/javascript">
    $(function() {
        var bulan = <?= $bulanTgl; ?>;
        var tahun = <?= $tahunTgl; ?>;
        $('.date-picker').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
            defaultDate: new Date(tahun, bulan - 1, 1),
            onClose: function(dateText, inst) {
                // console.log(inst.selectedMonth);
                // console.log(inst.selectedYear);
                function isDonePressed() {
                    return ($('#ui-datepicker-div').html().indexOf('ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all ui-state-hover') > -1);
                }
                if (isDonePressed()) {
                    //$(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth + 1, 1));
                    $(location).attr('href', `/bulan/${inst.selectedMonth+1}/${inst.selectedYear}`)
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>