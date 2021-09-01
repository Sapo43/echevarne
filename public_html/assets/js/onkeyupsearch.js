$(function() {
    const search = document.body;
search.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
        console.log("Enterr");
        // f es la funcion que realiza la busqueda verifiando los filtros
        f();
    }
});
});


