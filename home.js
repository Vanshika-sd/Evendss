document.addEventListener("DOMContentLoaded", () => {
    const profileLink = document.querySelector(".sbar a");

    // Simulated login state (you can replace this with your actual authentication logic)
    const isLoggedIn = false; // Change to `true` to simulate a logged-in state.

    profileLink.addEventListener("click", (event) => {
        event.preventDefault(); // Prevent the default anchor behavior.

        if (isLoggedIn) {
            // Redirect to profile details page if logged in
            window.location.href = "/profile-details.html";
        } else {
            // Redirect to login/signup page if not logged in
            window.location.href = "/login-signup.html";
        }
    });
});
function hello() {
    mna = document.getElementById('mna');
    icon = document.getElementById('icon');
    mna.style.visibility = 'visible';
    icon.style.transition = 'transform 1s';
    icon.style.transform = 'rotate(360deg)';
}
function bye() {
    menu = document.getElementById('enu');
    mna = document.getElementById('mna');
    mna.style.visibility = 'hidden';
    menu.style.transition = 'transform 1s';
    menu.style.transform = 'rotate(360deg)';
}
function hello1() {
    smen = document.getElementById('smen');
    mv = document.getElementById('mv');
    h = document.getElementById('h');
    smen.style.visibility = 'visible'; 
    mv.style.visibility = 'hidden';
    document.body.style.backgroundColor = '#000000';
    h.style.visibility = 'visible';
}        
function bye1(){
    smen = document.getElementById('smen');
    mv = document.getElementById('mv');
    smen.style.visibility = 'hidden'; 
    mv.style.visibility = 'visible';
    document.body.style.backgroundColor = '#ffffff';
}
function shsign(){
    sn = document.getElementById('signup-form');
    lg = document.getElementById('login-form');
    sn.classList.remove('hiddn');   
    lg.style.display = 'none';
    c.classList.add('hidden');
}
function log(){
    sn = document.getElementById('signup-form');
    lg = document.getElementById('login-form');
    sn.classList.add('hiddn');
    lg.style.display = 'block';
}