const btnBack = document.querySelector('#btn-back');
btnBack.addEventListener('click', (e) => {
  e.preventDefault();
  location.href = 'index.php';
});