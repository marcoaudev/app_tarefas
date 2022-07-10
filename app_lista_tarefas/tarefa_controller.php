<?php

require '../../app_lista_tarefas/conexao.php';
require '../../app_lista_tarefas/tarefa.model.php';
require '../../app_lista_tarefas/tarefa.service.php';



$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;


if ($acao == 'inserir') {
    $tarefa = new Tarefa();
    $tarefa->__set($_POST['descricao'], 'tarefa');

    $conexao = new Conexao();
    $tarefaservice = new TarefaService($conexao, $tarefa);

    $tarefaservice->inserir();
    header('Location: nova_tarefa.php?inclusao=1');
}else if($acao == 'recuperar'){
    $tarefa = new Tarefa();
    $conexao = new Conexao();
    $tarefaservice = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaservice->recuperar();
}else if($acao == 'atualizar'){
    $tarefa = new Tarefa();
    $tarefa->__set($_POST['id'], 'id');
    $tarefa->__set($_POST['tarefa'], 'tarefa');
    $conexao = new Conexao();
    $tarefaservice = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaservice->atualizar();
    if(isset($_GET['acao']) and $_GET['pag'] == 'index'){
        header('Location: index.php');
    }else{
        header('Location: todas_tarefas.php');
    }
}else if($acao == 'remover'){
    $tarefa = new Tarefa();
    $tarefa->__set($_GET['id'], 'id');
    $conexao = new Conexao();
    $tarefaservice = new TarefaService($conexao, $tarefa);
    $tarefaservice->remover();
    if(isset($_GET['acao']) and $_GET['pag'] == 'index'){
        header('Location: index.php');
    }else{
        header('Location: todas_tarefas.php');
    }
    
}else if($acao == 'check'){
    $tarefa = new Tarefa();
    $tarefa->__set($_GET['id'], 'id');
    $tarefa->__set(2, 'id_status');
    $conexao = new Conexao();
    $tarefaservice = new TarefaService($conexao, $tarefa);
    $tarefaservice->check();

    if(isset($_GET['acao']) and $_GET['pag'] == 'index'){
        header('Location: index.php');
    }else{
        header('Location: todas_tarefas.php');
    }
}
    
