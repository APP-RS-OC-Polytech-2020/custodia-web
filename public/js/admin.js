let btnStartCustodia = document.querySelector('#btnStartCustodia');

btnStartCustodia.addEventListener('click', (event) => {
    event.preventDefault();
    fetch('src/php/ajax/admin.php')
    .then(response => console.log(response));
});