<?php

/**
 * PropostaTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PropostaTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PropostaTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Proposta');
    }

    public function findPropostaByProfessor($professor, $status = null, $execute = true) {
        $q = $this->createQuery()
           ->from('Proposta p')
           ->innerJoin('p.Aluno a')
           ->innerJoin('a.Orientacao o')
           ->where('o.professor_id = ?', $professor);

        switch($status){
        case 'aguardando':
            $q->innerJoin('p.Avaliacao aval');
            $q->where('aval.aprovada is null');

            break;
        case 'aprovado':
            $q->innerJoin('p.Avaliacao aval WITH aval.aprovada = true');

            break;
        case 'rejeitado':
            $q->innerJoin('p.Avaliacao aval WITH aval.aprovada = false');

            break;
        }

        if($execute){
            return $q->execute();
        } else {
            return $q;
        }
    }

    public function findPropostaCronogramas($proposta)
    {
        $q = $this->createQuery()
           ->from('Proposta p')
           ->leftJoin('p.Cronogramas c')
           ->leftJoin('p.Comentarios co')
           ->where('p.id = ?', $proposta)
           ->orderBy('c.etapa ASC, c.data_entrega ASC');

        return $q->fetchOne();
    }
    
    public function findPropostaAluno($aluno, $lidos = true)
    {
        $q = $this->createQuery()
           ->from('Proposta p')
           ->leftJoin('p.Cronogramas c')
           ->leftJoin('p.Comentarios co WITH co.lido = ?', $lidos)
           ->where('p.aluno_id = ?', $aluno)
           ->orderBy('c.etapa ASC, c.data_entrega ASC');

        return $q->fetchOne();
    }
    
    public function findPropostaComentarios($proposta, $local, $lidos = true)
    {
        $q = $this->createQuery()
           ->from('Proposta p')
           ->leftJoin('p.Cronogramas c')           
           ->leftJoin('p.Comentarios co WITH co.local = ? AND co.lido = ?', array($local, $lidos))
           ->where('p.id = ?', $proposta)       
           ->orderBy('c.etapa ASC, c.data_entrega ASC');

        return $q->fetchOne();
    }
    
    public function findPropostasAlunos($execute = true) 
    {
        $q = $this->createQuery()
           ->from('Proposta p')
           ->innerJoin('p.Aluno a')
           ->leftJoin('p.Avaliacao av');
        
        if($execute){
            $q->execute();
        }
           
        return $q;
    }
}
