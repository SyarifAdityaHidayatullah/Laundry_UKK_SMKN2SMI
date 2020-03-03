<div class="container">
    <h3 class="text-center mt-3"><?= $judul; ?></h3>
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
            $total = $d->harga * $d->qty;
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d->nama_paket; ?></td>
                <td><?= $d->harga; ?></td>
                <td><?= $d->qty; ?></td>
                <td><?= $total ?></td>
            </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="4">Total</td>
            <td><?= $total ?></td>
        </tr>
    </table>
</div>