document.getElementById('registroForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            // Verifica se as senhas coincidem antes de enviar
            const senha = formData.get('senha');
            const confirmarSenha = formData.get('confirmarSenha');

            if (senha !== confirmarSenha) {
                document.getElementById('mensagem').innerText = 'As senhas não coincidem.';
                return;
            }

            try {
                const response = await fetch('../admin/register.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                document.getElementById('mensagem').innerText = result.message;

            } catch (error) {
                document.getElementById('mensagem').innerText = 'Erro ao registrar. Tente novamente.';
                console.error('Erro:', error);
            }
        });