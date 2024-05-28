<?php
//$_SERVER: é uma variável do PHP que armazenar caminhos.
//serve para não dar erro quando acessar o formulário.
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    // Informações de conexão com o banco de dados
    $servername="localhost";
    $username= "root";
    $password= "";
    $dbname= "biblioteca";


//$conn: variável qualquer, armazena a conexão com o banco de dados
//mysqli_connect: É uma função incorporada no PHP que é usada para abrir uma nova conexão com 
//um servidor de banco de dados MySQL.

$conn = mysqli_connect($servername, $username, $password, $dbname);

// (!$conn): vai retornar verdadeiro ou falso, ou seja, se for verdadeiro é por que falhou a conexão ai 
//mostra a mensagem se for falso irá pular o if
if (!$conn){

 //die: É uma função do PHP que exibe uma mensagem e termina a execução do script 
//imediatamente.
//mysqli_connect_error(): é uma função do PHP que mostrar erros de conexão
die("Conexão falhou: " . mysqli_connect_error());
}

//armazena informações do formulário, nesse caso está pegando informações do campo que tem a 
//propriedade name a informação nome.
//mysqli_real_escape_string: é uma função em PHP que serve para criptografar as informações. 
//Evitar SQL injection.
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

//password_hash é uma função em PHP utilizada para criar uma senha criptografada de forma 
//segura.
// PASSWORD_DEFAULT: tipo de criptografia.
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); 
//Criptografar a senha
$tipo = mysqli_real_escape_string($conn, $_POST['tipo']);

// Inserir dados no banco de dados

//$sql: É uma varivael comum, poderia ser qualquer nome.
// INSERT INTO: commando do SQL que serve para inserir informações no
$sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES ('$nome', '$email', '$senha', '$tipo')";
//mysqli: é uma função do php que verifica a execução de uma consulta SQL.
//O if vai retornar verdadeiro ou falso, se verdadeiro mostra a frase.
if (mysqli_query($conn, $sql)) {
echo "Novo registro criado com sucesso";
} else {
echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
}
// Fechar conexão com o banco de dados
mysqli_close($conn);

}


?>




<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="titulo">BEM VINDO A BIBLIOTECA</h1>
    <?php include 'cabecalho.php';?>
    <br>
    <form method="POST">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>
        <label for="email">Email</label>
        <input type="email"id="email" name="email" required>
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required>
        <label for="tipo"> Tipo</label>
        <select name="tipo" id="tipo" required>
            <option value="admin">Admin</option>
            <option value="aluno">Aluno</option>
        </select>
        <button type="submit">Cadastrar</button>
 
    </form>
 
 
 
 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>






