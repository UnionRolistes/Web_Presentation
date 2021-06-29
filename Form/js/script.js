function save()
{
	localStorage.setItem("text", document.getElementById("desc").value); //Permet de stocker le contenu de la description
}

function Alert()
{
	document.getElementById("alert").innerHTML="<div class='uk-alert-success' uk-alert > <a class='uk-alert-close' uk-close ></a> <p>Votre formulaire a bien été pris en compte.</p></div>"
}

function chgMode()
{
	if (document.getElementById("mode").innerHTML == "Clair ☀")
	{
		document.getElementById("mode").innerHTML = "Sombre 🌙";

		var oldlink1 = document.getElementsByTagName("link").item(1);
		var newlink1 =  document.createElement("link");
		newlink1.setAttribute("rel", "stylesheet");
		newlink1.setAttribute("href", "css/styleDark.css");
		document.getElementsByTagName("head").item(0).replaceChild(newlink1, oldlink1);
	}
	else
	{
		document.getElementById("mode").innerHTML = "Clair ☀";
		var oldlink1 = document.getElementsByTagName("link").item(1);
		var newlink1 =  document.createElement("link");
		newlink1.setAttribute("rel", "stylesheet");
		newlink1.setAttribute("href", "css/styleLight.css");

		document.getElementsByTagName("head").item(0).replaceChild(newlink1, oldlink1);	
	}
}

function chgAgeDisplay(){ //Change la zone de saisie d'age en menu déroulant pour les tranches d'âge

	if(document.getElementById('checkAge').checked){ //On affiche les tranches

		document.getElementById('age').value=""; //Pour pas que le texte rentré avant de cocher soit compté à l'envoi
		document.getElementById('age').style.display="none";
		document.getElementById('age').required = false;

		document.getElementById('trancheAge').style.display="initial";
		document.getElementById('trancheAge').required = true;
	}
	else{ //On réaffiche l'age

		document.getElementById('trancheAge').value="";
		document.getElementById('trancheAge').style.display="none";
		document.getElementById('trancheAge').required = false;

		document.getElementById('age').style.display="initial";
		document.getElementById('age').required = true;
	}
		
}
