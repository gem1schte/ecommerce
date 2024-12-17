//Dropdown Menu
function Dropdown() {
  /* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
  document.getElementById("dropdown-list").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
  if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      for (var i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
              openDropdown.classList.remove('show');
          }
      }
  }
};

//Change background color
function Change_bg_color() {
  const body = document.querySelector('body');
  const toggle = document.getElementById('toggleDark');

  if (body.classList.contains('bg-secondary')) {
    body.classList.remove('bg-secondary');
    body.classList.add('bg-white');
    toggle.classList.remove('bi-brightness-high-fill');

    toggle.classList.add('bi-moon-fill');
  } 
  else {
    body.classList.remove('bg-white');
    body.classList.add('bg-secondary');
    toggle.classList.remove('bi-moon-fill');
    toggle.classList.add('bi-brightness-high-fill');
  }
}

//Change Index background color
function Index_Change_bg_color() {
  const body = document.querySelector('.min-h-screen');
  const toggle = document.getElementById('toggleColor');

  if (body.classList.contains('bg-red-400')) {
    body.classList.remove('bg-red-400');
    body.classList.add('bg-stone-100');
    toggle.classList.remove('bi-brightness-high-fill');

    toggle.classList.add('bi-moon-fill');
  } 
  else {
    body.classList.remove('bg-stone-100');
    body.classList.add('bg-red-400');
    toggle.classList.remove('bi-moon-fill');
    toggle.classList.add('bi-brightness-high-fill');
  }
}

//Typed
//Source https://github.com/mattboldt/typed.js
window.onload = function (){
    new Typed('#login_Section_Title', {
    strings: ['<i>Hello </i>', 'Welcome.'],
    typeSpeed: 50,
    backSpeed:50,
    backDelay:500,
    cursorChar: '_',
    fadeOut: true,
    loop:true
  });
}

window.onload = function (){
  new Typed('#Index_Section_Title', {
  strings: ['<i>History of Programming Languages </i>'],
  typeSpeed: 50,
  backSpeed:50,
  backDelay:500,
  cursorChar: '~',
  // fadeOut: true,
  loop:true
});
}

//showpassword
let PasswordVisible = false;

function showpassword() {
    const passwordLabel = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");

    if (PasswordVisible) {
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
        passwordLabel.type = 'password';
        PasswordVisible = false;
    } else {
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
        passwordLabel.type = 'text';
        PasswordVisible = true;
    }
}

//Input validation
document.addEventListener('DOMContentLoaded',function(){
  document.querySelectorAll('input','text').forEach(function (element) {
    element.addEventListener('input',function(){
      if(this.validity.valid){
        this.classList.add('valid');
        this.classList.remove('invalid');
      }
      else{
        this.classList.add('invalid');
        this.classList.remove('valid');
      }
    })
  })
});