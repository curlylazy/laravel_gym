@extends('front/template')

@push('scripts')

<script type="text/javascript">

$(document).ready(function() {
    
});

</script>

@endpush


@push('stylecss')

@endpush


@section('content')

<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url({{ asset('cssfront/images/img_bg_2.jpg') }});" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				<div class="display-t">
					<div class="display-tc animate-box" data-animate-effect="fadeIn">
						<h1>Make it a lifestyle, not a duty</h1>
						<h2>bergabung segera dengan kami <a href="{{ url('auth/registrasi') }}">Registrasi Tiger Gym Member</a></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<div id="fh5co-services" class="fh5co-bg-section">
	<div class="container">
		<div class="row">
			<div class="col-md-4 text-center animate-box">
				<div class="services">
					<span><img class="img-responsive" src="{{ asset('cssfront/images/dumbbell.svg') }}" alt=""></span>
					<h3>Alat Gym Lengkap</h3>
					<p>Tiger Gym meruapakan sebuah pusat kebugaran dengan alat alat gym yang berkualitas dan lengkap</p>
					<p><a href="{{ url('alatgym/list') }}" class="btn btn-primary btn-outline btn-sm">More <i class="icon-arrow-right"></i></a></p>
				</div>
			</div>
			<div class="col-md-4 text-center animate-box">
				<div class="services">
					<span><img class="img-responsive" src="{{ asset('cssfront/images/exercise.svg') }}" alt=""></span>
					<h3>Murah dan Lengkap</h3>
					<p>biaya untuk menjadi member di Tiger Gym sangar murah hanya 50.000 per bulan.</p>
					<p><a href="{{ url('auth/registrasi') }}" class="btn btn-primary btn-outline btn-sm">More <i class="icon-arrow-right"></i></a></p>
				</div>
			</div>
			<div class="col-md-4 text-center animate-box">
				<div class="services">
					<span><img class="img-responsive" src="{{ asset('cssfront/images/yoga-carpet.svg') }}" alt=""></span>
					<h3>Nyaman dan Luas</h3>
					<p>Lokasi parkir luas, dan tempat gym yang juga luas, anda bisa menikmati semua fasilitas tanpa perlu mengantre.</p>
					<p><a href="#" class="btn btn-primary btn-outline btn-sm">More <i class="icon-arrow-right"></i></a></p>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="fh5co-started" class="fh5co-bg" style="background-image:url({{ asset('cssfront/images/img_bg_3.jpg') }});">
	<div class="overlay"></div>
	<div class="container">
		<div class="row animate-box fadeInUp animated-fast">
			<div class="col-md-8 col-md-offset-2 text-center">
				<h2>Bergabung menjadi anggota Tiger Gym<br>
				<span> Cukup dengan biaya<br>
				<span class="percent">Rp. 50.000 </span> per Bulan</span></h2>
			</div>
		</div>
		<div class="row animate-box fadeInUp animated-fast">
			<div class="col-md-8 col-md-offset-2 text-center">
				<p><a href="https://www.free-css.com/free-css-templates" class="btn btn-default btn-lg">Become a Member</a></p>
			</div>
		</div>
	</div>
</div>

@endsection

