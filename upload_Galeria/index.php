@ -0,0 +1,29 @@
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Galeria de Fotos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Galeria de Fotos</h1>

    <!-- Formulario -->
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="imagem">Enviar nova imagem:</label><br>
        <input type="file" name="imagem" id="imagem" accept="image/*" required>
        <button type="submit">Enviar</button>
    </form>

    <!-- Galeria -->
    <div class="galeria">
        <?php
        $arquivos = glob("galeria/*.{jpg,jpeg,png,gif}", GLOB_BRACE);

        foreach ($arquivos as $imagem) {
            echo "<div class='foto'><img src='$imagem' alt='Foto'></div>";
        }
        ?>
    </div>
</body>
</html>