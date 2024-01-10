<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
<h1>Dashboard </h1>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>

<?php
    // Memuat library session
    $session = session();
    $userData = $session->get('user');
?>

<div id="xxx" style="display:none">
    <div id="level" style="display:none"><?php echo $userData['level'] ?></div>
    <div class="mb-3">
        <div class="row">
            <div class="col" style="text-align: center;">
                
                    <h1  style= "font-style: italic;">
                        Selamat Datang 
                        <?php echo $userData['nama'] ?> !
                    </h1>
                    <h2 style="color:red; font-family: Verdana;">
                    UD. Sawung White Kabupaten Pemalang</h2>
                    
                <nav class="navbar-dark bg-primary" style="color:#000000; ">
                    <!-- <center><p >Alamat Comal Kabupaten Pemalang, No Wa 089681929700 (Pak Tarsono)</p></center> -->
                </nav>
            </div>
        </div>
    </div>

    <div class="sembunyi pemilik super-admin admin-pembelian">
        Lihat Grafik Pembelian
        <select class="form-control" id="beli_produk" name="beli_produk" onchange="GrafikPembelian()">
            <option value="" disabled selected>== Pilih Produk ==</option>
                <?php foreach ($list_produk as $indexs => $produk) : ?>
                    <option value="<?= $produk['kode_produk']?>#<?= $produk['nama_produk']?>"><?= $produk['nama_produk']?></option>
                <?php endforeach ?>
        </select>

        <div id="tombolPilih" style="margin:20px auto;text-align:center">
            <button style="font-weight: bold;" type="button" class="btn btn-info" onclick="BhariIni()">
                Hari ini
            </button>
            <button style="display: none;" type="button" class="btn btn-info" onclick="BpekanIni()">
                Pekan ini
            </button>
            <button style="font-weight: bold;" type="button" class="btn btn-info" onclick="BbulanIni()">
                Bulan ini
            </button>
            <button style="font-weight: bold;" type="button" class="btn btn-info" onclick="BtahunIni()">
                Setahun ini
            </button>
        </div>
        <div id="judulB" style="text-align:center;font-weight:bold;"></div>
        <div style="width: 80%; margin: auto;">
            <canvas id="grafikPembelian"></canvas>
        </div>
    </div>
    
    <div class="sembunyi pemilik super-admin admin-penjualan">
        Lihat Grafik Penjualan
        <select class="form-control" id="jual_produk" name="jual_produk" onchange="GrafikPenjualan()">
            <option value="" disabled selected>== Pilih Produk ==</option>
                <?php foreach ($list_produk as $indexs => $produk) : ?>
                    <option value="<?= $produk['kode_produk']?>#<?= $produk['nama_produk']?>"><?= $produk['nama_produk']?></option>
                <?php endforeach; ?>
        </select>

        <div id="tombolPilih" style="margin:20px auto;text-align:center">
            <button style="font-weight: bold;" type="button" class="btn btn-info" onclick="JhariIni()">
                Hari ini
            </button>
            <button style="display: none;" type="button" class="btn btn-info" onclick="JpekanIni()">
                Pekan ini
            </button>
            <button style="font-weight: bold;" type="button" class="btn btn-info" onclick="JbulanIni()">
                Bulan ini
            </button>
            <button style="font-weight: bold;" type="button" class="btn btn-info" onclick="JtahunIni()">
                Setahun ini
            </button>
        </div>
        <div id="judulJ" style="text-align:center;font-weight:bold;"></div>
        <div style="width: 80%; margin: auto;">
            <canvas id="grafikPenjualan"></canvas>
        </div>
    </div>
