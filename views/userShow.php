<?php 
//Affichage de l'objet user qui est un tableau (même avec un seul élément)
var_dump($user);
//get_object_vars($user);
//if(!empty($user))
//{
//	echo $user[0]->getName();
//	echo $user[0]->getSurname();
//        echo $user[0]->getQuery();
//}
//else
//{
//	echo 'Aucun utilisateur trouve';
//}
//
//foreach($users as $un_user) {
//    echo $un_user->getName();
//}
//var_dump($users);
foreach($user as $line) {
    echo $line['user_id'];
}
?>