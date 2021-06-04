<!-- SIDE-BAR START -->
<nav class="navbar-default navbar-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav" id="main-menu">
			<li class="text-center">
				<img class="user-image img-responsive" src="/assets/img/find_user.png" width="123px" height="123px" alt="">
			</li>
			<?php if (session()->get('akses') != 4) : ?>
				<li>
					<a href="/bulan"><i class="fa fa-table fa-3x"></i>Lihat Jadwal</a>
				</li>
				<li>
					<a href="/dosen/penelitian/"><i class="fa fa-sitemap fa-3x"></i>Penelitian</a>
				</li>
				<li>
					<a href="/dosen/pengabdian/"><i class="fa fa-sitemap fa-3x"></i>Pengabdian</a>
				</li>
				<li>
					<a href="/dosen/list/"><i class="fa fa-users fa-3x"></i>Daftar Dosen</a>
				</li>
			<?php else : ?>
				<li>
					<a href="/admin/dosen/"><i class="fa fa-users fa-3x"></i>Daftar Dosen</a>
				</li>
				<li>
					<a href="/admin/mahasiswa/"><i class="fa fa-list fa-3x"></i>Daftar Mahasiswa</a>
				</li>
			<?php endif; ?>
		</ul>
	</div>
</nav>
<!-- /. SIDE-BAR END -->