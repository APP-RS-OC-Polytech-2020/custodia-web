# Client web de Custodia

Le client web est codé en PHP 5.2.1 et est utilisable sur des serveurs PHP <= 5.6.
Depuis PHP 5.5.0, l'extension MySQL utilisée dans le projet est devenu obsolète. Si une version PHP > 5.5.0 est utilisée, des messages d'avertissements sont affichées. Il est possible de contourner ce problème en désactivant l'affichage des avertissements (`php -S localhost:8080 -display_errors=0` ou `@mysql_pconnect(...)`).

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
