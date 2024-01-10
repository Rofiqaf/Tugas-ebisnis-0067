<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Tambah Data Transaksi Pembelian
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-danger" onclick="localStorage.setItem('dataBeli',0);location.href=('/pembelian/index')">
    Batal Tambah
</button>
<button style="display:none" type="button" class="btn btn-sm btn-success" onclick="document.getElementById('tbTambahPembelian').click()">
    Simpan
</button>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>

<?= form_open('pembelian/simpandata', ['enctype' => 'multipart/form-data']); ?>

<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>

<div id="bagian1" style="display:none">
    <div class="col-sm-12" style="margin:1% auto">
        <label for="beli_kode" class="col-sm-12 col-form-label">Kode Pembelian</label>
        <input type="text" class="form-control" id="beli_kode" name="beli_kode" autofocus placeholder="Masukkan Kode Pembelian">
    </div>

    <div class="col-sm-12" style="margin:1% auto">
        <label for="beli_tanggal" class="col-sm-12 col-form-label">Tanggal Pembelian</label>
        <input type="date" class="form-control" id="beli_tanggal" name="beli_tanggal" laceholder="Masukkan Tanggal Pembelian">
    </div>

    <div class="col-sm-12">
        <label for="beli_supplier" class="col-sm-12 col-form-label">Pilih Supplier</label>
        <select class="form-control" id="beli_supplier" name="beli_supplier">
        <option value="" disabled selected>== Pilih Supplier ==</option>
            <?php foreach ($supplier as $indexs => $supplier) : ?>
                <option value="<?= $supplier['nama_supplier']?>"><?= $supplier['nama_supplier']?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-sm-12">
        <label for="beli_produk" class="col-sm-12 col-form-label">Pilih Produk</label>
        <select class="form-control" id="beli_produk" name="beli_produk">
        <option value="" disabled selected>== Pilih Produk ==</option>
            <?php foreach ($produk as $indexs => $produk) : ?>
                <option value="<?= $produk['kode_produk']?>#<?= $produk['nama_produk']?>"><?= $produk['nama_produk']?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <hr/>
    <div style="text-align:right;margin-top:20px;">
        <button type="button" class="btn btn-sm btn-success" onclick="keBag2()">Selanjutnya</button>
    </div>
</div>

<div id="bagian2" style="display:none">
    <h5>Data Timbangan</h5>
    <div style="margin:15px auto;">
    <div id="inputContainer"></div>

    <span class="btn btn-sm btn-info" onclick="tambahTimbangan()">Tambah Timbangan</span>
    <span class="btn btn-sm btn-secondary" onclick="hapusTimbangan()">Hapus Timbangan</span>

    <input type="text" class="form-control" id="beli_detail_ekor" name="beli_detail_ekor" placeholder="Jumlah Ekor" style="display:none">
    <input type="text" class="form-control" id="beli_detail_kg" name="beli_detail_kg" placeholder="Jumlah Kg" style="display:none">
    <hr/>

    </div>
    <div style="text-align:left;margin-top:20px;width:50%;float:left">
        <button type="button" class="btn btn-sm btn-warning" onclick="$('#bagian1').show();$('#bagian2').hide()">Sebelumnya</button>
    </div>
    <div style="text-align:right;margin-top:20px;width:50%;float:right">
        <button type="button" class="btn btn-sm btn-success" onclick="keBag3()">Selanjutnya</button>
    </div>
</div>

<div id="bagian3" style="display:none">
    <div class="col-sm-12">
        <label for="beli_ekor" class="col-sm-12 col-form-label">Jumlah Ekor</label>
        <input type="number" class="form-control" id="beli_ekor" name="beli_ekor" placeholder="Jumlah Ekor" readonly="true">
    </div>

    <div class="col-sm-12">
        <label for="beli_kg" class="col-sm-12 col-form-label">Jumlah Kg</label>
        <input type="text" class="form-control" id="beli_kg" name="beli_kg" placeholder="Jumlah Kilo" readonly="true">
    </div>
    
    <div class="col-sm-12">
        <label for="beli_harga" class="col-sm-12 col-form-label">Harga Beli per kg</label>
        <input type="number" class="form-control" id="beli_harga" name="beli_harga" placeholder="Harga/kg" onkeyup="hitungTotal()">
    </div>

    <div class="col-sm-12">
        <label for="beli_harga" class="col-sm-12 col-form-label">Harga Jual per kg</label>
        <input type="number" class="form-control" id="beli_hargaJual" name="beli_hargaJual" placeholder="Harga/kg">
    </div>

    <div class="col-sm-12">
        <label for="beli_totalHarga" class="col-sm-12 col-form-label">Total Harga Beli</label>
        <input type="number" class="form-control" id="beli_totalHarga" name="beli_totalHarga" placeholder="Total Harga" readonly="true">
    </div>

    <div class="col-sm-12">
        <label for="beli_bukti" class="col-sm-12 col-form-label">Bukti Pembelian</label>
        <input type="file" accept="image/jpeg, image/png" class="form-control" id="beli_bukti" name="beli_bukti" placeholder="Pilih Bukti">
    </div>
    
    <hr/>
    <div style="text-align:left;margin-top:20px;width:50%;float:left">
        <button type="button" class="btn btn-sm btn-warning" onclick="$('#bagian2').show();$('#bagian3').hide()">Sebelumnya</button>
    </div>
    <div style="text-align:right;margin-top:20px;width:50%;float:right">
        <input id="tbTambahPembelian" type="submit" value="Simpan Data" class="btn btn-sm btn-success">
    </div>
