<h2><?php echo __('Administrador');?></h2>
<h3><?php echo __('Listagem');?></h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<?php echo link_to(__('Novo'),url_for('administrador/new'),array('class' => 'new_register'));?>
<table>
    <thead>
        <tr>
            <th><?php echo __('Nome');?></th>
            <th><?php echo __('E-mail');?></th>
            <th class="actions"><?php echo __('Ações');?></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="3" class="results"><?php echo $pager->getNbResults();?> <?php echo __('registro(s)');?></td>
        </tr>
    </tfoot>
    <tbody>
    <?php foreach ($administradors as $administrador): ?>
        <tr>
            <td><?php echo $administrador->getNome() ?></td>
            <td><?php echo $administrador->getEmail() ?></td>
            <td class="actions">
                <?php echo link_to(__('Alterar'),'administrador/edit?id=' . $administrador->getId(), array('class' => 'user_edit'));?>
                <?php echo link_to(__('Excluir'),'administrador/delete?id=' . $administrador->getId(), array('class' => 'user_delete delete'));?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php 
    include_partial('global/pager',array(
        'pager' => $pager,
    ));
?>
