
<?php
// verifca se esta tudo certo
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    $permitidos = ['image/jpeg', 'image/png', 'image/gif'];
    $tipo = $_FILES['imagem']['type'];

    if (in_array($tipo, $permitidos)) {
        $nomeTemp = $_FILES['imagem']['tmp_name'];
        $nomeFinal = 'galeria/' . basename($_FILES['imagem']['name']);

        // coloca foto na pasta da galeria
        if (move_uploaded_file($nomeTemp, $nomeFinal)) {
            header("Location: index.php"); // Redireciona após upload
            exit();
        } else {
            echo "Erro ao salvar a imagem.";
        }
    } else {
        echo "Tipo de arquivo não permitido.";
    }
} else {
    echo "Nenhuma imagem enviada.";
}
?>