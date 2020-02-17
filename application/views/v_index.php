<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login</title>
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-4 mx-auto">
				<br><br><br>
				<h1 class="text-center">Laundry</h1>
				<br>
				<?php if ($this->session->flashdata()) : ?>
					<div class="alert alert-danger">
						<?= $this->session->flashdata('pesan'); ?>
					</div>
				<?php endif ?>
				<div class="card bg-light">
					<div class="card-body">
						<form action="<?= base_url('C_Auth') ?>" method="post">
							<input type="hidden" name="<?= csrf()['name'] ?>" value="<?= csrf()['hash']; ?>">
							<div class="form-group">
								<label for="Username">Username <span class="text-danger">*</span></label>
								<input type="text" name="username" placeholder="Masukkan Username" class="form-control">
								<?= form_error('username', '<div class="text-danger">', '</div>') ?>
							</div>
							<div class="form-group">
								<label for="password">password <span class="text-danger">*</span></label>
								<input type="password" name="password" placeholder="Masukkan Password" class="form-control">
								<?= form_error('password', '<div class="text-danger">', '</div>') ?>
							</div>
							<button name="submit" type="submit" class="btn btn-primary btn-block">Login</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>