<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Pengelolaan Data Transaksi Pembelian
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-primary" onclick="location.href=('/pembelian/tambah')">
    <i class="fa fa-plus-circle"></i> Tambah Data
</button>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>

<div class="input-group mb-3" style="display:none">
    <input id="cari" type="text" class="form-control" placeholder="Cari Data Transaksi Pembelian" name="cari" autofocus onkeyup="cariData()">
    <div class="input-group-append">
        <button class="btn btn-outline-success" type="submit" name="tombolcari"><i class="fa fa-search"></i></button>
    </div>
</div>

<span class="badge badge-success" style="padding:10px;font-size:14px;margin:10px auto">
    <?= "Total Data Pembelian : $totaldata"; ?>
</span>
<style>
    #dataPembelian td,
    #dataPembelian th {
        padding: .5rem;
    }

    #dataPembelian_filter input {
        width: 100%;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 10px;
        margin: 10px auto;
    }

    #dataPembelian_length {
        text-align: right
    }

    #dataPembelian_paginate {
        margin-top: 20px
    }

    #dataPembelian_paginate a {
        padding: 7px;
        border: 1px solid #dee2e6;
        margin: 2px;
    }
</style>

<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>

<table id="dataPembelian" class="table table-striped table-bordered" style="width:100%;font-size:12px;">
    <thead>
        <tr style="text-align:center;">
            <th>No</th>
            <th>Kode Pembelian</th>
            <th>Tanggal Pembelian</th>
            <th>Nama Suplier</th>
            <th>Produk</th>
            <th>Jml Ekor</th>
            <th>Jml Kg</th>
            <th>Total Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        array_multisort(array_column($pembelian, 'kode_pembelian'), SORT_ASC, $pembelian);

        $nomorUrut = 1;
        foreach ($pembelian as $pembelian) : ?>
            <tr id="<?= $pembelian['kode_pembelian']; ?>" class="barisData">
                <td style="text-align:center;"><?= $nomorUrut; ?></td>
                <td style="text-align:center;"><?= $pembelian['kode_pembelian']; ?></td>
                <td><?= date('d-m-Y', strtotime($pembelian['tanggal_pembelian'])); ?></td>
                <td><?= $pembelian['supplier']; ?></td>
                <td><?= $pembelian['produk_dibeli']; ?></td>
                <td><?= $pembelian['jml_ekor']; ?></td>
                <td><?= number_format($pembelian['jml_kg'],2); ?></td>
                <td style="text-align:right;">Rp. <?= number_format($pembelian['harga_total'],0,",","."); ?></td>
            
                <td style="text-align:center;">
                    <span class="badge badge-success" title="Detail Data" style="padding:8px;margin:1px 3px;cursor:pointer; font-size:larger" onclick="detail('<?= $pembelian['kode_pembelian']; ?>')"><i class="fa fa-info-circle"></i></span>

                    <span class="badge badge-warning" title="Edit Data" style="padding:8px;margin:1px 3px;cursor:pointer; font-size:larger" onclick="edit('<?= $pembelian['kode_pembelian']; ?>')"><i class="fa fa-edit"></i></span>

                    <span class="badge badge-danger" title="Edit Data" style="padding:8px;margin:1px 3px;cursor:pointer; font-size:larger" onclick="hapus('<?= $pembelian['kode_pembelian']; ?>')"><i class="fa fa-trash-alt"></i></span>
            </tr>
        <?php
            $nomorUrut++;
        endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataPembelian').DataTable();
        //$('#dataPembelian_filter').hide();
        $('#dataPembelian_filter label input[type="search"]').unwrap();
        $('#dataPembelian_filter').contents().filter(function() {
            return this.nodeType === 3; // Memeriksa node berupa teks
        }).remove();
        $('#dataPembelian_filter input[type="search"]').attr('placeholder', 'Cari Data Transaksi Pembelian');
        setTimeout(function() {
            $('.close').click();
        }, 3000);
    });

    function cariData() {
        let yangdicari = $("#cari").val().toLowerCase();
        if (yangdicari === "") {
            $(".barisData").show();
        } else {
            $(".barisData").hide();

            // Menampilkan baris yang mengandung huruf atau kata yang dicari
            $(".barisData").filter(function() {
                return $(this).text().toLowerCase().includes(yangdicari);
            }).show();
        }
    }

    function hapus(kode) {
        pesan = confirm('Yakin data transaksi ini akan dihapus ?');
        if (pesan) {
            window.location.href = ('/pembelian/hapus/' + kode);
        }
    }

    function detail(kode) {
        window.location.href = ('/pembelian/detail/' + kode);
    }

    function edit(kode) {
        window.location.href = ('/pembelian/edit/' + kode);
    }
</script>
<?= $this->endSection('isi') ?>