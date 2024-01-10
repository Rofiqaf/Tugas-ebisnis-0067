<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Edit Pengguna
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/user/index')">
    Kembali
</button>
<button type="button" class="btn btn-sm btn-success" onclick="document.getElementById('tbTambahUser').click()">
    Simpan
</button>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>

<?= form_open('user/updatedata') ?>

<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>

    <div class="form-group row">
        <div class="col-sm-12" style="margin:1% auto;display:none">
            <input type="text" id="user_kode" name="user_kode" value="<?= $detail['kode_user'] ?>">
        </div>

        <div class="col-sm-12" style="margin:1% auto">
            <label for="user_username" class="col-sm-12 col-form-label">Username</label>
            <input type="text" class="form-control" id="user_username" name="user_username" placeholder="Masukkan Username" value="<?= $detail['username'] ?>">
        </div>

        <div class="col-sm-12">
            <label for="user_password" class="col-sm-12 col-form-label">Password</label>
            <input type="select" class="form-control" id="user_password" name="user_password" placeholder="Masukkan Password" value="<?= $detail['password'] ?>">
        </div>

        <div class="col-sm-12">
            <label for="user_nama" class="col-sm-12 col-form-label">Nama Lengkap</label>
            <input type="select" class="form-control" id="user_nama" name="user_nama" placeholder="Masukkan Nama" value="<?= $detail['nama'] ?>">
        </div>

        <div class="col-sm-12">
            <label for="user_level" class="col-sm-12 col-form-label">User Level</label>
            <select class="form-control" id="user_level" name="user_level">
            <option value="" disabled selected>== Pilih Level User ==</option>
                <?php foreach ($userlevel as $userlevel) : ?>
                    <option value="<?= $userlevel['nama_levels']?>"><?= $userlevel['nama_levels']?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group row" style="display:none">
        <div class="col-sm-12" style="text-align:center">
            <input id="tbTambahUser" type="submit" value="Simpan" class="btn btn-success">
        </div>
    </div>
<?= form_close(); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $("#user_level").val("<?= $detail['level'] ?>");
        }, false);
    </script>
<?= $this->endSection('isi') ?>