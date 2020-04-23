<div class="container">
    <h3 class="text-center mt-3"><?= $judul; ?></h3>
    <a href="<?= base_url('C_Pelanggan/formtambahpelanggan') ?>" class="btn btn-outline-success mt-3 mb-3">Tambah</a>
    <?php if ($this->session->flashdata()) : ?>
        <div class="alert alert-success mt-3">
            <?= $this->session->flashdata('pesanberhasil'); ?>
        </div>
    <?php endif ?>
    <table class="table table-bordered" id="data">
        <thead class="text-black" style="background-color: #e3f2fd;">
            <tr>
                <td>No</td>
                <td>Nama</td>
                <?php if ($this->session->userdata('level') == 'admin') : ?>
                    <td>Outlet</td>
                <?php endif ?>
                <td>Jenis Kelamin</td>
                <td>Alamat</td>
                <td>No HP</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <?php
        $no = 1;
        foreach ($pelanggan as $p) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $p->nama; ?></td>
                <?php if ($this->session->userdata('level') == 'admin') : ?>
                    <td><?= $p->nama_outlet; ?></td>
                <?php endif ?>
                <td><?= $p->jk; ?></td>
                <td><?= $p->alamat; ?></td>
                <td><?= $p->no_hp; ?></td>
                <td>
                    <a href="<?= base_url('C_Pelanggan/formeditpelanggan/' . $p->id_pelanggan) ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                    <a href="<?= base_url('C_Pelanggan/hapuspelanggan/' . $p->id_pelanggan) ?>" onclick="return confirm('anda yakin akan menghapus data member?')" class="btn btn-outline-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>