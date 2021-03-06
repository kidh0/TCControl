<?php

/**
 * orientacao actions.
 *
 * @package    TCCtrl
 * @subpackage orientacao
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orientacaoActions extends sfActions
{
    public function executeOrientadorList(sfWebRequest $request)
    {
        
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('Professor')->createQuery('a');
        $this->pager = new sfDoctrinePager('Professor',sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->professors= $this->pager->getResults();
        
        $aluno = Doctrine::getTable('Aluno')->find($this->getUser()->getAttribute('id',null,'usuario'));
        if($aluno->Orientacao[0]->Professor->id != null){
            if($aluno->Orientacao[0]->status == 0){
                $this->getUser()->setFlash('info','Sua solicitação de orientação do professor(a) ' . $aluno->Orientacao[0]->Professor->nome . ' está aguardando aprovação',false);
            } else if($aluno->Orientacao[0]->status == 1) {
                $this->getUser()->setFlash('info','Sua solicitação de orientação do professor(a) ' . $aluno->Orientacao[0]->Professor->nome . ' foi aprovada',false);
            } else if($aluno->Orientacao[0]->status == 2) {
                $this->getUser()->setFlash('info','Sua solicitação de orientação do professor(a) ' . $aluno->Orientacao[0]->Professor->nome . ' foi rejeitada',false);
            }
        }        
    }

    public function executeSemOrientadorList(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('Aluno')->findAlunoSemOrientador($this->getUser()->getAttribute('curso',null,'usuario'));
        $this->pager = new sfDoctrinePager('Aluno', sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->alunos = $this->pager->getResults();
    }
    
    public function executeEscolherOrientador(sfWebRequest $request)
    {
        $this->aluno = Doctrine::getTable('Aluno')->find($request->getParameter('aluno_id'));
        
        $this->orientacao = Doctrine::getTable('Orientacao')->findOneByAlunoId($request->getParameter('aluno_id'));
                
        $this->form = new OrientacaoForm($this->orientacao);        
        if($request->isMethod(sfRequest::POST) OR $request->isMethod(sfRequest::PUT)){
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));                        
            if($this->form->isValid()){
                
                $this->form->save();
                $this->getUser()->setFlash('success', 'Orientador ' . ($request->isMethod(sfRequest::POST) ? 'selecionado' : 'alterado') . ' com sucesso.', false);
            } 
        } else {
            $this->form->setDefault('aluno_id', $request->getParameter('aluno_id'));
        }
    }
    
    public function executeOrientandosCoordenadorList(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        
        $query = Doctrine::getTable('Orientacao')->findOrientacoesPendentes(
            $this->getUser()->getAttribute('curso',null,'usuario'),
            $this->getUser()->getAttribute('alunos_por_professor',null,'configuracao'),
            false
        );
        
        $this->pager = new sfDoctrinePager('Orientacao',sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->orientacoes = $this->pager->getResults();

        $this->showActions = true;
        
    }

    public function executeOrientandosList(sfWebRequest $request)
    {
        switch($request->getParameter('filtro')){
        case 'aguardando':
            $status = array(0);

            break;
        case 'aprovado':
            $status = array(1);

            break;
        case 'rejeitado':
            $status = array(2);

            break;
        default:
            $status = array(0,1,2);
        }
        
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        
        $query = Doctrine_Core::getTable('Orientacao')->findAlunosOrientacao(
            $this->getUser()->getAttribute('id',null,'usuario'),
            $status,
            false
        );
        
        $this->pager = new sfDoctrinePager('Orientacao',sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->alunos = $this->pager->getResults();

        $this->showActions = true;
        if(!$this->getUser()->getAttribute('coordenador',false,'professor')){
            $orientacoes = Doctrine_Core::getTable('Orientacao')->findOrientacoes($this->getUser()->getAttribute('id',null,'usuario'),null,1);
            if(count($orientacoes) >= $this->getUser()->getAttribute('alunos_por_professor',0,'configuracao')){
                $this->getUser()->setFlash('warning', 'Seu número de orientandos atingiu o valor máximo definido pelo professor coordenador, o aceite deverá ser efetuado por ele.', false);
                $this->showActions = false;
            }
        } else if(in_array(1,$status) OR in_array(2,$status)){
            $this->showActions = false;
        }
    }

    public function executeSolicitar(sfWebRequest $request)
    {
        //verifica se o aluno ainda nao solicitou uma orientacao
        $orientacao = Doctrine_Core::getTable('Aluno')->findOrientacao($this->getUser()->getAttribute('id', null, 'usuario'));
        if(!$orientacao){
            $orientacao = new Orientacao();
            $orientacao->aluno_id = $this->getUser()->getAttribute('id', null, 'usuario');
            $orientacao->professor_id = $request->getParameter('professor_id');
            $orientacao->save();
            
            //recupera o numero de orientacoes que o professor tem
            $orientacoes = Doctrine_Core::getTable('Orientacao')->findOrientacoes($request->getParameter('professor_id'),null,1);
            if(count($orientacoes) > $this->getUser()->getAttribute('alunos_por_professor',0,'configuracao')){            
                $this->getUser()->setFlash('warning', 'O número de orientandos do professor excedeu o limite máximo. Sua solicitação será analisada pelo coordenador do curso.');
            } else {
                $this->getUser()->setFlash('success', 'Orientação solicitada com sucesso! Aguarde a decisão do professor.');
            }
        } else {
            if($orientacao->status == 0){
                $this->getUser()->setFlash('error', 'Você não pode solicitar uma nova orientação porque você já tem uma aguardando aceitação');
            } else {
                $this->getUser()->setFlash('error', 'Você não pode solicitar uma nova orientação porque você já está sendo orientado por um professor');
            }
            
        }

        $this->redirect('@orientador_list');
    }
    
    public function executeUpdateStatus(sfWebRequest $request)
    {
        $orientacao = Doctrine_Core::getTable('Orientacao')->findOrientacao(
            $this->getUser()->getAttribute('id',null,'usuario'), 
            $request->getParameter('aluno_id')
        );
        
        if($request->getParameter('acao') == 'aceitar'){
            $orientacao->status = 1;
            $this->getUser()->setFlash('success','Solicitação de orientação aceita com sucesso!');
        } else {
            $orientacao->status = 2;
            $this->getUser()->setFlash('success','Solicitação de orientação rejeitada com sucesso!');
        }
        
        $orientacao->save();
        $this->redirect('@orientandos_list?filtro=aguardando');
    }
}   
