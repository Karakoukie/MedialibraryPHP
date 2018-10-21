<form>
    <input hidden name="mainView" value="articles">
    <input hidden name="mediasView" value="0">

    <fieldset>
        <legend>Filtres</legend>

        Type:  
        <select name="type">
            <option value="all">Tout</option>
            <option value="movies">Films</option>
            <option value="musics">Musiques</option>
            <option value="books">Livres</option>
        </select>
        
        
        Titre: <input type='text' name='title' value="">
        <br>
        
        Prix: <input type='number' name='price' placeholder="1.0" min="0.0" max="999" step="1.0">
        
        
        Année: <input type='number' name='year' placeholder="2018" step="1.0">
        
    </fieldset>

    <fieldset>
        <legend>Affichage</legend>

        Nombre de résultats:
            <select name="articleAmount">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option selected>5</option>
                <option>10</option>
                <option>15</option>
            </select>
    </fieldset>   

    <input type='submit' value="Chercher">
</form>

<?php
include 'controllers/moviesArticlesController.php';
?>