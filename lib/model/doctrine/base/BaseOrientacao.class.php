<?php

/**
 * BaseOrientacao
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $aluno_id
 * @property integer $professor_id
 * @property enum $status
 * 
 * @method integer    getAlunoId()      Returns the current record's "aluno_id" value
 * @method integer    getProfessorId()  Returns the current record's "professor_id" value
 * @method enum       getStatus()       Returns the current record's "status" value
 * @method Orientacao setAlunoId()      Sets the current record's "aluno_id" value
 * @method Orientacao setProfessorId()  Sets the current record's "professor_id" value
 * @method Orientacao setStatus()       Sets the current record's "status" value
 * 
 * @package    TCCtrl
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOrientacao extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('orientacao');
        $this->hasColumn('aluno_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('professor_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('status', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 0,
              1 => 1,
              2 => 2,
             ),
             'default' => 0,
             ));

        $this->option('type', 'MyISAM');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}