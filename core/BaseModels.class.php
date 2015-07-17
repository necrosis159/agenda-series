<?php

class baseModels {

    protected $pdo;
    protected $table;
    protected $columns = [];
    private $query = '';
    private $select = "";
    private $columns_select = array();
    private $from = "";
    private $where = "";
    private $order = "";
    private $limit = "";
    private $select_subquery = "";
    private $columns_subquery = array();
    private $from_subquery = "";
    private $where_subquery = "";

    //initialisation
    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=agendaserie;charset=utf8', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->table = get_called_class();
        } catch (Exception $e) {
            die("Erreur BDD " . $e->getMessage());
        }
    }

    public function insert($data = array(), $table = NULL) {
        if ($table == NULL) {
            $table = $this->table;
        }

        foreach ($data as $key => $value) {
            $sql_columns[] = "'" . $value . "'";
        }

        $query = $this->pdo->prepare('INSERT INTO ' . strtolower($table) . '(' . implode(",", array_keys($data)) . ') VALUES (' . implode(",", $sql_columns) . ')');
        $query->execute();
    }

    public function update($data = array(), $table = NULL) {
        if ($table == NULL) {
            $table = $this->table;
        }

        foreach ($data as $key => $value) {
            $set[] = "$key = '$value' ";
        }

        $this->query = 'UPDATE ' . strtolower($this->table) . ' SET ' . implode(" , ", $set);
        return $this;
    }

    public function delete($table, $params = array()) {
        foreach ($params as $key => $value) {
            $set[] = "$key = '$value' ";
        }

        $query = $this->pdo->prepare("DELETE FROM $table WHERE " . implode("AND ", $set));
        $query->execute();
    }

    public function selectAll() {

        $this->query = 'SELECT * FROM ' . strtolower($this->table);
        return $this;
    }

    public function selectObject() {
        $args = func_get_args();
        //on verifie si les paramètres entré existe
        foreach ($args as $value) {
            if (property_exists($this, $value))
                $data[] = $value;
        }
        if (isset($data))
            if (sizeof($data) > 1)
                $this->query = 'SELECT ' . implode(", ", $data) . ' FROM ' . strtolower($this->table);
            else
                $this->query = 'SELECT ' . $data[0] . ' FROM ' . strtolower($this->table);

        return $this;
    }

    public function count() {
        $this->select = "SELECT COUNT(*)";

        return $this;
    }

    public function select() {
        $this->select = "SELECT ";

        return $this;
    }

    public function selectDistinct() {
        $this->select = "SELECT DISTINCT ";

        return $this;
    }

    // Fonction select pour les requêtes imbriquées
    public function select_subquery() {
        $this->select_subquery = "(SELECT ";
        return $this;
    }

    // $table : tableau contenant en clé le préfixe et en valeur le nom de la table
    // ou juste en valeur le nom de la table (si requête sur une seule table)
    // $columns : tableau contenant les champs de la table SQL que l'on veut récupérer
    public function from($table = array(), $columns = array()) {
        $keys = array_keys($table);
        $alias = $keys[0];

        if ($alias == "0") {
            $this->from = " FROM " . $table[0];
            foreach ($columns as $column) {
                $this->columns_select[] = $column;
            }
        } else {
            $this->from = " FROM " . $table[$alias] . " " . $alias;
            foreach ($columns as $column) {
                $this->columns_select[] = $alias . "." . $column;
            }
        }
        return $this;
    }

    // Fonction from pour les requêtes imbriquées
    public function from_subquery($table = array(), $columns = array()) {
        $keys = array_keys($table);
        $alias = $keys[0];

        if ($alias == "0") {
            $this->from_subquery = " FROM " . $table[0];
            foreach ($columns as $column) {
                $this->columns_subquery[] = $column;
            }
        } else {
            $this->from_subquery = " FROM " . $table[$alias] . " " . $alias;
            foreach ($columns as $column) {
                $this->columns_subquery[] = $alias . "." . $column;
            }
        }
        return $this;
    }

    // $table : tableau contenant en clé le préfixe et en valeur le nom de la table
    // $columns : tableau contenant les champs de la table SQL que l'on veut récupérer
    // $jointure : chaine content la jointure entre les tables
    public function join($table = array(), $columns = array(), $jointure) {
        $keys = array_keys($table);
        $alias = $keys[0];
        $this->from .= ', ' . $table[$alias] . " " . $alias;
        if (count($columns) > 0) {
            foreach ($columns as $column) {
                $this->columns_select[] = $alias . "." . $column;
            }
        }
        $this->where .= " AND " . $jointure;

        return $this;
    }

    //execute la requète
    public function executeObject() {
        $req = $this->pdo->prepare($this->query . $this->where . $this->limit);
//        var_dump($this->query.$this->where);die();
        $req->execute();

        $this->query = "";
        $this->select = "";
        $this->from = "";
        $this->where = "";
        $this->order= "";
        $this->limit= "";
        $this->columns_select = array();

        $data = $req->fetchAll(PDO::FETCH_CLASS, $this->table);
        return $data;
    }

    public function execute() {
        $columns = implode(",", $this->columns_select);
        $columns_subquery = implode(",", $this->columns_subquery);
        $this->query = $this->select . $columns . $this->from . $this->where . $this->order . $this->limit . $this->select_subquery . $columns_subquery . $this->from_subquery . $this->where_subquery;
        $req = $this->pdo->prepare($this->query);
//        var_dump($this->query);
        $req->execute();

        $this->query = "";
        $this->select = "";
        $this->from = "";
        $this->where = "";
        $this->order = "";
        $this->limit = "";
        $this->columns_select = array();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    
    public function where($col, $operator, $val = null, $escape = true) {
        return $this->addWhere('WHERE', $col, $operator, $val, $escape);
    }

    // Fonction where pour les requêtes imbriquées
    public function where_subquery($key, $col, $operator, $val = null, $escape = true) {
        if ($val === null) {
            $val = $operator;
            $operator = '=';
        }

        if (!in_array($operator, ['=', '!=', '<', '<=', '>', '>=', 'LIKE'])) {
            $operator = '=';
        }

        //on adapte la syntaxe correctement
        if ($operator === 'LIKE') {
            $val = "%$val%";
        }

        //echappement des variables.
        if ($escape) {
            $val = $this->pdo->quote($val);
        }


        $this->where_subquery .= " $key $col $operator $val )";
        return $this;
    }

    public function andWhere($col, $operator, $val = null, $escape = true) {
        return $this->addWhere('AND', $col, $operator, $val, $escape);
    }

    public function orWhere($col, $operator, $val = null, $escape = true) {
        return $this->addWhere('OR', $col, $operator, $val, $escape);
    }

    public function addWhere($key, $col, $operator, $val = null, $escape = true) {
//        if ($val === null) {
//            $val = $operator;
//            $operator = '=';
//        }
        if (!in_array($operator, ['=', '!=', '<', '<=', '>', '>=', 'LIKE', 'NOT IN', 'IN'])) {
            $operator = '=';
        }

        //on adapte la syntaxe correctement
        if ($operator === 'LIKE') {
            $val = "%$val%";
        }

        //echappement des variables.
        if ($escape) {
            $val = $this->pdo->quote($val);
        }


        $this->where .= " $key $col $operator $val";
        return $this;
    }
    
    public function order($order) {
        $this->order = " ORDER BY " . $order;
        return $this;
    }
    
    public function limit($start,$quantity)
    {
        $this->limit = " LIMIT $start , $quantity ";
        return $this;
    }

    // Fonction in_array pour tableaux mutlidimentionnels
    function inArrayMulti($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->inArrayMulti($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }
}
