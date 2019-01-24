# Installation
SrpinkDomus - Gestion de l'arrosage avec eedomus  
  

    
### Les principes
  
SprinkDomus permet de piloter des zones d'arrosage, manuellement ou de mani�re programm�e.  
Une installation du plugin correspond � une zone d'arrosage (repr�sent�e par son num�ro).  
Pour une zone donn�e, vous pouvez piloter 1 � 3 vannes d'arrosage.  



  

### Ajout des p�riph�riques
Cliquez sur "Configuration" / "Ajouter ou supprimer un p�riph�rique" / "Store eedomus" / "SprinkDomus" / "Cr�er"  

  
*Voici les diff�rents champs � renseigner:*

* [Obligatoire] - Le num�ro de Zone, par d�faut � 1  
* [Obligatoire] - La vanne � piloter, dans vos p�riph�riques actionneurs eedomus  
* [Obligatoire] - la valeur de fermeture de la vanne, par d�faut 0  
* [Obligatoire] - la valeur d'ouverture de la vanne (arrosage), par d�faut 100 
* [Optionnel]   - Le p�riph�rique capteur d'humidit� (du sol � arroser)  
* [Optionnel]   - Le p�riph�rique capteur de pr�cipitations  
* [Optionnel]   - Le p�riph�rique de pr�vision de pr�cipitations  

    
  
  
### Utilisation
  
S�lectionnez le mode:  
  
* Manuel - Lancement de l'arrosage � la demande, pour la dur�e d�finie  
* Arr�t  - Arr�t � tout moment de l'arrosage en cours  
* Auto 1 - Arrosage automatique, en fonction de la programmation (Agenda, horaires) 
* Auto 2 - Arrosage automatique, en fonction de la programmation et si l'humidit� est en dessous du seuil (en [VAR3])  
* Auto 3 - Arrosage automatique, en fonction de la programmation et s'il n'y a pas eu de pr�cipations  
* Auto 4 - Arrosage automatique, en fonction de la programmation et si l'humidit� est en dessous du seuil et s'il n'y a pas eu de pr�cipations    
* Auto 5 - Arrosage automatique, en fonction de la programmation et s'il n'y a pas eu de pr�cipations ni pr�vision de pluie  
  
Pour d�finir une programmation, s�lectionnez l'agenda, l'horaire 1 d'arrosage et la dur�e 1 d'arrosage.
Vous pouvez ajouter/modifier des valeurs d'agenda, ex "LUN-JEU".  
Vous pouvez ajouter/modifier des horaires.  
Vous pouvez ajouter/modifier des dur�es.  
Vous pouvez param�trer un deuxi�me horaire (deux arrosages par jour) via le p�riph�rique "horaire 2". 
Si vous n'utilisez pas de deuxi�me horaire, s�lectionnez la valeur "--:--".  

Vous pouvez modifier le seuil d'humidit� minimale en VAR3 du p�riph�rique Statut (par d�faut � 50).   
Vous pouvez ajouter une ou deux autres vannes en VAR1, en respectant le format suivant : PeriphID,ValeurFERMEE,ValeurOUVERTE  
Exemple pour trois vannes : 1,123456,0,100,222222,0,100,333333,0,100  
Le premier chiffre �tant le num�ro de zone obligatoire.  
  
  
Apr�s chaque changement dans les donn�es de programmation (Agenda, Dur�e, Horaires, VAR1, VAR2, VAR3), il faut res�lectionner le mode souhait� pour que les modifications soient pris en compte.  				 
   
   
   
   
Influman 2019  
therealinfluman@gmail.com  
[Paypal Me](https://www.paypal.me/influman "paypal.me")  


  



 

 

  


