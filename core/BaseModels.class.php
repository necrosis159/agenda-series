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
    private $select2 = "";
    private $columns_select2 = array();
    private $from2 = "";
    private $where2 = "";

    //initialisation
    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=agenda", "root", "");
            $this->table = get_called_class();
        } catch (Exception $e) {
            die("Erreur BDD " . $e->getMessage());
        }
    }

    public function insert($args) {

        foreach ($args as $key => $value) {
            $sql_columns[] = ":" . $key;
        }

        //requete
        $request = $this->pdo->prepare('INSERT INTO ' . strtolower($this->table) . '(' . implode(",", array_keys($args)) . ') VALUES (' . implode(",", $sql_columns) . ')');
//        var_dump($request);die();
        $success = $request->execute($args);
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

    public function select2() {
        $this->select2 = "(SELECT ";
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

    public function from2($table = array(), $columns = array()) {
        $keys = array_keys($table);
        $alias = $keys[0];

        if ($alias == "0") {
            $this->from2 = " FROM " . $table[0];
            foreach ($columns as $column) {
                $this->columns_select2[] = $column;
            }
        } else {
            $this->from2 = " FROM " . $table[$alias] . " " . $alias;
            foreach ($columns as $column) {
                $this->columns_select2[] = $alias . "." . $column;
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
        $req = $this->pdo->prepare($this->query . $this->where);
//        var_dump($this->query.$this->where);die();
        $req->execute();

        $this->query = "";
        $this->select = "";
        $this->from = "";
        $this->where = "";
        $this->columns_select = array();

        $data = $req->fetchAll(PDO::FETCH_CLASS, $this->table);
        return $data;
    }

    public function execute() {
        $columns = implode(",", $this->columns_select);
        $columns2 = implode(",", $this->columns_select2);
        $this->query = $this->select . $columns . $this->from . $this->where . $this->select2 . $columns2 . $this->from2 . $this->where2;
//        var_dump($this->query); die();
        $req = $this->pdo->prepare($this->query);
        $req->execute();

        $this->query = "";
        $this->select = "";
        $this->from = "";
        $this->where = "";
        $this->columns_select = array();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);

      //   if (!empty($result)) {
      //       if (count($result) > 1) {
      //           return $result;
      //       } else {
      //           return $result[0];
      //       }
      //   }

        return $result;
    }

    public function where($col, $operator, $val = null, $escape = true) {
        return $this->addWhere('WHERE', $col, $operator, $val, $escape);
    }

    public function where2($key, $col, $operator, $val = null, $escape = true) {
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


        $this->where2 .= " $key $col $operator $val )";
        return $this;
    }

    public function andWhere($col, $operator, $val = null, $escape = true) {
        return $this->addWhere('AND', $col, $operator, $val, $escape);
    }

    public function orWhere($col, $operator, $val = null, $escape = true) {
        return $this->addWhere('OR', $col, $operator, $val, $escape);
    }

    public function addWhere($key, $col, $operator, $val = null, $escape = true) {
//        var_dump($operator);die();
//        if ($val === null) {
//            $val = $operator;
//            $operator = '=';
//        }
        if (!in_array($operator, ['=', '!=', '<', '<=', '>', '>=', 'LIKE', 'NOT IN'])) {
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

    public function update($args) {
        $set = [];
        foreach ($args as $key => $value) {
            $set[] = "$key = '$value' ";
        }

        $this->query = 'UPDATE ' . strtolower($this->table) . ' SET ' . implode(" , ", $set);
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
