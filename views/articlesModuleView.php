<section class="panel-white">
    <form>
        <input hidden name="page" value="connection">
        
        <fieldset>
            <legend>Filtres</legend>
            
            Type:  
            <select name="type">
                <option value="movies">Films</option>
                <option value="musics">Musiques</option>
                <option value="books">Livres</option>
            </select>
        </fieldset>
        
        <input type='submit' value="Chercher">
    </form>
</section>

<?php
require 'controllers/articleModuleController.php';