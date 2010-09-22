<?php

/**
 * BaseProposta
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $aluno_id
 * @property string $titulo
 * @property string $descricao_problema
 * @property string $descricao_solucao
 * @property string $objetivos
 * @property enum $status
 * @property Aluno $Aluno
 * @property Doctrine_Collection $Cronograma
 * 
 * @method integer             getAlunoId()            Returns the current record's "aluno_id" value
 * @method string              getTitulo()             Returns the current record's "titulo" value
 * @method string              getDescricaoProblema()  Returns the current record's "descricao_problema" value
 * @method string              getDescricaoSolucao()   Returns the current record's "descricao_solucao" value
 * @method string              getObjetivos()          Returns the current record's "objetivos" value
 * @method enum                getStatus()             Returns the current record's "status" value
 * @method Aluno               getAluno()              Returns the current record's "Aluno" value
 * @method Doctrine_Collection getCronograma()         Returns the current record's "Cronograma" collection
 * @method Proposta            setAlunoId()            Sets the current record's "aluno_id" value
 * @method Proposta            setTitulo()             Sets the current record's "titulo" value
 * @method Proposta            setDescricaoProblema()  Sets the current record's "descricao_problema" value
 * @method Proposta            setDescricaoSolucao()   Sets the current record's "descricao_solucao" value
 * @method Proposta            setObjetivos()          Sets the current record's "objetivos" value
 * @method Proposta            setStatus()             Sets the current record's "status" value
 * @method Proposta            setAluno()              Sets the current record's "Aluno" value
 * @method Proposta            setCronograma()         Sets the current record's "Cronograma" collection
 * 
 * @package    TCCtrl
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProposta extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('proposta');
        $this->hasColumn('aluno_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('titulo', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('descricao_problema', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('descricao_solucao', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('objetivos', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
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
        $this->hasOne('Aluno', array(
             'local' => 'aluno_id',
             'foreign' => 'id'));

        $this->hasMany('Cronograma', array(
             'local' => 'id',
             'foreign' => 'proposta_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}