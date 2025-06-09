<?php
// Verifica se a requisição foi feita usando o método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ***** ATENÇÃO: ALTERE ESTAS DUAS LINHAS! *****
    
    // 1. E-mail que vai RECEBER a mensagem.
    $destinatario = "amaurijr.23@gmail.com"; 
    
    // 2. E-mail que vai ENVIAR a mensagem (use um e-mail do seu próprio domínio para evitar spam).
    $remetente = "amaurijr.23@gmail.com";

    // Assunto do e-mail que você receberá
    $assunto = "Nova Mensagem do Site";

    // --- Coleta e Limpeza dos Dados do Formulário ---
    $nome = htmlspecialchars(strip_tags(trim($_POST["nome"])));
    $telefone = htmlspecialchars(strip_tags(trim($_POST["telefone"])));
    $mensagem = htmlspecialchars(strip_tags(trim($_POST["mensagem"])));

    // --- Validação Simples ---
    // Verifica se os campos essenciais não estão vazios
    if (empty($nome) || empty($telefone) || empty($mensagem)) {
        // Redireciona de volta com status de erro se algum campo estiver vazio
        header("Location: index.php?status=erro#contato");
        exit;
    }

    // --- Montagem do Corpo do E-mail ---
    $corpo_email = "Você recebeu uma nova mensagem através do formulário de contato do site.\n\n";
    $corpo_email .= "Nome: " . $nome . "\n";
    $corpo_email .= "Telefone: " . $telefone . "\n\n";
    $corpo_email .= "Mensagem:\n" . $mensagem . "\n";

    // --- Cabeçalhos do E-mail (Headers) ---
    // Essencial para o envio correto e para evitar que o e-mail seja marcado como spam
    $headers = "From: " . $remetente . "\r\n";
    $headers .= "Reply-To: " . $remetente . "\r\n"; // Responder para o e-mail do site
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8" . "\r\n";

    // --- Envio do E-mail ---
    // Tenta enviar o e-mail usando a função mail() do PHP
    if (mail($destinatario, $assunto, $corpo_email, $headers)) {
        // Se enviado com sucesso, redireciona com status de sucesso
        header("Location: index.php?status=sucesso#contato");
    } else {
        // Se falhar, redireciona com status de erro
        header("Location: index.php?status=erro#contato");
    }

} else {
    // Se o arquivo for acessado diretamente, redireciona para a página inicial
    header("Location: index.php");
    exit;
}
?>