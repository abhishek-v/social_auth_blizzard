Clone the repository onto your Drupal modules folder.

Add the following line in the requirements field of the the composer.json of Drupal root directory:

"depotwarehouse/oauth2-bnet": "^5.0"

Save and run: composer update
Enable social API, social auth and social_auth_blizzard modules in the Extend tab of Drupal.

In https://develop.battle.net/access/clients, create a new client. Copy Client ID and Client secret to social_auth_blizzard settings.
Copy the redirect URI to the battle.net client settings.

Now the blizzard authentication is set. drupalsiteroot/user/login/blizzard allows users to login through blizzard. The login block can also be set in the "Structure" menu.
