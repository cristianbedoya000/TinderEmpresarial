const iniciarBtn=document.getElementById('LoginBtn');
const registrarBtn =document.getElementById('RegisterBtn');
const loginForm=document.getElementById('Login');
const registerForm=document.getElementById('Register');

registrarBtn.addEventListener('click',function(){
    loginForm.style.display="none";
    registerForm.style.display="block";
})

iniciarBtn.addEventListener('click',function(){
    loginForm.style.display="block";
    registerForm.style.display="none";
})