<?php include_once("templates/header.php");?>
    <div class="container">
        <?php include_once("templates/backbtn.html"); ?>
        <h1 id="main-title">Editar Contato</h1>
        <!--ENVIANDO A REQUISIÇÃO-->
       <form id="create-form" action="<?= $BASE_URL ?>config/process.php" method="POST">
         <input type="hidden" name="type" value="edit">
         <input type="hidden" name="id" value="<?= $contact['id'] ?>">
         <!--BOOTSTRAP-->
         <div class="form-group">
             <label for="name">Nome do contato:</label>
             <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome" value="<?= $contact['name'] ?>" required>
         </div>
         <div class="form-group">
             <label for="phone">Telefone do contato:</label>
             <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o Telefone" value="<?= $contact['phone'] ?>"required>
         </div>
         <div class="form-group">
             <label for="observations">Observações:</label>
             <!--Textarea = textbox de tamanho aumentado-->
             <textarea type="text" class="form-control" id="observations" name="observations" 
             placeholder="Observações" rows="3"><?= $contact['observations'] ?></textarea>
         </div>
         <!--Botão utilizando Classe do bootstrap-->
         <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
<?php include_once("templates/footer.php");?>