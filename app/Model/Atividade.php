<?php

class Atividade extends AppModel {
    public $name = 'Atividades';

    public $validate = array(
    	'titulo' => array(
    		'rule'=>'notEmpty'
    	),
    	'data' => array(
    		'rule'=>'notEmpty'
    	),
    	'descricao' => array(
    		'rule' => 'notEmpty'
    	)
    );
}