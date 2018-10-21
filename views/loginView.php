<section class="panel-white">
    <form>
        <fieldset>
            <legend>Connexion</legend>
            login: <input type="text" name='login'>
            password: <input type="password" name='password'>
        </fieldset>

        <input type="submit" value="Se connecter">
    </form>
</section>

<?php
require 'controllers/loginController.php';
?>