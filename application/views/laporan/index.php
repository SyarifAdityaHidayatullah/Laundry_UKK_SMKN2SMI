<div class="container">
    <h3 class="text-center mt-3"><?= $judul; ?></h3>
    <?php if ($this->session->flashdata()) :  ?>
        <div class="alert alert-success mt-3">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    <?php endif ?>
    <form id="form" action="" method="POST">
        <input type="hidden" name="<?= csrf()['name'] ?>" value="<?= csrf()['hash']; ?>">
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tanggal Awal</label>
                        <input id="min" type="date" class="form-control" name="tgl_awal">
                        <?= form_error('tgl_awal', '<div class="text-danger">', '</div>') ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <input id="max" type="date" class="form-control" name="tgl_akhir">
                        <?= form_error('tgl_akhir', '<div class="text-danger">', '</div>') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary btn-sm" id="cari">Cari</button>
                        <button type="submit" class="btn btn-outline-danger btn-sm" id="pdf">Pdf</button>
                        <button type="submit" class="btn btn-outline-success btn-sm" id="excel">Excel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <table class="table table-bordered mt-3" id="data">
        <thead class=" text-black" style="background-color: #e3f2fd;">
            <tr>
                <td>No</td>
                <td>Nama Pelanggan</td>
                <td>Tanggal Transaksi</td>
                <td>Tanggal Bayar</td>
                <td>Batas Waktu</td>
                <td>Kode Invoice</td>
                <?php if ($this->session->userdata('level') == 'admin') : ?>
                    <td>Outlet</td>
                <?php endif ?>
                <td>Status Cucian</td>
                <td>Total Harga</td>
            </tr>
        </thead>

        <?php
        $no = 1;
        $a = 0;
        foreach ($laporan as $t) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $t->nama; ?></td>
                <td><?= $t->tgl; ?></td>
                <td><?= $t->tgl_bayar; ?></td>
                <td><?= $t->batas_waktu; ?></td>
                <td><?= $t->kode_invoice; ?></td>
                <?php if ($this->session->userdata('level') == 'admin') : ?>
                    <td><?= $t->nama_outlet; ?></td>
                <?php endif ?>
                <td><?= $t->status; ?></td>
                <td><?= 'Rp ' . number_format($t->total_harga, 0, '.', '.'); ?></td>
            </tr>
        <?php $a = $a + $t->total_harga;
        endforeach;
        ?>
    </table>
    <label><b>Total Pemasukan adalah Rp. <?= number_format($a, 0, ',', '.') ?></b></label>
</div>
<script>
    $('#cari').click(function() {
        $('#form').attr('action', "<?= base_url('C_Laporan/cari') ?>");
        $('#form').submit();
    });
    $('#pdf').click(function() {
        $('#form').attr('action', "<?= base_url('C_Laporan/pdf') ?>");
        $('#form').submit();
    });
    $('#excel').click(function() {
        $('#form').attr('action', "<?= base_url('C_Laporan/excel') ?>");
        $('#form').submit();
    });
</script>