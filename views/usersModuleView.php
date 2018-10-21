<section class="panel-white">
    <h3>Utilisateurs</h3>
    
    <form>
        <input hidden name="module" value="users">
        <fieldset>
            <legend>Recherche</legend>
            login: <input name="loginSearch">
        </fieldset>
        <input type="submit" value="Chercher">
    </form>
</section>

<?php
include 'controllers/userModuleController.php';