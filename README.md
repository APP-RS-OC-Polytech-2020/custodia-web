# Client web de Custodia

Le client web est codé en PHP 5.2.1 et est utilisable sur des serveurs PHP <= 5.6.

## Structure
Le code du site web est réparti en plusieurs parties :   
- **docs** : documentation JS et PHP
- **public** : contient les fichiers à accès public (JS, CSS, images, PDF)
- **ressources** : contient les ressources utiles au système (JSON)
- **src** : contient les fichiers à accès privé

## Librairies
Deux libraries sont actuellement utilisées :
- nipplejs (https://github.com/yoannmoinet/nipplejs) pour la gestion du joystick virtuel
- snackbarjs (https://www.polonel.com/snackbar/) pour la gestion des snackbar

## Connexion au site
Le site ne contient pour le moment qu'un seul utilisateur enregistré sous le pseudonyme *admin* et le mot de passe *admin*.
