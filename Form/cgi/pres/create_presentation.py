#!python
import re
import sys

from discord import Webhook, RequestsWebhookAdapter
import discord
from discord.embeds import Embed
import cgi
import cgitb
from importlib import resources

import xml.etree.ElementTree as ET # Fonctions pour lire un xml

# Logging
cgitb.enable(display=0, logdir="d:/wamp64/logs/cgi")
# Getting form data
# form = cgi.FieldStorage()


# Verification des données :
def verify_data(form: cgi.FieldStorage) -> str:
    # Verification des champs obligatoires :
    if form.getvalue('region') == "" or form.getvalue('connaissance') == "" or form.getvalue('JDR') == "":
        return False

    if form.getvalue('age') == "" and form.getvalue('trancheAge') == "": # Si aucun des 2 n'est rempli
        return False

    if form.getvalue('age') != "":
        age = form.getvalue('age')
        if not(age.isnumeric()) or age <= 0 or age > 150:
            return False
    else:
        tranche_age = form.getvalue('trancheAge')
        # On vérifie que la tranche corresponde à une qui existe dans le xml :
        is_in_list = False

        with open("../../data/tranchesAge.xml", 'r', encoding='utf-8') as f:
            xml_root = ET.fromstring(f)
            for x in xml_root.findall('tranche'):
                tranche = x.text
                if tranche == tranche_age:
                    is_in_list = True
        if not is_in_list:
            return False

    # On vérifie MJ/PJ :
    if form.getvalue('typeJoueur') != 'MJ' and form.getvalue('typeJoueur') != 'PJ' and form.getvalue('typeJoueur') != "":
        return False


def get_payload(form: cgi.FieldStorage) -> str:
    """ Process form data to create webhook payload. """

    if not verify_data(form): # Si les données sont invalides :
        print("Location: http://93.11.4.50.nip.io?error=invalidData") # Lien à personnaliser avant la mise en ligne ( ../../index.php en lien local)
    else:
        res = ""
        checks = []
        if form.getvalue('news'):
            checks.append("**News: ** ✅")
        if form.getvalue('gn'):
            checks.append("**GN: ** ☑")

        kwargs = {
            'pseudo': f"<@{form['user_id'].value}> [{form['pseudo'].value}]",
            'home': f"{form.getvalue('region')}{' - ' + form.getvalue('ville') if form.getvalue('ville') else ''}",
            'age': form['age'].value if form.getvalue('age') else form['trancheAge'].value,
            'experience': form.getvalue('experience'),
            'origin':  form.getvalue('connaissance'),
            'hobby': form.getvalue('hobby'),
            'mj_pj': form.getvalue('typeJoueur'),
            'jdr': form.getvalue('JDR'),
            'i_like': form.getvalue('like'),
            'i_dislike': form.getvalue('dislike'),
            'availability': form.getvalue('dispos'),
            'jobs': form.getvalue('job'),
            'other': form.getvalue('autre'),
            'free_expression': form.getvalue('expression'),
            'checks': "  **|**  ".join(checks)
        }

    with open("pres_template.txt", 'r', encoding='utf-8') as f:
        for line in f:
            is_empty = True
            is_field = False
            # checks line is not a comment
            if not re.match(" *#", line):
                for match in re.finditer("{([A-Za-z0-9_]*)}", line):
                    is_field = True
                    key = match.group(1)
                    if key in kwargs and kwargs[key]:
                        is_empty = False
                        break

                if not is_empty or not is_field:
                    res += line.format(**kwargs)
    return res


def get_webhook_url(_form: cgi.FieldStorage) -> str:
    return _form['webhook_url'].value

def main():
    try:
        form = cgi.FieldStorage()
        webhook = Webhook.from_url(get_webhook_url(form), adapter=RequestsWebhookAdapter())
        webhook.send(get_payload(form))
    except Exception as e:
        print("Content-Type: text/html")    # HTML is following
        print()
        raise e

        # print(cgitb.html(sys.exc_info()))
    else:
        # Redirects to main page
        print("Status: 303 See other")
        print("Location: http://93.11.4.50.nip.io")
        print()

if __name__ == '__main__':
    main()