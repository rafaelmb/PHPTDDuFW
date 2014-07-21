<?php
use SON\Di\Container;

class ArticleTest extends PHPUnit_Framework_TestCase {
    
    private $model;
    
    public function setUp() {
        $this->model = Container::getClass("Article");
        $db = new \PDO("mysql:host=local.dev;port=33066;dbname=phptdd", "root", "vagrant");
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $db->exec("truncate table article");
        
    }
    
    public function testVerificaTipoDoObjeto() {
        $this->assertInstanceOf("App\Models\Article", $this->model);
        
    }
    
    public function testVerificaSeConsegueInserirRegistro() {
        $data['nome'] = "Artigo Teste";
        $data['descricao'] = "Artigo teste descrição";
        
        $this->assertEquals(1, $this->model->save($data));
        $this->assertEquals(2, $this->model->save($data));
    }
    
    public function testVerificaSeInsereRegistroSemDados() {
        $data = array();
        try{
        $this->model->save($data);
        $this->fail("Não pode inserir com dados em branco");
        }
        catch(\Exception $e) {
        
        }
    }
    
    /**
     * @depends testVerificaSeConsegueInserirRegistro
     */
    public function testVerificaSeConsegueAlterarRegistro() {
        $data['nome'] = "Artigo Teste";
        $data['descricao'] = "Artigo teste descrição";
        $this->model->save($data);
        
        $data['id'] = 1;
        $data['nome'] = "Artigo alterado nome";
        $data['descricao'] = "Artigo alterado descrição";
        
        $this->assertEquals(1,$this->model->save($data));
    }
    
    public function testVerificaSeConsegueSelecionarAlgumRegistro() {
        $data['nome'] = "Artigo Teste";
        $data['descricao'] = "Artigo teste descrição";
        $this->model->save($data);
        
        $data['nome'] = "Artigo Teste 2";
        $data['descricao'] = "Artigo teste descrição 2";
        $this->model->save($data);
        
        $this->assertEquals("Artigo Teste", $this->model->find(1)['nome']);
        $this->assertEquals("Artigo Teste 2", $this->model->find(2)['nome']);
        
    }
    
    public function testVerificaSeConsegueRemoverRegistro() {
        $data['nome'] = "Artigo Teste";
        $data['descricao'] = "Artigo teste descrição";
        $this->model->save($data);
        
        $this->assertTrue($this->model->delete(1));
        
    }
    
    public function testVerificaSeConsegueListarRegistros() {
        $data['nome'] = "Artigo Teste";
        $data['descricao'] = "Artigo teste descrição";
        $this->model->save($data);
        
        $data['nome'] = "Artigo Teste 2";
        $data['descricao'] = "Artigo teste descrição 2";
        $this->model->save($data);
        
        $this->assertEquals("Artigo Teste", $this->model->fetchAll()[0]['nome']);
        $this->assertEquals("Artigo Teste 2", $this->model->fetchAll()[1]['nome']);
        
    }
    
}