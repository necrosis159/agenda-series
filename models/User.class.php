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

    public function test() {
//        $query = $this->selectAll();
//        return $query;
        $query = $this->select()
                ->from(array("u" => "user"), array("user_id", "user_name"))
                ->where("u.user_id", "=", 11)
                ->join(array("su" => "serie_user"), array(), "u.user_id = su.su_id_user")
                ->join(array("s" => "serie"), array("serie_name"), "su.su_id_serie = s.serie_id")
                ->execute();
        return $query;
    }
    
    // Récupère tous les id de tous les utilisateurs du site
    public function getAllIdUser() {
        $query = $this->select()
                ->from(array("u" => "user"), array("user_id"))
                ->execute();
        return $query;
    }
    
    // Récupère toutes les informations concernant un utilisateur par son pseudo
    public function getUserByUsername($username) {
        $query = $this->select()
                ->from(array("u" => "user"), array("user_id", "user_password", "user_status","user_avatar","user_username"))
                ->where("u.user_username", "=", $username)
                ->execute();
        return $query[0];
    }

    // Récupère toutes les informations concernant un utilisateur par son id
    public function getUserById($user_id) {
        $query = $this->select()
                ->from(array("user"), array("user_id", "user_name", "user_surname", "user_avatar", "user_gender", "user_username", "user_email", "user_birthdate", "user_creation_date", "user_last_login", "user_status", "user_newsletter"))
                ->where("user_id", "=", $user_id)
                ->execute();

        return $query[0];
    }

    // Vérifie l'existence de l'adresse email dans la bdd pour un utilisateur
    // Retourne 0 si le mail n'existe pas et 1 si il existe
    function isEmailExists($email) {
        $query = $this->select()
                ->from(array("user"), array("user_id", "user_email"))
                ->where("user_email", "=", $email)
                ->execute();

        if (empty($query)) {
            return 0;
        } else {
            return 1;
        }
    }

    // Vérifie l'existence de l'adresse email dans la bdd pour un utilisateur autre que l'utilisateur en cours
    // Retourne 1 si le mail existe déjà sinon 0
    function isEmailExistsWhenUpdate($id_user, $email) {
        $query = $this->select()
                ->from(array("user"), array("user_id", "user_email"))
                ->where("user_email", "=", $email)
                ->addWhere("AND", "user_id", "!=", $id_user)
                ->execute();

        if (empty($query)) {
            return 0;
        } else {
            return 1;
        }
    }

    // Vérifie l'existence du pseudo
    // Retourne 1 si le pseudo existe déjà sinon 0
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

    // Insère un utilisateur
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

        return $query[0]["COUNT(*)"];
    }

    // Fonction pour éditer n'importe quelle information concernant un utilisateur
    // $user_id : chaine contenant l'id de l'utilisateur
    // $data : tableau contenant en clé le champ à modifier et en valeur la valeur de remplacement
    public function updateUser($id_user, $data) {
        $this->update($data)
                ->where("user_id", "=", $id_user)
                ->executeObject();
    }
    
    // Retourne toutes les séries suivies par un utilisateur
    public function getSeriesByUser($id_user) {
        $query = $this->select()
                ->from(array("u" => "user"), array("user_id", "user_name"))
                ->where("u.user_id", "=", $id_user)
                ->join(array("su" => "serie_user"), array(), "u.user_id = su.su_id_user")
                ->join(array("s" => "serie"), array("serie_id", "serie_name", "serie_image", "serie_notation"), "su.su_id_serie = s.serie_id")
                ->execute();
        return $query;
    }
    
    // Retourne le résultat de la recherche de séries de l'utilisateur en fonction de ce qu'il a entré comme chaine
    // Ne retourne pas les séries déjà suivies par l'utilisateur
    public function searchSeriesFromUser($id_user, $serie_name) {
        $query = $this->select()
                ->from(array("serie"), array("serie_name"))
                ->where("serie_name", "LIKE", $serie_name)
                ->addWhere("AND", "serie_id", "NOT IN", null, false)
                ->select_subquery()
                ->from_subquery(array("serie_user"), array("su_id_serie"))
                ->where_subquery("WHERE", "su_id_user", "=", $id_user)
                ->execute();
        return $query;
    }
    
    // Ajoute une série suivie à l'utilisateur
    public function addSerieToUser($serie_id, $user_id) {
        $data = array(
            "su_id_serie" => $serie_id,
            "su_id_user" => $user_id
        );
        $this->insert($data, "serie_user");
    }

    //Retourne le nom d'un user par son ID
    public function getNameById($id){
        $query = $this->selectObject('user_username')
            ->where('user_id',"=",$id)
            ->executeObject();
        return $query[0]->getUsername();
    }
    
    //Retourne l'avatar par son ID
    public function getAvatarById($id){
        $query = $this->selectObject('user_avatar')
            ->where('user_id',"=",$id)
            ->executeObject();
        return $query[0]->getAvatar();
    }

    //Fonctions pour la newsletter
    //Fonction qui récupère tout les utilisateurs qui sont inscrit a la newsletter : test user_newsletter = 1 et on récupère les ID + Mail
    public function getNewsletter() {
            $query = $this->select()
                    ->from(array("u" =>"user"), array("user_id, user_email, user_surname"))
                    ->where("u.user_newsletter", "=", "1")
                    ->execute();
            return $query;
        }

    //On récupère ensuite les series de chaque user_id

    public function serieUser($user_id) {
            $query = $this->select()
                    ->from(array("u" =>"user", "s" => "serie"))
                    ->where("u.user_id", "=", $user_id)
                    ->join(array("su" => "serie_user"), array(), "u.user_id = su.su_id_user")
                    ->join(array("s" => "serie"), array("serie_id, serie_name"), "su.su_id_serie = s.serie_id")
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
    public function setCreationDate($user_creation_date) {
        $this->user_creation_date = $user_creation_date;
    }

    public function getCreationDate() {
        return $this->user_creation_date;
    }

    //Last_login
    public function setLastLogin($user_last_login) {
        $this->user_last_login = $user_last_login;
    }

    public function getLastLogin() {
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
