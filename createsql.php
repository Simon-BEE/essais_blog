<?php
require_once 'vendor/autoload.php';

$pdo = new PDO('mysql:dbname=blog;host=172.17.0.2;charset=UTF8', 'userblog', 'blogpwd');
$pdo->exec('SET FOREIGN_KEY_CHECKS=0'); //désactiver la vérification des clés étrangères
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS=1'); //ré-activer la vérification des clés étrangères

$faker = Faker\Factory::create('fr_FR'); // créer une instance de la classe factory, on y appelle la méthode create
for ($i = 0; $i < 50; $i++) { 
    $pdo->exec("INSERT INTO post SET name='{$faker->sentence()}', slug='{$faker->slug}', content='{$faker->paragraphs(rand(3,12), true)}', created_at='{$faker->date} {$faker->time}'");
}

for ($i = 0; $i < 50; $i++) { 
    $pdo->exec("INSERT INTO category SET name='{$faker->sentence(3, false)}', slug='{$faker->slug}'");
}
/*for ($i = 0; $i < 50; $i++) { 
    $pdo->exec("INSERT INTO post SET name='name{$i}', slug='moi{$i}', content='lorem{$i}', created_at='2038-01-19 03:14:07.999999'");
}*/
