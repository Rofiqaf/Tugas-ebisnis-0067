<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Form Edit Data PT
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fa fa-backward" ></i> Kembali', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('data_pt/index') . "')"
]) ?>


<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>
<?= form_open('data_pt/editdata', '', [
    ''
]) ?>
<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Kode PT</label>
    <div class="col-sm-8">
        <?= session()->getFlashdata('errorKodePt'); ?>
        <input type="text" class="form-control" id="kode_pt" name="kode_pt" readonly value="<?= $kode; ?>">
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Nama PT</label>
    <div class="col-sm-8">
        <?= session()->getFlashdata('errorNamaPt'); ?>
        <input type="text" class="form-control" id="nama_pt" name="nama_pt" value="<?= $nama; ?>">
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Alamat PT</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="alamat_pt" name="alamat_pt" value="<?= $alamat; ?>">
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Telepon PT</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="telepon_pt" name="telepon_pt" value="<?= $telepon; ?>">
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