<?php

/**
 * BaseCurso
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $nome
 * @property Doctrine_Collection $Professores
 * @property Doctrine_Collection $Alunos
 * 
 * @method string              getNome()        Returns the current record's "nome" value
 * @method Doctrine_Collection getProfessores() Returns the current record's "Professores" collection
 * @method Doctrine_Collection getAlunos()      Returns the current record's "Alunos" collection
 * @method Curso               setNome()        Sets the current record's "nome" value
 * @method Curso               setProfessores() Sets the current record's "Professores" collection
 * @method Curso               setAlunos()      Sets the current record's "Alunos" collection
 * 
 * @package    TCCtrl
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCurso extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('curso');
        $this->hasColumn('nome', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));

        $this->option('type', 'MyISAM');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Professor as Professores', array(
             'local' => 'id',
             'foreign' => 'curso_id'));

        $this->hasMany('Aluno as Alunos', array(
             'local' => 'id',
             'foreign' => 'curso_id'));
    }
}