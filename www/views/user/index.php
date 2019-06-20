<?php
use App\UsersQuery;
$page = $match['name'];

if (!empty($_POST) && empty($_POST['robot'])) {
    $user = UsersQuery::selectUser($_POST['login']);
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
    if($page === 'password2' && !empty($_POST['email_p'])){
        die('FATAL ERROR NO OPTION LIKE THIS');
    }
}


$subtitle = ucfirst($page);
?>

<section class="connection">
    <h2><?= $subtitle ?></h2>
    <form method="POST" action="">
<?php if($page === 'connection'): ?>
        <div class="message">
            <p><a href="/connection/register">Not registered yet?</a> / <a href="/connection/password">Forgot your password?</a></p>
        </div>
        <input type="text" name="login" placeholder="Your login" required>
        <input type="password" name="passwd" placeholder="Your password" required>
        <input type="hidden" name="robot" value=""></<input>
<?php elseif($page === 'register'): ?>
        <div class="message">
            <p><a href="/connection">Already registered?</a></p>
        </div>
        <div class="register">
            <div class="text"><input type="text" name="login" placeholder="Your login" required></div>
            <div class="mail"><input type="email" name="email_r" placeholder="Your mail adress" required></div>
            <div class="mail2"><input type="email" name="email2_r" placeholder="Verify your mail adress" required></div>
            <div class="pass"><input type="password" name="passwd_r" placeholder="Your password" required></div>
            <div class="pass2"><input type="password" name="passwd2_r" placeholder="Verify your password" required></div>
            <div><input type="hidden" name="robot" value=""></div>
        </div>
<?php elseif($page === 'password'): ?>
        <div class="message">
            <p><a href="/connection">Return?</a></p>
        </div>
        <input type="email" name="email_p" placeholder="Your mail adress" required>
        <input type="hidden" name="robot" value="">
<?php endif; ?>
        <div><button id="send"><?= $subtitle ?></button></div>
    </form>
    
</section>