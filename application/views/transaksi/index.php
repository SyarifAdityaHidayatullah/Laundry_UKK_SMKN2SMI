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
                <td>Outlet</td>
                <td>Status Cucian</td>
                <td>Status Pembayaran</td>
                <td>Diskon</td>
                <td>Pajak</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <?php
        $no = 1;
        foreach ($transaksi as $t) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $t->tgl; ?></td>
                <td><?= $t->kode_invoice; ?></td>
                <td><?= $t->nama; ?></td>
                <td><?= $t->nama_user; ?></td>
                <td><?= $t->nama_outlet; ?></td>
                <td><?= $t->status; ?></td>
                <?php if ($t->dibayar == 'belum_dibayar') : ?>
                    <td>
                        <a href="" class="badge badge-danger">Belum dibayar</a>
                    </td>
                <?php else : ?>
                    <td>
                        <a href="" class="badge badge-success">dibayar</a>
                    </td>
                <?php endif ?>
                <td><?= $t->diskon; ?></td>
                <td><?= $t->pajak; ?></td>
                <td>
                    <a href="<?= base_url('C_Outlet/formeditoutlet/' . $t->id_outlet) ?>" class="badge badge-primary">Edit</a>
                    <a href="<?= base_url('C_Outlet/hapusoutlet/' . $t->id_outlet) ?>" onclick="return confirm('apa anda yakin? data dihapus?')" class="badge badge-danger">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>