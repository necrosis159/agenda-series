<?php 
//Affichage de l'objet user qui est un tableau (même avec un seul élément)
var_dump($user);
if(!empty($user))
{
	echo $user[0]->getName();
	echo $user[0]->getSurname();
}
else
{
	echo 'Aucun utilisateur trouve';
}