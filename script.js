function showSignupPt1() {
    a=document.getElementById('signup-form');
    b=document.getElementById('login-form');    
    c=document.getElementById('signup-form_pt2');
    d=document.getElementById('signup-form_pt3');
    a.classList.remove('hidden');   
    b.style.display = 'none';
    c.classList.add('hidden');
    d.classList.add('hidden');
}
function showLogin(){
    a=document.getElementById('signup-form');
    b=document.getElementById('login-form');
    a.classList.add('hidden');   
    b.style.display = 'block';
}