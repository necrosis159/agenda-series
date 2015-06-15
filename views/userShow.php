<?php 
//Affichage de l'objet user qui est un tableau (même avec un seul élément)
if(!empty($user))
{
	echo $user[0]->name;
	echo $user[0]->surname;
}
else
{
	echo 'Aucun utilisateur trouve';
}