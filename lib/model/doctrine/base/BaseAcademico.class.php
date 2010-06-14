<?php

/**
 * BaseAcademico
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $matricula
 * @property string $endereco
 * @property string $fone_residencial
 * @property string $fone_celular
 * 
 * @method string    getMatricula()        Returns the current record's "matricula" value
 * @method string    getEndereco()         Returns the current record's "endereco" value
 * @method string    getFoneResidencial()  Returns the current record's "fone_residencial" value
 * @method string    getFoneCelular()      Returns the current record's "fone_celular" value
 * @method Academico setMatricula()        Sets the current record's "matricula" value
 * @method Academico setEndereco()         Sets the current record's "endereco" value
 * @method Academico setFoneResidencial()  Sets the current record's "fone_residencial" value
 * @method Academico setFoneCelular()      Sets the current record's "fone_celular" value
 * 
 * @package    TCCtrl
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAcademico extends Usuario
{
    public function setTableDefinition()
    {
        parent::setTableDefinition();
        $this->setTableName('academico');
        $this->hasColumn('matricula', 'string', 20, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 20,
             ));
        $this->hasColumn('endereco', 'string', 200, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 200,
             ));
        $this->hasColumn('fone_residencial', 'string', 20, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 20,
             ));
        $this->hasColumn('fone_celular', 'string', 20, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 20,
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