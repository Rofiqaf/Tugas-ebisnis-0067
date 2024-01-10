<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Form Tambah Data Produk
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/produk/index')">
<i class="fa fa-backward"> Kembali</i>
</button>


<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>
<?= form_open('produk/simpandata') ?>

<?= session()->getFlashdata('error'); ?>

<div class="form-group row">
    <div class="col-sm-4">
        <label for="kode_produk" class="col-form-label">Kode Produk</label>
    </div>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="kode_produk" name="kode_produk" autofocus>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-4">
        <label for="" class="col-form-label">Nama Produk</label>
    </div>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="nama_produk" name="nama_produk">
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-4">
        <label for="" class="col-form-label">Harga Beli/Kg</label>
    </div>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="harga_beliperkg" name="harga_beliperkg">
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-4">
        <label for="" class="col-form-label">Harga Jual/Kg</label>
    </div>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="harga_jualperkg" name="harga_jualperkg">
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-4">
        <label for="" class="col-form-label">Stok (Kg)</label>
    </div>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="stok_perkg" name="stok_perkg">
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <label for="" class="col-form-label">Stok (Ekor)</label>
    </div>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="stok_perekor" name="stok_perekor">
    </div>
</div>
<div style="text-align:center">
    <input type="submit" value="Simpan" class="btn btn-success">
</div>
<?= form_close(); ?>


<?= $this->endSection('isi') ?>