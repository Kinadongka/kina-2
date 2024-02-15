<?= $this->session->flashdata('pesan'); ?>

<div class="card">
    <div class="card-header">
       <!-- <a href="<?= base_url('harga/plus') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Harga</a>-->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Harga</th>
                    <th>Jenis Bahan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($harga as $ssw) : ?>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $ssw->harga ?></td>
                        <td><?= $ssw->jenis_bahan ?></td>
                        <td>
                           <!-- <button data-toggle="modal" data-target="#edit<?= $ssw->id_harga ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                            <a href="<?= base_url('harga/delete/' . $ssw->id_harga) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>-->
                        </td>
                    </tr>

                    <!-- Modal edit -->
                    <div class="modal fade" id="edit<?= $ssw->id_harga ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Harga</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('harga/edit/' . $ssw->id_harga) ?>" method="POST">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="text" name="harga" class="form-control" value="<?= $ssw->harga ?>">
                                            <?= form_error('harga', '<div class="text-small text-danger">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Bahan</label>
                                            <input type="text" name="jenis_bahan" class="form-control" value="<?= $ssw->jenis_bahan ?>">
                                            <?= form_error('jenis_bahan', '<div class="text-small text-danger">', '</div>'); ?>
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
            </tbody>
        </table>
    </div>
</div>
