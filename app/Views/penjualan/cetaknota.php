<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
NOTA TRANSAKSI PENJUALAN
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/penjualan/index')">
    <i class="fa fa-backward"> Kembali</i>
</button>
<button type="button" class="btn btn-sm btn-info" onclick="cetak()">
    <i class="fa fa-print"> Cetak</i>
</button>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>
<div id="nota" style="margin:10px;padding:10px;border:2px solid lightgray;">
    <div class="col">
        <div style="padding-left: 20%; margin-top: 10px; margin-bottom: -25px;">
        <img src="<?= base_url() ?>/dist/img/logo-ayam.png" class="img-circle elevation-2" style="width: 100px; height: 100px;" alt="User Image">
        </div>
        <h2 style="text-align:center;margin-bottom:0px; font-weight: bold; font-size: 30pt;">SAWUNG WHITE</h2>
        <h6 style="text-align:center;margin-top:0px;padding:0 0 10px 0;font-size: 14pt;">JL. Melati Ds. Lowa Kec. Comal Kab. Pemalang, 52363</h6>

    </div>
    <div style="margin:5px auto;background:black;height:2px;width:100%"></div>

    <div class="row">
        <div class="col-sm-6">No. Nota &ensp; &nbsp; : <?= $detail['kode_penjualan'] ?></div>
        <div class="col-sm-6">Tanggal &emsp14; : <?= date('d-m-Y', strtotime($detail['tanggal_penjualan'])); ?></div>
        <div class="col-sm-6">Pelanggan &ensp; : <?= $detail['customer'] ?></div>
    </div>

    <style>
        #dataPenjualan thead th {
            border-color: black;
        }

        #dataPenjualan tbody td {
            border-color: black;
        }

        @media print {

            #dataPenjualan,
            #dataPenjualan thead th,
            #dataPenjualan tbody td {
                border-color: black !important;
            }
        }
    </style>

    <table id="dataPenjualan" class="table table-striped table-bordered" style="width:100%;font-size:12px;margin:10px auto;">
        <thead>
            <tr style="text-align:center;">
                <th>No</th>
                <!-- <th>Kode</th> -->
                <th>Produk</th>
                <th>Ekor</th>
                <th>Kg</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center">1</td>
                <!-- <td style="text-align:center"><?= $detail['kode_produk_dijual'] ?></td> -->
                <td style=""><?= $detail['produk'] ?></td>
                <td style="text-align:center"><?= number_format($detail['ekor']) ?></td>
                <td style="text-align:center"><?= number_format($detail['kg'],2,",") ?></td>
                <td style="text-align:right">Rp. <?= number_format($detail['harga'],0,",",".") ?></td>
                <td style="text-align:right">Rp. <?= number_format($detail['totalHarga'],0,",",".") ?></td>
            </tr>


        </tbody>
    </table>
    <div style="padding-left:70%">
        <div>Total &emsp;&emsp; &emsp; &emsp; &nbsp;&ensp;: Rp. <?= number_format($detail['totalHarga'],0,",",".") ?></div>
        <div>Bayar &emsp;&emsp; &emsp; &emsp; &nbsp;: Rp. <?= number_format($detail['bayar'],0,",",".") ?></div>
        <div>Kembali &emsp; &emsp; &emsp; &nbsp;: Rp. <?= number_format($detail['kembalian'],0,",",".") ?></div>
        <div>Status Lunas &emsp;&emsp;: <?= $detail['status'] ?></div>
    </div>

    <div style="text-align:center;padding:5px;margin:20px auto;">
        ** TERIMA KASIH **<br />
        Barang yang Sudah Dibeli Tidak Dapat Ditukar atau Dikembalikan.
    </div>
</div>
<script>
    function cetak() {
        $('.card-header').hide();
        $('.main-footer').hide();
        $('#nota').css('border', '0px solid lightgray');
        $('.content').css('background', 'white');
        window.print();
    }
    window.onafterprint = function() {
        $('.card-header').show();
        $('.main-footer').show();
        $('#nota').css('border', '2px solid lightgray');
        $('.content').css('background', '#f4f6f9');

    };
</script>
<?= $this->endSection('isi') ?>