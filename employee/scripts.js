function validateForm() {
    let name = document.forms["employeeForm"]["name"].value;
    let gender = document.forms["employeeForm"]["gender"].value;
    let maritalStatus = document.forms["employeeForm"]["marital_status"].value;
    let phone = document.forms["employeeForm"]["phone"].value;
    let email = document.forms["employeeForm"]["email"].value;
    let address = document.forms["employeeForm"]["address"].value;
    let dob = document.forms["employeeForm"]["dob"].value;
    let nationality = document.forms["employeeForm"]["nationality"].value;
    let hireDate = document.forms["employeeForm"]["hire_date"].value;
    let department = document.forms["employeeForm"]["department"].value;

    if (name == "" || gender == "" || maritalStatus == "" || phone == "" || email == "" || address == "" || dob == "" || nationality == "" || hireDate == "" || department == "") {
        alert("All fields must be filled out");
        return false;
    }

    let phonePattern = /^[0-9]{10}$/;
    if (!phonePattern.test(phone)) {
        alert("Phone number must be 10 digits.");
        return false;
    }

    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    return true;
}

document.addEventListener("DOMContentLoaded", function() {
    fetchEmployeeData();
});

function fetchEmployeeData() {
    fetch('http://localhost:81/restApi/public/api/employees')
        .then(response => response.json())
        .then(data => populateTable(data))
        .catch(error => console.error('Error fetching employee data:', error));
}

function populateTable(employees) {
    const tableBody = document.querySelector("#employeeTable tbody");
    tableBody.innerHTML = "";

    employees.forEach(employee => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${employee.name}</td>
            <td>${employee.gender}</td>
            <td>${employee.marital_status}</td>
            <td>${employee.phone}</td>
            <td>${employee.email}</td>
            <td>${employee.address}</td>
            <td>${employee.dob}</td>
            <td>${employee.nationality}</td>
            <td>${employee.hire_date}</td>
            <td>${employee.department}</td>
        `;
        tableBody.appendChild(row);
    });
}
