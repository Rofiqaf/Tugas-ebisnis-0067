<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
LAPORAN PEMBELIAN
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/pembelian/laporan')">
<i class="fa fa-backward"> Kembali</i>
</button>
<button type="button" class="btn btn-sm btn-info" onclick="cetak()">
<i class="fa fa-print"> Cetak</i>
</button>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>

<div id="laporan" style="margin:10px;padding:10px;border:2px solid lightgray;">
<div style="padding-left: 20%; margin-top: 10px; margin-bottom: -25px;">
        <img src="<?= base_url() ?>/dist/img/logo-ayam.png" class="img-circle elevation-2" style="width: 100px; height: 100px;" alt="Logo Perusahaan">
        </div>
    <h2 style="text-align:center; font-weight: bold; font-size: 30pt;" >UD. SAWUNG WHITE</h2>
    <h3 style="text-align:center; font-weight: bold; font-size: 20pt;" >LAPORAN PEMBELIAN</h3>
    <h3 style="text-align:center; font-weight: bold; font-size: 18pt; padding:0px 0px 10px 0px;">Periode: <?= date('d-m-Y', strtotime($awal)); ?> - <?= date('d-m-Y', strtotime($akhir)); ?> </h3>
    <div style="background:black;height:2px;width:100%"></div>

    <table id="dataPembelian" class="table table-striped table-bordered" style="width:100%;font-size:12px;">
    <thead>
        <tr style="text-align:center;">
            <th>No</th>
            <th>Kode Pembelian</th>
            <th>Tanggal Pembelian</th>
            <th>Produk</th>
            <th>Nama Suplier</th>
            <th>Jml Ekor</th>
            <th>Jml Kg</th>
            <th>Harga/kg</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        array_multisort(array_column($hasil_query, 'tanggal_pembelian'), SORT_ASC, $hasil_query);

        $nomorUrut = 1;
        foreach ($hasil_query as $row): ?>
            <tr id="<?= $row['kode_pembelian']; ?>" class="barisData">
                <td style="text-align:center;"><?= $nomorUrut; ?></td>
                <td style="text-align:center;"><?= $row['kode_pembelian']; ?></td>
                <td style="text-align:center;"><?= date('d-m-Y', strtotime($row['tanggal_pembelian'])); ?></td>
                <td><?= $row['produk_dibeli']; ?></td>
                <td><?= $row['supplier']; ?></td>
                <td class="ekor" style="text-align:right;"><?= number_format($row['jml_ekor']); ?></td>
                <td class="kg" style="text-align:right;"><?= $row['jml_kg']; ?></td>
                <td style="text-align:right;"><?= number_format($row['harga']); ?></td>
                <td class="totHarga" style="text-align:right;"><?= number_format($row['harga_total']); ?></td>
            </tr>
        <?php 
        $nomorUrut++;
        endforeach; ?>
    </tbody>
    </table>
    
    <div class="row">
        <div style="padding-left: 8%;">
            <br />
            <p style="text-align: center;">Mengetahui,</p>
            <p style="text-align: center;"> Pemilik</p>
            <br />
            <br />
            <p style="text-align: center;">(.......................)</p>
        </div>
        <div style="padding-left: 55%;">
            <p style="text-align: center;">Pemalang, <?php echo date("d-m-Y"); ?></p>
            <br />
            <p style="text-align: center;"> Admin Pembelian</p>
            <br />
            <br />
            <p style="text-align: center;">(.......................)</p>
        </div>
    </div>
</div>
<script>
    function cetak(){
        $('.card-header').hide();
        $('.main-footer').hide();
        $('#laporan').css('border','0px solid lightgray');
        $('.content').css('background','white');
        window.print();
    }
    window.onafterprint = function () {
        $('.card-header').show();
        $('.main-footer').show();
        $('#laporan').css('border','2px solid lightgray');
        $('.content').css('background','#f4f6f9');
        
    };
    document.addEventListener("DOMContentLoaded", () => {
        var tabelProduk = document.getElementById('dataPembelian').getElementsByTagName('tbody')[0];
        var newRow = tabelProduk.insertRow();
        var newCellMerged = newRow.insertCell(0);
        newCellMerged.colSpan = 5;
        newCellMerged.textContent = 'Total';
        newCellMerged.style.fontWeight = 'bold';
        newCellMerged.style.textAlign = 'right';
        for (var i = 1; i <= 4; i++) {
            var newCell = newRow.insertCell(i);
            newCell.id = 'nilai' + i;
            newCell.style.fontWeight = 'bold';
            newCell.style.textAlign = 'right';
        }
        jumlah();
    });
    function jumlah(){
        //ekor
        var ekore = document.getElementsByClassName('ekor');
        var totalekore = 0;

        for (var i = 0; i < ekore.length; i++) {
            var elementek = document.getElementsByClassName('ekor')[i];
            var jumlahek = elementek.textContent;
            var jjumlahek = parseInt(jumlahek.replace(/,/g, ''));
            totalekore += jjumlahek;
        }
        $("#nilai1").html(totalekore.toLocaleString());

        //kg
        var kge = document.getElementsByClassName('kg');
        var totalkge = 0;

        for (var i = 0; i < kge.length; i++) {
            var elementkg = document.getElementsByClassName('kg')[i];
            var jumlahkg = elementkg.textContent;
            var jjumlahkg = parseFloat(jumlahkg.replace(/,/g, ''));
            totalkge += jjumlahkg;
        }
        $("#nilai2").html(totalkge.toLocaleString());

        //totHarga
        var totHarga = document.getElementsByClassName('totHarga');
        var totalH = 0;

        for (var i = 0; i < totHarga.length; i++) {
            var elementH = document.getElementsByClassName('totHarga')[i];
            var jumlahH = elementH.textContent;
            var jjumlahH = parseFloat(jumlahH.replace(/,/g, ''));
            totalH += jjumlahH;
        }
        $("#nilai4").html(totalH.toLocaleString());
    }
</script>
<?= $this->endSection('isi') ?>