<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <h2>Registro</h2>
    <form id="registroForm">
        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Senha:</label>
        <input type="password" name="senha" required><br>

        <button type="submit">Registrar</button>
    </form>

    <div id="mensagem"></div>

    <script>
        document.getElementById('registroForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            const response = await fetch('../admin/register.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            document.getElementById('mensagem').innerText = result.message;
        });
    </script>
</body>
</html>
