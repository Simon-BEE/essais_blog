<?php
require_once '/var/www/vendor/autoload.php';


$pdo = new PDO('mysql:dbname=blog;host=blog.mysql;charset=UTF8', 'userblog', 'blogpwd');
//creation table
$pdo->exec("CREATE TABLE post(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    content TEXT(650000) NOT NULL,
    created_at DATETIME NOT NULL,
    PRIMARY KEY (id)
)");
$pdo->exec("CREATE TABLE category(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
)");
$pdo->exec("CREATE TABLE user(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
)");
$pdo->exec("CREATE TABLE post_category(
    post_id INT UNSIGNED NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (post_id, category_id),
    CONSTRAINT fk_post
        FOREIGN KEY (post_id)
        REFERENCES post (id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT,
    CONSTRAINT fk_category
        FOREIGN KEY (category_id)
        REFERENCES category (id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
)");

//vidage table
$pdo->exec('SET FOREIGN_KEY_CHECKS=0'); //désactiver la vérification des clés étrangères
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS=1'); //ré-activer la vérification des clés étrangères
/*for ($i = 0; $i < 50; $i++) { 
    $pdo->exec("INSERT INTO post SET name='name{$i}', slug='moi{$i}', content='lorem{$i}', created_at='2038-01-19 03:14:07.999999'");
}*/

//remplir table
$faker = Faker\Factory::create('fr_FR'); // créer une instance de la classe factory, on y appelle la méthode create
$posts = [];
$categories= [];

for ($i = 0; $i < 100; $i++) { 
    $pdo->exec("INSERT INTO post SET name='{$faker->sentence()}', slug='{$faker->slug}', content='{$faker->paragraphs(rand(3,12), true)}', created_at='{$faker->date} {$faker->time}'");
    $posts[] = $pdo->lastInsertId();
}


for ($i = 0; $i < 50; $i++) { 
    $pdo->exec("INSERT INTO category SET name='{$faker->sentence(3, false)}', slug='{$faker->slug}'");
    $categories[] = $pdo->lastInsertId();
}

foreach ($posts as $post) {
    $randomCategories = $faker->randomElements($categories, rand(2, 4));
    foreach ($randomCategories as $category) {
        $pdo->exec("INSERT INTO post_category SET post_id = {$post}, category_id = {$category}");
    }
}

$password = password_hash('admin', PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO user SET username='admin', password='{$password}'");