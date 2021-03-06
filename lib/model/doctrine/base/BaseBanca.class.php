<?php

/**
 * BaseBanca
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $aluno_id
 * @property integer $professor_id_1
 * @property integer $professor_id_2
 * @property integer $professor_id_3
 * @property datetime $data_banca
 * @property Aluno $Aluno
 * @property Professor $Avaliador1
 * @property Professor $Avaliador2
 * @property Professor $Avaliador3
 * @property BancaAvaliacao $Avaliacao
 * 
 * @method integer        getAlunoId()        Returns the current record's "aluno_id" value
 * @method integer        getProfessorId1()   Returns the current record's "professor_id_1" value
 * @method integer        getProfessorId2()   Returns the current record's "professor_id_2" value
 * @method integer        getProfessorId3()   Returns the current record's "professor_id_3" value
 * @method datetime       getDataBanca()      Returns the current record's "data_banca" value
 * @method Aluno          getAluno()          Returns the current record's "Aluno" value
 * @method Professor      getAvaliador1()     Returns the current record's "Avaliador1" value
 * @method Professor      getAvaliador2()     Returns the current record's "Avaliador2" value
 * @method Professor      getAvaliador3()     Returns the current record's "Avaliador3" value
 * @method BancaAvaliacao getAvaliacao()      Returns the current record's "Avaliacao" value
 * @method Banca          setAlunoId()        Sets the current record's "aluno_id" value
 * @method Banca          setProfessorId1()   Sets the current record's "professor_id_1" value
 * @method Banca          setProfessorId2()   Sets the current record's "professor_id_2" value
 * @method Banca          setProfessorId3()   Sets the current record's "professor_id_3" value
 * @method Banca          setDataBanca()      Sets the current record's "data_banca" value
 * @method Banca          setAluno()          Sets the current record's "Aluno" value
 * @method Banca          setAvaliador1()     Sets the current record's "Avaliador1" value
 * @method Banca          setAvaliador2()     Sets the current record's "Avaliador2" value
 * @method Banca          setAvaliador3()     Sets the current record's "Avaliador3" value
 * @method Banca          setAvaliacao()      Sets the current record's "Avaliacao" value
 * 
 * @package    TCCtrl
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseBanca extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('banca');
        $this->hasColumn('aluno_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('professor_id_1', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('professor_id_2', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('professor_id_3', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('data_banca', 'datetime', null, array(
             'type' => 'datetime',
             'notnull' => true,
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

        $this->hasOne('Professor as Avaliador1', array(
             'local' => 'professor_id_1',
             'foreign' => 'id'));

        $this->hasOne('Professor as Avaliador2', array(
             'local' => 'professor_id_2',
             'foreign' => 'id'));

        $this->hasOne('Professor as Avaliador3', array(
             'local' => 'professor_id_3',
             'foreign' => 'id'));

        $this->hasOne('BancaAvaliacao as Avaliacao', array(
             'local' => 'id',
             'foreign' => 'banca_id'));
    }
}