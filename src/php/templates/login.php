<?php
require_once 'src/php/autoload.php';
$db = Database::getInstance();
$session = Session::getInstance();
$auth = new Auth($session);

if (!empty($_POST))
{
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$password = htmlspecialchars($_POST['password']);
	$auth->login($db, $pseudo, $password);
}
?>

<div class="jumbotron jumbotron-page rounded-0">
	<h1 class="display-3">Connexion</h1>
</div>

<div class="container margin-top-50">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <form method="post">
                <div class="form-group">
                    <label for="pseudo">Se connecter</label>
                    <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="Pseudo">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Mot de passe">
                </div>
                <button type="submit" class="btn btn-info btn-block">Se connecter</button>
            </form>
        </div>
    </div>
</div>