</div>

<?= form_close(); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('beli_tanggal').value = makeFormDate();
            if(localStorage.getItem("dataBeli")=="1"){
                loadData();
            }else{
                localStorage.clear();
            }
            $("#bagian1").show();

            // menambah timbangan
            jumlahTimbangan = localStorage.getItem("jumlahTimbangan");
			if(jumlahTimbangan > 0){
                if(localStorage.getItem("dataBeli")=="1"){
				    tambahInputTersimpan(jumlahTimbangan);
                    loadDataTimbangan();
                }else{
                    localStorage.setItem("jumlahTimbangan",0);
                }
			}else{
				localStorage.setItem("jumlahTimbangan",0);
			}
        }, false);

        function tambahInput() {
            var jumlahTimbangan = localStorage.getItem("jumlahTimbangan");
            var counter = parseInt(jumlahTimbangan) + 1;
            var label = "Timbangan " + counter + " ";
            var inputKg = $('<input>', {
                type: 'text',
                id: 'kg' + counter,
                placeholder: 'Kg'
            });

            var inputEk = $('<input>', {
                type: 'number',
                id: 'ek' + counter,
                placeholder: 'Ekor'
            });
            inputKg.add(inputEk).css('margin', '3px');
            inputKg.add(inputEk).css('padding', '5px');
            inputKg.add(inputEk).css('width', '20%');
            inputKg.add(inputEk).css('text-align', 'right');

            $('#inputContainer').append("<div id='timbangan"+counter+"' style='margin:10px auto;'></div>");
            $('#timbangan'+counter).append(label).append(" | Ekor: ").append(inputEk).append(" Kg: ").append(inputKg);
            
            localStorage.setItem("jumlahTimbangan",counter);
            
        }
        function tambahInputTersimpan(jml){
            jml = parseInt(jml) + 1;
            for (let i = 1; i < jml; i++) {
                var counter = i;
                var label = "Timbangan " + counter + " ";
                var inputKg = $('<input>', {
                    type: 'text',
                    id: 'kg' + counter,
                    placeholder: 'Kg'
                });

                var inputEk = $('<input>', {
                    type: 'number',
                    id: 'ek' + counter,
                    placeholder: 'Ekor'
                });
                inputKg.add(inputEk).css('margin', '3px');
                inputKg.add(inputEk).css('padding', '5px');
                inputKg.add(inputEk).css('width', '15%');
                inputKg.add(inputEk).css('text-align', 'right');

                $('#inputContainer').append("<div id='timbangan"+counter+"' style='margin:10px auto;'></div>");
                $('#timbangan'+counter).append(label).append(" | Ekor: ").append(inputEk).append(" Kg: ").append(inputKg);
            } 
        }
        function tambahTimbangan() {
            //simpan data timbangan sebelumnya
            jumlahTimbangan = localStorage.getItem("jumlahTimbangan");
            jml = parseInt(jumlahTimbangan) + 1;

            if(jumlahTimbangan > 0){
                for (let i = 1; i < jml; i++) {
                    if($("#ek"+i).val() == "" || $("#ek"+i).val() == 0 || $("#kg"+i).val() == "" || $("#kg"+i).val() == 0){
                        nole = "yes";
                    }else{
                        nole = "no";
                        localStorage.setItem("ek"+i,$("#ek"+i).val());
                        localStorage.setItem("kg"+i,$("#kg"+i).val());
                    }
                }
            }else{
                nole = "no";
            }
            
            if(nole == "no"){
                tambahInput();
            }else{
                alert("isi timbangan dulu sebelum menambah yang lain!")
            }
            
        }
        function hapusTimbangan() {
            jumlahTimbangan = localStorage.getItem("jumlahTimbangan");
            if(jumlahTimbangan > 0){
                jumlahTimbanganBaru = parseInt(jumlahTimbangan) - 1;
                $('#timbangan'+jumlahTimbangan).remove();
                localStorage.removeItem("ek"+jumlahTimbangan);
                localStorage.removeItem("kg"+jumlahTimbangan);
                localStorage.setItem("jumlahTimbangan",jumlahTimbanganBaru);
            }else{
                alert("Tidak ada data timbangan");
            }
        }

        function makeFormDate(dateInstance){
            var dt = dateInstance instanceof Date ? dateInstance : new Date;
            return dt.getFullYear()+'-'+(dt.getMonth()+1).toString().replace(/^(\d)$/, '0$1')+'-'+dt.getDate().toString().replace(/^(\d)$/, '0$1');
        }

        function loadData(){
            $("#beli_kode").val(localStorage.getItem("beli_kode"));
            $("#beli_tanggal").val(localStorage.getItem("beli_tanggal"));
            $("#beli_supplier").val(localStorage.getItem("beli_supplier"));
            $("#beli_produk").val(localStorage.getItem("beli_produk"));
        }
        function loadDataTimbangan(){
            jumlahTimbangan = localStorage.getItem("jumlahTimbangan");
            jml = parseInt(jumlahTimbangan) + 1;
            for (let i = 1; i < jml; i++) {
                $("#ek"+i).val(localStorage.getItem("ek"+i));
                $("#kg"+i).val(localStorage.getItem("kg"+i));
            }
        }
        function keBag2(){
            d1 = $("#beli_kode").val();
            d2 = $("#beli_tanggal").val();
            d3 = $("#beli_supplier").val();
            d4 = $("#beli_produk").val();
            $("#beli_detail_ekor").val("");
            $("#beli_detail_kg").val("");

            if(d1 == "" || d2 == "" || d3 == "" || d3 == null || d4 == "" || d4 == null){
                alert("lengkapi data terlebih dahulu");
            }else{
                // simpan ke localstorage
                localStorage.setItem("dataBeli","1");
                localStorage.setItem("beli_kode",d1);
                localStorage.setItem("beli_tanggal",d2);
                localStorage.setItem("beli_supplier",d3);
                localStorage.setItem("beli_produk",d4);
                $('#bagian1').hide();$('#bagian2').show();
            }   
        }
        function keBag3(){
            jumlahTimbangan = localStorage.getItem("jumlahTimbangan");
            jml = parseInt(jumlahTimbangan) + 1;
            jmlEk = 0;
            jmlKg = 0;
            nolee = "no";
            $("#beli_detail_ekor").val("");
            $("#beli_detail_kg").val("");

            for (let i = 1; i < jml; i++) {
                
                if($("#ek"+i).val() != ""){
                    ek = $("#ek"+i).val();
                }else{
                    ek = 0;
                }

                if($("#kg"+i).val() != ""){
                    kg = $("#kg"+i).val();
                }else{
                    kg = 0;
                }
                
                if(ek == 0 || kg == 0){
                    nolee = "yes";
                }else{
                    localStorage.setItem("ek"+i,ek);
                    localStorage.setItem("kg"+i,kg);
                    
                    jmlEk = parseInt(jmlEk) + parseInt(ek);
                    jmlKg = parseFloat(jmlKg) + parseFloat(kg);

                    dataEk = $("#beli_detail_ekor").val() + "#" + localStorage.getItem("ek"+i);
                    $("#beli_detail_ekor").val(dataEk);
                    dataKg = $("#beli_detail_kg").val() + "#" + localStorage.getItem("kg"+i);
                    $("#beli_detail_kg").val(dataKg);
                }
            }

            // menjumlah otomatis
            if(nolee=="yes"){
                alert("Timbangan tidak boleh nol! Isi dengan benar!")
            }else{
                $("#beli_ekor").val(jmlEk);
                $("#beli_kg").val(jmlKg);
                $("#beli_detail_ekor").val(dataEk);
                $("#beli_detail_kg").val(dataKg);
                $('#bagian2').hide();$('#bagian3').show();
            }
        }
        function hitungTotal(){
            kilo = $("#beli_kg").val();
            hrg = $("#beli_harga").val();
            totalHarga = parseFloat(kilo) * parseFloat(hrg);
            $("#beli_totalHarga").val(totalHarga);
        }
    </script>
<?= $this->endSection('isi') ?>