<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>

    <?php
    // define variables and set to empty values
    $cod_produtoErr = $cod_categoriaErr = $genderErr = "";
    $cod_produto = $cod_categoria = $gender = $descricao = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["cod_produto"])) {
            $cod_produtoErr = "cod_produto is required";
        } else {
            $cod_produto = test_input($_POST["cod_produto"]);
            // check if cod_produto only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $cod_produto)) {
                $cod_produtoErr = "Verifique o código do produto";
            }
        }

        if (empty($_POST["cod_categoria"])) {
            $cod_categoriaErr = "cod_categoria is required";
        } else {
            $cod_categoria = test_input($_POST["cod_categoria"]);
            // check if e-mail address is well-formed
            if (!filter_var($cod_categoria, FILTER_VALIDATE_EMAIL)) {
                $cod_categoriaErr = "Invalid cod_categoria format";
            }
        }

        if (empty($_POST["descricao"])) {
            $descricao = "";
        } else {
            $descricao = test_input($_POST["descricao"]);
        }

        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $gender = test_input($_POST["gender"]);
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <h2>Insira seus Produtos</h2>
    <p><span class="error">* Campos Obrigatórios</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Código do Produto: <input type="text" name="cod_produto" value="<?php echo $cod_produto; ?>">
        <span class="error">* <?php echo $cod_produtoErr; ?></span>
        <br><br>
        Código da Categoria: <input type="text" name="cod_categoria" value="<?php echo $cod_categoria; ?>">
        <span class="error">* <?php echo $cod_categoriaErr; ?></span>
        <br><br>
        Descrição: <textarea name="descricao" rows="5" cols="40"><?php echo $descricao; ?></textarea>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php

    $servername = "localhost";
    $username = "usuario_local";
    $password = "local_usuario";
    $dbname = "if966";

    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "INSERT INTO produto  VALUES ($cod_produto,'$descricao',$cod_categoria)";

    if (mysqli_query($conn, $sql)) {
        echo "<h3>Informações Adicionadas com sucesso:</h3>";

        echo nl2br("\n$cod_produto\n $descricao\n "
            . "$cod_categoria");
    } else {
        echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
    }
    ?>

</body>

</html>