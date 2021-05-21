<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
    <a href="#" class="brand-link" style="background-color: #34656d; color: #fffbdf;">
      	<img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" >
      	<span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background-color: #334443;">
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="{{ asset('cssadmin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">{{ session('namaadmin') }}</a>
			</div>
		</div>

		<!-- Sidebar Menu -->
	    <nav class="mt-2">
	    	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
	    		
	    		<!-- MASTER ================================= -->
	    		<li class="nav-header">Master</li>
				<li class="nav-item">
					<a href="{{ url('admin/staff/list') }}" class="nav-link">
						<i class="nav-icon fas fa-user"></i>
						<p>Staff</p>
					</a>
	        	</li>
	        	<li class="nav-item">
					<a href="{{ url('admin/alatgym/list') }}" class="nav-link">
						<i class="nav-icon fas fa-box"></i>
						<p>Alat Gym</p>
					</a>
	        	</li>
	        	<li class="nav-item">
					<a href="{{ url('admin/informasi/list') }}" class="nav-link">
						<i class="nav-icon fas fa-newspaper"></i>
						<p>Informasi</p>
					</a>
	        	</li>
	        	<li class="nav-item">
					<a href="{{ url('admin/anggota/list') }}" class="nav-link">
						<i class="nav-icon fas fa-users"></i>
						<p>Anggota</p>
					</a>
	        	</li>
	        	

	        	<!-- TRANSAKSI ================================= -->
	        	<li class="nav-header">Transaksi</li>
	        	<li class="nav-item">
					<a href="{{ url('admin/anggota/verifikasi') }}" class="nav-link">
						<i class="nav-icon fas fa-check"></i>
						<p>Verifikasi Anggota</p>
					</a>
	        	</li>
	        	<li class="nav-item">
					<a href="{{ url('admin/anggota/informasi') }}" class="nav-link">
						<i class="nav-icon fas fa-info"></i>
						<p>Informasi Anggota</p>
					</a>
	        	</li>
	        	<li class="nav-item">
					<a href="{{ url('admin/kunjungan/tambah') }}" class="nav-link">
						<i class="nav-icon fas fa-qrcode"></i>
						<p>Kunjungan</p>
					</a>
	        	</li>
	        	<li class="nav-item">
					<a href="{{ url('admin/kunjungan/list') }}" class="nav-link">
						<i class="nav-icon fas fa-calendar"></i>
						<p>History Kunjungan</p>
					</a>
	        	</li>
	        	<li class="nav-item">
					<a href="{{ url('admin/konfirmasi/list') }}" class="nav-link">
						<i class="nav-icon fas fa-dollar-sign"></i>
						<p>Konfirmasi</p>
					</a>
	        	</li>

	        	<!-- LAPORAN ================================= -->
	        	<li class="nav-header">Laporan</li>
	        	<li class="nav-item">
					<a href="{{ url('admin/laporan/anggota') }}" class="nav-link">
						<i class="nav-icon fas fa-book"></i>
						<p>Lap. Anggota</p>
					</a>
	        	</li>
	        	<li class="nav-item">
					<a href="{{ url('admin/laporan/kunjungan') }}" class="nav-link">
						<i class="nav-icon fas fa-book"></i>
						<p>Lap. Kunjungan</p>
					</a>
	        	</li>

	    	</ul>
	    </nav>
    </div>

    
</aside>