<?php
    $host = "localhost";
    $dbname = "agenda";
    $user = "root";
    $pass = "";

    try{

        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

        // ativar o modo de erros
        // vai exibir na tela caso der erro na conexão do banco
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $e)
    {
        $error = $e->getMessage();
        echo "Erro: $error";
    }

?>