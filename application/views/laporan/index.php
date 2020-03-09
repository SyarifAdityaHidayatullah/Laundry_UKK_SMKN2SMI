<div class="container">
    <h3 class="text-center mt-3"><?= $judul; ?></h3>
    <?php if ($this->session->flashdata()) : ?>
        <div class="alert alert-success mt-3">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    <?php endif ?>
    <table class="table table-bordered mt-3" id="data">
        <thead class="bg-info text-white">
            <tr>
                <td>No</td>
                <td>tanggal</td>
                <td>Kode invoice</td>
                <td>Nama Pelanggan</td>
                <td>Nama kasir</td>
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
        foreach ($laporan as $l) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $l->tgl; ?></td>
                <td><?= $l->kode_invoice; ?></td>
                <td><?= $l->nama; ?></td>
                <td><?= $l->nama_user; ?></td>
                <?php if ($this->session->userdata('level') == 'admin') : ?>
                    <td><?= $l->nama_outlet; ?></td>
                <?php endif ?>
                <td><?= $l->status; ?></td>
                <?php if ($l->dibayar == 'belum_dibayar') : ?>
                    <td>
                        <a href="" class="badge badge-danger">Belum dibayar</a>
                    </td>
                <?php else : ?>
                    <td>
                        <a href="" class="badge badge-success">dibayar</a>
                    </td>
                <?php endif ?>
                <td>
                    <a target="_blank" href="<?= base_url('C_Laporan/detail/' . $l->id_transaksi) ?>" class="badge badge-primary">Detail</a>
                    <a target="_blank" href="<?= base_url('C_Laporan/cetak/' . $l->id_transaksi) ?>" class="badge badge-warning" target="_blank">Cetak invoice</a>
                    <a href="<?= base_url('C_Outlet/formeditoutlet/' . $l->id_outlet) ?>" class="badge badge-primary">Edit</a>
                    <a href="<?= base_url('C_Outlet/hapusoutlet/' . $l->id_outlet) ?>" onclick="return confirm('apa anda yakin? data dihapus?')" class="badge badge-danger">Hapus</a>
                </td>
            </tr>
        <?php endforeach;
        ?>
    </table>
</div>