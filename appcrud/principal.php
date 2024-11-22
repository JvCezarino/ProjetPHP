<?php include 'principal_controller.php'; 
 //pega todos os produtos para preencher os dados da tabela
 $prods =getProds();
 ?>
 <?php include 'header.php'; ?>

<div class="flex-grow-1">
        <!-- Conteúdo da página vai aqui -->
        <h2>Olá, <?php echo htmlspecialchars($nome); ?>!</h2>

       <!--  <form method="POST" action="">
            <input type="submit" name="logout" value="Logout">
        </form>
        -->
    </div>

    <div class= "container p-2">
    <?php foreach ($prods as $prod): ?>
        <div class="card" style="width: 18rem;">
  <img src="<?php echo $prod['url_img']; ?>" class="rounded mx-auto d-block" alt="Imagem do produto" style ="width: 100px;">
  <div class="card-body">
    <h5 class="card-title"><?php echo $prod['nome']; ?></h5>
    <p class="card-text"><?php echo $prod['descricao']; ?></p>
    <a href="#" class="btn btn-primary">Comprar</a>
        </div>
    </div>
</div>
<?php endforeach; ?>



<?php include 'footer.php'; ?>