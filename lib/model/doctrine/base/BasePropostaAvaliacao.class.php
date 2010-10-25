<?php

/**
 * BasePropostaAvaliacao
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $proposta_id
 * @property boolean $aprovada
 * @property string $parecer
 * @property Proposta $Proposta
 * 
 * @method integer           getPropostaId()  Returns the current record's "proposta_id" value
 * @method boolean           getAprovada()    Returns the current record's "aprovada" value
 * @method string            getParecer()     Returns the current record's "parecer" value
 * @method Proposta          getProposta()    Returns the current record's "Proposta" value
 * @method PropostaAvaliacao setPropostaId()  Sets the current record's "proposta_id" value
 * @method PropostaAvaliacao setAprovada()    Sets the current record's "aprovada" value
 * @method PropostaAvaliacao setParecer()     Sets the current record's "parecer" value
 * @method PropostaAvaliacao setProposta()    Sets the current record's "Proposta" value
 * 
 * @package    TCCtrl
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePropostaAvaliacao extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('proposta_avaliacao');
        $this->hasColumn('proposta_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('aprovada', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             ));
        $this->hasColumn('parecer', 'string', null, array(
             'type' => 'string',
             ));

        $this->option('type', 'MyISAM');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Proposta', array(
             'local' => 'proposta_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}