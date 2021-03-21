const URLROOT='http://localhost/COMP2171/HMS';
document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll("tr[data-href]");
    const add_feedback_btn = document.querySelectorAll(".add-feedback-btn");
    addLinksToTableRows(rows);
    addListenertoFeedbackBtn(add_feedback_btn);

});

function addLinksToTableRows(rows){
    rows.forEach(row => {
        row.addEventListener("click", () => {
            window.location.href = row.dataset.href;
        });
    });
}


function addListenertoFeedbackBtn(btn){
    let feedback_form;
    btn.forEach(row => {
        row.addEventListener("click", () => {
            feedback_form = document.getElementById("feedback-form");
            feedback_form.style.display = "block";
            // console.log("I was here");
            row.style.display="none";
        });
    });
}