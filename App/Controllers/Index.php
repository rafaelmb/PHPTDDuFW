<?php

namespace App\Controllers;
use SON\Controller\Action,
        SON\Di\Container,
        SON\Controller\Crud;

class Index extends Action {
    use Crud;
    protected $model = "article";
    
       
}
