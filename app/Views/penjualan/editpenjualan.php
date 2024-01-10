<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Edit Transaksi Penjualan
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-sm btn-danger" onclick="location.href=('/penjualan/index')">
    Batal Edit
</button>
<button style="display:none" type="button" class="btn btn-sm btn-success" onclick="document.getElementById('tbTambahPenjualan').click()">
    Simpan
</button>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>

<pre id="dataProduk" style="display:none">
    <?php echo json_encode($json_data, JSON_PRETTY_PRINT); ?>
</pre>

<?= form_open('penjualan/updatedata', ['enctype' => 'multipart/form-data']); ?>

<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>

<div id="bagian1" style="display:none">
    <div class="col-sm-12" style="margin:1% auto">
        <label for="jual_kode" class="col-sm-12 col-form-label">No. Nota</label>
        <input type="text" class="form-control" id="jual_kode" name="jual_kode" autofocus placeholder="Masukkan No. Nota" readonly>
    </div>

    <div class="col-sm-12" style="margin:1% auto">
        <label for="jual_tanggal" class="col-sm-12 col-form-label">Tanggal Penjualan</label>
        <input type="date" class="form-control" id="jual_tanggal" name="jual_tanggal" laceholder="Masukkan Tanggal Penjualan">
    </div>

    <div class="col-sm-12">
        <label for="jual_customer" class="col-sm-12 col-form-label">Nama Pelanggan</label>
        <input type="text" class="form-control" id="jual_customer" name="jual_customer" placeholder="Masukkan Nama Pelanggan">
    </div>

    <div class="col-sm-12">
        <label for="jual_produk" class="col-sm-12 col-form-label">Produk</label>
        <input type="text" class="form-control" id="prdsmrn" name="prdsmrn" placeholder="Produk" readonly>
        <select style="display:none" class="form-control" id="jual_produk" name="jual_produk" onchange="pilihProduk()" readonly>
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
        <input style="display:none" type="number" class="form-control" id="jual_ekor_produk" name="jual_ekor_produk" placeholder="Jumlah Ekor" readonly="true" value="<?= $detailproduk['stok_perekor'] ?>">
        <input style="display:none" type="number" class="form-control" id="jual_ekor_lama" name="jual_ekor_lama" placeholder="Jumlah Ekor" readonly="true">

        <input type="number" class="form-control" id="jual_ekor" name="jual_ekor" placeholder="Jumlah Ekor" readonly="true">
        <div id="warningEk" style="color:red;font-style:italic"></div>
        <input style="display:none" type="number" class="form-control" id="jual_ekor_sekarang" name="jual_ekor_sekarang" placeholder="Jumlah Ekor" readonly="true">
    </div>

    <div class="col-sm-12">
        <label for="jual_kg" class="col-sm-12 col-form-label">Jumlah Kg</label>
        <input style="display:none" type="text" class="form-control" id="jual_kg_produk" name="jual_kg_produk" placeholder="Jumlah Kilo" readonly="true" value="<?= $detailproduk['stok_perkg'] ?>">
        <input style="display:none" type="text" class="form-control" id="jual_kg_lama" name="jual_kg_lama" placeholder="Jumlah Kilo" readonly="true">

        <input type="text" class="form-control" id="jual_kg" name="jual_kg" placeholder="Jumlah Kilo" readonly="true">
        <div id="warningKg" style="color:red;font-style:italic"></div>
        <input style="display:none" type="text" class="form-control" id="jual_kg_sekarang" name="jual_kg_sekarang" placeholder="Jumlah Kg" readonly="true">
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
        <div style="font-size:18px;padding:5px;margin:10px auto;">Kembalian: <span id="kembalian"></span></div>
        <div style="font-size:18px;padding:5px;margin:10px auto;">Status: <span id="status"></span></div>
        
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

    <?= 
        "<script>
        var kode_penjualan = ".json_encode($detail['kode_penjualan']).";
        var tanggal_penjualan = ".json_encode($detail['tanggal_penjualan']).";
        var customer = ".json_encode($detail['customer']).";
        var kode_produk_dijual = ".json_encode($detail['kode_produk_dijual']).";
        var produk_dijual = ".json_encode($detail['produk']).";
        var detail_ekor = ".json_encode($detail['detail_ekor']).";
        var detail_kg = ".json_encode($detail['detail_kg']).";
        var jml_ekor = ".json_encode($detail['ekor']).";
        var jml_kg = ".json_encode($detail['kg']).";
        var harga = ".json_encode($detail['harga']).";
        var harga_total = ".json_encode($detail['totalHarga']).";
        var bayar = ".json_encode($detail['bayar']).";
        var kembalian = ".json_encode($detail['kembalian']).";
        var status = ".json_encode($detail['status']).";
        </script>"
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // load data
            $("#jual_kode").val(kode_penjualan);
            $("#jual_tanggal").val(tanggal_penjualan);
            $("#jual_customer").val(customer);
            $("#jual_produk").val(kode_produk_dijual+"#"+produk_dijual);
            pilihProduk();
            bnykTmb = parseInt(detail_ekor.split("#").length) -1;
            localStorage.setItem("jumlahTimbangan",bnykTmb);
            localStorage.setItem("dataJual",1);
            $("#jual_ekor_lama").val(jml_ekor);
            $("#jual_ekor").val(jml_ekor);
            $("#jual_kg_lama").val(jml_kg);
            $("#jual_kg").val(jml_kg);
            $("#jual_harga").val(harga);
            $("#jual_totalHarga").val(harga_total);
            $("#jual_bayar").val(bayar);
            $("#kembalian").html(kembalian);
            $("#status").html(status);
                        
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
                type: 'text',
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
                    localStorage.setItem("jek"+i,$("#jek"+i).val());
                    localStorage.setItem("jkg"+i,$("#jkg"+i).val());
                }
            }
            
            //
            tambahInput();
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

            dataEkor = detail_ekor.split("#");
            dataKg = detail_kg.split("#");
            for (let i = 1; i < jml; i++) {
                localStorage.setItem("jek"+i,dataEkor[i]);
                localStorage.setItem("jkg"+i,dataKg[i]);
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

                localStorage.setItem("jek"+i,jek);
                localStorage.setItem("jkg"+i,jkg);
                
                jmlEk = parseInt(jmlEk) + parseInt(jek);
                jmlKg = parseFloat(jmlKg) + parseFloat(jkg);
                
                dataEk = $("#jual_detail_ekor").val() + "#" + localStorage.getItem("jek"+i);
                $("#jual_detail_ekor").val(dataEk);
                dataKg = $("#jual_detail_kg").val() + "#" + localStorage.getItem("jkg"+i);
                $("#jual_detail_kg").val(dataKg);
            }

            // menjumlah otomatis
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
            hitungKembalian();
            $('#bagian2').hide();$('#bagian3').show();
        }
        function hitungTotal(){
            kilo = $("#jual_kg").val();
            hrg = $("#jual_harga").val();
            totalHarga = parseFloat(kilo) * parseFloat(hrg);
            $("#jual_totalHarga").val(totalHarga);

            //hitung sekarang
            ekorStok = $('#jual_ekor_produk').val();
            ekorLama = $('#jual_ekor_lama').val();
            ekorBaru = $('#jual_ekor').val();
            
            kgStok = $('#jual_kg_produk').val();
            kgLama = $('#jual_kg_lama').val();
            kgBaru = $('#jual_kg').val();

            stokSekarang = (parseInt(ekorStok) + parseInt(ekorLama)) - parseInt(ekorBaru);
            $('#jual_ekor_sekarang').val(stokSekarang);
            kgSekarang = (parseFloat(kgStok) + parseFloat(kgLama)) - parseFloat(kgBaru);
            $('#jual_kg_sekarang').val(kgSekarang);
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
            $("#prdsmrn").val(terpilih[1]);
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
                $("#status").html("BELUM LUNAS");
                $("#jual_kembalian").val(kembalian);
                $("#jual_status").val("BELUM LUNAS");
                $("#kembalian").css("color","red");
                $("#status").css("color","red");
                $("#tbTambahPenjualan").show();
            }
        }
    </script>
<?= $this->endSection('isi') ?>