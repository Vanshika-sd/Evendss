const bookingModal = document.getElementById('bookingModal');
const book = document.getElementById('book');

function openBooking() {
    bookingModal.style.display = 'flex';
}

function closeBooking() {
    bookingModal.style.display = 'none';
}

function addmore() {
  book.style.display = 'flex';
}

function close() {
  book.style.display = 'none';
}

function showep() {
  a=document.getElementById('ep');
  b=document.getElementById('wh');    
  a.classList.remove('hidden');   
  b.style.display = 'none';
}
function hidep(){
  a=document.getElementById('ep');
  b=document.getElementById('wh');
  a.classList.add('hidden');   
  b.style.display = 'block';
}
