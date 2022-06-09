<?php
    session_start();

    include_once("connection.php");
    include_once("url.php");


    $data = $_POST;
//modificações no banco
    if(!empty($data))
    {
        // Criar contato
        if($data["type"] === "create")
            {
                $name = $data["name"];
                $phone = $data["phone"];
                $observations = $data["observations"];

                $query = "INSERT INTO contacts (name, phone, observations) VALUES (:name, :phone, :observations)";

                $stmt = $conn->prepare($query);

                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":phone", $phone);
                $stmt->bindParam(":observations", $observations);

                 try{
                    //executando o insert
                    $stmt->execute();
                    //tratamento da msg de notificação na tela
                    $_SESSION["msg"] = "Contato criado com sucesso";
  
                    }catch(PDOException $e)
                    {
                        $error = $e->getMessage();
                        echo "Erro: $error";
                    }
            } else if($data["type"] === "edit")
            {
                $name = $data["name"];
                $phone = $data["phone"];
                $observations = $data["observations"];
                $id = $data["id"];

                $query = "UPDATE contacts 
                            SET name = :name, phone = :phone, observations = :observations 
                            WHERE id = id";

                $stmt = $conn->prepare($query);

                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":phone", $phone);
                $stmt->bindParam(":observations", $observations);
                $stmt->bindParam(":id", $id);

                 try{
                    //executando o insert
                    $stmt->execute();
                    //tratamento da msg de notificação na tela
                    $_SESSION["msg"] = "Contato atualizado com sucesso";
                    }catch(PDOException $e)
                    {
                        $error = $e->getMessage();
                        echo "Erro: $error";
                    }
            } else if($data["type"] === "delete")
                {
                    $id = $data["id"];

                    $query = "DELETE FROM contacts WHERE id = :id";

                    $stmt = $conn->prepare($query);

                    $stmt->bindParam(":id", $id);

                    $stmt->execute();

                     try{
                    //executando o insert
                    $stmt->execute();
                    //tratamento da msg de notificação na tela
                    $_SESSION["msg"] = "Contato removido com sucesso";
                    }catch(PDOException $e)
                    {
                        $error = $e->getMessage();
                        echo "Erro: $error";
                    }

                }

            header("Location:" . $BASE_URL . "../index.php");
//selecionando os dados
    }else
    {
        // Retorna um id
$id;

//Verificar se tem ID na URL
if(!empty($_GET))
{
    $id = $_GET["id"];
}

if(!empty($id))
{
    $query = "SELECT * FROM contacts where id = :id";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(":id", $id);

    $stmt->execute();

    $contact = $stmt->fetch();
        }else
        {
        // Retorna todos os contatos
        $contacts = [];

        $query = "SELECT * FROM contacts";

        $stmt = $conn->prepare($query);

        $stmt->execute();

        $contacts = $stmt->fetchAll();
        }
}

//FECHAR A CONEXÃO VIA PDO
$conn = null;
?>