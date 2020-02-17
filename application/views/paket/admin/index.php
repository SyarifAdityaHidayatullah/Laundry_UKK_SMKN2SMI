<div class="container">
    <h3 class="text-center mt-3"><?= $judul; ?></h3>
    <a href="<?= base_url('C_Paket/formtambahpaket') ?>" class="btn btn-success mt-3">Tambah</a>
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
                <td>Jenis</td>
                <td>Harga</td>
                <td>Outlet</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <?php
        $no = 1;
        foreach ($paket as $p) :
            if ($p->id_outlet) :
        ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p->nama_paket; ?></td>
                    <td><?= $p->jenis; ?></td>
                    <td><?= $p->harga; ?></td>
                    <td><?= $p->nama_outlet; ?></td>
                    <td>
                        <a href="<?= base_url('C_Paket/formeditpaket/' . $p->id_paket) ?>" class="badge badge-primary">Edit</a>
                        <a href="<?= base_url('C_Paket/hapuspaket/' . $p->id_paket) ?>" onclick="return confirm('apa anda yakin? data dihapus?')" class="badge badge-danger">Hapus</a>
                    </td>
                </tr>
        <?php
            endif;
        endforeach
        ?>
    </table>
</div>