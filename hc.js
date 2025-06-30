// Toggle FAQ Answer Visibility
function toggleAnswer(faqId) {
    var answer = document.getElementById(faqId);
    var icon = answer.previousElementSibling.querySelector(".icon");

    if (answer.style.display === "block") {
        answer.style.display = "none";
        answer.style.opacity = "0";
        icon.classList.remove("open");
    } else {
        answer.style.display = "block";
        answer.style.opacity = "1";
        icon.classList.add("open");
    }
}