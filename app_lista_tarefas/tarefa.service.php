<?php 


class TarefaService{

    private $conexao;
    private $tarefa;

    public function __construct(Conexao $conexao, Tarefa $tarefa){
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;  
    }

    public function inserir(){ //create
        $insert = 'INSERT INTO tb_tarefas (tarefa) VALUES (:tarefa)';
        $stmt = $this->conexao->prepare($insert);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();

    }
    public function recuperar(){ //read
        $query = 'SELECT 
        t.tarefa, 
        s.status,
        t.id
        FROM tb_tarefas t
        left join tb_status s ON t.id_status = s.id';
        $consul = $this->conexao->prepare($query);
        $consul->execute();
        return $consul->fetchAll(PDO::FETCH_ASSOC);
    }
    public function atualizar(){ //update
        $update = "UPDATE tb_tarefas SET tarefa = ? WHERE id = ? ";
        $atua = $this->conexao->prepare($update);
        $atua->bindValue(1, $this->tarefa->__get('tarefa'));
        $atua->bindValue(2, $this->tarefa->__get('id'));
        $atua->execute();

    }
    public function remover(){ //delete
        $delete = "DELETE FROM tb_tarefas WHERE id = :id";
        $apagar = $this->conexao->prepare($delete);
        $apagar->bindValue(':id', $this->tarefa->__get('id'));
        $apagar->execute();
    }
    public function check(){ //delete
        $check = "UPDATE tb_tarefas SET id_status = :id_status WHERE id = :id ";
        $mudar = $this->conexao->prepare($check);
        $mudar->bindValue(':id', $this->tarefa->__get('id'));
        $mudar->bindValue(':id_status', $this->tarefa->__get('id_status'));
        $mudar->execute();
    }
}

?>