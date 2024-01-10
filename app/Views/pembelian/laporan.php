<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Laporan Pembelian
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/pembelian/index')">
<i class="fa fa-backward"> Kembali</i>
</button>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>
<div id="tombolPilih" style="text-align:center">
    <h4>Pilih Periode</h4>
    <button style="font-weight: bold;" type="button" class="btn btn-info" onclick="hariIni()">
        Hari ini
    </button>
    <button style="display: none;" type="button" class="btn btn-info" onclick="pekanIni()">
        Pekan ini
    </button>
    <button style="font-weight: bold;" type="button" class="btn btn-info" onclick="bulanIni()">
        Bulan ini
    </button>
    <button style="font-weight: bold;" type="button" class="btn btn-info" onclick="pilihTanggal()">
        Tanggal Tertentu
    </button>
</div>

<div id="pilihTanggal" style="display:none">
<form method="post" action="<?= base_url('pembelian/detaillaporan'); ?>">
    <div style="text-align:center">
        
        <label for="tanggal_awal">Tanggal Awal:</label><br/>
        <input class="col-sm-4" style="padding:5px" type="text" id="tanggal_awal" name="tanggal_awal" placeholder="Masukkan Tanggal Awal" onfocus="(this.type='date')" required><br/><br/>

        <label for="tanggal_akhir">Tanggal Akhir:</label><br/>
        <input class="col-sm-4" style="padding:5px" type="text" id="tanggal_akhir" name="tanggal_akhir" placeholder="Masukkan Tanggal Akhir" onfocus="(this.type='date')" required><br/>

        <button id="cariTanggal" type="submit" class="btn btn-sm btn-success" style="padding:10px;margin:20px auto;"><i class="fa fa-search"> Cari Laporan</i></button>
    </div>
    <div style="text-align: left;">
        <button class="btn btn-sm btn-danger" onclick="backPilih()"> Batal</button></div>
</form>
</div>

<script>
    function hariIni(){
        var inputTanggalAwal = document.getElementById('tanggal_awal');
        var inputTanggalAkhir = document.getElementById('tanggal_akhir');
        inputTanggalAwal.focus();
        var today = new Date();
        var formattedDate = today.toISOString().split('T')[0];
        inputTanggalAwal.value = formattedDate;
        inputTanggalAkhir.focus();
        inputTanggalAkhir.value = formattedDate;
        $("#cariTanggal").click();
    }
    function pekanIni(){
        var inputTanggalAwal = document.getElementById('tanggal_awal');
        inputTanggalAwal.focus();
        var today = new Date();
        var sevenDaysAgo = new Date(today);
        sevenDaysAgo.setDate(today.getDate() - 7);
        var formattedSevenDaysAgo = sevenDaysAgo.toISOString().split('T')[0];
        inputTanggalAwal.value = formattedSevenDaysAgo;

        var inputTanggalAkhir = document.getElementById('tanggal_akhir');
        inputTanggalAkhir.focus();
        inputTanggalAkhir.value = today.toISOString().split('T')[0];
        $("#cariTanggal").click();
    }
    function bulanIni(){
        var inputTanggalAwal = document.getElementById('tanggal_awal');
        inputTanggalAwal.focus();
        var firstDayOfMonth = new Date();
        firstDayOfMonth.setDate(1);
        var formattedFirstDayOfMonth = firstDayOfMonth.toISOString().split('T')[0];
        inputTanggalAwal.value = formattedFirstDayOfMonth;

        var inputTanggalAkhir = document.getElementById('tanggal_akhir');
        inputTanggalAkhir.focus();
        var today = new Date();
        inputTanggalAkhir.value = today.toISOString().split('T')[0];
        $("#cariTanggal").click();
    }
    function pilihTanggal(){
        $("#pilihTanggal").show();
        $("#tombolPilih").hide();
    }
    function backPilih(){
        $("#pilihTanggal").hide();
        $("#tombolPilih").show();
    }
</script>
<?= $this->endSection('isi') ?>