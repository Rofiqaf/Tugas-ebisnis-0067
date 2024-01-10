<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Tambah Transaksi Penjualan
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-danger" onclick="localStorage.setItem('dataJual',0);location.href=('/penjualan/index')">
    Batal Tambah
</button>
<button style="display:none" type="button" class="btn btn-sm btn-success" onclick="document.getElementById('tbTambahPenjualan').click()">
    Simpan
</button>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>

<pre id="dataProduk" style="display:none">
    <?php echo json_encode($json_data, JSON_PRETTY_PRINT); ?>
</pre>

<?= form_open('penjualan/simpandata', ['enctype' => 'multipart/form-data']); ?>

<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>

<div id="bagian1" style="display:none">
    <div class="col-sm-12" style="margin:1% auto">
        <label for="jual_kode" class="col-sm-12 col-form-label">No. Nota</label>
        <input type="text" class="form-control" id="jual_kode" name="jual_kode" readonly placeholder="Masukkan No. Nota">
    </div>
    <input type="number" id="no_perbulan" name="no_perbulan" style="display:none" value="<?= $maxNoPerbulan; ?>">
    <input type="number" id="no_perbulanOK" name="no_perbulanOK" style="display:none" value="">
    <input type="number" id="bulan" name="bulan" style="display:none" value="">
    
    <div class="col-sm-12" style="margin:1% auto">
        <label for="jual_tanggal" class="col-sm-12 col-form-label">Tanggal Penjualan</label>
        <input type="date" class="form-control" id="jual_tanggal" name="jual_tanggal" laceholder="Masukkan Tanggal Penjualan" autofocus>
    </div>

    <div class="col-sm-12">
        <label for="jual_customer" class="col-sm-12 col-form-label">Nama Pelanggan</label>
        <input type="text" class="form-control" id="jual_customer" name="jual_customer" placeholder="Masukkan Nama Pelanggan">
    </div>

    <div class="col-sm-12">
        <label for="jual_produk" class="col-sm-12 col-form-label">Pilih Produk</label>
        <select class="form-control" id="jual_produk" name="jual_produk" onchange="pilihProduk()">
        <option value="" disabled selected>== Pilih Produk ==</option>
            <?php foreach ($produk as $indexs => $produk) : ?>
                <option value="<?= $produk['kode_produk']?>#<?= $produk['nama_produk']?>"><?= $produk['nama_produk']?></option>
            <?php endforeach; ?>
        </select>
        <div style="color:blue;font-style:italic">STOK: <span id="stokSekarang">Pilih produk dahulu</span></div>
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

    <input type="text" class="form-control" id="jual_detail_ekor" name="jual_detail_ekor" placeholder="Jumlah Ekor" style="display:none">
    <input type="text" class="form-control" id="jual_detail_kg" name="jual_detail_kg" placeholder="Jumlah Kg" style="display:none">

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
    <div style="display:none">
    <input type="number" class="form-control" id="stokEkAkhir" name="stokEkAkhir" placeholder="stokEkAkhir" readonly="true">
    <input type="number" class="form-control" id="stokKgAkhir" name="stokKgAkhir" placeholder="stokKgAkhir" readonly="true">
    </div>
    
    <div class="col-sm-12">
        <label for="jual_ekor" class="col-sm-12 col-form-label">Jumlah Ekor</label>
        <input type="number" class="form-control" id="jual_ekor" name="jual_ekor" placeholder="Jumlah Ekor" readonly="true">
        <div id="warningEk" style="color:red;font-style:italic"></div>
    </div>

    <div class="col-sm-12">
        <label for="jual_kg" class="col-sm-12 col-form-label">Jumlah Kilo</label>
        <input type="text" class="form-control" id="jual_kg" name="jual_kg" placeholder="Jumlah Kilo" readonly="true">
        <div id="warningKg" style="color:red;font-style:italic"></div>
    </div>
    
    <div class="col-sm-12">
        <label for="jual_harga" class="col-sm-12 col-form-label">Harga/kg</label>
        <input type="number" class="form-control" id="jual_harga" name="jual_harga" placeholder="Harga/kg" onkeyup="hitungTotal()">
    </div>

    <div class="col-sm-12">
        <label for="jual_totalHarga" class="col-sm-12 col-form-label">Total Harga</label>
        <input type="number" class="form-control" id="jual_totalHarga" name="jual_totalHarga" placeholder="Total Harga" readonly="true">
    </div>

    <div class="col-sm-12">
    <label for="jual_bayar" class="col-sm-12 col-form-label">Jumlah Bayar</label>
        <input type="number" class="form-control" id="jual_bayar" name="jual_bayar" placeholder="Bayar" onkeyup="hitungKembalian()">
    </div>

    <div class="col-sm-12">
        <div style="font-size:18px;padding:5px;margin:10px auto;">Kembalian: <span id="kembalian" name="kembalian"></span></div>
        <div style="font-size:18px;padding:5px;margin:10px auto;">Status: <span id="status" name="status"></span></div>
        
        <input style="display:none" type="text" class="form-control" id="jual_kembalian" name="jual_kembalian" placeholder="Status" readonly="true">
        <input style="display:none" type="text" class="form-control" id="jual_status" name="jual_status" placeholder="Status" readonly="true">
    </div>
    
    <hr/>
    <div style="text-align:left;margin-top:20px;width:50%;float:left">
        <button type="button" class="btn btn-sm btn-warning" onclick="$('#bagian2').show();$('#bagian3').hide()">Sebelumnya</button>
    </div>
    <div style="text-align:right;margin-top:20px;width:50%;float:right">
        <input style="display:none" id="tbTambahPenjualan" type="submit" value="Simpan Data" class="btn btn-sm btn-success" onclick="localStorage.setItem('dataJual',0)">
    </div>
