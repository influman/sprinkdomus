# Installation
SrpinkDomus - Gestion de l'arrosage avec eedomus  
  

    
### Les principes
  
SprinkDomus permet de piloter des zones d'arrosage, manuellement ou de manière programmée.  
Une installation du plugin correspond à une zone d'arrosage (représentée par son numéro).  
Pour une zone donnée, vous pouvez piloter 1 à 3 vannes d'arrosage.  



  

### Ajout des périphériques
Cliquez sur "Configuration" / "Ajouter ou supprimer un périphérique" / "Store eedomus" / "SprinkDomus" / "Créer"  

  
*Voici les différents champs à renseigner:*

* [Obligatoire] - Le numéro de Zone, par défaut à 1  
* [Obligatoire] - La vanne à piloter, dans vos périphériques actionneurs eedomus  
* [Obligatoire] - la valeur de fermeture de la vanne, par défaut 0  
* [Obligatoire] - la valeur d'ouverture de la vanne (arrosage), par défaut 100 
* [Optionnel]   - Le périphérique capteur d'humidité (du sol à arroser)  
* [Optionnel]   - Le périphérique capteur de précipitations  
* [Optionnel]   - Le périphérique de prévision de précipitations  

    
  
  
### Utilisation
  
Sélectionnez le mode:  
  
* Manuel - Lancement de l'arrosage à la demande, pour la durée définie  
* Arrêt  - Arrêt à tout moment de l'arrosage en cours  
* Auto 1 - Arrosage automatique, en fonction de la programmation (Agenda, horaires) 
* Auto 2 - Arrosage automatique, en fonction de la programmation et si l'humidité est en dessous du seuil (en [VAR3])  
* Auto 3 - Arrosage automatique, en fonction de la programmation et s'il n'y a pas eu de précipations  
* Auto 4 - Arrosage automatique, en fonction de la programmation et si l'humidité est en dessous du seuil et s'il n'y a pas eu de précipations    
* Auto 5 - Arrosage automatique, en fonction de la programmation et s'il n'y a pas eu de précipations ni prévision de pluie  
  
Pour définir une programmation, sélectionnez l'agenda, l'horaire 1 d'arrosage et la durée 1 d'arrosage.
Vous pouvez ajouter/modifier des valeurs d'agenda, ex "LUN-JEU".  
Vous pouvez ajouter/modifier des horaires.  
Vous pouvez ajouter/modifier des durées.  
Vous pouvez paramétrer un deuxième horaire (deux arrosages par jour) via le périphérique "horaire 2". 
Si vous n'utilisez pas de deuxième horaire, sélectionnez la valeur "--:--".  

Vous pouvez modifier le seuil d'humidité minimale en VAR3 du périphérique Statut (par défaut à 50).   
Vous pouvez ajouter une ou deux autres vannes en VAR1, en respectant le format suivant : PeriphID,ValeurFERMEE,ValeurOUVERTE  
Exemple pour trois vannes : 1,123456,0,100,222222,0,100,333333,0,100  
Le premier chiffre étant le numéro de zone obligatoire.  
  
  
Après chaque changement dans les données de programmation (Agenda, Durée, Horaires, VAR1, VAR2, VAR3), il faut resélectionner le mode souhaité pour que les modifications soient pris en compte.  				 
   
   
   
   
Influman 2019  
therealinfluman@gmail.com  
[Paypal Me](https://www.paypal.me/influman "paypal.me")  


  



 

 

  


