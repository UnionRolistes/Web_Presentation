#!python
import re

from discord import Webhook, RequestsWebhookAdapter
import discord
from discord.embeds import Embed
import cgi
import cgitb
from importlib import resources
# Logging
cgitb.enable(display=0, logdir="d:/wamp64/logs/cgi")
# Getting form data
# form = cgi.FieldStorage()

def get_payload(_form: cgi.FieldStorage) -> str:
    """ Process form data to create webhook payload. """
    res = ""
    with open("pres_template.txt", 'r', encoding='utf-8') as f:
        for line in f:
            # checks line is not a comment
            if not re.match(" *#", line):
                res += line.format(
                    pseudo=f"<@{_form['user_id'].value}> [{_form['pseudo'].value}]",
                    region=_form['region'].value,
                    city=_form['ville'].value,
                    age=_form['age'].value if _form.getvalue('age') else _form['trancheAge'].value,
                    experience=_form['experience'].value,
                    origin=_form['connaissance'].value,
                    hobby=_form['hobby'].value,
                    mj_pj=_form['typeJoueur'].value,
                    jdr=_form['JDR'].value,
                    i_like=_form['like'].value,
                    i_dislike=_form['dislike'].value,
                    availability=_form['dispos'].value,
                    jobs=_form['job'].value,
                    other=_form['autre'].value,
                    free_expression=_form['expression'].value,
                    news='Oui' if _form.getvalue('news') else 'Non',
                    gn='Oui' if _form.getvalue('gn') else 'Non'
                )
    return res


def get_webhook_url(_form: cgi.FieldStorage) -> str:
    return _form['webhook_url'].value


if __name__ == '__main__':
    try:
        form = cgi.FieldStorage()
        webhook = Webhook.from_url(get_webhook_url(form), adapter=RequestsWebhookAdapter())
        webhook.send(get_payload(form))
    except Exception as e:
        print("Content-Type: text/html")    # HTML is following
        print()
        print(cgitb.html(e))
    else:
        # Redirects to main page
        print("Status: 303 See other")
        print("Location: http://93.11.4.50.nip.io")
        print()