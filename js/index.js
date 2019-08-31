var burger = document.querySelector('.menu-burger');
var barMenu = document.querySelector('.menu-bar');
var menu = document.querySelector('.container-menu');

burger.addEventListener('click', function(){  
  barMenu.classList.toggle('is-active');
  menu.classList.toggle('is-active');  
});

menu.addEventListener('click', function(){  
  barMenu.classList.toggle('is-active');
  menu.classList.toggle('is-active');  
});