<div class="mt-3 ml-3">
    <form class="form-inline my-2 my-lg-0" action="" method="POST">
        <input type="search" placeholder="cari paket" class="form-control mr-sm-2">
        <button class="btn btn-primary" type="submit">Cari</button>
    </form>
</div>
<div class="row">
    <div class="col-8">
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
                                    <input type="number" name="qty" value="1" class="form-control">
                                </div>
                                <div class="col-6">
                                    <button class="tambah_beli btn btn-success form-control" type="submit" data-namapaket="<?= $p->nama_paket ?>" data-idpaket="<?= $p->id_paket ?>" data-harga="<?= $p->harga ?>" data-qty="<?= $this->input->post('qty') ?>">Pesan</button>
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
    <div class="col-sm-4 mt-3">
        <form action="<?= base_url() ?>" method="post"></form>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-lg-12">

                            <h4>Table Keranjang</h4>
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
            var nama = $(this).data('namapaket');
            var id = $(this).data('idpaket');
            var harga_paket = $(this).data('hargapaket');
            var qty = $(this).data('qty');
            $.ajax({
                url: "<?= base_url('paket/simpan_keranjang') ?>",
                method: "POST",
                data: {
                    id_paket: id,
                    nama_paket: nama,
                    harga: harga_paket
                },
                success: function(data) {
                    $('#tampil_keranjang').html(data);
                }
            });
            $('#tampil_keranjang').load("<?= base_url('paket/load_keranjang') ?>");
        });
    });
</script>