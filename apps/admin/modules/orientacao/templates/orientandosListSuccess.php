<h2>Orientandos</h2>
<h3>Listagem</h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<table>
    <thead>
        <tr>
            <?php if($sf_user->getAttribute('coordenador', false, 'professor')):?>
            <th>Professor</th>
            <?php endif; ?>
            <th>Nome</th>            
            <th>Status</th>
            <th class="actions">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($alunos as $aluno): ?>
        <tr>
            <?php if($sf_user->getAttribute('coordenador', false, 'professor')):?>
            <td><?php echo $aluno->Orientador[0]->getNome() ?></td>
            <?php endif; ?>
            <td><?php echo $aluno->getNome() ?></td>
            <!-- FIX ME -->            
            <td><?php echo $aluno->Orientacao[0]->getStatusDescricao();?></td>
            <td class="actions">
                <?php
                    if($showActions){
                        echo link_to(__('Aceitar Orientação'),'@orientacao_action?professor_id=' . $aluno->Orientador[0]->getId() . '&aluno_id=' . $aluno->getId() . '&acao=aceitar', array('class' => 'user_orientacao_accept', 'title' => 'Aceitar Orientação'));
                        echo link_to(__('Rejeitar Orientação'),'@orientacao_action?professor_id=' . $aluno->Orientador[0]->getId() . '&aluno_id=' . $aluno->getId()  . '&acao=rejeitar', array('class' => 'user_orientacao_deny', 'title' => 'Rejeitar Orientação'));
                    }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
    include_partial('global/pager',array(
        'pager' => $pager,
        'action' => 'orientandosList?filtro=' . $sf_request->getParameter('filtro')
    ));
?>
