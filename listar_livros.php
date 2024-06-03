<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Erro na conexão". mysqli_connect_error());
}
$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);
$usuarios = array();
//Mostra quantas linhas tem dentro do array
if(mysqli_num_rows($resultado)> 0){
    while($linha = mysqli_fetch_assoc($resultado)){
        $usuarios[] = $linha;
}
}

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
    <h1 class="titulo">BEM VINDO A BIBLIOTECA</h1>
    <?php include 'cabecalho.php'; ?>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Autor</th>
                    <th>Dsiponivel</th>
                    <th>Imagem</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                if(mysqli_num_rows($resultado)> 0){
                    while($row = mysqli_fetch_assoc($resultado)){
                        echo"<tr>";
                        echo"<td>" . htmlspecialchars($row['titulo'])."</td>";
                        echo"<td>" . htmlspecialchars($row['autor'])."</td>";
                        echo"<td>" . ($row["disponivel"]?"sim":"não")."</td>";
                        echo"<td> <img src='". htmlspecialchars($row["imagem"])."'alt='Imagem do livro' width'100'></td>";
                        echo "</tr>";
                    }
                    
                    }
                    else{
                        echo "nenhum livro encontrado";
                }



                ?>

            </tbody>

        </table>

    </div>

    
    



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

<?php mysqli_close($conn); ?>