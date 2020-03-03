<div class="container">
    <h3 class="text-center mt-3"><?= $judul; ?></h3>
    <?php if ($this->session->flashdata()) : ?>
        <div class="alert alert-success mt-3">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    <?php endif ?>
    <table class="table table-bordered" id="data">
        <thead class="bg-info text-white">
            <tr>
                <td>No</td>
                <td>Kode Invoice</td>
                <td>Nama Pelanggan</td>
                <td>Tanggal</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <?php
        $no = 1;
        foreach ($laporan as $l) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $l->kode_invoice; ?></td>
                <td><?= $l->nama; ?></td>
                <td><?= $l->tgl; ?></td>
                <td>
                    <a href="<?= base_url('C_Laporan/detail/' . $l->id_transaksi) ?>" class="badge badge-primary">Detail</a>
                    <a href="<?= base_url('C_Laporan/cetak' . $l->id_transaksi) ?>" class="badge badge-warning" target="_blank">Cetak</a>
                </td>
            </tr>
        <?php
        endforeach
        ?>
    </table>
</div>