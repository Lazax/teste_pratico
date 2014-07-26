<?php
class AtividadesController extends AppController {
    public $helpers = array ('Html','Form', 'Time');
    public $name = 'Atividades';
    public $components = array('Session');

    public function index(){

    }

    public function gerenciarAtividade($id = null){
    	if($this->request->is('post') || $this->request->is('put')):
    		$data = $this->request->data;

	    	$data['Atividade']['data'] = date("Y-m-d H:i:s", strtotime($data['Atividade']['data']));
			
    		if($this->Atividade->save($data)):
    			$mensagem = 'A ação foi execultada com sucesso.';
                $info_redirect = array('action' => 'index');
    		else:
    			$mensagem = 'Ocorreu um erro. Tente novamente.';
                $info_redirect = array('action' => 'adicionarAtividade');
    		endif;

    		$this->Session->setFlash($mensagem);
            $this->redirect($info_redirect);
        elseif($this->request->is('get') && $id != null):
        	$this->Atividade->id = $id;
        	$this->request->data = $this->Atividade->read();
        	$this->set('atividade_id', $id);
    	endif;
    }

}