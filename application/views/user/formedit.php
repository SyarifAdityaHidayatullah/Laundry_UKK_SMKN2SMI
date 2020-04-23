<div class="container">
    <div class="row">
        <div class="mx-auto mt-3">
            <h3 class="text-center"><?= $judul; ?></h3>
            <br>
            <div class="card bg-light" style="width: 30rem;">
                <div class="card-body">
                    <form action="<?= base_url('C_User/formedituser/' . $user->id_user) ?>" method="post">
                        <input type="hidden" name="<?= csrf()['name'] ?>" value="<?= csrf()['hash']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama" value="<?= $user->nama_user ?>" placeholder="Masukkan nama" class="form-control">
                            <?= form_error('nama', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label for="Username">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" value="<?= $user->username ?>" placeholder="Masukkan Username" class="form-control">
                            <?= form_error('username', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label for="level">Nama Level <span class="text-danger">*</span></label>
                            <select name="level" class="form-control">
                                <?php foreach ($level as $l) : ?>
                                    <?php if ($user->level == $l) : ?>
                                        <option value="<?= $l ?>" selected><?= $l ?></option>
                                    <?php else : ?>
                                        <option value="<?= $l ?>"><?= $l ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('level', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label for="outlet">Nama Outlet <span class="text-danger">*</span></label>
                            <select name="outlet" class="form-control">
                                <?php foreach ($outlet as $o) : ?>
                                    <?php if ($o->id_outlet == $user->id_outlet) : ?>
                                        <option value="<?= $o->id_outlet ?>" selected><?= $o->nama_outlet ?></option>
                                    <?php else : ?>
                                        <option value="<?= $o->id_outlet ?>"><?= $o->nama_outlet ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('level', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <a href="<?= base_url('C_User') ?>" class="btn btn-outline-success">Kembali</a>
                        <button type="submit" class="btn btn-outline-primary mr-auto">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>