
// Confirm before deleting a student
function confirmDelete() {

    return confirm(
        "Are you sure you want to delete this student?"
    );

}

// Validate student registration form
function validateForm() {

    let name = document.getElementById("name").value.trim();

    let phone = document.getElementById("phone").value.trim();

    if (name == "") {

        alert("Please enter student name.");

        return false;

    }

    if (!/^[0-9]{10,15}$/.test(phone)) {

        alert("Please enter a valid phone number (10-15 digits).");

        return false;

    }

    return true;

}
