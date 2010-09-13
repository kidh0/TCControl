<?php

/**
 * professor actions.
 *
 * @package    TCCtrl
 * @subpackage professor
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class professorActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('Professor')->createQuery('a');
        $this->pager = new sfDoctrinePager('Professor',sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->professors= $this->pager->getResults();

    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new ProfessorCoordenadorForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new ProfessorCoordenadorForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($professor = Doctrine::getTable('Professor')->find(array($request->getParameter('id'))), sprintf('Object professor does not exist (%s).', $request->getParameter('id')));
        $this->form = new ProfessorCoordenadorForm($professor);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($professor = Doctrine::getTable('Professor')->find(array($request->getParameter('id'))), sprintf('Object professor does not exist (%s).', $request->getParameter('id')));
        $this->form = new ProfessorCoordenadorForm($professor);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $this->forward404Unless($professor = Doctrine::getTable('Professor')->find(array($request->getParameter('id'))), sprintf('Object professor does not exist (%s).', $request->getParameter('id')));
        $professor->delete();

        $this->getUser()->setFlash('success', 'Professor excluído com sucesso!');
        $this->redirect('professor/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()){
            $professor = $form->save();
            $this->getUser()->setFlash('success','Professor alterado com sucesso!');
            $this->redirect('professor/edit?id='.$professor->getId());
        } else {
            $this->getUser()->setFlash('error', 'O formulário contém erros!',false);
        }        
    }
}
