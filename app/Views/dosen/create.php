 <?= $this->extend('layout/template'); ?>

 <?= $this->section('content'); ?>
 <div id="page-wrapper">
 	<div id="page-inner">
 		<div class="row">
 			<div class="col-md-12">
 				<h2>Tambah Dosen</h2>
 				<h5 class="error"> * wajib diisi </h5>

 				<hr />
 				<!-- //echo $validation->listErrors(); -->
 				<form action="/admin/dosen/add" method="post">

 					<?= csrf_field(); ?>

 					<div class="form-group">
 						<label class="col-sm-2 col-sm-2 control-label">NIP</label>
 						<div class="col-sm-4">
 							<!-- ifelse but in 1 line -->
 							<input type="text" name="nip" class="form-control <?= ($validation->hasError('nip')) ? 'is-invalid' : ''; ?>" size="120" maxlength="50" placeholder="" value="<?= old('nip'); ?>"></td>
 							<span class="error">* <?= ($validation->hasError('nip')) ? $validation->getError('nip') : ''; ?> </span>
 						</div>
 					</div>
 					<div style="clear: both;"></div>

 					<div class="form-group">
 						<label class="col-sm-2 col-sm-2 control-label">NIDN</label>
 						<div class="col-sm-4">
 							<input type="text" name="nidn" class="form-control" size="30" maxlength="50" placeholder="" value="<?= old('nidn'); ?>"></td>
 							<span class="error" style="padding : 10px"> <?= ($validation->hasError('nidn')) ? $validation->getError('nidn') : ''; ?> </span>
 						</div>
 					</div>
 					<div style="clear: both;"></div>

 					<!-- <div class="form-group">
 						<label class="col-sm-2 col-sm-2 control-label">Gelar Depan</label>
 						<div class="col-sm-4">
 							<input type="text" name="gelar_depan" class="form-control" size="30" maxlength="50" placeholder="" value=""></td>
 							<span class="error" style="padding : 10px"></span>
 						</div>
 					</div>
 					<div style="clear: both;"></div> -->

 					<div class="form-group">
 						<label class="col-sm-2 col-sm-2 control-label">Nama</label>
 						<div class="col-sm-4">
 							<input type="text" name="nama" class="form-control" size="30" maxlength="50" placeholder="" value="<?= old('nama'); ?>">
 							<span class="error">*
 							</span>
 						</div>
 					</div>
 					<div style="clear: both;"></div>

 					<!-- <div class="form-group">
 						<label class="col-sm-2 col-sm-2 control-label">Gelar Belakang</label>
 						<div class="col-sm-4">
 							<input type="text" name="gelar_belakang" class="form-control" size="30" maxlength="50" placeholder="" value="">
 							<span class="error" style="padding : 10px"> </span>
 						</div>
 					</div>
 					<div style="clear: both;"></div> -->

 					<div class="form-group">
 						<label class="col-sm-2 col-sm-2 control-label">Email</label>
 						<div class="col-sm-4">
 							<input type="text" name="email" class="form-control" size="30" maxlength="50" placeholder="" value="<?= old('email'); ?>">
 							<span class="error" style="padding : 10px"> <?= ($validation->hasError('email')) ? $validation->getError('email') : ''; ?> </span>
 						</div>
 					</div>
 					<div style="clear: both;"></div>

 					<div class="form-group">
 						<label class="col-sm-2 col-sm-2 control-label">Tempat Lahir</label>
 						<div class="col-sm-4">
 							<input type="text" name="tempat_lahir" class="form-control" size="30" maxlength="50" placeholder="" value="<?= old('tempat_lahir'); ?>"></td>
 							<span class="error" style="padding : 10px"></span>
 						</div>
 					</div>
 					<div style="clear: both;"></div>

 					<div class="form-group">
 						<label class="col-sm-2 col-sm-2 control-label">Tanggal Lahir</label>
 						<div class="col-xs-6 col-sm-3">
 							<input type="date" name="tanggal_lahir" class="form-control" maxlength="50" placeholder="" value="<?= old('tanggal_lahir'); ?>"></td>
 							<span class="error" style="padding : 10px"></span>
 						</div>
 					</div>
 					<div style="clear: both;"></div>

 					<div class="form-group">
 						<label class="col-sm-2 col-sm-2 control-label">Alamat Rumah</label>
 						<div class="col-sm-4">
 							<textarea class="form-control" rows="3" name="address" maxlength="1000"><?= old('address'); ?></textarea></td>
 							<span class="error" style="padding : 10px"></span>
 						</div>
 					</div>
 					<div style="clear: both;"></div>

 					<div class="form-group">
 						<label class="col-sm-2 col-sm-2 control-label">Nomor Hp/ Telepon</label>
 						<div class="col-sm-4">
 							<input type="text" name="no_hp" class="form-control" size="30" maxlength="50" placeholder="" value="<?= old('no_hp'); ?>"></td>
 							<span class="error" style="padding : 10px"> </span>
 						</div>
 					</div>
 					<div style="clear: both;"></div>

 					<div class="form-group">
 						<label class="col-sm-2 col-sm-2 control-label">Scopus ID</label>
 						<div class="col-sm-4">
 							<input type="text" name="scopus_id" class="form-control" size="30" maxlength="50" placeholder="" value="<?= old('scopus_id'); ?>"></td>
 							<span class="error" style="padding : 10px"> <?= ($validation->hasError('scopus_id')) ? $validation->getError('scopus_id') : ''; ?> </span>
 						</div>
 					</div>
 					<div style="clear: both;"></div>

 					<div class="form-group">
 						<label class="col-sm-2 col-sm-2 control-label"></label>
 						<div class="col-sm-4">
 							<a class="btn btn-outline btn-danger" href="/admin/dosen"><i class="fa fa-arrow-circle-left fa-fw"></i> Kembali</a>
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