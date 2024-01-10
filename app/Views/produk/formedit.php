<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Form Edit Data Produk
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/produk/index')">
<i class="fa fa-backward"> Kembali</i>
</button>


<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>
<?= form_open('produk/updatedata') ?>

<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>


<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Kode Produk</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="kode_produk" name="kode_produk" readonly value="<?= $kode_produk; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Pilih Supplier</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $nama_produk; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Harga Beli/Kg</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="harga_beliperkg" name="harga_beliperkg" value="<?= $harga_beliperkg; ?>">
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Harga Jual/Kg</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="harga_jualperkg" name="harga_jualperkg" value="<?= $harga_jualperkg; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Stok/Kg</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="stok_perkg" name="stok_perkg" value="<?= number_format($stok_perkg,2); ?>">
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Stok/Ekor</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="stok_perekor" name="stok_perekor" value="<?= $stok_perekor; ?>">
    </div>
</div>
<div style="text-align:center">
    <input type="submit" value="Simpan" class="btn btn-success">
</div>
<?= form_close(); ?>


<?= $this->endSection('isi') ?>