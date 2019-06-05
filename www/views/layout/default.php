
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= $_SERVER['REQUEST_SCHEME']. '://' . $_SERVER['HTTP_HOST'] ?>/assets/css/styles.css">
    <title><?= $title ? 'Mon site | ' . $title : 'Mon site' ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
</head>

<body class="container-fluid p-0">
    <header>
        <h1><?= $title ?? 'hello' ?></h1>
        <div class="top-head">
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="categories">Categories</a></li>
                    <li><a href="#">Archives</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
            <div class="search">
                <input id="search" type="search" name="search" value=""><button id="btn"><i class="fas fa-search"></i></button>
                <!--<input id="myInput" type="text" placeholder="Search..">-->
            </div>
        </div>
    </header>
    <body>
        <?= $content ?>
    </body>
    <footer class="footer bg-dark fixed-bottom py-1">
        <div class="text-center">
            <span class="text-white">by SIMON</span>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="<?= $_SERVER['REQUEST_SCHEME']. '://' . $_SERVER['HTTP_HOST'] ?>/assets/js/scripts.js"></script>
</body>

</html>