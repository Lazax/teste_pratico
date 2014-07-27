<?php
class AtividadesController extends AppController {
    public $helpers = array ('Html','Form', 'Time');
    public $name = 'Atividades';
    public $components = array('Session');

    public function index($mes = null, $ano = null){
    	if($mes == null || $ano == null):
    		$mes = date('m');
    		$ano = date('Y');
    		$qtd_dias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

			$atividades = $this->getAtividadesMes($mes, $ano);

    		$this->set('lista_atividades', $atividades);
    		$this->set('info_calendario', array('qtd_dias'=>$qtd_dias, 'mes'=>$mes, 'ano'=>$ano));
    		
    	endif;
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

    public function ajaxRemanejarAtividade($atividade_id, $nova_data){
    	$data['Atividade']['id'] = $atividade_id;
    	$data['Atividade']['data'] = $nova_data;
    	$this->autoRender = false;

    	if($this->Atividade->save($data)):
    		echo json_encode('true');
    	else:
    		echo json_encode('false');
    	endif;
    }

    private function getAtividadesMes($mes, $ano){
    	$data_inicio = $ano.'-'.$mes.'-01';
		$condicao = array("Atividade.data BETWEEN '".$data_inicio."' AND DATE_ADD('".$data_inicio."', INTERVAL 30 DAY)");
		
		$lista_atividades = $this->Atividade->find('all', array(
			'conditions'=>$condicao,
			'fields' => array('Atividade.*, DAY(Atividade.data) AS dia'),
		));

		$atividades = array();

		foreach ($lista_atividades as $key => $atividade) :
			$index_dia = $atividade[0]['dia'];
			$atividades[$index_dia][] = $atividade['Atividade'];
		endforeach;

		return $atividades;
    }

}