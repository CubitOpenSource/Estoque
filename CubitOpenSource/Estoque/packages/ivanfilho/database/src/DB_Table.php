<?php

namespace IvanFilho\Database;

use \IvanFilho\Database\Database;
use \IvanFilho\Database\DB_Utils;

define("INT", "INT");
define("VARCHAR", "VARCHAR");
define("TEXT", "TEXT");
define("DATE", "DATE");
define("TIME", "TIME");
define("DATETIME", "DATETIME");

define("COMMA", ", ");
define("AND_A", " AND ");
define("BQ", "`"); #Backquote
define("QT", "'"); #Single Quote
define("CL", ":"); #Colon

/**
* Class: DB_Table
* 
* Common operations related to all tables in the database.
*
* @package      IvanFilho
* @subpackage   Database
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: Mar 11, 2019.
* Last Modified: Jun 1, 2019.
*/

class DB_Table
{
    private $db;
    private $columns;
    private $tableName;

    public function __construct($tableName)
    {
        $this->db = Database::getInstance()->db;
        $this->tableName = $tableName;
        $this->columns = array();
    }

    public function getName() { return $this->tableName; }
    
    public function getColumns() { return $this->columns; }
    
    public function addColumn($column) { $this->columns[] = $column; }

    public function findColumn($columnName)
    {
        $column = false;
        foreach ($this->columns as $c) {
            if ($c->getName() === $columnName) {
                $column = $c;
                break;
            }
        }
        return $column;
    }

    public function create()
    {
        $fields = DB_Utils::getFieldsFromColumnArray($this->columns);
        $sql = "CREATE TABLE IF NOT EXISTS " .BQ .$this->tableName .BQ ." (" .$fields .")";
        # echo $sql; die();
        $this->db->query($sql);
    }

    public function drop()
    {
        $sql = "DROP TABLE IF EXISTS " .BQ .$this->tableName .BQ;
        # echo $sql; die();
        $this->db->query($sql);
    }

    public function insert($array)
    {
        $this->prepareValues("insert", $array);
    }

    protected function update($array, $whereColumnArray)
    {
        $this->prepareValues("update", $array, $whereColumnArray);
    }

    protected function delete($whereColumnArray)
    {
        $this->prepareValues("delete", array(), $whereColumnArray);
    }

    private function prepareValues($operation = "", $array = array(), $whereColumnArray = array(), $includePK = false)
    {
        $fields = DB_Utils::getFieldsFromColumnArray($this->columns, $includePK, false);
        $pseudoValues = DB_Utils::getPseudoValuesFromColumnArray($this->columns, $includePK);
        $where = $this->formatWhereClause($whereColumnArray);

        if ($operation == "insert")
            $sql = "INSERT INTO";
        elseif ($operation == "update")
            $sql = "UPDATE";
        elseif ($operation == "delete")
            $sql = "DELETE FROM";
        else
            return false;

        $sql .= " " .BQ .$this->tableName .BQ;
        if (is_array($array) && count($array) > 0)
            $sql .= " SET " .$pseudoValues;
        $sql .= $where;
        # echo $sql ."<br>"; die();
        $sql = $this->db->prepare($sql);

        foreach ($array as $key => $value) {
            $column = $this->findColumn($key);
            if (! $includePK && $column->getKey() == "PRIMARY KEY") {
                continue;
            }
            $columnName = $this->findColumn($key)->getName();
            $sql->bindValue(CL .$columnName, $value);
            # echo CL .$columnName . " = " . $value . "<br>";
        }

        if (is_array($whereColumnArray) && count($whereColumnArray) > 0) {
            foreach ($whereColumnArray as $column) {
                $sql->bindValue(CL .$column->getName(), $column->getValue());
                #  echo CL .$column->getName() . " = " . $column->getValue() . "<br>"  ;
            }
        }        

        $sql->execute();
    }

    private function formatWhereClause($columnArray = "")
    {
        $clause = "";

        if (! empty($columnArray)) {
            $clause .= " WHERE ";
            foreach ($columnArray as $column) {
                $clause .= BQ .$column->getName() .BQ ." = " .CL .$column->getName() .AND_A;
            }
            $clause = DB_Utils::removeLastString($clause, AND_A);
        }
        return $clause;
    }
}