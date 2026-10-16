 



"use strict";

// Array containing student objects.
const students = [
    { name: "Ayesha", rollNo: 101, marks: 85 },
    { name: "Rahul", rollNo: 102, marks: 72 },
    { name: "Sara", rollNo: 103, marks: 38 }
];

// Access HTML elements using the DOM.
const form = document.getElementById("studentForm");
const nameInput = document.getElementById("name");
const rollInput = document.getElementById("rollNo");
const marksInput = document.getElementById("marks");
const tableBody = document.getElementById("studentTable");
const summary = document.getElementById("summary");
const message = document.getElementById("message");

// Function to display student records.
function displayStudents() {
    // Clear previous table contents.
    tableBody.replaceChildren();

    let totalMarks = 0;

    // Loop through the array of student objects.
    students.forEach(function (student) {
        totalMarks += student.marks;

        // Create a new table row.
        const row = document.createElement("tr");

        // Create cells and insert text safely.
        const nameCell = document.createElement("td");
        nameCell.textContent = student.name;

        const rollCell = document.createElement("td");
        rollCell.textContent = student.rollNo;

        const marksCell = document.createElement("td");
        marksCell.textContent = student.marks;

        const resultCell = document.createElement("td");
        resultCell.textContent =
            student.marks >= 40 ? "Pass" : "Fail";

        // Add cells to the row.
        row.append(
            nameCell,
            rollCell,
            marksCell,
            resultCell
        );

        // Add the row to the table.
        tableBody.appendChild(row);
    });

    // Calculate the average.
    const average = students.length > 0
        ? totalMarks / students.length
        : 0;

    // Update the page using the DOM.
    summary.textContent =
        "Average Marks: " + average.toFixed(2);
}

// Handle form submission.
form.addEventListener("submit", function (event) {
    // Prevent the browser from reloading the page.
    event.preventDefault();

    // Read and validate input values.
    const name = nameInput.value.trim();
    const rollNo = Number(rollInput.value);
    const marks = Number(marksInput.value);

    if (
        name === "" ||
        !Number.isInteger(rollNo) ||
        rollNo < 1 ||
        !Number.isFinite(marks) ||
        marks < 0 ||
        marks > 100
    ) {
        message.textContent =
            "Please enter valid student details.";
        return;
    }

    // Prevent duplicate roll numbers.
    const duplicate = students.some(function (student) {
        return student.rollNo === rollNo;
    });

    if (duplicate) {
        message.textContent =
            "This roll number already exists.";
        return;
    }

    // Create a new student object.
    const newStudent = {
        name: name,
        rollNo: rollNo,
        marks: marks
    };

    // Add the object to the array.
    students.push(newStudent);

    // Refresh the table and average.
    displayStudents();

    // Reset the form.
    form.reset();

    message.textContent =
        "Student added successfully!";
});

// Display initial records when the page loads.
displayStudents();