<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Form Edit Data Supplier
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/supplier/index')">
    <i class="fa fa-backward"></i> Kembali
</button>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>

<?= form_open('supplier/updatedata') ?>

<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Kode Supplier</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="kode_supplier" name="kode_supplier" readonly value="<?= $kodesupplier; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Nama Supplier</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="<?= $namasupplier; ?>">
    </div>
</div>

<div class=" form-group row">
    <label for="" class="col-sm-4 col-form-label">Alamat Supplier</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier" value="<?= $alamatsupplier; ?>">
    </div>
</div>

<div class=" form-group row">
    <label for="" class="col-sm-4 col-form-label">Telepon Supplier</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="telepon_supplier" name="telepon_supplier" value="<?= $teleponsupplier; ?>">
    </div>
</div>

<div class=" form-group row">
    <label for="" class="col-sm-4 col-form-label">Pilih PT</label>
    <div class="col-sm-4">
        <select name="data_pt" id="data_pt" class="form-control">
            <?php foreach ($datapt as $pt) : ?>

                <?php if ($pt['kode_pt'] == $supdata_pt) : ?>

                    <option selected value="<?= $pt['kode_pt'] ?>"><?= $pt['nama_pt'] ?></option>

                <?php else : ?>

                    <option value="<?= $pt['kode_pt'] ?>"><?= $pt['nama_pt'] ?></option>

                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label"></label>
    <div class="col-sm-4">
        <input type="submit" value="Simpan" class="btn btn-success">
    </div>
</div>
<?= form_close(); ?>

<?= $this->endSection('isi') ?>