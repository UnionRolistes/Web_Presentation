<?php
session_start();

if (isset($_GET['webhook']))
    $_SESSION['webhook'] = $_GET['webhook'];


$xml = simplexml_load_file('data/regions.xml'); 
$regions = $xml->region;
//Récupère la liste des régions depuis le xml

$xml = simplexml_load_file('data/tranchesAge.xml'); 
$tranches = $xml->tranche;
//Récupère les tranches d'ages depuis le xml
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Le formulaire de présentation</title>

    <link rel="stylesheet" href="css/master.css"> <!--Gère la disposition de la page-->
    <link rel="stylesheet" href="css/styleDark.css"><!--Gère les couleurs, affichage sombre par défaut-->

    <link rel="icon" type="image/png" href="https://cdn.discordapp.com/attachments/652207549168484352/862019020516622377/ur.png">
    <script src="js/age_switch.js" ></script>
    <script src="js/color_mode_switch.js" ></script>
    <script src="js/requireMJ.js" ></script>
    
</head>
<body>


<h1 class="titleCenter">Formulaire de présentation</h2>

<?php
if (isset($_GET['error'])){ 
//Affichage des erreurs. Rajouter des lignes si on rajoute d'autres codes d'erreurs (optimisable en les mettant dans un fichier si on commence à en avoir beaucoup)
    $error=$_GET['error'];
    if($error=='invalidData') echo 'Données invalides. Veuillez vérifier le formulaire';
    if($error=='isPosted') echo 'Votre présentation a bien été postée'; //--> Pas encore fonctionnel côté Python
} 
?>

<form method=post action="cgi/pres/create_presentation.py" id="URform" onsubmit="alert('Votre présentation a bien été envoyée')">
    <!-- Connection area -->
    <input type=hidden name="webhook_url" value="<?= isset($_SESSION['webhook']) ? $_SESSION['webhook'] : "" ?>">
    <input type=hidden name="user_id" value="<?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ""?>">
    <input type=hidden name="pseudo" value="<?= isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : ""?>">
	<label>Connexion Discord <span class="rouge">*</span></label>
    <?php
        if (isset($_SESSION['avatar_url']) and isset($_SESSION['username'])) {
            echo '<div>';
            echo "<img id='username' src=\"". $_SESSION['avatar_url']."\"/>";      
            echo $_SESSION['username'];
            echo '<input type="button" value="Deconnexion" id="deconnexion" onclick="window.location.href=\'php/logout.php\'"/>';
            echo '</div>';
        } else
            echo '<div><input type="button" value="Me connecter" id="connexion" onclick="window.location.href=\'php/get_authorization_code.php\'"/></div>'
    ?>

    <label id="mode">Sombre 🌙</label>					
    <div>
        <label class="switch">
            <input type="checkbox" onclick="chgMode()">
            <span class="slider round"></span>
        </label>
    </div>


    <label>Région : <span class="rouge">*</span></label>
    <select name="region" id="region" required>
            <option value="" selected>--Choisir--</option>

        <?php foreach ($regions as $i => $region) { ?>         
            <option value="<?=$region?>"><?=$region?></option>
        <?php } ?>           
    </select>
    

    
    <label>Ville :</label>
    <input type="text" name="ville" placeholder="Ville"/>
 
            
    <fieldset>
        <legend>Age : <span class="rouge">*</span></legend>
        <label><input type="checkbox" id="checkAge" onclick="chgAgeDisplay()"> Indiquer une tranche d'âge à la place </label>
        <label><input type="number" name="age" id="age" min="1" max="150" required></label>

        <select name="trancheAge" id="trancheAge" style="display: none">
            <option value="" selected>--Choisir--</option>

            <?php foreach ($tranches as $tranche) { ?>         
            <option value="<?=$tranche?>"><?=$tranche?> ans</option>
            <?php } ?> 

        </select>
    </fieldset>


	<label>Ancienneté dans le JDR :</label>
    <input type="text" name="experience" placeholder="3 ans, initié, ..."/>


    <label>Comment avez-vous connu le serveur : <span class="rouge">*</span></label>
    <input type="text" name="connaissance" placeholder="Association partenaire, groupe Facebook, ..." required/>                               

    <label>Hobby :</label>
    <input type="text" name="hobby" id="hobby" placeholder="Lecture, jeux, ...">


    <label>MJ/PJ : <span class="rouge">*</span></label>
    <div>
        <input type="checkbox" name="typeJoueur" id="MJ" value="MJ" required onclick="chgMjRequire()">MJ&nbsp&nbsp&nbsp
        <input type="checkbox" name="typeJoueur" id="PJ" value="PJ" onclick="chgMjRequire()">PJ
    </div>

    <label>JDR 🎲: <span class="rouge">*</span></label>
    <input type="text" name="JDR" id="JDR" placeholder="Vos JDR préférés" required>
                        

    <label>J'aime :</label>
    <input type="text" name="like" id="like" placeholder="Le JDR, lire, ...">

    <label>J'aime pas :</label>
    <input type="text" name="dislike" id="dislike" placeholder="Rien, les légumes, ...">

    <label>Disponibilités :</label>
    <input type="text" name="dispos" id="dispos" placeholder="Quelques soirs, toutes les nuits, ...">

    <label>Jobs :</label>
    <input type="text" name="job" id="job" placeholder="">

    <label>Autre (votre OS par exemple) :</label>
    <input type="text" name="autre" id="autre" placeholder="">

    <label>Expression libre :</label>
    <input type="text" name="expression" id="expression" placeholder="">


    <label>Je veux être notifié des news autour du JDR </label>
    <input type="checkbox" name="news">

    <label>Je suis intéressé par du JDR grandeur nature </label>
    <input type="checkbox" name="gn">


							
	<div>	
	</div>
							
	<div id="submitButtons">	
        <button type="reset">Réinitialiser 🔄</button>	
        <br><br>			
        <button type="submit" name="submit" id="submit" <?php if (!isset($_SESSION['avatar_url']) and !isset($_SESSION['username'])){echo 'disabled ><b>Veuillez vous connecter';}else{ echo 'style="background-color:#169719;"'?>><b>Valider ✔<?php }?></b></button>					
        <!--Bloque le bouton si on s'est pas connecté-->				
	</div>

	<span class="beta"><b>Attention cet outil est en beta-test</b><br>
    <a href="https://github.com/UnionRolistes/Web_Presentation" uk-icon="icon: github; ratio:1.5">GitHub</a></span>
</form>
<script src="js/record_form.js"></script>



</body>

<?php 
    include('php/footer.php');
?>

</html>