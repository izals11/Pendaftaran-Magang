<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Diskominfosan</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-white shadow pt-4 pb-4">
			<div class="container">
				<a class="navbar-brand font-weight-bold" href="#">DISKOMINFOSAN</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav ml-auto">
						<a class="btn btn-success rounded-pill mx-2" href="<?= base_url('auth'); ?>">MASUK</a>
						<a class="btn btn-primary rounded-pill mx-2" href="<?= base_url('auth/registrasi'); ?>">DAFTAR</a>
					</div>
				</div>
			</div>
		</nav>
	</header>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h3 class="h1 mb-3">
						PENDAFTARAN MAGANG <br />
						DISKOMINFOSAN
					</h3>

					<p class="mb-5">
						Untuk calon pendaftar magang di Dinas Komunikasi, Informatika
						dan Persandikan Kota Yogyakarta bisa mendaftar melalui website ini.
					</p>

					<a href="<?= base_url('auth/registrasi'); ?>" class="btn btn-primary btn-lg rounded-pill">DAFTAR SEKARANG</a>
				</div>
				<div class="col-md-6 d-none d-sm-block">
					<img src="assets/img/image-hero.svg" alt="image hero" class="img-fluid d-block mx-auto" style="max-height: 300px;" />
				</div>
			</div>
		</div>
	</section>



	<section class="tentang">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<img src="assets/img/best_place.svg" alt="tentang sekolah" class="img-fluid mx-auto d-block" />
				</div>
				<div class="col-md-6">
					<h3 class="font-weight-bold mb-3 mt-5">DISKOMINFOSAN</h3>
					<p class="deskripsi">
						Dinas Komunikasi Informatika dan Persandian merupakan Instansi Pemerintahan yang terdapat di Kota Yogyakarta.
						Dinas Komunikasi, Informatika dan Persandian mempunyai tugas melaksanakan urusan pemerintahan daerah
						berdasarkan asas otonomi dan tugas pembantuan di bidang komunikasi, informatika, persandian dan statistik.
					</p>
				</div>
			</div>
		</div>
	</section>


	<footer>
		<div class="container py-5 ">
			<div class="text-center py-3">
				<div class="container">
					<span>Copyright &copy; Diskominfosan <?= date('Y') ?></span>
				</div>
			</div>
	</footer>




	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>