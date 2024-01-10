<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Pengelolaan Data PT
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('','<i class="fa fa-plus-circle" ></i> Tambah Data', [
    'class' => 'btn btn-sm btn-primary',
    'onclick' => "location.href=('".site_url('data_pt/formtambah')."')"
])?>


<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>

<?= session()->getFlashdata('sukses'); ?>
<?= session()->getFlashdata('error'); ?>
<?= form_open('data_pt/index') ?>
<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Cari Data PT" name="cari" autofocus value="<?= $cari ?>">
<div class="input-group-append">
    <button class="btn btn-outline-success" type="submit" name="tombolcari"><i class="fa fa-search"></i></button>
</div>
</div>
<?= form_close(); ?>
<span class="badge badge-success" style="padding:10px;margin:5px auto;">
    <?= "Total Data : $totaldata"; ?>
</span>
<br>

<table class="table table-striped table-bordered" style="width:100%;font-size:12px;">
    <thead>
        <tr style="text-align:center">
            <th style="width: 5%;">No</th>
            <th>Kode PT</th>
            <th>Nama PT</th>
            <th>Alamat PT</th>
            <th>Telepon PT</th>
            <th style="width: 15%;">Aksi</th>
        </tr>
    </thead>


<tbody>
    <?php
    $nomor = 1 + (($nohalaman - 1)* 5);
    foreach ($tampildata as $row) :
    ?>

        <tr>
            <td style="text-align:center"><?= $nomor++; ?></td>
            <td><?= $row['kode_pt']; ?></td>
            <td><?= $row['nama_pt']; ?></td>
            <td><?= $row['alamat_pt']; ?></td>
            <td><?= $row['telepon_pt']; ?></td>
            <td style="text-align:center;">
                <button type="button" class="btn btn-sm btn-warning" title="Edit Data" onclick="edit('<?= $row['kode_pt']?>')">
                    <i class="fa fa-edit"></i>
                </button>

                <form method="POST" action="/data_pt/hapus/<?= $row['kode_pt'] ?>" style="display:inline;" onsubmit=" return hapus();">
                <input type="hidden" value="DELETE" name="_method">

                <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data " onclick="hapus('<?= $row['kode_pt']?>')">
                    <i class="fa fa-trash-alt"></i>
                </button>
            </form>
                
            </td>
        </tr>

    <?php endforeach; ?>
</tbody>
</table>
<div class="float-left mt-4" style="font-size:12px;">
    <?= $pager->links('data_pt', 'paging') ?>
</div>
<script>
    function edit(kode) {
        window.location = ('/data_pt/formedit/' + kode);
    }

    function hapus() {
        pesan = confirm('Yakin data PT dihapus ?');

        if(pesan){
        return true;
        }else{
            return false;
        }
    }
</script>



<?= $this->endSection('isi') ?>