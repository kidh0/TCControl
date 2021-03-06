<?php

/**
 * arquivo actions.
 *
 * @package    TCCtrl
 * @subpackage arquivo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class arquivoActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('Arquivo')->findArquivos($this->getUser()->getAttribute('id', null, 'usuario'), true);
        $this->pager = new sfDoctrinePager('Arquivo', sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->arquivos = $this->pager->getResults();
    }
    
    public function executeAll(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('Arquivo')->findTodosArquivos(true);
        $this->pager = new sfDoctrinePager('Arquivo', sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->arquivos = $this->pager->getResults();
    }

    public function executeNew(sfWebRequest $request)
    {
        if($this->getUser()->hasCredential('aluno')){
            $this->form = new ArquivoForm();
            $this->form->setDefault('remetente_id', $this->getUser()->getAttribute('id', null, 'usuario'));
            //recupera o orientador
            $aluno = Doctrine::getTable('Aluno')->findOrientacao($this->getUser()->getAttribute('id', null, 'usuario'));
            $this->form->setDefault('destinatario_id', $aluno->Professor->id);
        } else {
            $this->form = new ArquivoProfessorForm();
            $this->form->setDefault('remetente_id', $this->getUser()->getAttribute('id', null, 'usuario'));            
        }
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = ($this->getUser()->hasCredential('aluno')) ? new ArquivoForm() : new ArquivoProfessorForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($arquivo = Doctrine::getTable('Arquivo')->find(array($request->getParameter('id'))), sprintf('Object arquivo does not exist (%s).', $request->getParameter('id')));
        $this->form = new ArquivoForm($arquivo);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($arquivo = Doctrine::getTable('Arquivo')->find(array($request->getParameter('id'))), sprintf('Object arquivo does not exist (%s).', $request->getParameter('id')));
        $this->form = $this->form = ($this->getUser()->hasCredential('aluno')) ? new ArquivoForm($arquivo) : new ArquivoProfessorForm($arquivo);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $this->forward404Unless($arquivo = Doctrine::getTable('Arquivo')->find(array($request->getParameter('id'))), sprintf('Object arquivo does not exist (%s).', $request->getParameter('id')));
        unlink(sfConfig::get('sf_upload_dir') . '/arquivo/' . $arquivo->path);
        $arquivo->delete();

        $this->getUser()->setFlash('success', 'Arquivo excluído com sucesso!');

        $this->redirect('arquivo/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()){
            $arquivo = $form->save();

            $this->getUser()->setFlash('success','Arquivo ' . ($form->isNew() ? 'incluído' : 'alterado') . ' com sucesso!');
            $this->redirect('arquivo/index');
        }
    }
}
