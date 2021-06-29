<?php //Mettre le html dans un fichier séparé ? ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Le formulaire de présentation</title>

    <link rel="stylesheet" href="css/master.css"> <!--Gère la disposition de la page-->
    <link rel="stylesheet" href="css/styleDark.css"><!--Gère les couleurs-->

    <link rel="icon" type="image/png" href="https://cdn.discordapp.com/attachments/457233258661281793/458727800048713728/dae-cmd.png">
    <script src="js/script.js" ></script>
    
</head>
<body>


<h1 class="titleCenter">Formulaire de présentation</h2>


<form method=post action=# id="URform">
    

    <label id="mode">Sombre 🌙</label>					
    <div>
        <label class="switch">
            <input type="checkbox" onclick="chgMode()">
            <span class="slider round"></span>
        </label>
    </div>

    <label for="region">Région :</label>
        <input type="text" name="region" placeholder="Région" required/>
        <input type="text" name="ville" placeholder="Ville"/>

   

        <label for="age"> </label> 
            
 <fieldset>
    <legend>Age :</legend>
    <label><input type="checkbox" id="checkAge" onclick="chgAgeDisplay()"> Indiquer une tranche d'âge à la place </label>
    <label><input type="number" name="age" id="age" min="1"></label>

    <select name="trancheAge" id="trancheAge" style="display: none">
        <option value="" selected="selected">--Choisir--</option>
        <option value="mineur">Mineur</option>
        <option value="18/25">18/25</option>
        <option value="25/35">25/35</option>
        <option value="35/45">...Voir les tranches avec Dae</option>
    </select>

  </fieldset>


	<label for="phone_number">Ancienneté dans le JDR :</label>
    <input type="text" name="ancienneté" placeholder="Ex : 3 ans"/>


    <label for="connaissance">Comment avez-vous connu le serveur :</label>
    <input type="text" name="connaissance" placeholder="Ex : un ami, groupe Facebook" required/>                               

    <label for="hobby">Hobby :</label>
    <input type="text" name="hobby" id="hobby" placeholder="Lecture, jeux, ...">


    <label for="typeJoueur">MJ/PJ :</label>
    <div>
        <input type="radio" name="typeJoueur" id="MJ" value="MJ">MJ&nbsp&nbsp&nbsp
        <input type="radio" name="typeJoueur" id="PJ" value="PJ">PJ
    </div>

    <label for="JDR">JDR 🎲:</label>
    <input type="text" name="JDR" id="JDR" placeholder="Vos JDR préférés" required>
                        

    <label for="like">J'aime :</label>
    <input type="text" name="like" id="like" placeholder="J'aime">

    <label for="dislike">J'aime pas :</label>
    <input type="text" name="dislike" id="dislike" placeholder="J'aime pas">

    <label for="dispos">Disponibilités :</label>
    <input type="text" name="dispos" id="dispos" placeholder="Quelques soirs, toutes les nuits, ...">

    <label for="job">Jobs :</label>
    <input type="text" name="job" id="job" placeholder="">

    <label for="autre">Autre (votre OS par exemple) :</label>
    <input type="text" name="autre" id="autre" placeholder="">

    <label for="expression">Expression libre :</label>
    <input type="text" name="expression" id="expression" placeholder="">


    <label for="news">Je veux être notifié des news du serveur </label>
    <input type="checkbox">

    <label for="news">Je suis intéressé par du JDR grandeur nature </label>
    <input type="checkbox">


							
	<div>	

	</div>
							
	<div id="submitButtons">	
        <button type="reset">Réinitialiser 🔄</button>	
        <br><br>			
		<button type="submit" style="background-color:#169719;" name="submit" id="submit" onclick="Alert()"><b>Valider ✔</b></button>					
	</div>

	<span style="text-align:center;margin-top:5vh;font-size:14px;color:#990000;font-family:mono;"><b>Attention cet outil est en beta-test</b><br>
    <a href="https://github.com/UnionRolistes/Web_Presentation" uk-icon="icon: github; ratio:1.5">GitHub</a></span>
</form>



</body>

<?php 
    include('php/footer.php');
?>

</html>