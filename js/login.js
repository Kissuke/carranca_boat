document.getElementById('loginForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    try {
        const response = await fetch('../admin/login.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        const msgEl = document.getElementById('mensagem');
        msgEl.innerText = result.message;

        if (result.success) {
            msgEl.style.color = 'green';
            // Redireciona para página que vc queira
            window.location.href = 'painel.html'; // substitua pela sua página principal
        } else {
            msgEl.style.color = 'red';
        }

    } catch (error) {
        document.getElementById('mensagem').innerText = 'Erro ao tentar fazer login.';
        console.error('Erro:', error);
    }
});
