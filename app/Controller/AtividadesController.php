<?php
class AtividadesController extends AppController {
    public $helpers = array ('Html','Form', 'Time');
    public $name = 'Atividades';
    public $components = array('Session');

    public function index($mes = null, $ano = null){
    	if($mes == null || $ano == null):
    		$mes = date('m');
    		$ano = date('Y');
    	endif;

    	$qtd_dias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
		$atividades = $this->getAtividadesMes($mes, $ano);	

    	$this->set('lista_atividades', $atividades);
    	$this->set('info_calendario', array('qtd_dias'=>$qtd_dias, 'mes'=>$mes, 'ano'=>$ano));	
    }

    public function gerenciarAtividade($id = null){
    	if($this->request->is('post') || $this->request->is('put')):
    		$data = $this->request->data;

	    	$data['Atividade']['data'] = $this->formatarData($data['Atividade']['data']);
			
    		if($this->Atividade->save($data)):
    			$mensagem = '<div class="alert alert-success" role="alert">A ação foi execultada com sucesso.</div>';
                $info_redirect = array('action' => 'index');
    		else:
    			$mensagem = '<div class="alert alert-danger" role="alert">Ocorreu um erro. Tente novamente.</div>';
                $info_redirect = array('action' => 'adicionarAtividade');
    		endif;

    		$this->Session->setFlash($mensagem);
            $this->redirect($info_redirect);
        elseif($this->request->is('get') && $id != null):
        	$this->Atividade->id = $id;
        	$this->request->data = $this->Atividade->read();
        	$this->request->data['Atividade']['data'] = $this->formatarDataApresentacao($this->request->data['Atividade']['data']);
        	
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

    public function ajaxExcluirAtividade($atividade_id){
    	$this->autoRender = false;

    	if($this->Atividade->delete($atividade_id)):
    		echo json_encode('true');
    	else:
    		echo json_encode('false');
    	endif;
    }

    private function formatarData($data){
    	if($data == '') return '';

    	$data = explode("/", $data);
		return $data[2]."-".$data[1]."-".$data[0];
    }

    private function formatarDataApresentacao($data){
    	if($data == '') return '';

    	$data = explode(" ", $data);
    	$data = explode("-", $data[0]);
    	return $data[2]."/".$data[1]."/".$data[0];
    }

}