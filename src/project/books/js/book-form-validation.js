const bookForm = document.getElementById('book_form');
const submitBtn = document.getElementById('submit_btn');
const errorSummary = document.getElementById('error_summary_top');

const fields = ['title', 'author', 'publisher_id', 'year', 'isbn', 'format_ids', 'description', 'cover'];

function addError(fieldName, message, errors) {
    errors[fieldName] = message;
}

function showFieldErrors(errors) {
    fields.forEach(field => {
        const errorSpan = document.getElementById(`${field}_error`);
        if (errorSpan) {
            errorSpan.innerHTML = errors[field] || "";
        }
        const phpError = document.querySelector(`input[name="${field}"] + p`);
        if (phpError) {
            phpError.style.display = 'none';
        }
    });
}

function showErrorSummaryTop(errors) {
    const errorMessages = Object.values(errors);
    if (errorMessages.length > 0) {
        errorSummary.innerHTML = `<ul>${errorMessages.map(msg => `<li>${msg}</li>`).join('')}</ul>`;
        errorSummary.style.display = 'block';
    } else {
        errorSummary.style.display = 'none';
        errorSummary.innerHTML = "";
    }
}

function onSubmitForm(evt) {
    let errors = {};
    if (!document.getElementById('title').value.trim()) addError('title', "Title is required.", errors);
    if (!document.getElementById('author').value.trim()) addError('author', "Author is required.", errors);
    if (!document.getElementById('publisher_id').value) addError('publisher_id', "Please select a publisher.", errors);
    if (!document.getElementById('year').value) addError('year', "Year is required.", errors);
    if (!document.getElementById('isbn').value.trim()) addError('isbn', "ISBN is required.", errors);
    if (!document.getElementById('description').value.trim()) addError('description', "Description is required.", errors);
    if (!document.getElementById('cover').value) addError('cover', "Cover image is required.", errors);

    const checkedFormats = document.querySelectorAll('input[name="format_ids[]"]:checked');
    if (checkedFormats.length === 0) addError('format_ids', "Please select at least one format.", errors);

    showFieldErrors(errors);
    showErrorSummaryTop(errors);

    if (Object.keys(errors).length === 0) {
        bookForm.submit();
    }
}

if (bookForm && submitBtn) {
    submitBtn.addEventListener('click', onSubmitForm);
}