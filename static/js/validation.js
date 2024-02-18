function validateForm() {
    let checkboxes = document.querySelectorAll('input[type="checkbox"]');
    let checked = Array.from(checkboxes).some(checkbox => checkbox.checked);
    if (!checked) {
        alert('Cocher au moins un genre');
        return false;
    }
    return true;
}
