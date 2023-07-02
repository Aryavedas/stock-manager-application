<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stock Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="icon" href="img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../css/style.css">
</head>

<style>
    body{
        background-color: #F0F2F5;
    }
    .cropped-img {
        height: 92%;
        width: 100%;
        object-fit: fill;
        object-position: center center;
    }

    .card-body{
        margin-top: -40px;
    }
</style>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand" href="tampilkan_barang.php">
                <!-- <img src="img/favicon.png" alt="" class="" style="width: 30px;"> -->
                Stock Manager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item px-3">
                        <a class="nav-link active" href="tampilkan_barang.php">Daftar Barang</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link active" href="my_account.php">My Acoount</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link active" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>