<?php
namespace App\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->loadModel('user');
    }

    public function index()
    {
        dd($_SERVER);
        $page = $match['name'];
        // if (is_null($page)) {
        //     $title = "Connection";
        // }
        $title = "Connection";
        if (!empty($_POST) && empty($_POST['robot'])) {
            $user = $this->user->selectUser($_POST['login']);

            if($page === 'connection2' && !empty($_POST['passwd'] && !empty($user))){
                if(password_verify($_POST['passwd'], $user->password)){
                    die('bienvenue');
                }else{
                    die('Password error');
                }
            }
            if($page === 'register2' && !empty($_POST['email_r'] && empty($user))){
                $login = htmlspecialchars($_POST['login']);
                if ($_POST['email_r'] == $_POST['email2_r'] && $_POST['passwd_r'] == $_POST['passwd2_r']) {
                    $email = htmlspecialchars($_POST['email_r']);
                    $password = password_hash($_POST['passwd_r'], PASSWORD_DEFAULT);
                    UsersQuery::insertUser($login, $password, $email);
                    die('Enregistrement ok');
                }else{
                    die('Verify error');
                }
            }
        }
        $this->render("user/index", ["title" => $title, "page" => $page, "subtitle" => $subtitle]);
    }
}