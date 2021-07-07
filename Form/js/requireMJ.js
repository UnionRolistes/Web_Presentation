
function chgMjRequire(){ //Force qu'au moins MJ ou PJ soit coché

	if(document.getElementById('PJ').checked){ //Si on a choisi PJ
		document.getElementById('MJ').required = false;//Alors MJ n'est plus obligatoire
	}
    else{
        document.getElementById('MJ').required = true;
    }

}
