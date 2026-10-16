"use strict";

// Global variable: accessible throughout this script.
const studentName = "Iqram";

// Function to calculate the total and average.
function calculateMarks() {
    // Local variables: declared inside the function.
    const marks = [85, 72, 90, 65, 78];

    let total = 0;
    let output = "";

    // FOR loop: display each subject's marks and calculate total.
    for (let i = 0; i < marks.length; i++) {
        output += "Subject " + (i + 1) + ": " + marks[i] + "<br>";
        total += marks[i];
    }

    // Function expression demonstrating another way to define a function.
    const calculateAverage = function (sum, count) {
        return sum / count;
    };

    const average = calculateAverage(total, marks.length);

    // IF-ELSE condition: determine the result.
    let result;

    if (average >= 40) {
        result = "Pass";
    } else {
        result = "Fail";
    }

    // ELSE-IF condition: assign a grade.
    let grade;

    if (average >= 80) {
        grade = "A";
    } else if (average >= 60) {
        grade = "B";
    } else if (average >= 40) {
        grade = "C";
    } else {
        grade = "F";
    }

    // WHILE loop: demonstrate repeated execution.
    let count = 1;

    output += "<br>Counting using while loop:<br>";

    while (count <= 3) {
        output += count + "<br>";
        count++;
    }

    // Display the final result.
    output += "<br>Student: " + studentName;
    output += "<br>Total Marks: " + total;
    output += "<br>Average Marks: " + average.toFixed(2);
    output += "<br>Result: " + result;
    output += "<br>Grade: " + grade;

    document.getElementById("output").innerHTML = output;

    // Scope demonstration.
    console.log("Global variable:", studentName);
    console.log("Local variable:", total);
}

// Normal function with parameters and a return value.
function addNumbers(a, b) {
    return a + b;
}

console.log("Sum:", addNumbers(10, 20));