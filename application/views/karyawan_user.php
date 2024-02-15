<?= $this->session->flashdata('pesan'); ?>

<div class="card">
    <div class="card-header">
        <a href="<?= base_url('karyawan/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Karyawan</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama Karyawan</th>
                    <th>Nomor Telp</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($karyawan as $ssw) : ?>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $ssw->nama_karyawan ?></td>
                        <td><?= $ssw->nomor_telp ?></td>
                        <td><?= $ssw->alamat ?></td>
                        <td>
                           <!-- <button data-toggle="modal" data-target="#edit<?= $ssw->id_karyawan ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                            <a href="<?= base_url('karyawan/delete/' . $ssw->id_karyawan) ?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>-->
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal edit -->
<?php foreach ($karyawan as $ssw) : ?>
    <div class="modal fade" id="edit<?= $ssw->id_karyawan ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('karyawan/edit/' . $ssw->id_karyawan) ?>" method="POST">
                        <div class="form-group">
                            <label>Nama Karyawan</label>
                            <input type="text" name="nama_karyawan" class="form-control" value="<?= $ssw->nama_karyawan ?>">
                            <?= form_error('nama_karyawan', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telp</label>
                            <input type="text" name="nomor_telp" class="form-control" value="<?= $ssw->nomor_telp ?>">
                            <?= form_error('nomor_telp', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="<?= $ssw->alamat ?>">
                            <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                            <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
