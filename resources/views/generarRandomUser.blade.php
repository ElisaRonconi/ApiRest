<!DOCTYPE html>
<html>
<head>
    <title>Generar Usuarios</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .usuario {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            text-align: center;
            width: 180px;
        }
        .usuario img {
            max-width: 100px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <h1>Generar Random Users</h1>

    <input type="number" id="cantidad" placeholder="Cantidad de usuarios">
    <button onclick="generarUsuarios()">Generar</button>

    <div id="resultado"></div>

    <script>
    function generarUsuarios() {
        const cantidad = document.getElementById('cantidad').value;

        fetch('/generar-usuarios', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ cantidad: cantidad })
        })
        .then(response => response.json())
        .then(data => {
            const resultadoDiv = document.getElementById('resultado');
            if (data.success) {
                let html = '<h2>Usuarios generados:</h2><div style="display:flex; flex-wrap:wrap;">';

                data.usuarios.forEach(usuario => {
                    html += `
                        <div class="usuario">
                            <img src="${usuario.picture}" alt="Foto de ${usuario.name}">
                            <p><strong>${usuario.name}</strong></p>
                            <p>${usuario.email}</p>
                        </div>
                    `;
                });

                html += '</div>';
                resultadoDiv.innerHTML = html;
            } else {
                resultadoDiv.innerHTML = `<p style="color:red;">Error: ${data.mensaje}</p>`;
            }
        })
        .catch(error => {
            document.getElementById('resultado').innerHTML = `<p style="color:red;">Error de conexión: ${error.message}</p>`;
        });
    }
    </script>
</body>
</html>
