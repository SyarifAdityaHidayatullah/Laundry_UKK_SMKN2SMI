<div class="container">
    <div class="row">
        <div class="mx-auto mt-3">
            <h3 class="text-center"><?= $judul; ?></h3>
            <br>
            <div class="card bg-light" style="width: 30rem;">
                <div class="card-body">
                    <form action="<?= base_url('C_Paket/formtambahpaket') ?>" method="post">
                        <input type="hidden" name="<?= csrf()['name'] ?>" value="<?= csrf()['hash']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama Paket <span class="text-danger">*</span></label>
                            <input type="text" name="nama_paket" value="<?= set_value('nama_paket') ?>" placeholder="Masukkan Nama Paket" class="form-control">
                            <?= form_error('nama_paket', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga <span class="text-danger">*</span></label>
                            <input type="number" name="harga" placeholder="Masukkan Harga" value="<?= set_value('harga') ?>" class="form-control">
                            <?= form_error('harga', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis <span class="text-danger">*</span></label>
                            <select name="jenis" class="form-control">
                                <?php foreach ($jenis as $j) : ?>
                                    <option value="<?= $j ?>"><?= $j ?></option>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('jenis', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label for="outlet">Nama Outlet <span class="text-danger">*</span></label>
                            <select name="outlet" class="form-control">
                                <?php foreach ($outlet as $o) : ?>
                                    <option value="<?= $o->id_outlet ?>"><?= $o->nama_outlet ?></option>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('outlet', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <a href="<?= base_url('C_Paket') ?>" class="btn btn-outline-success">Kembali</a>
                        <button type="submit" class="btn btn-outline-primary mr-auto">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>