<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Detail Data Transaksi Pembelian
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>
<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/pembelian/index')">
    <i class="fa fa-backward"> Kembali</i>
</button>
<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kode Pembelian :</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" readonly value="<?= $detail['kode_pembelian']; ?>">
    </div>
    <label class="col-sm-2 col-form-label">Tanggal Pembelian :</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" readonly value="<?= date('d-m-Y', strtotime($detail['tanggal_pembelian'])); ?>">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Supplier :</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" readonly value="<?= $detail['supplier'] ?>">
    </div>
    <label class="col-sm-1 col-form-label">Ekor :</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" readonly value="<?= number_format($detail['jml_ekor']) ?>  Ekor">
    </div>
    <label class="col-sm-1 col-form-label">Kg :</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" readonly value="<?= number_format($detail['jml_kg'],2,",") ?>  Kg">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Produk :</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" readonly value="<?= $detail['produk_dibeli'] ?>">
    </div>
    <label class="col-sm-1.5 col-form-label">Harga/Kg :</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" readonly value="Rp. <?= number_format($detail['harga'],0,",",".") ?>">
    </div>
    <label class="col-sm-1.5 col-form-label">Total Harga :</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" readonly value="Rp. <?= number_format($detail['harga_total'],0,",",".") ?>">
    </div>
</div>
<div style="padding-left:3%;">
    <strong>Detail Timbangan:</strong>
    <div id="detail"></div>
    <br />
</div>

<?=
"<script>var detail_ekor = " . json_encode($detail['detail_ekor']) . ";var detail_kg = " . json_encode($detail['detail_kg']) . ";</script>"
?>
<script>
    timbangan_ekor = detail_ekor.split("#");
    timbangan_kg = detail_kg.split("#");

    bnyk = timbangan_ekor.length - 1;

    for (i = 1; i <= bnyk; i++) {
        $("#detail").append("<div>Timbangan " + i + " | Hasil: " + timbangan_ekor[i] + "    ekor (" + timbangan_kg[i] + " kg)</div>");

    }
</script>

<div style="padding-left:3%;">
    <strong>
        Bukti Pembelian: <br />
        <img width="50%" src="<?= base_url('bukti_beli/' . $detail['bukti']) ?>" alt="Bukti">
    </strong>
</div>
<?= $this->endSection('isi') ?>