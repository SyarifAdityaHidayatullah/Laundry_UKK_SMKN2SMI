<div class="container">
    <h3 class="text-center mt-3"><?= $judul; ?></h3>
    <a href="<?= base_url('C_User/formtambahuser') ?>" class="btn btn-outline-success mt-3 mb-3">Tambah</a>
    <?php if ($this->session->flashdata()) : ?>
        <div class="alert alert-success mt-3">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    <?php endif ?>
    <table class="table table-bordered mt-3" id="data">
        <thead class="text-black" style="background-color: #e3f2fd;">
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Level</td>
                <td>Nama Outlet</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <?php
        $no = 1;
        foreach ($user as $u) :
            if ($u->id_outlet) :
        ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $u->nama_user; ?></td>
                    <td><?= $u->level; ?></td>
                    <td><?= $u->nama_outlet; ?></td>
                    <td>
                        <a href="<?= base_url('C_User/formedituser/' . $u->id_user) ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                        <a href="<?= base_url('C_User/hapususer/' . $u->id_user) ?>" onclick="return confirm('anda yakin akan menghapus data user ini?')" class="btn btn-outline-danger btn-sm">Hapus</a>
                        <a href="<?= base_url('C_User/resetpass/' . $u->id_user) ?>" onclick="return confirm('anda yakin akan mereset password menjadi = randompassword')" class="btn btn-outline-warning btn-sm">Reset Password</a>
                    </td>
                </tr>
            <?php endif ?>
        <?php endforeach ?>
    </table>
</div>