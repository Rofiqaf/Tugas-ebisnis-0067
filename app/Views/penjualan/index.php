<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Pengelolaan Data Transaksi Penjualan
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-primary" onclick="location.href=('/penjualan/tambah')">
<i class="fa fa-plus-circle"></i> Tambah Data
</button>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>

<div class="input-group mb-3" style="display:none">
    <input id="cari" type="text" class="form-control" placeholder="Cari Data Transaksi Penjualan" name="cari" autofocus onkeyup="cariData()">
<div class="input-group-append">
    <button class="btn btn-outline-success" type="submit" name="tombolcari"><i class="fa fa-search"></i></button>
</div>
</div>

<span class="badge badge-success" style="padding:10px;font-size:14px;margin:10px auto">
        <?= "Total Data Penjualan : $totaldata"; ?>
</span>
<style>
    #dataPenjualan td, #dataPenjualan th {padding: .5rem;}
    #dataPenjualan_filter input{
        width:100%;
        border: 1px solid #dee2e6;
        border-radius:5px;
        padding:10px;
        margin:10px auto;
    }
    #dataPenjualan_length{text-align:right}
    #dataPenjualan_paginate{margin-top:20px}
    #dataPenjualan_paginate a{
        padding: 7px;
        border: 1px solid #dee2e6;
        margin: 2px;
    }
</style>

<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>

<table id="dataPenjualan" class="table table-striped table-bordered" style="width:100%;font-size:12px;">
    <thead>
        <tr style="text-align:center;">
            <th style="vertical-align:middle">No</th>
            <th style="vertical-align:middle">No. Nota</th>
            <th style="vertical-align:middle">Tanggal Penjualan</th>
            <th style="vertical-align:middle">Nama Pelanggan</th>
            <th style="vertical-align:middle">Produk</th>
            <th style="vertical-align:middle">Ekor</th>
            <th style="vertical-align:middle">Kg</th>
            <th style="vertical-align:middle">Total Harga</th>
            <th style="vertical-align:middle">Status Lunas</th>
            <th style="vertical-align:middle">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        array_multisort(array_column($penjualan, 'kode_penjualan'), SORT_ASC, $penjualan);

        $nomorUrut = 1;
        foreach ($penjualan as $penjualan) : ?>
            <tr id="<?= $penjualan['kode_penjualan']; ?>" class="barisData">
                <td style="text-align:center;"><?= $nomorUrut; ?></td>
                <td style="text-align:center;"><?= $penjualan['kode_penjualan']; ?></td>
                <td><?= date('d-m-Y', strtotime($penjualan['tanggal_penjualan'])); ?></td>
                <td><?= $penjualan['customer']; ?></td>
                <td><?= $penjualan['produk']; ?></td>
                <td style="text-align:right;"><?= $penjualan['ekor']; ?></td>
                <td style="text-align:right;"><?= number_format($penjualan['kg'],2); ?></td>
                <td style="text-align:right;"><?= "Rp.".number_format($penjualan['totalHarga'],0,",","."); ?></td>
                <td style="text-align:center;"><?= $penjualan['status']; ?></td>
                <td style="text-align:center;">
                    <span class="badge badge-success" style="padding:8px;margin:1px 3px;cursor:pointer;font-size:larger" onclick="detail('<?= $penjualan['kode_penjualan']; ?>')">
                    <i class="fa fa-info-circle"></i></span>

                    <span class="badge badge-success" style="padding:8px;margin:1px 3px;cursor:pointer;font-size:larger" onclick="nota('<?= $penjualan['kode_penjualan']; ?>')">
                    <i class="fa fa-print"></i>
                    </span>
                    
                    <span class="badge badge-warning" style="padding:8px;margin:1px 3px;cursor:pointer;font-size:larger;" onclick="edit('<?= $penjualan['kode_penjualan']; ?>')">
                    <i class="fa fa-edit"></i></span>                    
                    
                    <span class="badge badge-danger" style="padding:8px;margin:1px 3px;cursor:pointer;font-size:larger" onclick="hapus('<?= $penjualan['kode_penjualan']; ?>')"><i class="fa fa-trash-alt"></i></span>
                </td>
            </tr>
        <?php 
        $nomorUrut++;
        endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataPenjualan').DataTable();
        //$('#dataPenjualan_filter').hide();
        $('#dataPenjualan_filter label input[type="search"]').unwrap();
        $('#dataPenjualan_filter').contents().filter(function() {
            return this.nodeType === 3; // Memeriksa node berupa teks
        }).remove();
        $('#dataPenjualan_filter input[type="search"]').attr('placeholder', 'Cari Data Transaksi Penjualan');
        setTimeout(function() {
            $('.close').click();
        }, 3000);
    });
    function cariData(){
        let yangdicari = $("#cari").val().toLowerCase();
        if(yangdicari===""){
            $(".barisData").show();
        }else{
            $(".barisData").hide();

            // Menampilkan baris yang mengandung huruf atau kata yang dicari
            $(".barisData").filter(function() {
                return $(this).text().toLowerCase().includes(yangdicari);
            }).show();
        }
    }

    function hapus(kode) {
        pesan = confirm('Yakin data transaksi ini akan dihapus ?');
        if(pesan){
            window.location.href = ('/penjualan/hapus/'+kode);
        }
    }
    function detail(kode) {
        window.location.href = ('/penjualan/detail/'+kode);
    }
    function edit(kode) {
        window.location.href = ('/penjualan/edit/'+kode);
    }
    function nota(kode) {
        window.location.href = ('/penjualan/nota/'+kode);
    }
</script>
<?= $this->endSection('isi') ?>