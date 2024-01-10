<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Pengelolaan Data User
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-primary" onclick="location.href=('/user/tambah')">
<i class="fa fa-plus-circle"></i> Tambah Data
</button>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>

<span class="badge badge-success" style="padding:10px;font-size:14px;margin:10px auto">
        <?= "Total User : $totaldata"; ?>
</span>
<style>
    #dataUser td, #dataUser th {padding: .5rem;}
    #dataUser_filter input{
        width:100%;
        border: 1px solid #dee2e6;
        border-radius:5px;
        padding:10px;
        margin:10px auto;
    }
    #dataUser_length{text-align:right}
    #dataUser_paginate{margin-top:20px}
    #dataUser_paginate a{
        padding: 7px;
        border: 1px solid #dee2e6;
        margin: 2px;
    }
</style>

<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>

<table id="dataUser" class="table table-striped table-bordered" style="width:100%;font-size:12px;">
    <thead>
        <tr style="text-align:center;">
            <th>No</th>
            <th>Username</th>
            <th>Password</th>
            <th>Nama</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        array_multisort(array_column($datauser, 'kode_user'), SORT_ASC, $datauser);

        $nomorUrut = 1;
        foreach ($datauser as $datauser) : ?>
            <tr id="<?= $datauser['kode_user']; ?>" class="barisData">
                <td style="text-align:center;"><?= $nomorUrut; ?></td>
                <td><?= $datauser['username']; ?></td>
                <td><?= $datauser['password']; ?></td>
                <td><?= $datauser['nama']; ?></td>
                <td><?= $datauser['level']; ?></td>
                <td style="text-align:center;">
                    <span class="badge badge-warning" title="Edit Data" style="padding:10px;margin:1px 3px;cursor:pointer;font-size:larger;" onclick="edit('<?= $datauser['kode_user']; ?>')"><i class="fa fa-edit"></i></span>
                
                    <span class="badge badge-danger" title="Hapus Data" style="padding:10px;margin:1px 3px;cursor:pointer;font-size:12px" onclick="hapus('<?= $datauser['kode_user']; ?>')"><i class="fa fa-trash-alt"></i></span>
                </td>
            </tr>
        <?php 
        $nomorUrut++;
        endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataUser').DataTable();
        //$('#dataUser_filter').hide();
        $('#dataUser_filter label input[type="search"]').unwrap();
        $('#dataUser_filter').contents().filter(function() {
            return this.nodeType === 3; // Memeriksa node berupa teks
        }).remove();
        $('#dataUser_filter input[type="search"]').attr('placeholder', 'Cari Pengguna');
        setTimeout(function() {
            $('.close').click();
        }, 3000);
    });

    function hapus(kode) {
        pesan = confirm('Yakin data transaksi ini akan dihapus ?');
        if(pesan){
            window.location.href = ('/user/hapus/'+kode);
        }
    }

    function edit(kode) {
        window.location.href = ('/user/edit/'+kode);
    }
</script>
<?= $this->endSection('isi') ?>