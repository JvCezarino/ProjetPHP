<?php
include 'produtos_controller.php';

session_start();

// Verifica se o usuário está registrado na sessão (logado)
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Armazena informações do usuário
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];

// Função para lidar com o logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

//Pega todos os produtos para preencher os dados da tabela
$prod = getProds();

//Variável que guarda o ID do produto que será editado
$prodToEdit = null;

// Verifica se existe o parâmetro edit pelo método GET
// e sé há um ID para edição de produto
if (isset($_GET['edit'])) {
    $prodToEdit = getProd($_GET['edit']);
}

?>
<?php include 'header.php'; ?>

<script src="js/main.js"></script>
    <div class="container">
    <h2>Cadastro de produtos</h2>
    <form method="POST" action="">
        <input type="hidden" id="id" name="id" value="<?php echo $prodToEdit['id'] ?? ''; ?>">

        <div class = "form-group input-group-sm">
        <label  class ="mb-0"  for="nome">Nome:</label>
        <input class = "form-control" type="text" id="nome" name="nome" value="<?php echo $prodToEdit['nome'] ?? ''; ?>" required>
        </div>

        <div class = "form-group input-group-sm">
        <label class ="mb-0" for="descricao">Descrição:</label>
        <input class = "form-control"type="text" id="descricao" name="descricao" value="<?php echo $prodToEdit['descricao'] ?? ''; ?>" required>
        </div>

        <div class = "form-group input-group-sm">
        <label  class ="mb-0"  for="marca">Marca:</label>
        <input class = "form-control" type="text" id="marca" name="marca" value="<?php echo $prodToEdit['marca'] ?? ''; ?>" required>
        </div>

        <div class = "form-group input-group-sm">
        <label  class ="mb-0"  for="modelo">Modelo:</label>
        <input class = "form-control" type="text" id="modelo" name="modelo" value="<?php echo $prodToEdit['modelo'] ?? ''; ?>"required>
        </div>

        <div class = "form-group input-group-sm">
        <label  class ="mb-0"  for="valorUnitario">Valor Unitario:</label>
        <input class = "form-control" type="double" id="valorUnitario" name="valorUnitario" value="<?php echo $prodToEdit['modelo'] ?? ''; ?>"required>
        </div>

        <div class = "form-group input-group-sm">
        <label  class ="mb-0"  for="categoria">Categoria:</label>
        <input class = "form-control" type="text" id="categoria" name="categoria" value="<?php echo $prodToEdit['categoria'] ?? ''; ?>"required>
        </div>

        <div class = "form-group input-group-sm">
        <label  class ="mb-0"  for="url_img">URL Imagem:</label>
        <input class = "form-control" type="text" id="url_img" name="url_img" value="<?php echo $prodToEdit['url_img'] ?? ''; ?>"required>
        </div>

        <div class = "form-group input-group-sm">
        <label  class ="mb-0"  for="ativo">Ativo:</label>
        <input class = "form-control" type="text" id="ativo" name="ativo" value="<?php echo $prodToEdit['ativo'] ?? ''; ?>"required>
        </div>

        <button type="submit" class="btn btn-success" name="save">Inserir</button>
        <button type="submit" class="btn btn-info" name="update">Atualizar</button>
        <button type="button" class="btn btn-primary" onclick="clearForm()">Novo</button>
    </form>
    <br>

    <h2>Produtos Cadastrados</h2>
    <table class="table table-sm" border="2">
        <tr class="thead-dark">
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Valor Unitario</th>
            <th>Categoria</th>
            <th>Ativo</th>
        </tr>
        <!--Faz um loop FOR no resultset de produto e preenche a tabela-->
        <?php foreach ($prod as $prod): ?>
            <tr>
                <td><?php echo $prod['id']; ?></td>
                <td><?php echo $prod['nome']; ?></td>
                <td><?php echo $prod['descricao']; ?></td>
                <td><?php echo $prod['marca']; ?></td>
                <td><?php echo $prod['modelo']; ?></td>
                <td><?php echo $prod['valorunitario']; ?></td>
                <td><?php echo $prod['categoria']; ?></td>
                <td><?php echo $prod['ativo']; ?></td>
                <td><img src="<?php echo $prod['url_img']; ?>" alt="Imagem do Produto" style="width: 100px;"></td>

                <td>
                    <a class="btn btn-outline-warning" href="?edit=<?php echo $prod['id']; ?>">Editar</a>
                    <a class="btn btn-outline-danger" href="?delete=<?php echo $prod['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>
    <?php include 'footer.php'; ?>