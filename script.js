let hamburgerMenu = document.querySelector('#menu-toggle');
let userBtn = document.querySelector('#user-icon');

hamburgerMenu.addEventListener('click',function(){
    let nav = document.querySelector('navbar');
    nav.classList.toggle('active');
})

user-icon.addEventListener('click',function(){
    let userBox = document.querySelector('user-box');
    userBox.classList.toggle('active');
})

//close form

const closeBtn = document.querySelector('#close-edit');

closeBtn.addEventListener('click',()=>{
    document.querySelector('.update-container') .style.display='none';
})
