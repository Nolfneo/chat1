<?php

class View {

    function __construct() {
        
    }
    
    public function generate($view, $model) {
        include Q_PATH.'/application/views/template.php';
    }

}