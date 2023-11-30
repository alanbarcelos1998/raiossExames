<?php

namespace App\Core;

use Exception;

class Core
{
    private $action = 'index';
    private $controller = 'ExamController';
    
    function __construct($url)
    {
        try {
            if(isset($url['page'])){
                $this->controller = ucfirst($url['page'].'Controller');
            }

            if(isset($url['method'])){
                $this->action = $url['method'];
            }

            
            if(!class_exists($this->controller)){
                $this->controller = 'ErrorController';
            }
            
            if (isset($url['id']) && $url['id'] != null) {
				call_user_func_array(array(new $this->controller, $this->action), array('id' => $url['id']));
			} else {
                call_user_func_array(array(new $this->controller, $this->action), array()); 
			}   
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
    }
}
