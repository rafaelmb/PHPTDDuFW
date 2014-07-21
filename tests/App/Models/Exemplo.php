<?php

require '../App/Models/Exemplo.php';

class ExemploTest extends PHPUnit_Framework_TestCase {
    private $model;
    
    public function setUp() {
        $this->model = new App\Models\Exemplo();
    }
    
    public function testVerificaTipoDoObjeto() {
        $this->assertInstanceOf("App\Models\Exemplo", $this->model);
    }
    
    public function testVerificaSepodeSomar() {
        $this->assertEquals(2,  $this->model->somar(1,1));
        $this->assertEquals(3, $this->model->somar(1,2));
    }
    
    public function testVerificaSeAsEntradasSaoNumeros() {
        try {
            $result = $this->model->somar(1, 'a');
        } catch (Exception $ex) {
            $this->assertEquals('Não é numérico', $ex->getMessage());

        }
    }
    
    

}
