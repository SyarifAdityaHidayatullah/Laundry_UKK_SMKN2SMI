<div class="container">
    <h3 class="text-center mt-3"><?= $judul; ?></h3>
    <a href="<?= base_url('C_User/formtambahuser') ?>" class="btn btn-success mt-3">Tambah</a>
    <?php if ($this->session->flashdata()) : ?>
        <div class="alert alert-success mt-3">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    <?php endif ?>
    <table class="table table-bordered mt-3">
        <thead class="bg-info text-white">
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Username</td>
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
                    <td><?= $u->username; ?></td>
                    <td><?= $u->level; ?></td>
                    <td><?= $u->nama_outlet; ?></td>
                    <td>
                        <a href="<?= base_url('C_User/formedituser/' . $u->id_user) ?>" class="badge badge-primary">Edit</a>
                        <a href="<?= base_url('C_User/hapususer/' . $u->id_user) ?>" onclick="return confirm('apa anda yakin? data dihapus?')" class="badge badge-danger">Hapus</a>
                        <a href="<?= base_url('C_User/resetpass/' . $u->id_user) ?>" onclick="return confirm('apa anda yakin? password di reset?')" class="badge badge-warning">Reset Password</a>
                    </td>
                </tr>
            <?php endif ?>
        <?php endforeach ?>
    </table>
</div>