</div>

<?= form_close(); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('jual_tanggal').value = makeFormDate();
            // ger bulan
            const currentDate = new Date();
            const bulan = currentDate.getMonth() + 1;
            const tahun = currentDate.getFullYear();
            noSkrg = $("#no_perbulan").val();
            $("#bulan").val(bulan);
            
            if(noSkrg < 0 || noSkrg == "" || noSkrg == null){
                noSkrgF = String(1).padStart(4, '0') + "/J-SW/"+bulan+"/"+tahun;
                $("#jual_kode").val(noSkrgF);
                $("#no_perbulanOK").val(1);
            }else{
                noSkrg = parseInt(noSkrg) + 1;
                noSkrgF = String(noSkrg).padStart(4, '0') + "/J-SW/"+bulan+"/"+tahun;
                $("#jual_kode").val(noSkrgF);
                $("#no_perbulanOK").val(noSkrg);
            }
            //$("#bulan").html(bulan);

            if(localStorage.getItem("dataJual")=="1"){
                loadData();
                pilihProduk();
            }else{
                localStorage.clear();
            }
            $("#bagian1").show();

            // menambah timbangan
            jumlahTimbangan = localStorage.getItem("jumlahTimbangan");
			if(jumlahTimbangan > 0){
                if(localStorage.getItem("dataJual")=="1"){
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
                id: 'jkg' + counter,
                placeholder: 'Kg'
            });

            var inputEk = $('<input>', {
                type: 'number',
                id: 'jek' + counter,
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
                    id: 'jkg' + counter,
                    placeholder: 'Kg'
                });

                var inputEk = $('<input>', {
                    type: 'number',
                    id: 'jek' + counter,
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
                    if($("#jek"+i).val() == "" || $("#jek"+i).val() == 0 || $("#jkg"+i).val() == "" || $("#jkg"+i).val() == 0){
                        nole = "yes";
                    }else{
                        nole = "no";
                        localStorage.setItem("jek"+i,$("#jek"+i).val());
                        localStorage.setItem("jkg"+i,$("#jkg"+i).val());
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
                localStorage.removeItem("jek"+jumlahTimbangan);
                localStorage.removeItem("jkg"+jumlahTimbangan);
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
            $("#jual_kode").val(localStorage.getItem("jual_kode"));
            $("#jual_tanggal").val(localStorage.getItem("jual_tanggal"));
            $("#jual_customer").val(localStorage.getItem("jual_customer"));
            $("#jual_produk").val(localStorage.getItem("jual_produk"));
        }
        function loadDataTimbangan(){
            jumlahTimbangan = localStorage.getItem("jumlahTimbangan");
            jml = parseInt(jumlahTimbangan) + 1;
            for (let i = 1; i < jml; i++) {
                $("#jek"+i).val(localStorage.getItem("jek"+i));
                $("#jkg"+i).val(localStorage.getItem("jkg"+i));
            }
        }
        function keBag2(){
            d1 = $("#jual_kode").val();
            d2 = $("#jual_tanggal").val();
            d3 = $("#jual_customer").val();
            d4 = $("#jual_produk").val();
            $("#jual_detail_ekor").val("");
            $("#jual_detail_kg").val("");

            if(d1 == "" || d2 == "" || d3 == "" || d3 == null || d4 == "" || d4 == null){
                alert("lengkapi data terlebih dahulu");
            }else{
                // simpan ke localstorage
                localStorage.setItem("dataJual","1");
                localStorage.setItem("jual_kode",d1);
                localStorage.setItem("jual_tanggal",d2);
                localStorage.setItem("jual_customer",d3);
                localStorage.setItem("jual_produk",d4);
                $('#bagian1').hide();$('#bagian2').show();
            }   
        }
        function keBag3(){
            jumlahTimbangan = localStorage.getItem("jumlahTimbangan");
            jml = parseInt(jumlahTimbangan) + 1;
            jmlEk = 0;
            jmlKg = 0;
            nolee = "no";
            $("#jual_detail_ekor").val("");
            $("#jual_detail_kg").val("");

            for (let i = 1; i < jml; i++) {
                
                if($("#jek"+i).val() != ""){
                    jek = $("#jek"+i).val();
                }else{
                    jek = 0;
                }

                if($("#jkg"+i).val() != ""){
                    jkg = $("#jkg"+i).val();
                }else{
                    jkg = 0;
                }

                if(jek == 0 || jkg == 0){
                    nolee = "yes";
                }else{
                    localStorage.setItem("jek"+i,jek);
                    localStorage.setItem("jkg"+i,jkg);
                    
                    jmlEk = parseInt(jmlEk) + parseInt(jek);
                    jmlKg = parseFloat(jmlKg) + parseFloat(jkg);
                    
                    dataEk = $("#jual_detail_ekor").val() + "#" + localStorage.getItem("jek"+i);
                    $("#jual_detail_ekor").val(dataEk);
                    dataKg = $("#jual_detail_kg").val() + "#" + localStorage.getItem("jkg"+i);
                    $("#jual_detail_kg").val(dataKg);
                }
            }

            // menjumlah otomatis
            if(nolee=="yes"){
                alert("Timbangan tidak boleh nol! Isi dengan benar!")
            }else{
                $("#jual_ekor").val(jmlEk);
                $("#jual_kg").val(jmlKg);
                $("#jual_detail_ekor").val(dataEk);
                $("#jual_detail_kg").val(dataKg);
                // bandingkan dengan stok
                stokEk = localStorage.getItem("stokEkSekarang");
                stokKg = localStorage.getItem("stokKgSekarang");

                if(jmlEk > stokEk){
                    $("#warningEk").html("Stok tidak mencukupi");
                    stokEkAkhir = stokEk;
                    //$("#tbTambahPenjualan").hide();
                }else{
                    $("#warningEk").html("");
                    stokEkAkhir = parseInt(stokEk) - parseInt(jmlEk);
                    //$("#tbTambahPenjualan").show();
                }
                if(jmlKg > stokKg){
                    $("#warningKg").html("Stok tidak mencukupi");
                    stokKgAkhir = stokKg;
                    //$("#tbTambahPenjualan").hide();
                }else{
                    $("#warningKg").html("");
                    stokKgAkhir = parseFloat(stokKg) - parseFloat(jmlKg);
                    //$("#tbTambahPenjualan").show();
                }

                // hitung stok akhir
                $('#stokEkAkhir').val(stokEkAkhir);
                $('#stokKgAkhir').val(stokKgAkhir);

                hitungTotal();
                $('#bagian2').hide();$('#bagian3').show();
            }
        }

        function hitungTotal(){
            kilo = $("#jual_kg").val();
            hrg = $("#jual_harga").val();
            totalHarga = parseFloat(kilo) * parseFloat(hrg);
            $("#jual_totalHarga").val(totalHarga);
            
        }

        //tangani array JSON
        var jsonContent = document.getElementById('dataProduk').textContent;
        var jsonData = JSON.parse(jsonContent);
        function cariProdukBerdasarkanKode(kodeProduk) {
            return jsonData.find(function(produk) {
                return produk.kode_produk === kodeProduk;
            });
        }
        // JSON -- end

        function pilihProduk(){
            terpilih = $("#jual_produk").val().split("#");
            var id = terpilih[0];

            hasilPencarian = cariProdukBerdasarkanKode(id);
            stokEkSekarang = hasilPencarian.stok_perekor;
            stokKgSekarang = hasilPencarian.stok_perkg;
            hargaSekarang = hasilPencarian.harga_jualperkg;
            var stokEk = parseInt(stokEkSekarang).toLocaleString();
            var stokKg = parseFloat(stokKgSekarang).toLocaleString();
            $("#stokSekarang").html(stokEk +" ekor | "+stokKg +" Kg");
            $("#jual_harga").val(hargaSekarang);
            localStorage.setItem("stokEkSekarang",stokEkSekarang);
            localStorage.setItem("stokKgSekarang",stokKgSekarang);
            localStorage.setItem("hargaSekarang",hargaSekarang);
        }
        function hitungKembalian(){
            harusDibayar = $("#jual_totalHarga").val();
            dibayar = $("#jual_bayar").val();
            kembalian = parseFloat(dibayar) - parseFloat(harusDibayar);
            if(kembalian>=0){
                $("#kembalian").html(kembalian);
                $("#status").html("LUNAS");
                $("#jual_kembalian").val(kembalian);
                $("#jual_status").val("LUNAS");
                $("#kembalian").css("color","green");
                $("#status").css("color","green");
                $("#tbTambahPenjualan").show();
            }else{
                $("#kembalian").html(kembalian);
                $("#status").html("BELUM");
                $("#jual_kembalian").val(kembalian);
                $("#jual_status").val("BELUM");
                $("#kembalian").css("color","red");
                $("#status").css("color","red");
                $("#tbTambahPenjualan").show();
            }
        }
    </script>
<?= $this->endSection('isi') ?>