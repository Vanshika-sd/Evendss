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