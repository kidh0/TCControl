<?php

/**
 * Professor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    TCCtrl
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Professor extends BaseProfessor
{
    public function __toString()
    {
        return $this->getNome();
    }
    
    public function getOrientacaoCount($aceito = false)
    {
        $count = 0;
        foreach($this->Orientacao as $orientacao){
            if($orientacao->aceito) {
                $count++;
            }
        }
        
        return $count;
    }
}
