<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Detail Data Transaksi Penjualan
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>
<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/penjualan/index')">
<i class="fa fa-backward"> Kembali</i>
</button>
<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>

<div class="form-group row">
<label class="col-sm-2 col-form-label">No. Nota :</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" readonly value="<?= $detail['kode_penjualan']; ?>">
    </div>
    <label class="col-sm-3.5 col-form-label">Tanggal Penjualan :</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" readonly value="<?= date('d-m-Y', strtotime( $detail['tanggal_penjualan'])); ?>">
    </div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Nama Pelanggan :</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" readonly value="<?= $detail['customer'] ?>">
    </div>
    <label class="col-sm-1 col-form-label">Ekor :</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" readonly value="<?= number_format($detail['ekor']) ?>  Ekor">
    </div>
    <label class="col-sm-1 col-form-label">Kg :</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" readonly value="<?= number_format($detail['kg'],2) ?>  Kg">
    </div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Nama Produk :</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" readonly value="<?= $detail['produk'] ?>">
    </div>
    <label class="col-sm-1.5 col-form-label">Harga/Kg :</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" readonly value="Rp. <?= number_format($detail['harga'],0,",",".") ?>">
    </div>
    <label class="col-sm-1.5 col-form-label">Total Harga :</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" readonly value="Rp. <?= number_format($detail['totalHarga'],0,",",".") ?>">
    </div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Status Lunas :</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" readonly value="<?= $detail['status'] ?>">
    </div>
    <label class="col-sm-1.5 col-form-label">Dibayar :</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" readonly value="Rp. <?= number_format($detail['bayar'],0,",",".") ?>">
    </div>
    <label class="col-sm-1.5 col-form-label">Kurang Bayar :</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" readonly value="Rp. <?php
                        $kr = $detail['kembalian'];
                        if ($kr < 0) {
                            echo number_format($kr,0,",",".");
                        } else {
                            echo "0";
                        }
                        ?>">
                        
    </div>
</div>

<div style="padding-left:3%;">
    <strong>Detail Timbangan:</strong>
    <div id="detail"></div>
    <br/>
</div>

<?= 
"<script>var detail_ekor = ".json_encode($detail['detail_ekor']).";var detail_kg = ".json_encode($detail['detail_kg']).";</script>"
?>
<script>
    timbangan_ekor = detail_ekor.split("#");
    timbangan_kg = detail_kg.split("#");

    bnyk = timbangan_ekor.length -1;

    for (i = 1; i <= bnyk; i++) {
        $("#detail").append("<div>Timbangan "+i+" | Hasil: "+timbangan_ekor[i]+" ekor ("+timbangan_kg[i]+" kg)</div>");
    }
</script>


<?= $this->endSection('isi') ?>