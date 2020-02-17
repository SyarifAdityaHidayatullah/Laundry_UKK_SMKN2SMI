<div class="container">
    <div class="row">
        <div class="mx-auto mt-3">
            <h3 class="text-center"><?= $judul; ?></h3>
            <br>
            <div class="card bg-light" style="width: 30rem;">
                <div class="card-body">
                    <form action="<?= base_url('C_Outlet/formtambahoutlet') ?>" method="post">
                        <input type="hidden" name="<?= csrf()['name'] ?>" value="<?= csrf()['hash']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama" value="<?= set_value('nama') ?>" placeholder="Masukkan Nama" class="form-control">
                            <?= form_error('nama', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat" class="form-control" placeholder="masukkan alamat"><?= set_value('nama') ?></textarea>
                            <?= form_error('alamat', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label for="tlp">Telepon <span class="text-danger">*</span></label>
                            <input type="text" name="tlp" placeholder="Masukkan No Telepon" value="<?= set_value('tlp') ?>" class="form-control">
                            <?= form_error('tlp', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <a href="<?= base_url('C_Outlet') ?>" class="btn btn-success">Kembali</a>
                        <button type="submit" class="btn btn-primary mr-auto">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>