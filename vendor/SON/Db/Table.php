<?php

namespace SON\Db;
use SON\Di\Container;

abstract class Table {
    protected $db;
    protected $table;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    abstract protected function _insert(array $data);
    
    abstract protected function _update(array $data);


    public function save(array $data) {
        if(!isset($data['id'])){
           return $this->_insert($data);
            
            
        } else {
           return $this->_update($data);      
        }
        
    }
    
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROm {$this->table} where id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("Delete FROm {$this->table} where id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return true;
    }
    
    public function fetchAll() {
        $stmt = $this->db->prepare("SELECT * FROm {$this->table} ");

        $stmt->execute();
        return $stmt->fetchAll();
        
    }
} 
