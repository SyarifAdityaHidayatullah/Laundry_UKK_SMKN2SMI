<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login</title>
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
</head>

<body style="background-color:;">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 mx-auto">
				<br><br><br>
				
				<br>
				<?php if ($this->session->flashdata()) : ?>
					<div class="alert alert-danger">
						<?= $this->session->flashdata('pesan'); ?>
					</div>
				<?php endif ?>
				<div class="card bg-transparent" style="border-radius:8%; box-shadow: 7px 13px #e3f2fd;">
					<div class="card-body">
					<h2 class="text-center">#LaundryAja</h2><br>
						<form action="<?= base_url('C_Auth') ?>" method="post">
							<input type="hidden" name="<?= csrf()['name'] ?>" value="<?= csrf()['hash']; ?>">
							<div class="form-group">
								<label for="Username">Username <span class="text-danger"></span></label>
								<input type="text" name="username" placeholder="Masukkan Username" class="form-control" style="background-color: #e3f2fd;">
								<?= form_error('username', '<div class="text-danger">', '</div>') ?>
							</div>
							<div class="form-group">
								<label for="password">password <span class="text-danger"></span></label>
								<input type="password" name="password" placeholder="Masukkan Password" class="form-control" style="background-color: #e3f2fd;">
								<?= form_error('password', '<div class="text-danger">', '</div>') ?>
							</div>
							<button name="submit" type="submit" class="btn btn-outline-primary btn-block" style="border-radius:8%; box-shadow: 3px 6px #e3f2fd;" >Login</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>