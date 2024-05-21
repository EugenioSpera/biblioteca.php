<?php
class Usuario{
    private $db;
    //metodo construtor é acionado quando um objeto é criado
    public function __construct($db){
        //atrinui o valor de $db ao membro db deste objeto
        $this->db = $db;
    }
    //criando o metodo cadastrar que vai receber 4 parametros que foi inserido no banco de dados.
    public function cadastrar($nome, $email, $senha,$tipo){
        //por segurança a senha é convetida em hash
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        //está preparando para a consulta da tabela usuarios
        $smtp = $this->db->prepare("INSERT INTO usuarios(nome, email, senha, tipo) VALUES(?,?,?,?)");
        //verificação se a consulta falhar
        if(!$smtp){
            //se der erro na consulta mostra a mensagem
            die("erro ao preparar a consulta: ".$this->db->error);
        }
        //caso esteja tudo certo: irá executar $smtp e cadastrar os valores no banco
        $smtp->bind_param('ssss',$nome,$email,$senha_hash,$tipo);
        return $smtp->execute();
    }
 
 
}
 
?>