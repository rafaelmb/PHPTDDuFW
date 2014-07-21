<?php

namespace App\Models;

class Exemplo {
    
    public function somar($x, $y) {
        if(is_numeric($x) AND is_numeric($y)) {
            return $x + $y;
            
        } else {
            throw new \Exception('Não é numérico');
        }
        
        
    }
    
}
