<?php

/**
 * BaseProfessor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property Doctrine_Collection $AreasAfinidade
 * @property Doctrine_Collection $AreasInteresse
 * @property Doctrine_Collection $Orientandos
 * @property Curso $Curso
 * @property Doctrine_Collection $ProfessorAreasAfinidade
 * @property Doctrine_Collection $Orientacao
 * 
 * @method Doctrine_Collection getAreasAfinidade()          Returns the current record's "AreasAfinidade" collection
 * @method Doctrine_Collection getAreasInteresse()          Returns the current record's "AreasInteresse" collection
 * @method Doctrine_Collection getOrientandos()             Returns the current record's "Orientandos" collection
 * @method Curso               getCurso()                   Returns the current record's "Curso" value
 * @method Doctrine_Collection getProfessorAreasAfinidade() Returns the current record's "ProfessorAreasAfinidade" collection
 * @method Doctrine_Collection getOrientacao()              Returns the current record's "Orientacao" collection
 * @method Professor           setAreasAfinidade()          Sets the current record's "AreasAfinidade" collection
 * @method Professor           setAreasInteresse()          Sets the current record's "AreasInteresse" collection
 * @method Professor           setOrientandos()             Sets the current record's "Orientandos" collection
 * @method Professor           setCurso()                   Sets the current record's "Curso" value
 * @method Professor           setProfessorAreasAfinidade() Sets the current record's "ProfessorAreasAfinidade" collection
 * @method Professor           setOrientacao()              Sets the current record's "Orientacao" collection
 * 
 * @package    TCCtrl
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProfessor extends Academico
{
    public function setUp()
    {
        parent::setUp();
        $this->hasMany('AreaAfinidade as AreasAfinidade', array(
             'refClass' => 'ProfessorAreaAfinidade',
             'local' => 'professor_id',
             'foreign' => 'area_afinidade_id'));

        $this->hasMany('AreaInteresse as AreasInteresse', array(
             'local' => 'id',
             'foreign' => 'professor_id'));

        $this->hasMany('Aluno as Orientandos', array(
             'refClass' => 'Orientacao',
             'local' => 'professor_id',
             'foreign' => 'aluno_id'));

        $this->hasOne('Curso', array(
             'local' => 'curso_id',
             'foreign' => 'id'));

        $this->hasMany('ProfessorAreaAfinidade as ProfessorAreasAfinidade', array(
             'local' => 'id',
             'foreign' => 'professor_id'));

        $this->hasMany('Orientacao', array(
             'local' => 'id',
             'foreign' => 'professor_id'));
    }
}