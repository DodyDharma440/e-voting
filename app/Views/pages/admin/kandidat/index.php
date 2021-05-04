<!--Header Breadcrumb-->
<div class="row m-0">
    <div class="col-md-4 p-0">
        <h4>Data Kandidat</h4>
    </div>
    <div class="col-md-6 offset-md-2 d-flex justify-content-md-end p-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb admin-breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kandidat</li>
            </ol>
        </nav>
    </div>
</div>
<hr class="mt-0">

<?php
//Alert Berhasil
if (session()->getFlashdata('sukses')) { ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            html: '<?= session()->getFlashdata('sukses') ?>'
        })
    </script>
<?php
}
?>

<div class="btn-wrap d-flex">
    <!--Button-->
    <a href="<?= base_url('admin/kandidat/tambah') ?>" class="btn btn-info ml-auto" id="btnTambahKandidat"><i class="fas fa-plus-square"></i> <span class="d-none d-sm-inline-block"> Tambah Kandidat</span></a>
</div>

<?php
if (!$kandidat) { ?>
    <!--No Data-->
    <div class="card mt-3">
        <div class="card-body text-center">
            <img src="<?= base_url('/assets/images/cartoon/nodata.png') ?>" class="img-nodata img-fluid">
            <p>Whooops! Belum ada kandidat yang ditambahkan. Silahkan klik tombol <b class="text-info">Tambah Kandidat</b> terlebih dahulu.</p>
        </div>
    </div>
<?php
} else {
?>
    <div class="card mt-3">
        <div class="card-header">
            Tabel Data
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php
                $table = new CodeIgniter\View\Table();

                $template = [
                    'table_open'            => '<table class="table table-striped table-bordered table-evoting" id="tableKandidat">',
                    'table_close'           => '</table>',

                    'thead_open'            => '<thead class="bg-dark text-light">',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th scope="col" class="text-center">',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td scope="row" class="text-center">',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td scope="row" class="text-center">',
                    'cell_alt_end'          => '</td>',

                    'tfoot_open'            => '<tfoot>',
                    'tfoot_close'           => '</tfoot>',

                    'footing_row_start'     => '<tr>',
                    'footing_row_end'       => '</tr>',
                    'footing_cell_start'    => '<td scope="row" class="text-center">',
                    'footing_cell_end'      => '</td>',
                ];
                $table->setHeading('No', 'Nomor Urut', 'Nama Pasangan', 'Jabatan', 'Aksi');
                $no = 1;
                foreach ($kandidat as $rows) {
                    //Komponen Aksi
                    $edit = '<a href="' . base_url('admin/kandidat/edit/' . $rows->kandidat_id) . '" class="btn btn-success m-1 p-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>';
                    $hapus = '<button class="btn btn-danger m-1 p-2 btn-delete-kandidat" data-id="' . $rows->kandidat_id . '" data-pasangan="' . $rows->pasangan . '" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="far fa-trash-alt"></i></button>';
                    $detail = '<a href="' . base_url('admin/kandidat/detail/' . $rows->kandidat_id) . '" class="btn btn-info m-1 p-2" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-eye"></i></a>';
                    $aksi = $edit . ' ' . $hapus . ' ' . $detail;
                    $table->addRow($no++, $rows->no_urut, $rows->pasangan, $rows->jabatan, $aksi);
                }
                $table->setTemplate($template);
                echo $table->generate();
                ?>
            </div>
        </div>
    </div>

    <!--Modal Hapus Kandidat-->
    <div class="modal fade" id="modalHapusKandidat" tabindex="-1" role="dialog" aria-labelledby="HapusKandidat" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="HapusKandidat">Hapus Kandidat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>Apakah Anda yakin untuk menghapus kandidat dengan nama pasangan <b><span class="nama-pasangan"></span></b> ?</p>
                </div>
                <div class="modal-footer">
                    <?= form_open(base_url('admin/kandidat/hapus')) ?>
                    <input type="hidden" class="kandidat-id" name="kandidat_id">
                    <input type="hidden" class="pasangan" name="pasangan">
                    <input type="hidden" class="foto-calon" name="foto_calon">
                    <input type="hidden" class="foto-calon-wakil" name="foto_calon_wakil">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-submit">Hapus</button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>