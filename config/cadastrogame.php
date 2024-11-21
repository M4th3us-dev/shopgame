<?php
// Configurações do banco de dados
$host = 'localhost';
$db = 'api_db';
$user = 'root'; // Ajuste para o seu usuário do banco
$pass = '12345'; // Ajuste para a sua senha do banco

// Conexão com o banco de dados
try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
    exit();
}

// Recebendo os dados do formulário via POST
$data = json_decode(file_get_contents("php://input"));

if (isset($data->nome, $data->descricao, $data->preco, $data->id_jogo, $data->ano)) {
    $nome = $data->nome;
    $descricao = $data->descricao;
    $preco = $data->preco;
    $id_jogo = $data->id_jogo;
    $ano = $data->ano;

    // Preparando a consulta SQL para inserir os dados
    $stmt = $conn->prepare("INSERT INTO games (nome, descricao, preco, id_jogo, ano) VALUES (:nome, :descricao, :preco, :id_jogo, :ano)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':id_jogo', $id_jogo);
    $stmt->bindParam(':ano', $ano);

    // Executando a consulta
    if ($stmt->execute()) {
        // Retorna uma resposta de sucesso
        echo json_encode([
            'success' => true,
            'message' => 'Jogo cadastrado com sucesso!'
        ]);
    } else {
        // Caso ocorra algum erro no cadastro
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao cadastrar o jogo!'
        ]);
    }
} else {
    // Caso faltem dados no envio
    echo json_encode([
        'success' => false,
        'message' => 'Por favor, preencha todos os campos.'
    ]);
}
?>
