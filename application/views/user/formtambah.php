<div class="container">
    <div class="row">
        <div class="mx-auto mt-3">
            <h3 class="text-center"><?= $judul; ?></h3>
            <br>
            <div class="card bg-light" style="width: 40rem;">
                <div class="card-body">
                    <form action="<?= base_url('C_User/formtambahuser') ?>" method="post">
                        <input type="hidden" name="<?= csrf()['name'] ?>" value="<?= csrf()['hash']; ?>">
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="nama">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nama" value="<?= set_value('nama') ?>" placeholder="Masukkan Nama" class="form-control">
                                <?= form_error('nama', '<div class="text-danger">', '</div>') ?>
                            </div>
                            <div class="col-6">
                                <label for="Username">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" value="<?= set_value('username') ?>" placeholder="Masukkan Username" class="form-control">
                                <?= form_error('username', '<div class="text-danger">', '</div>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" placeholder="Masukkan Password" class="form-control">
                                <?= form_error('password', '<div class="text-danger">', '</div>') ?>
                            </div>
                            <div class="col-6">
                                <label for="password1">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" name="password1" placeholder="Masukkan Konfirmasi Password" class="form-control">
                                <?= form_error('password1', '<div class="text-danger">', '</div>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="level">Nama Level <span class="text-danger">*</span></label>
                                <select name="level" class="form-control">
                                    <?php foreach ($level as $l) : ?>
                                        <option value="<?= $l ?>"><?= $l ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?= form_error('level', '<div class="text-danger">', '</div>') ?>
                            </div>
                            <div class="col-6">
                                <label for="outlet">Nama Outlet <span class="text-danger">*</span></label>
                                <select name="outlet" class="form-control">
                                    <?php foreach ($outlet as $o) : ?>
                                        <option value="<?= $o->id_outlet ?>"><?= $o->nama_outlet ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?= form_error('outlet', '<div class="text-danger">', '</div>') ?>
                            </div>
                        </div>
                        <a href="<?= base_url('C_User') ?>" class="btn btn-success">Kembali</a>
                        <button type="submit" class="btn btn-primary mr-auto">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>