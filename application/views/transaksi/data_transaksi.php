<div class="container">
    <h3 class="text-center mt-3"><?= $judul; ?></h3>
    <?php if ($this->session->flashdata()) : ?>
        <div class="alert alert-success mt-3">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    <?php endif ?>
    <table class="table table-bordered mt-3" id="data">
        <thead class="text-black" style="background-color: #e3f2fd;">
            <tr>
                <td>No</td>
                <td>tanggal</td>
                <td>Kode invoice</td>
                <td>Nama Pelanggan</td>
                <?php if ($this->session->userdata('level') == 'admin') : ?>
                    <td>Outlet</td>
                <?php endif ?>
                <td>Status Cucian</td>
                <td>Status Pembayaran</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <?php
        $no = 1;
        foreach ($laporan as $t) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $t->tgl; ?></td>
                <td><?= $t->kode_invoice; ?></td>
                <td><?= $t->nama; ?></td>
                <?php if ($this->session->userdata('level') == 'admin') : ?>
                    <td><?= $t->nama_outlet; ?></td>
                <?php endif ?>
                <td><?= $t->status; ?></td>
                <td><?= $t->dibayar; ?></td>
                <td>
                    <a target="_blank" href="<?= base_url('C_Transaksi/detail/' . $t->id_transaksi) ?>" class="btn btn-outline-primary btn-sm">Detail</a>
                    <?php if ($t->status == 'proses') : ?>
                        <a href="<?= base_url('C_Transaksi/selesai/' . $t->id_transaksi) ?>" onclick="return confirm('Yakin Apakah Barang Telah selesai Dicuci')" class="btn btn-outline-warning btn-sm">Selesai</a>
                    <?php endif ?>
                    <?php if ($t->dibayar == 'dibayar' && $t->status == 'selesai') : ?>
                        <a href="<?= base_url('C_Transaksi/ambil/' . $t->id_transaksi) ?>" onclick="return confirm('apa anda yakin barang akan diambil?')" class="btn btn-outline-secondary btn-sm">Ambil</a>
                    <?php endif ?>
                    <?php if ($t->dibayar == 'belum_dibayar' && $t->status == 'proses') : ?>
                        <a href="<?= base_url('C_Transaksi/hapus/' . $t->id_transaksi) ?>" onclick="return confirm('anda yakin akan mengapus data transaksi ini?')" class="btn btn-outline-danger btn-sm">Hapus</a>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach;
        ?>
    </table>
</div>