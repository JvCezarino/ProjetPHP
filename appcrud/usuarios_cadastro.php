<?php
include 'usuarios_controller.php';

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

//Pega todos os usuários para preencher os dados da tabela
$users = getUsers();

//Variável que guarda o ID do usuário que será editado
$userToEdit = null;

// Verifica se existe o parâmetro edit pelo método GET
// e sé há um ID para edição de usuário
if (isset($_GET['edit'])) {
    $userToEdit = getUser($_GET['edit']);
}

?>
<?php include 'header.php'; ?>

    <script src="js/main.js"></script>
    <div class="container">
    <h2>Cadastro de Usuários</h2>
    <form method="POST" action="">
        <input type="hidden" id="id" name="id" value="<?php echo $userToEdit['id'] ?? ''; ?>">

        <div class = "form-group input-group-sm">
        <label  class ="mb-0"  for="nome">Nome:</label>
        <input class = "form-control" type="text" id="nome" name="nome" value="<?php echo $userToEdit['nome'] ?? ''; ?>" required>
        </div>

        <div class = "form-group input-group-sm">
        <label class ="mb-0" for="telefone">Telefone:</label>
        <input class = "form-control"type="text" id="telefone" name="telefone" value="<?php echo $userToEdit['telefone'] ?? ''; ?>" required>
        </div>

        <div class = "form-group input-group-sm">
        <label  class ="mb-0"  for="email">Email:</label>
        <input class = "form-control" type="email" id="email" name="email" value="<?php echo $userToEdit['email'] ?? ''; ?>" required>
        </div>

        <div class = "form-group input-group-sm">
        <label  class ="mb-0"  for="senha">Senha:</label>
        <input class = "form-control" type="password" id="senha" name="senha" required>
        </div>


        <button type="submit" class="btn btn-success" name="save">Inserir</button>
        <button type="submit" class="btn btn-info" name="update">Atualizar</button>
        <button type="button" class="btn btn-primary" onclick="clearForm()">Novo</button>
    </form>
    <br>

    <h2>Usuários Cadastrados</h2>
    <table class="table table-sm" border="2">
        <tr class="thead-dark">
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <!--Faz um loop FOR no resultset de usuários e preenche a tabela-->
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['nome']; ?></td>
                <td><?php echo $user['telefone']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td>
                    <a class="btn btn-outline-warning" href="?edit=<?php echo $user['id']; ?>">Editar</a>
                    <a class="btn btn-outline-danger" href="?delete=<?php echo $user['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>
    <?php include 'footer.php'; ?>
