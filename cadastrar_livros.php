<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Erro ao conectar ao banco de dados
        " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $titulo = mysqli_real_escape_string($conn, $_POST["titulo"]);
    $autor =  mysqli_real_escape_string($conn,$_POST["autor"]);
    $disponivel = isset($_POST["disponivel"])? 1:0;

    //tratamento de imagens
    $diretorio_imagens = "uploads/"; //diretório onde irão ficar as imagens
    $imagen_nome = basename($_FILES["imagem"] ["name"]); //variavel que vai receber o nome da imagem enviada pelo formulário
    $destino = $diretorio_imagens . $imagen_nome; //variavel $destino irá receber o diretório e o nome da imagem
    if(move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
        $sql = "INSERT INTO livros (titulo, autor, disponivel, imagem) VALUES ('$titulo', '$autor', '$disponivel', '$destino')";
    if(mysqli_query($conn, $sql)) {
            echo "Livro cadastrado com sucesso";  

} 
else {
    echo "erro ao cadastrar o livro" . mysqli_error($conn);
}
}
else {
    echo "erro ao fazer o upload da imagem";
}
}
// Fechar conexão com o banco de dados
mysqli_close($conn);
?>

<!doctype html>
<html lang="pt-br">
 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
 
    <!-- Css -->
    <link rel="stylesheet" href="css/style.css">
 
    <!-- BootsTrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
 
<body>
    <h1 class="titulo">Bem Vindo a Biblioteca</h1>
 
    <?php include 'cabecalho.php'; ?>
    <br>
 
    <!-- Enctype = Função para dizer para o php dizer como se fosse em codigo binário salvar no banco de dados, vai salvar a imagem que agente pego transformando em numero "binário" -->
    <form method="POST" enctype="multipart/form-data">
 
        <label for="titulo">Titulo</label>
        <input type="text" id="titulo" name="titulo" required>
 
        <label for="autor">Autor</label>
        <input type="text" id="autor" name="autor" required>
 
        <label for="disponivel">Disponivel</label>
        <input type="checkbox" id="disponivel" name="disponivel">
 
        <label for="imagem">Imagem de Livro</label>
        <input type="file" id="imagem" name="imagem" required>
 
        <button type="submit">Cadastrar</button>
 
    </form>
 
    <!-- BootsTrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
 
</body>
 
</html>