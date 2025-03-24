
document.addEventListener("DOMContentLoaded", function () {
    fetchPatients();

    document.getElementById("addPatientForm").addEventListener("submit", function (event) {
        event.preventDefault();
        
        const formData = new FormData(this);
        fetch("../backend/add_patient.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                fetchPatients();
                this.reset();
            }
        })
        .catch(error => console.error("Error adding patient:", error));
    });
});

function fetchPatients() {
    fetch("../backend/get_patients.php")
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById("patientTableBody");
            tableBody.innerHTML = "";
            data.forEach(patient => {
                const row = `<tr>
                    <td>${patient.id}</td>
                    <td>${patient.name}</td>
                    <td>${patient.age}</td>
                    <td>${patient.gender}</td>
                    <td>${patient.contact}</td>
                    <td>
                        <button onclick="deletePatient(${patient.id})">Delete</button>
                    </td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error("Error fetching patients:", error));
}

function deletePatient(id) {
    if (confirm("Are you sure you want to delete this patient?")) {
        fetch("../backend/delete_patient.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) fetchPatients();
        })
        .catch(error => console.error("Error deleting patient:", error));
    }
}
