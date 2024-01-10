<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
LAPORAN PENJUALAN
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/penjualan/laporan')">
    <i class="fa fa-backward"> Kembali</i>
</button>
<button type="button" class="btn btn-sm btn-info" onclick="cetak()">
    <i class="fa fa-print"> Cetak</i>
</button>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>
<style>
    @media print {
        .no-print {
            display: none;
        }
    }

    
</style>
<div class="no-print" style="padding:10px">
    <input class="form-control" style="margin:5px auto" type="text" id="filterProduct" placeholder="Ketik untuk Filter Produk">
    <input class="form-control" style="margin:5px auto" type="text" id="filterCustomer" placeholder="Ketik untuk Filter Pelanggan">
    <input class="form-control" style="margin:5px auto" type="text" id="filterStatus" placeholder="Ketik untuk Filter Status Pembayaran">
</div>

<div id="laporan" style="margin:10px;padding:10px;border:2px solid lightgray;overflow: auto;">
    
    <div style="padding-left: 20%; margin-top: 10px; margin-bottom: -25px;">
        <img src="<?= base_url() ?>/dist/img/logo-ayam.png" class="img-circle elevation-2" style="width: 100px; height: 100px;" alt="Logo Perusahaan">
        </div>
        <h2 style="text-align:center; font-weight: bold; font-size: 30pt;" >UD. SAWUNG WHITE</h2>
        <h3 style="text-align:center; font-weight: bold; font-size: 20pt;" >LAPORAN PENJUALAN</h3>
        <h3 style="text-align:center; font-weight: bold; font-size: 18pt; padding:0px 0px 10px 0px;">Periode: <?= date('d-m-Y', strtotime($awal)); ?> - <?= date('d-m-Y', strtotime($akhir)); ?> </h3>
    <div style="background:black;height:2px;width:100%"></div>

    <table id="dataPenjualan" class="table table-striped table-bordered" style="width:100%;font-size:12px;">
        <thead>
            <tr style="text-align:center;">
                <th style="vertical-align:middle">No</th>
                <th style="vertical-align:middle">No. Nota</th>
                <th style="vertical-align:middle">Tanggal</th>
                <th style="vertical-align:middle">Pelanggan</th>
                <th style="vertical-align:middle">Produk</th>
                <th style="vertical-align:middle">Ekor</th>
                <th style="vertical-align:middle">Kg</th>
                <th style="vertical-align:middle">Harga</th>
                <th style="vertical-align:middle">Total Harga</th>
                <!-- <th style="vertical-align:middle; display: none;">Dibayar</th> -->
                <th style="vertical-align:middle">Kurang Bayar</th>
                <th style="vertical-align:middle">Status Lunas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            array_multisort(array_column($hasil_query, 'tanggal_penjualan'), SORT_ASC, $hasil_query);

            $nomorUrut = 1;
            foreach ($hasil_query as $row) : ?>
                <tr id="<?= $row['kode_penjualan']; ?>" class="barisData">
                    <td style="text-align:center;"><?= $nomorUrut; ?></td>
                    <td style="text-align:center;"><?= $row['kode_penjualan']; ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal_penjualan'])); ?></td>
                    <td><?= $row['customer']; ?></td>
                    <td><?= $row['produk']; ?></td>
                    <td class="ekor" style="text-align:right"><?= number_format($row['ekor']); ?></td>
                    <td class="kg" style="text-align:right"><?= number_format($row['kg'],2); ?></td>
                    <td style="text-align:right"><?= number_format($row['harga']); ?></td>
                    <td class="totHarga" style="text-align:right"><?= number_format($row['totalHarga']); ?></td>
                    <!-- <td class="bayar" style="text-align:right; display: none;">
                    <?= number_format($row['bayar']) ?>
                </td> -->
                    <td class="kembalian" style="text-align:right">
                        <?php
                        $kr = $row['kembalian'];
                        if ($kr < 0) {
                            echo number_format($kr);
                        } else {
                            echo "0";
                        }
                        ?>
                    </td>
                    <td style="text-align:center"><?= $row['status']; ?></td>
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
            <p style="text-align: center;"> Admin Penjualan</p>
            <br />
            <br />
            <p style="text-align: center;">(.......................)</p>
        </div>
    </div>
</div>
<script>
    function cetak() {
        $('.card-header').hide();
        $('.main-footer').hide();
        $('#laporan').css('border', '0px solid lightgray');
        $('.content').css('background', 'white');
        window.print();
    }
    window.onafterprint = function() {
        $('.card-header').show();
        $('.main-footer').show();
        $('#laporan').css('border', '2px solid lightgray');
        $('.content').css('background', '#f4f6f9');

    };

    function applyFilter() {
        var filterProduct = document.getElementById('filterProduct').value.toUpperCase();
        var filterCustomer = document.getElementById('filterCustomer').value.toUpperCase();
        var filterStatus = document.getElementById('filterStatus').value.toUpperCase();
        var table = document.getElementById('dataPenjualan');
        var rows = table.getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');
            var showRow = true;

            if (cells.length >= 2) { // Pastikan baris memiliki cukup sel untuk di-filter
                var product = cells[4].innerText.toUpperCase();
                var customer = cells[3].innerText.toUpperCase();
                var status = cells[10].innerText.toUpperCase();

                if (product.indexOf(filterProduct) === -1 || customer.indexOf(filterCustomer) === -1 || status.indexOf(filterStatus) === -1) {
                    showRow = false;
                }
            }

            // Menampilkan atau menyembunyikan baris berdasarkan filter
            rows[i].style.display = showRow ? '' : 'none';
        }
    }

    // Menambahkan event listener untuk setiap input
    document.getElementById('filterProduct').addEventListener('input', applyFilter);
    document.getElementById('filterCustomer').addEventListener('input', applyFilter);
    document.getElementById('filterStatus').addEventListener('input', applyFilter);

    document.addEventListener("DOMContentLoaded", () => {
        var tabelProduk = document.getElementById('dataPenjualan').getElementsByTagName('tbody')[0];
        var newRow = tabelProduk.insertRow();
        var newCellMerged = newRow.insertCell(0);
        newCellMerged.colSpan = 5;
        newCellMerged.textContent = 'Total';
        newCellMerged.style.fontWeight = 'bold';
        newCellMerged.style.textAlign = 'right';
        for (var i = 1; i <= 6; i++) {
            var newCell = newRow.insertCell(i);
            newCell.id = 'nilai' + i;
            newCell.style.fontWeight = 'bold';
            newCell.style.textAlign = 'right';
        }
        jumlah();
    });

    function jumlah() {
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


        //bayar
        // var bayare = document.getElementsByClassName('bayar');
        // var totalbayare = 0;

        // for (var i = 0; i < bayare.length; i++) {
        //     var elementB = document.getElementsByClassName('bayar')[i];
        //     var jumlahB = elementB.textContent;
        //     var jjumlahB = parseInt(jumlahB.replace(/,/g, ''));
        //     totalbayare += jjumlahB;
        // }
        // $("#nilai5").html(totalbayare.toLocaleString());

        //kembalian
        var kembaliane = document.getElementsByClassName('kembalian');
        var totalKembalian = 0;

        for (var i = 0; i < kembaliane.length; i++) {
            var element = document.getElementsByClassName('kembalian')[i];
            var jumlah = element.textContent;
            var jjumlah = parseFloat(jumlah.replace(/,/g, ''));
            totalKembalian += jjumlah;
        }
        $("#nilai5").html(totalKembalian.toLocaleString());
    }
</script>
<?= $this->endSection('isi') ?>