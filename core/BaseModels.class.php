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

    //initialisation
    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=agendaseltserie", "root", "");
            $this->table = get_called_class();
        } catch (Exception $e) {
            die("Erreur BDD " . $e->getMessage());
        }
    }

    public function insert() {

        //Récupérer les variables de la class enfant
        $data = get_object_vars($this);
        //retirer les variables inutile
        unset($data['pdo']);
        unset($data['table']);
        unset($data['query']);
        unset($data['columns']);

        foreach ($data as $key => $value) {
            $sql_columns[] = ":" . $key;
        }

        //requete
        $request = $this->pdo->prepare('INSERT INTO ' . strtolower($this->table) . '(' . implode(",", array_keys($data)) . ') VALUES (' . implode(",", $sql_columns) . ')');
        $success = $request->execute($data);
    }

    public function selectAll() {

        //Récupérer les variables le la class enfant
        $data = get_object_vars($this);
        unset($data['pdo']);
        unset($data['table']);
        unset($data['query']);
        unset($data['columns']);

        foreach ($data as $key => $value) {
            $sql_columns[] = ":" . $key;
        }

        $this->query = 'SELECT * FROM ' . strtolower($this->table);
        return $this;
    }

//    public function select() {
//        $args = func_get_args();
//        //on verifie si les paramètres entré existe
//        foreach ($args as $value) {
//            if (property_exists($this, $value))
//                $data[] = $value;
//        }
//        if (isset($data))
//            if (sizeof($data) > 1)
//                $this->query = 'SELECT ' . implode(", ", $data) . ' FROM ' . strtolower($this->table);
//            else
//                $this->query = 'SELECT ' . $data[0] . ' FROM ' . strtolower($this->table);
//
//        return $this;
//    }

    public function select() {
        $this->select = "SELECT ";

        return $this;
    }
    
    public function from($table = array(), $columns = array()) {
        $keys = array_keys($table);
        $alias = $keys[0];
        $this->from = " FROM " . $table[$alias] . " " . $alias ;
        foreach($columns as $column) {
            $this->columns_select[] = $alias . "." . $column;
        }
        return $this;
    }
    
    public function join($table = array(), $columns = array(), $jointure) {
        $keys = array_keys($table);
        $alias = $keys[0];
        $this->from .= ', ' . $table[$alias] . " " . $alias;
        if(count($columns) > 0) {
            foreach($columns as $column) {
                $this->columns_select[] = $alias . "." . $column;
            }
            $this->where .= " AND ".$jointure;
        }
        
        return $this;
    }
    
    //execute la requète
//    public function execute() {
//        $req = $this->pdo->prepare($this->query);
//        $req->execute();
//
//        $data = $req->fetchAll(PDO::FETCH_CLASS, $this->table);
//        return $data;
//    }
    
    public function execute() {
        $columns = implode(",", $this->columns_select);
        $this->query = $this->select . $columns . $this->from . $this->where;
//        var_dump($this->query);die();
        $req = $this->pdo->prepare($this->query);
        $req->execute();

        $result = $req->fetchAll();
        $data = array_unique($result[0]);
        return $data;
    }

    public function where($col, $operator, $val = null, $escape = true) {
        return $this->addWhere('WHERE', $col, $operator, $val, $escape);
    }

    public function andWhere($col, $operator, $val = null, $escape = true) {
        return $this->addWhere('AND', $col, $operator, $val, $escape);
    }

    public function orWhere($col, $operator, $val = null, $escape = true) {
        return $this->addWhere('OR', $col, $operator, $val, $escape);
    }

    public function addWhere($key, $col, $operator, $val = null, $escape = true) {
        if ($val === null) {
            $val = $operator;
            $operator = '=';
        }

        if (!in_array($operator, ['=', '<', '<=', '>', '>=', 'LIKE'])) {
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

    public function update() {
        $set = [];
        $args = func_get_args();
        /* foreach ($tabdata as $key => $value) {
          $set[] = "$key = '$value'";
          }

          $this->query = 'UPDATE '.strtolower($this->table).' SET '.implode(" , ", $set);
          return $this; */
    }

    public function getQuery() {
        return $this->query;
    }

}
