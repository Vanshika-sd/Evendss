ds = document.getElementById('ds');
us = document.getElementById('us');
vd = document.getElementById('vd');
j = document.getElementById('j');
ep = document.getElementById('ep');
ta = document.getElementById('ta');
tas = document.getElementById('tas');
tat = document.getElementById('tat');
taf = document.getElementById('taf');
cht = document.getElementById('cht');

function dash() {
    cht.style.display = 'flex';
    ds.classList.add('ext');
    us.classList.remove('ext');   
    vd.classList.remove('ext');   
    j.classList.remove('ext');   
    ep.classList.remove('ext'); 
    ta.classList.add('hiddn');
    tas.classList.add('hiddn');
    tat.classList.add('hiddn');
    taf.classList.add('hiddn');
}
function user() {
    cht.style.display = 'none';
    ta.classList.add('hiddn');
    tat.classList.add('hiddn');
    taf.classList.add('hiddn');
    ds.classList.remove('ext');
    us.classList.add('ext');   
    vd.classList.remove('ext');   
    j.classList.remove('ext');   
    ep.classList.remove('ext'); 
    tas.classList.remove('hiddn');
}
function vend() {
    cht.style.display = 'none';
    tas.classList.add('hiddn');
    tat.classList.add('hiddn');
    taf.classList.add('hiddn');
    ds.classList.remove('ext');
    us.classList.remove('ext');   
    vd.classList.add('ext');   
    j.classList.remove('ext');   
    ep.classList.remove('ext');
    ta.classList.remove('hiddn');   
}
function jobe() { 
    cht.style.display = 'none';
    tas.classList.add('hiddn');
    ta.classList.add('hiddn');
    tat.classList.add('hiddn');
    ds.classList.remove('ext');
    us.classList.remove('ext');   
    vd.classList.remove('ext');   
    j.classList.add('ext');   
    ep.classList.remove('ext');
    taf.classList.remove('hiddn');   
}
function empe() {
    cht.style.display = 'none';
    ta.classList.add('hiddn');
    tas.classList.add('hiddn');
    taf.classList.add('hiddn');
    ds.classList.remove('ext');
    us.classList.remove('ext');   
    vd.classList.remove('ext');   
    j.classList.remove('ext');   
    ep.classList.add('ext'); 
    tat.classList.remove('hiddn');  
}
// Booking Modal Logic
const bookingModal = document.getElementById('bookingModal');

function openBooking() {
    bookingModal.style.display = 'block';
}

function closeBooking() {
    bookingModal.style.display = 'none';
}

// Close modal on clicking outside the content
window.onclick = function(event) {
    if (event.target == bookingModal) {
        closeBooking();
    }
};