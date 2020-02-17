<div class="row">
    <!-- <div class="row"> -->
    <?php foreach ($paket as $p) : ?>
        <?php if ($p->id_outlet) : ?>
            <div class="col-sm-4 col-lg-2">
                <div class="card mt-3 ml-3">
                    <div class="brand-card-header bg-info">
                        <div class="chart-wrapper text-center text-white">
                            <h3><?php echo $p->nama_paket; ?></h3>
                        </div>
                    </div>
                    <h3 class="text-center"><?= $p->jenis ?></h3>
                    <h6 class="text-center"><?php echo 'Rp ' . number_format($p->harga, 0, '.', '.') ?></h6>
                    <div class="brand-card-body row">
                        <div class="col-6">
                            <input type="number" name="qty" value="1" class="form-control">
                        </div>
                        <div class="col-6">
                            <button class="tambah_beli btn btn-success form-control" type="submit">Pesan</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
    <?php endforeach ?>
</div>