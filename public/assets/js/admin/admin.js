document.querySelector('.toggle-menu').addEventListener('click', function () {
    const menu = document.querySelector('.menu'); 
    menu.classList.toggle('wide');
    menu.classList.toggle('narrow');

    const arrowleft = document.querySelector('.arrowleft'); 
    arrowleft.classList.toggle('d-none');
    
    const arrowright = document.querySelector('.arrowright'); 
    arrowright.classList.toggle('d-none');
  });

