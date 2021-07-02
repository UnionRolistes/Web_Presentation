#!python
import re
import sys

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

def get_payload(form: cgi.FieldStorage) -> str:
    """ Process form data to create webhook payload. """
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