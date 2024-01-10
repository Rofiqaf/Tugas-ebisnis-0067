<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Pengelolaan Data Produk
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-primary" onclick="location.href=('/produk/tambah')">
<i class="fa fa-plus-circle"> Tambah Data</i>
</button>


<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>

<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<table class="table table-striped table-bordered" style="width:100%;font-size:12px;">
    <thead>
        <tr style="text-align:center">
            <th>No</th>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Harga Beli/Kg</th>
            <th>Harga Jual/Kg</th>
            <th>Stok Kg</th>
            <th>Stok Ekor</th>
            <th>Aksi</th>
        </tr>
    </thead>


<tbody>
    <?php
    $nomor = 1;
    foreach ($tampildata as $row) :
    ?>

        <tr>
            <td style="text-align:center"><?= $nomor++; ?></td>
            <td><?= $row['kode_produk']; ?></td>
            <td><?= $row['nama_produk']; ?></td>
            <td>Rp. <?= number_format($row['harga_beliperkg'],0,",","."); ?></td>
            <td>Rp. <?= number_format($row['harga_jualperkg'],0,",","."); ?></td>
            <td><?= number_format($row['stok_perkg'],2); ?></td>
            <td><?= number_format($row['stok_perekor'], 0); ?></td>
            <td style="text-align:center">
            <button type="button" class="btn btn-sm btn-warning" style="margin:3%" onclick="edit('<?= $row['kode_produk'] ?>')"><i class="fa fa-edit"></i>
        </button>

        <form method="POST" action="/produk/hapus/<?= $row['kode_produk'] ?>" style="display:inline;" onsubmit=" return hapus();">
                <input type="hidden" value="DELETE" name="_method">

                <button type="submit" class="btn btn-sm btn-danger" style="margin:3%" title="Hapus Data " onclick="hapus('<?= $row['kode_produk']?>')">
                    <i class="fa fa-trash-alt"></i>
                </button>
            </form>
            </td>
        </tr>

    <?php endforeach; ?>
</tbody>
</table>

<script>
    function edit(kode)
    {
        window.location.href = ('/produk/edit/' +kode);  
    }

    function hapus() {
        pesan = confirm('Yakin data Produk ini akan dihapus ?');

        if(pesan){
        return true;
        }else{
        return false;
        }
    }
</script>

<?= $this->endSection('isi') ?>