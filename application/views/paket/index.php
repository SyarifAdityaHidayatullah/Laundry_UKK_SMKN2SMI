<div class="mt-3 ml-3">
    <form class="form-inline my-2 my-lg-0" action="" method="POST">
        <input type="search" placeholder="cari paket" class="form-control mr-sm-2">
        <button class="btn btn-primary" type="submit">Cari</button>
    </form>
</div>
<div class="row">
    <div class="col-6">
        <div class="row">
            <!-- awal card -->
            <?php foreach ($paket as $p) : ?>
                <?php if ($p->id_outlet) : ?>
                    <div class="col-sm-6">
                        <div class="card mt-3 ml-2 mr-2">
                            <div class="brand-card-header bg-info">
                                <div class="chart-wrapper text-center text-white">
                                    <h3><?php echo $p->nama_paket; ?></h3>
                                </div>
                            </div>
                            <h3 class="text-center"><?= $p->jenis ?></h3>
                            <h6 class="text-center"><?php echo 'Rp ' . number_format($p->harga, 0, '.', '.') ?></h6>
                            <div class="brand-card-body row">
                                <div class="col-6">
                                    <input type="number" name="qty" value="1" class="form-control" id="<?= $p->id_paket ?>">
                                </div>
                                <div class="col-6">
                                    <button class="tambah_beli btn btn-success form-control" type="submit" data-paketid="<?= $p->id_paket ?>" data-paketnama="<?= $p->nama_paket ?>" data-paketharga="<?= $p->harga ?>">Pesan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </div>
    <!-- akhir card -->

    <!-- awal keranjang -->
    <div class="col-sm-6 mt-3">
        <form action="<?= base_url('C_transaksi/transaksi') ?>" method="post"></form>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-lg-12">

                            <h4 class="text-center">Keranjang</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>Nama Paket</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Sub Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil_keranjang">

                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>

    </div>
    <!-- akhir keranjang -->
</div>

<script>
    $(document).ready(function() {
        $('.tambah_beli').click(function() {
            var id_paket = $(this).data('paketid');
            var nama_paket = $(this).data('paketnama');
            var harga = $(this).data('paketharga');
            var qty = $('#' + id_paket).val();
            $.ajax({
                url: "<?= base_url('C_Paket/simpan_keranjang') ?>",
                method: "POST",
                data: {
                    id_paket: id_paket,
                    nama_paket: nama_paket,
                    harga: harga,
                    qty: qty,
                },
                success: function(data) {
                    $('#tampil_keranjang').html(data);
                }
            });
        });

        $('#tampil_keranjang').load("<?= base_url() ?>C_Paket/load_keranjang");

        $(document).on('click', '.hapus_cart', function() {
            var row_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url('C_Paket/hapus_keranjang'); ?>",
                method: "POST",
                data: {
                    row_id: row_id
                },
                success: function(data) {
                    $('#tampil_keranjang').html(data);
                }
            });
        });
    });
</script>