<div class="container">
    <h3 class="text-center mt-3"><?= $judul; ?></h3>
    <a href="<?= base_url('C_Outlet/formtambahoutlet') ?>" class="btn btn-success mt-3">Tambah</a>
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
                <td>Alamat</td>
                <td>Telepon</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <?php
        $no = 1;
        foreach ($outlet as $o) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $o->nama_outlet; ?></td>
                <td><?= $o->alamat_outlet; ?></td>
                <td><?= $o->tlp; ?></td>
                <td>
                    <a href="<?= base_url('C_Outlet/formeditoutlet/' . $o->id_outlet) ?>" class="badge badge-primary">Edit</a>
                    <a href="<?= base_url('C_Outlet/hapusoutlet/' . $o->id_outlet) ?>" onclick="return confirm('apa anda yakin? data dihapus?')" class="badge badge-danger">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>