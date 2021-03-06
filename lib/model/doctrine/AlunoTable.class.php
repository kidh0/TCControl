<?php


class AlunoTable extends AcademicoTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Aluno');
    }

    public function findOrientacao($aluno) 
    {
        $q = $this->createQuery()
           ->from('Orientacao o')
           ->innerJoin('o.Professor p')
           ->where('o.aluno_id = ?', $aluno)
           ->fetchOne();

        return $q;
    }

    public function findAlunoSemOrientador($curso, $execute = true) 
    {
        $q = $this->createQuery()
           ->from('Aluno a')
           ->where('NOT EXISTS (SELECT o.aluno_id FROM Orientacao o WHERE o.aluno_id = a.id AND status IN (0,1))');
        
        if($execute){
            $q->execute();
        }
           
        return $q;
    }
    
    public function findAlunosMatriculados($execute = true) 
    {
        $q = $this->createQuery()
           ->from('Aluno a')
           ->innerJoin('a.Etapas et');
        
        if($execute){
            $q->execute();
        }
           
        return $q;
    }
    
    public function findAlunosBanca($execute = true) 
    {
        $q = $this->createQuery()
           ->from('Aluno a')
           ->innerJoin('a.Banca b')
           ->innerJoin('b.Avaliador1 av1')
           ->innerJoin('b.Avaliador2 av2')
           ->innerJoin('b.Avaliador3 av3')
           ->leftJoin('b.Avaliacao av');
        
        if($execute){
            $q->execute();
        }
           
        return $q;
    }
}
