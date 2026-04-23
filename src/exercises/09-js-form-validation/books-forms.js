const bookForm = document.getElementById('book_form');
const submitBtn = document.getElementById('submit_btn');
const errorSummary = document.getElementById('error_summary_top');

const inputs = {
    title: document.getElementById('title'),
    author: document.getElementById('author'),
    year: document.getElementById('year'),
    isbn: document.getElementById('isbn'),
    description: document.getElementById('description')
};

let errors = {};

function addError(fieldName, message) {
    errors[fieldName] = message;
}

function showFieldErrors() {
    for (let field in inputs) {
        const errorSpan = document.getElementById(`${field}_error`);
        errorSpan.innerHTML = errors[field] || "";
    }
}

function showErrorSummaryTop() {
    if (Object.keys(errors).length > 0) {
        errorSummary.innerHTML = `<ul>${Object.values(errors).map(e => `<li>${e}</li>`).join('')}</ul>`;
        errorSummary.style.display = 'block';
    } else {
        errorSummary.style.display = 'none';
        errorSummary.innerHTML = "";
    }
}

function validateTitle(value) {
    return value.trim() === "" ? "Title is required." : null;
}

function onSubmitForm(evt) {
    evt.preventDefault();
    errors = {};

    const titleErr = validateTitle(inputs.title.value);
    if (titleErr) addError('title', titleErr);
    

    showFieldErrors();
    showErrorSummaryTop();

    if (Object.keys(errors).length === 0) {
        bookForm.submit();
    }
}

if (bookForm && submitBtn) {
    submitBtn.addEventListener('click', onSubmitForm);
}