</div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            $("#xxx").css("display","block");
            level0 = document.getElementById("level").innerHTML.toLowerCase();
            level = level0.replace(/\s+/g, '-');
            sessionStorage.setItem("level",level);

            levelnya = sessionStorage.getItem("level");
            $("."+levelnya).show();

            //clear
            localStorage.clear();

            // pilih
            var grafikBeli = document.getElementById('beli_produk');
            grafikBeli.selectedIndex = 1;
            //BbulanIni();
            BtahunIni();
            var grafikJual = document.getElementById('jual_produk');
            grafikJual.selectedIndex = 1;
            //JbulanIni();
            JtahunIni();
        });
        
        function BhariIni(){
            var today = new Date();
            var dariB = today.toISOString().split('T')[0];
            var sampaiB = today.toISOString().split('T')[0];
            GrafikPembelian(dariB,sampaiB);
            $("#judulB").html("GRAFIK PEMBELIAN HARI INI");
        }
        function BpekanIni(){
            var today = new Date();
            var sevenDaysAgo = new Date();
            sevenDaysAgo.setDate(today.getDate() - 7);
            var dariB = sevenDaysAgo.toISOString().split('T')[0];
            var sampaiB = today.toISOString().split('T')[0];
            GrafikPembelian(dariB,sampaiB);
            $("#judulB").html("GRAFIK PEMBELIAN 7 HARI TERAKHIR");
        }
        function BbulanIni(){
            var firstDayOfMonth = new Date();
            firstDayOfMonth.setDate(1);

            // Mendapatkan tanggal akhir bulan ini
            var lastDayOfMonth = new Date();
            lastDayOfMonth.setMonth(lastDayOfMonth.getMonth() + 1);
            lastDayOfMonth.setDate(0);

            // Format tanggal menjadi string YYYY-MM-DD
            var dariB = firstDayOfMonth.toISOString().split('T')[0];
            var sampaiB = lastDayOfMonth.toISOString().split('T')[0];
            GrafikPembelian(dariB,sampaiB);
            $("#judulB").html("GRAFIK PEMBELIAN BULAN INI");
        }
        function BtahunIni(){
            <?PHP
                if($totalB1>0){echo  "var totalB1=".$totalB1.";";}else{echo  "var totalB1=0;";}
                if($totalB2>0){echo  "var totalB2=".$totalB2.";";}else{echo  "var totalB2=0;";}
                if($totalB3>0){echo  "var totalB3=".$totalB3.";";}else{echo  "var totalB3=0;";}
                if($totalB4>0){echo  "var totalB4=".$totalB4.";";}else{echo  "var totalB4=0;";}
                if($totalB5>0){echo  "var totalB5=".$totalB5.";";}else{echo  "var totalB5=0;";}
                if($totalB6>0){echo  "var totalB6=".$totalB6.";";}else{echo  "var totalB6=0;";}
                if($totalB7>0){echo  "var totalB7=".$totalB7.";";}else{echo  "var totalB7=0;";}
                if($totalB8>0){echo  "var totalB8=".$totalB8.";";}else{echo  "var totalB8=0;";}
                if($totalB9>0){echo  "var totalB9=".$totalB9.";";}else{echo  "var totalB9=0;";}
                if($totalB10>0){echo  "var totalB10=".$totalB10.";";}else{echo  "var totalB10=0;";}
                if($totalB11>0){echo  "var totalB11=".$totalB11.";";}else{echo  "var totalB11=0;";}
                if($totalB12>0){echo  "var totalB12=".$totalB12.";";}else{echo  "var totalB12=0;";}
            ?>

            $("#judulB").html("GRAFIK PEMBELIAN SETAHUN");
            var ctx = document.getElementById('grafikPembelian').getContext('2d');
            tanggalB = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun','Juli','Ags','Sep','Okt','Nov','Des'];
            jumlahB = [totalB1, totalB2, totalB3, totalB4, totalB5, totalB6, totalB7, totalB8, totalB9, totalB10, totalB11, totalB12];

            tanggalB.unshift(0);
            jumlahB.unshift(0);
            // Data untuk grafik
            var data = {
                labels: tanggalB,
                datasets: [{
                    label: 'Pembelian Produk',
                    backgroundColor: 'rgba(75, 192, 192, 1)',
                    borderColor: 'rgba(50, 39, 245, 1)',
                    borderWidth: 3,
                    data: jumlahB,
                    fill: false,
                }]
            };

            // Konfigurasi opsi grafik
            var options = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            // Buat objek grafik menggunakan Chart.js
            var myChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: options
            });
        }

        function GrafikPembelian(dariB,sampaiB){
            produkeB = $("#beli_produk").val();
            produkeOKB = produkeB.split("#");

            var startDateB = dariB;
            var endDateB = sampaiB;

            var grafikDataB = <?= json_encode($grafik_data_pembelian); ?>;

            var produkB = grafikDataB.filter(dataB => dataB.produk_dibeli === produkeOKB[1]);
            
            var dataBetweenDates = produkB.filter(dataB => {
                return dataB.tanggal_pembelian >= startDateB && dataB.tanggal_pembelian <= endDateB;
            });
            var tanggalB = dataBetweenDates.map(dataB => dataB.tanggal_pembelian);
            var jumlahB = dataBetweenDates.map(dataB => dataB.harga_total);

            tanggalB.unshift(0);
            jumlahB.unshift(0);
            // Buat chart
            var ctxB = document.getElementById('grafikPembelian').getContext('2d');
            var myChartB = new Chart(ctxB, {
                type: 'line',
                data: {
                    labels: tanggalB,
                    datasets: [{
                        label: 'Pembelian ' + produkeOKB[1],
                        data: jumlahB,
                        fill: false,
                        borderColor: 'rgba(50, 39, 245, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 3
                    }]
                },
                options: {
                    scales: {
                        x: {
                            
                            type: 'time',
                            time: {
                                unit: 'day'
                            },
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah'
                            }
                        }
                    }
                }
            });
        }

        function JhariIni(){
            var today = new Date();
            var dariJ = today.toISOString().split('T')[0];
            var sampaiJ = today.toISOString().split('T')[0];
            GrafikPenjualan(dariJ,sampaiJ);
            $("#judulJ").html("GRAFIK PEMBELIAN HARI INI");
        }
        function JpekanIni(){
            var today = new Date();
            var sevenDaysAgo = new Date();
            sevenDaysAgo.setDate(today.getDate() - 7);
            var dariJ = sevenDaysAgo.toISOString().split('T')[0];
            var sampaiJ = today.toISOString().split('T')[0];
            GrafikPenjualan(dariJ,sampaiJ);
            $("#judulJ").html("GRAFIK PEMBELIAN 7 HARI TERAKHIR");
        }
        function JbulanIni(){
            var firstDayOfMonth = new Date();
            firstDayOfMonth.setDate(1);

            // Mendapatkan tanggal akhir bulan ini
            var lastDayOfMonth = new Date();
            lastDayOfMonth.setMonth(lastDayOfMonth.getMonth() + 1);
            lastDayOfMonth.setDate(0);

            // Format tanggal menjadi string YYYY-MM-DD
            var dariJ = firstDayOfMonth.toISOString().split('T')[0];
            var sampaiJ = lastDayOfMonth.toISOString().split('T')[0];
            GrafikPenjualan(dariJ,sampaiJ);
            $("#judulJ").html("GRAFIK PEMBELIAN BULAN INI");
        }
        function JtahunIni(){
            <?PHP
                if($totalJ1>0){echo  "var totalJ1=".$totalJ1.";";}else{echo  "var totalJ1=0;";}
                if($totalJ2>0){echo  "var totalJ2=".$totalJ2.";";}else{echo  "var totalJ2=0;";}
                if($totalJ3>0){echo  "var totalJ3=".$totalJ3.";";}else{echo  "var totalJ3=0;";}
                if($totalJ4>0){echo  "var totalJ4=".$totalJ4.";";}else{echo  "var totalJ4=0;";}
                if($totalJ5>0){echo  "var totalJ5=".$totalJ5.";";}else{echo  "var totalJ5=0;";}
                if($totalJ6>0){echo  "var totalJ6=".$totalJ6.";";}else{echo  "var totalJ6=0;";}
                if($totalJ7>0){echo  "var totalJ7=".$totalJ7.";";}else{echo  "var totalJ7=0;";}
                if($totalJ8>0){echo  "var totalJ8=".$totalJ8.";";}else{echo  "var totalJ8=0;";}
                if($totalJ9>0){echo  "var totalJ9=".$totalJ9.";";}else{echo  "var totalJ9=0;";}
                if($totalJ10>0){echo  "var totalJ10=".$totalJ10.";";}else{echo  "var totalJ10=0;";}
                if($totalJ11>0){echo  "var totalJ11=".$totalJ11.";";}else{echo  "var totalJ11=0;";}
                if($totalJ12>0){echo  "var totalJ12=".$totalJ12.";";}else{echo  "var totalJ12=0;";}
            ?>

            $("#judulJ").html("GRAFIK PENJUALAN SETAHUN");
            var ctx = document.getElementById('grafikPenjualan').getContext('2d');
            tanggalJ = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun','Juli','Ags','Sep','Okt','Nov','Des'];
            jumlahJ = [totalJ1, totalJ2, totalJ3, totalJ4, totalJ5, totalJ6, totalJ7, totalJ8, totalJ9, totalJ10, totalJ11, totalJ12];

            tanggalJ.unshift(0);
            jumlahJ.unshift(0);
            // Data untuk grafik
            var data = {
                labels: tanggalJ,
                datasets: [{
                    label: 'Penjualan Produk',
                    backgroundColor: 'rgba(75, 192, 192, 1)',
                    borderColor: 'rgba(240, 39, 39, 1)',
                    borderWidth: 3,
                    data: jumlahJ,
                    fill: false,
                }]
            };

            // Konfigurasi opsi grafik
            var options = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            // Buat objek grafik menggunakan Chart.js
            var myChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: options
            });
        }
        function GrafikPenjualan(dariJ,sampaiJ){
            //ambil value
            produke = $("#jual_produk").val();
            produkeOK = produke.split("#");

            var startDateJ = dariJ;
            var endDateJ = sampaiJ;

            var grafikData = <?= json_encode($grafik_data_penjualan); ?>;
            var produk = grafikData.filter(data => data.produk === produkeOK[1]);
            
            var dataBetweenDates = produk.filter(data => {
                return data.tanggal_penjualan >= startDateJ && data.tanggal_penjualan <= endDateJ;
            });
            var tanggal = dataBetweenDates.map(data => data.tanggal_penjualan);
            var jumlah = dataBetweenDates.map(data => data.totalHarga);

            tanggal.unshift(0);
            jumlah.unshift(0);
            // Buat chart untuk produk "jeroan ayam"
            var ctxJeroan = document.getElementById('grafikPenjualan').getContext('2d');
            var myChartJ = new Chart(ctxJeroan, {
                type: 'line',
                data: {
                    labels: tanggal,
                    datasets: [{
                        label: 'Penjualan ' + produkeOK[1],
                        data: jumlah,
                        fill: false,
                        borderColor: 'rgba(240, 39, 39, 1)',
                        borderWidth: 3
                    }]
                },
                options: {
                    scales: {
                        x: {
                            
                            type: 'time',
                            time: {
                                unit: 'day'
                            },
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah'
                            }
                        }
                    }
                }
            });
        }
    </script>
<?= $this->endSection('isi') ?>