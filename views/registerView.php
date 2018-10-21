<form class="panel-white">
    <fieldset>
        <legend>Créer un compte</legend>
        login: <input type="text" name='login'>
        password: <input type="password" name='password'>
    </fieldset>
    
    <input type="submit" value="Créer un compte">
</form>

<?php
require 'controllers/registerController.php';
?>