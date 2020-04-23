<div class="container">
    <h3 class="text-center mt-3"><?= $judul; ?></h3>
    <a href="<?= base_url('C_Outlet/formtambahoutlet') ?>" class="btn btn-outline-success mt-3 mb-3">Tambah</a>
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
                    <a href="<?= base_url('C_Outlet/formeditoutlet/' . $o->id_outlet) ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                    <a href="<?= base_url('C_Outlet/hapusoutlet/' . $o->id_outlet) ?>" onclick="return confirm('anda yakin akan menghapus data outlet ini')" class="btn btn-outline-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>