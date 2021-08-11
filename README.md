# Web_Presentation :
Permet à un utilisateur de remplir un formulaire de présentation, via la commande $prez, qui sera ensuite mis en forme suivant un modèle (cgi/pres_template.txt) et posté sur Discord


# Installation
Pour une 1ère installation : 
"cd /usr/local/src && sudo git clone https://github.com/UnionRolistes/Bot_Base && cd Bot_Base && sudo bash updateBot.sh"
sudo nano /var/www/html/Web_Presentation/php/config.php.default" --> Remplir ce fichier avec le Client ID, Secret ID et Redirect_URI du Bot, trouvable sur Discord developer (https://discord.com/developers/applications)

sudo nano /etc/apache2/sites-available/200-UR_Prez.conf --> Remplacer "serverName presentation.unionrolistes.fr" (ligne 9) par la redirection saisie sur votre hébergeur en ligne


Pour une mise à jour :
"cd /usr/local/src/Bot_Base && sudo git checkout . && sudo git pull && sudo bash updateBot.sh"
