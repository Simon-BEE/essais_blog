<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? 'Mon site' ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1><?= $title ?? 'hello' ?></h1>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Categories</a></li>
                <li><a href="#">Archives</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    <?= $content; ?>
    <footer>
        <p>Merci !</p>
    </footer>
</body>
</html>