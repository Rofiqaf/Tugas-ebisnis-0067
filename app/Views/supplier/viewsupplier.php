<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Pengelolaan Data Supplier
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-primary" onclick="location.href=('/supplier/tambah')">
<i class="fa fa-plus-circle"></i> Tambah Data
</button>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>

<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<?= form_open('supplier/index') ?>
<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Cari Data Supplier" name="cari" autofocus value="<?= $cari ?>">
<div class="input-group-append">
    <button class="btn btn-outline-success" type="submit" name="tombolcari"><i class="fa fa-search"></i></button>
</div>
</div>
<?= form_close(); ?>
<span class="badge badge-success" style="padding:10px;font-size:14px;margin:5px auto">
    <?= "Total Data : $totaldata"; ?>
</span>
<br>
<table class="table table-striped table-bordered" style="width:100%;font-size:12px;">
    <thead>
        <tr style="text-align:center">
            <th style="width: 5%;">No</th>
            <th>Kode Supplier</th>
            <th>Nama Supplier</th>
            <th>Alamat Supplier</th>
            <th>Telepon Supplier</th>
            <th>Nama PT</th>
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
            <td><?= $row['kode_supplier']; ?></td>
            <td><?= $row['nama_supplier']; ?></td>
            <td><?= $row['alamat_supplier']; ?></td>
            <td><?= $row['telepon_supplier']; ?></td>
            <td><?= $row['nama_pt']; ?></td>
            <td style="text-align:center;">
            <button type="button" class="btn btn-sm btn-warning" title="Edit Data" onclick="edit('<?= $row['kode_supplier'] ?>')"><i class="fa fa-edit"></i>
        </button>

        <form method="POST" action="/supplier/hapus/<?= $row['kode_supplier'] ?>" style="display:inline;" onsubmit=" return hapus();">
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
    <?= $pager->links('supplier', 'paging') ?>
</div>
<script>
    function edit(kode)
    {
        window.location.href = ('/supplier/edit/' +kode);  
    }

    function hapus() {
        pesan = confirm('Yakin data Supplier ini akan dihapus ?');

        if(pesan){
        return true;
        }else{
        return false;
        }
    }
</script>


<?= $this->endSection('isi') ?>