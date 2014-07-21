<?php

namespace App\Models;

use SON\Db\Table;

class Article  extends Table {
    
    protected $table = "article";
    

    protected function _insert(array $data) {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (nome, descricao) VALUES (:nome, :descricao)");
        $stmt->bindParam(":nome", $data['nome']);
        $stmt->bindParam(":descricao", $data['descricao']);
        $stmt->execute();
        return $this->db->lastInsertId();
        
    }
    
    protected function _update(array $data) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET nome = :nome, descricao = :descricao WHERE id = :id");
        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":nome", $data['nome']);
        $stmt->bindParam(":descricao", $data['descricao']);
        $stmt->execute();
        return $data['id'];
    }


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