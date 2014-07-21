<?php

class indexTest extends PHPUnit_Extensions_SeleniumTestCase {
    public static $browsers = array(
        array(
            'name'=> 'Firefox',
            'browser'=>'*firefox',
            'timeout'=>10000,
            'host'=>'localhost'
        )
        
    );
    
    public function setUp() {
        
        $this->setBrowserUrl('http://127.0.0.1:8081');
    }
    
    public function title() {
        
        $this->open('/artigos');
        $this->assertTitle('SON Framework');
    }
    
    public function testVerificaSeConsegueInseirRegistro() {
        $this->open("/artigos");
        $this->click("adicionar");
        $this->type("nome", "Teste S");
        $this->type("descricao", "Descrição ssS");
        $this->click("submit");
        $this->waitForPageToLoad(1000);
        $this->assertEquals("Dados Inseridos com sucesso!", $this->getText("//div[@class='alert alert-success']/p"));
        
    }
    
    public function testGeral() {
        $this->title();
    }
}
