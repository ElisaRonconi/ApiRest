<!DOCTYPE html>
<html>
<head>
    <title>Generar Usuarios</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
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
        let html = '<h2>Usuarios generados:</h2><ul>';

        data.usuarios.forEach(usuario => {
            html += `<li>${usuario.name} - ${usuario.email} - ${usuario.username} - ${usuario.gender}</li>`;
        });

        html += '</ul>';
        resultadoDiv.innerHTML = html;
    } else {
        resultadoDiv.innerHTML = `<p style="color:red;">Error: ${data.mensaje}</p>`;
    }
})

    
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\apiRest\resources\views\generarRandomUser.blade.php ENDPATH**/ ?>