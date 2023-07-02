<?php
require("init.php");


if (!empty($_SESSION)) {
    header("Location: tampilkan_barang.php");
    die;
}

$user = new User();

if (!empty($_POST)) {
    $pesan_error = $user->validasiInsert($_POST);
    if (empty($pesan_error)) {
        $user->insert();
        header("Location: buat_akun_berhasil.php");
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stock Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="icon" href="img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../css/style.css">
</head>

<style>
    body {
        background-color: #F0F2F5;
    }
</style>

<body>
    <div class="container d-flex align-items-center justify-content-around mt-5">
        <div class="kanan w-50">
            <div class="container">
                <h1 class="text-center mb-3">Buat Akun</h1>
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <!-- jika ada error, tampilkan pesan error -->
                        <?php
                        if (!empty($pesan_error)) :
                        ?>

                            <div id="divPesanError" class="container w-100">
                                <div class="">
                                    <div class="alert alert-danger" role="alert">
                                        <ul class="mb-0">
                                            <?php
                                            foreach ($pesan_error as $pesan) {
                                                echo "<li style='list-style : none;'>$pesan</li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        <?php
                        endif;
                        ?>
                        <div class="card shadow">
                            <!-- <h4 class="text-center mt-3">Login</h4> -->
                            <div class="card-body">
                                <form method="post">
                                    <div class="mb-2">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" autocomplete="off" class="form-control" id="username" name="username" >
                                    </div>
                                    <div class="mb-2">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" autocomplete="off" class="form-control" id="email" name="email" >
                                    </div>
                                    <div class="mb-2">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" >
                                    </div>
                                    <div class="mb-2">
                                        <label for="ulangi_password" class="form-label">Ulangi Password</label>
                                        <input type="password" class="form-control" id="ulangi_password" name="ulangi_password" >
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary py-2 w-100 mt-3">Daftar</button>
                                    </div>
                                    <div class="text-center">
                                        <a href="login.php" class="btn btn-danger py-2 w-100 mt-3">Cancel</a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

<footer>

</footer>