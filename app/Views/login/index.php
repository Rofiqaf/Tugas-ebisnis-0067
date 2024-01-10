<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <style>
        body {
            font-family: Verdana, sans-serif;
            font-size: 12pt;
            color: black;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* .container {
            width: 300px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        } */
        .container {
            width: 300px;
            margin: 50px  auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* h1 {
            font-size: 14pt;
            color: black;
            text-align: center;
        } */
        h1 {
            font-size: 30pt;
            color: blue;
            text-align: center;
            margin-top: 50px;
            font-weight: bold;
        }

        h2 {
            font-size: 20pt;
            color: red;
            text-align: center;
            font-weight: bold;
        }

        h3 {
            font-size: 16pt;
            color: black;
            text-align: center;
            font-weight: bold;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 80%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            width: 30%;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
            font-size: 12pt;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>APP SIPP </h1>
    <h2>UD. SAWUNG WHITE KABUPATEN PEMALANG </h2>
    <div class="container">
        <h3>SILAHKAN LOGIN</h3>
        <form action="<?= base_url('login/processLogin') ?>" method="post">
            <!-- <label for="username">Username:</label>
            <input type="text" id="username" name="username" required onclick="bersihkanError()">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required onclick="bersihkanError()"> -->

            <div style="margin-left: 10%;">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required onclick="bersihkanError()">
            <i class="fa fa-user"></i>
            </div>
            <div style="margin-left: 10%;">
            <label for="username">Password:</label>
            <input type="password" id="password" name="password" required onclick="bersihkanError()">
            <i class="fa fa-lock"></i>
            </div>
            

            <?php if (session()->has('error')) : ?>
                <div id="pesanError" style="text-align:center;color:red;padding:10px;margin-bottom:20px">
                    <?= session('error') ?>
                </div>
            <?php endif; ?>

            <button style="margin-left: 30%;" type="submit">Login</button>
        </form>
    </div>

    <script>
        function bersihkanError() {
            document.getElementById("pesanError").innerHTML = "";
            document.getElementById("pesanError").style.display = "none";
        }
    </script>
</body>

</html>