<?php

class User extends baseModels {

    private $user_id = '';
    private $user_name;
    private $user_surname;
    private $user_avatar;
    private $user_gender;
    private $user_presentation;
    private $user_username;
    private $user_password;
    private $user_email;
    private $user_birthdate;
    private $user_creation_date;
    private $user_last_login;
    private $user_status;

    public function __construct() {
        parent::__construct();
    }

//        public function getUser($name, $username) {
//            $resultat = $this->select('id', 'name', 'surname')
//			 ->where('name', $name)
//			 ->andWhere('surname', $username)
//			 ->execute();
//            return $resultat;
//        }
//        
//        public function getAllUsers() {
//            $resultat = $this->select('id', 'name', 'surname')
//			 ->execute();
//            return $resultat;
//        }

    public function test() {
        $query = $this->rowCountByIdUser($_SESSION["user_id"], "serie_user", "su_id_user");
//        $query = $this->select()
//                ->from(array("u" => "user"), array("user_id", "user_name"))
//                ->where("u.user_id", "=", 11)
//                ->join(array("su" => "serie_user"), array(), "u.user_id = su.su_id_user")
//                ->join(array("s" => "serie"), array("serie_name"), "su.su_id_serie = s.serie_id")
//                ->execute();
//        $query = $this->count()
//                ->from(array("su" => "serie_user"))
//                ->where("su_id_user", "=", $_SESSION["user_id"])
//                ->execute();
        return $query;
    }

    public function getUserByUsername($username) {
        $query = $this->select()
                ->from(array("u" => "user"), array("user_id", "user_password", "user_status"))
                ->where("u.user_username", "=", $username)
                ->execute();
        return $query;
    }

    public function getUserById($user_id) {
        $query = $this->select()
                ->from(array("u" => $this->table), array("user_id", "user_name", "user_surname", "user_avatar", "user_gender", "user_username", "user_email", "user_birthdate", "user_creation_date", "user_last_login"))
                ->where("user_id", "=", $user_id)
                ->execute();

        return $query;
    }

    // Modifie la date de dernière connexion de l'utilisateur par la date actuelle lorsqu'il se connecte
    function updateLastLogin($data_update, $id) {
        $this->update($data_update)
                ->where("user_id", "=", $id)
                ->execute_objet();
    }

    // Vérifie l'existence de l'adresse email dans la bdd pour un utilisateur
    // Retourne 0 si le mail n'existe pas et 1 si il existe
    function isEmailExists($email) {
        $query = $this->select()
                ->from(array("u" => "user"), array("user_id", "user_email"))
                ->where("user_email", "=", $email)
                ->execute();

        if (empty($query)) {
            return 0;
        } else {
            return 1;
        }
    }

    function isUsernameExists($username) {
        $query = $this->select()
                ->from(array("u" => "user"), array("user_id", "user_username"))
                ->where("user_username", "=", $username)
                ->execute();

        if (empty($query)) {
            return 0;
        } else {
            return 1;
        }
    }

    function addUser($data) {
        $user = new User();
        // Ajout d'un avatar par défaut en fonction du genre de l'utilisateur
        if ($data["user_gender"] == 1) {
            $data["user_avatar"] = 'avatar/avatar_woman.png';
        } else {
            $data["user_avatar"] = 'avatar/avatar_man.png';
        }

        $data["user_creation_date"] = date("Y-m-d");
        $user->insert($data);
    }

    // Fonction de calcul de l'âge, date en paramètre au format mm/dd/yyyy
    function age($date) {
        $dna = strtotime($date);
        $now = time();

        $age = date('Y', $now) - date('Y', $dna);
        if (strcmp(date('md', $dna), date('md', $now)) > 0) {
            $age--;
        }

        return $age;
    }
    
    // Retourne le nombre de lignes dans une table pour un id utilisateur
    // $user_id : chaine contenant l'id de l'utilisateur
    // $table : chaine contenant la table SQL
    // $column : chaine contenant la colonne de la table qui contient l'id de l'utilisateur
    public function rowCountByIdUser($user_id, $table, $column) {
        $query = $this->count()
                ->from(array($table))
                ->where("$column", "=", $user_id)
                ->execute();
        
        return $query;
                
    }
    
    // GETTER AND SETTER
    //Id
    public function setId($user_id) {
        $this->user_id = $user_id;
    }

    public function getId() {
        return $this->user_id;
    }

    //Name
    public function setName($user_name) {
        $this->user_name = $user_name;
    }

    public function getName() {
        return $this->user_name;
    }

    //Surname
    public function setSurname($user_surname) {
        $this->user_surname = $user_surname;
    }

    public function getSurname() {
        return $this->user_surname;
    }

    //Avatar
    public function setAvatar($user_avatar) {
        $this->user_avatar = $user_avatar;
    }

    public function getAvatar() {
        return $this->user_avatar;
    }

    //Gender
    public function setGender($user_gender) {
        $this->user_gender = $user_gender;
    }

    public function getGender() {
        return $this->user_gender;
    }

    //Presentation
    public function setPresentation($user_presentation) {
        $this->user_presentation = $user_presentation;
    }

    public function getPresentation() {
        return $this->user_presentation;
    }

    //Username
    public function setUsername($user_username) {
        $this->user_username = $user_username;
    }

    public function getUsername() {
        return $this->user_username;
    }

    //Password
    public function setPassword($user_password) {
        $this->user_password = $user_password;
    }

    public function getPassword() {
        return $this->user_password;
    }

    //Email
    public function setEmail($user_email) {
        $this->user_email = $user_email;
    }

    public function getEmail() {
        return $this->user_email;
    }

    //Birthdate
    public function setBirthdate($user_birthdate) {
        $this->user_birthdate = $user_birthdate;
    }

    public function getBirthdate() {
        return $this->user_birthdate;
    }

    //Creation_date
    public function setCreation_date($user_creation_date) {
        $this->user_creation_date = $user_creation_date;
    }

    public function getCreation_date() {
        return $this->user_creation_date;
    }

    //Last_login
    public function setLast_login($user_last_login) {
        $this->user_last_login = $user_last_login;
    }

    public function getLast_login() {
        return $this->user_last_login;
    }

    //Status
    public function setStatus($user_status) {
        $this->user_status = $user_status;
    }

    public function getStatus() {
        return $this->user_status;
    }

}
