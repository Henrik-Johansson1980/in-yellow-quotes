<?php

class Database {
  private $db_host = 'localhost';
  private $db_user = 'root';
  private $db_password = '';
  private $db_name = 'inyellowquotes';

  protected $db_handler;
  protected $statement;

  public function __construct() {
    try{
      $this->db_handler = new PDO("mysql:host=".$this->db_host.";dbname=". $this->db_name , $this->db_user, $this->db_password);
    } catch(PDOException $e){
      echo '<div class="alert alert-danger">'.get_class($e).' on line: '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
    }
  }

  public function query($query) {
    try{
      $this->statement = $this->db_handler->prepare($query);
    } catch(Error $e){
      echo '<div class="alert alert-danger">'.get_class($e).' on line: '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
    }
  }
  
  public function bind($param, $value, $type = null) {
    if(is_null($type)) {
      switch (true) {
        case  is_int($value):
          $type = PDO::PARAM_INT;
        break;
        case  is_bool($value):
          $type = PDO::PARAM_BOOL;
        break;
        case  is_null($value):
          $type = PDO::PARAM_NULL;
        break;
        default: 
          $type = PDO::PARAM_STR;
        break;
      }
    }
    $this->statement->bindValue($param, $value, $type);
  }

  public function execute() {
    try{
      $this->statement->execute();
    } catch(Error $e){
      echo '<div class="alert alert-danger">'.get_class($e).' on line: '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
    }
  }
  
  //Get a single row
  public function single() :array {
    try {
      $this->statement->execute();
      return $this->statement->fetch(PDO::FETCH_ASSOC);
    } catch (Error $e){
      echo '<div class="alert alert-danger">'.get_class($e).' on line: '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
    }
  }
  
  public function lastInsertId() {
    return $this->db_handler->lastInsertId();
  }
  
  public function resultSet() :array {
    try {
      $this->execute();
      return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    } catch ( Error $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' on line: '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
    }
  }

}