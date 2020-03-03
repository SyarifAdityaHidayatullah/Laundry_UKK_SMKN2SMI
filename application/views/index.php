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
                <td>Id Transaksi</td>
                <td>Keterangan</td>
                <td>Kuantitas</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <?php
        $no = 1;
        foreach ($riwayat as $r) :
            if ($r->id_transaksi == $r->id_transaksi) :
        ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $r->id_transaksi; ?></td>
                    <td><?= $r->keterangan; ?></td>
                    <td><?= $r->tgl; ?></td>
                    <td>

                        <a href="<?= base_url('C_Laporan/cetak/' . $r->id_transaksi) ?>" class="badge badge-warning">Detail</a>
                    </td>
                </tr>
        <?php
            endif;
        endforeach
        ?>
    </table>
</div>