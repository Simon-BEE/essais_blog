
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

<body>
    <header>
        <h1><?= $title ?? 'hello' ?></h1>
        <div class="top-head">
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/categories">Categories</a></li>
                </ul>
            </nav>
            <div class="search">
                <input id="search" type="search" name="search" value=""><button id="btn"><i class="fas fa-search"></i></button>
                <!--<input id="myInput" type="text" placeholder="Search..">-->
            </div>
        </div>
    </header>
    <main>
        <?= $content ?>
    </main>
    <footer class="footer">
        <div>
            <?php
            $debug = "";
            if(getenv("ENV_DEV")){
                $end = microtime(true);
                //global $start;
                $generationTime = number_format(($end - GENERATE_TIME_START)*1000, 2);
                $debug ="-- page générée en  ". $generationTime ." ms";
            }
            ?>
            <span>by SIMON <?= $debug; ?></span>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="<?= $_SERVER['REQUEST_SCHEME']. '://' . $_SERVER['HTTP_HOST'] ?>/assets/js/scripts.js"></script>
</body>

</html>