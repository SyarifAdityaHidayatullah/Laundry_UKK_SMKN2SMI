<div class="container">
    <h3 class="text-center mt-3"><?= $judul; ?></h3>
    <?php if ($this->session->flashdata()) : ?>
        <div class="alert alert-success mt-3">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    <?php endif ?>
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4>Data Pelanggan</h4>
        </div>
        <?php foreach ($pelanggan as $p) : ?>
            <table class="mt-3 ml-3 mb-3">
                <tr>
                    <td style="width: 130px"> Kode Invoice</td>
                    <td style="width: 10px"> : </td>
                    <td> <?= $p->kode_invoice; ?></td>
                </tr>
                <tr>
                    <td> Nama</td>
                    <td> : </td>
                    <td> <?= $p->nama; ?></td>
                </tr>
                <tr>
                    <td> Alamat</td>
                    <td> : </td>
                    <td> <?= $p->alamat; ?></td>
                </tr>
                <tr>
                    <td> Telepon</td>
                    <td> : </td>
                    <td> <?= $p->no_hp; ?></td>
                </tr>
            </table>
        <?php endforeach ?>
    </div>
    <table class="table table-bordered mt-3">
        <thead class="bg-info text-white">
            <tr>
                <td>No</td>
                <td>Nama Paket</td>
                <td>Harga</td>
                <td>Jumlah</td>
                <td>Total Harga</td>
            </tr>
        </thead>
        <?php
        $no = 1;
        foreach ($detail as $d) :
            $biaya = $d->biaya_tambahan;
            $totalharga = $d->harga * $d->qty;
            $diskon = $d->diskon * $totalharga / 100;
            $pajak = $d->pajak * $totalharga / 100;
            $total[] = $totalharga - $diskon + $pajak + $biaya;
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d->nama_paket; ?></td>
                <td><?= 'Rp ' . number_format($d->harga, 0, '.', '.'); ?></td>
                <td><?= $d->qty; ?></td>
                <td><?= 'Rp ' . number_format($totalharga, 0, '.', '.') ?></td>
            </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="4">Pajak</td>
            <td><?= $d->pajak . " %" ?></td>
        </tr>
        <tr>
            <td colspan="4">Diskon</td>
            <td><?= $d->diskon . " %" ?></td>
        </tr>
        <tr>
            <td colspan="4">Biaya Tambahan</td>
            <td><?= 'Rp. ' . number_format($d->biaya_tambahan, 0, '.', '.') ?></td>
        </tr>
        <tr>
            <td colspan="4">Total</td>
            <td><?= 'Rp ' . number_format(array_sum($total), 0, '.', '.') ?></td>
        </tr>
    </table>
    <div class="form-inline mb-5">
        <a class="btn btn-outline-danger ml-auto mr-3" href="<?= base_url('C_Transaksi/data_transaksi') ?>">Kembali</a>
        <?php if ($d->dibayar == 'belum_dibayar') : ?>
            <a onclick="return confirm('apa anda yakin barang akan dibayar?')" class="btn btn-outline-primary" href="<?= base_url('C_Transaksi/bayar/') . $d->id_transaksi ?>">Bayar</a>
        <?php endif ?>
        <?php if ($d->status == 'selesai' && $d->dibayar == 'dibayar') : ?>
            <a onclick="return confirm('apa anda yakin barang akan diambil?')" class="btn btn-outline-primary" href="<?= base_url('C_Transaksi/ambil/') . $d->id_transaksi ?>">Ambil</a>
        <?php endif ?>
    </div>
</div>