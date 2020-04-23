<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?= $judul; ?></title>
  <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/datatables/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/jquery/jquery-ui.css') ?>">
  <script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/jquery/jquery-ui.js') ?>"></script>
  <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
</head>

<body>
  <!-- awal navbar -->
  <header class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="<?= base_url('C_Pelanggan') ?>" style="font-family:comic sans;">#LaundryAja</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <!-- jika admin login -->
        <?php if ($this->session->userdata('level') == 'admin') : ?>
          <li class="nav-item ml-5">
            <a class="nav-link <?= active('C_Pelanggan') ?>" href="<?= base_url('C_Pelanggan') ?>">Member</a>
          </li>
          <li class="nav-item  <?= active('C_Transaksi') ?>">
            <a class="nav-link " href="<?= base_url('C_Transaksi/data_transaksi') ?>">
              Data Transaksi
            </a>
          </li>
          <li class="nav-item ml-3">
            <a class="nav-link <?= active('C_Laporan') ?>" href="<?= base_url('C_Laporan') ?>">Laporan</a>
          </li>
          <li class="nav-item ml-3">
            <a class="nav-link <?= active('C_Paket') ?>" href="<?= base_url('C_Paket') ?>">Paket</a>
          </li>
          <li class="nav-item ml-3">
            <a class="nav-link <?= active('C_User') ?>" href="<?= base_url('C_User') ?>">User</a>
          </li>
          <li class="nav-item ml-3">
            <a class="nav-link <?= active('C_Outlet') ?>" href="<?= base_url('C_Outlet') ?>">Outlet</a>
          </li>
          
        <?php endif ?>
        <!-- jika kasir login -->
        <?php if ($this->session->userdata('level') == 'kasir') : ?>
          <li class="nav-item ml-5">
            <a class="nav-link <?= active('C_Pelanggan') ?>" href="<?= base_url('C_Pelanggan') ?>">Member</a>
          </li>
          <li class="nav-item dropdown <?= active('C_Transaksi') ?>">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Transaksi
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?= base_url('C_Transaksi') ?>">Transaksi</a>
              <a class="dropdown-item" href="<?= base_url('C_Transaksi/data_transaksi') ?>">Data Transaksi</a>
            </div>
          </li>
          <li class="nav-item ml-3">
            <a class="nav-link <?= active('C_Laporan') ?>" href="<?= base_url('C_Laporan') ?>">Laporan</a>
          </li>
        <?php endif ?>
        <!-- jika owner login -->
        <?php if ($this->session->userdata('level') == 'owner') : ?>
          <li class="nav-item ml-3">
            <a class="nav-link <?= active('C_Laporan') ?>" href="<?= base_url('C_Laporan') ?>">Laporan</a>
          </li>
        <?php endif ?>
      </ul>
      <a class="btn btn-outline-danger ml-auto" href="<?= base_url('C_Auth/logout') ?>">logout</a>
    </div>
  </header>
  <!-- akhir navbar -->