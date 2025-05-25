
document.addEventListener('DOMContentLoaded', function () {
    fetch('../Controller/categorias_controller.php')
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const select = document.getElementById('select-categorias');
                data.categorias.forEach(categoria => {
                    const option = document.createElement('option');
                    option.value = categoria.id;
                    option.textContent = categoria.nombre;
                    select.appendChild(option);
                });
            } else {
                console.error("Error al obtener categorías:", data.error);
            }
        })
        .catch(error => console.error("Error en la petición:", error));
});

