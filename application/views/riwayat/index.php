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
                <td>Tanggal Bayar</td>
                <td>Nama</td>
            </tr>
        </thead>

        <?php
        $no = 1;
        foreach ($riwayat as $r) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $r->tgl_bayar; ?></td>
                <td><?= $r->nama; ?></td>
            </tr>
        <?php endforeach ?>

    </table>
</div>