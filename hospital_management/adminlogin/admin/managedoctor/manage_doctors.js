document.addEventListener("DOMContentLoaded", function () {
    fetchDoctors();

    document.getElementById("addDoctorForm").addEventListener("submit", function (event) {
        event.preventDefault();
        
        const formData = new FormData(this);
        fetch("../backend/add_doctor.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                fetchDoctors();
                this.reset();
            }
        })
        .catch(error => console.error("Error adding doctor:", error));
    });
});

function fetchDoctors() {
    fetch("../backend/get_doctors.php")
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById("doctorTableBody");
            tableBody.innerHTML = "";
            data.forEach(doctor => {
                const row = `<tr>
                    <td>${doctor.id}</td>
                    <td>${doctor.name}</td>
                    <td>${doctor.specialization}</td>
                    <td>${doctor.contact}</td>
                    <td>${doctor.email}</td>
                    <td>
                        <button onclick="deleteDoctor(${doctor.id})">Delete</button>
                    </td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error("Error fetching doctors:", error));
}

function deleteDoctor(id) {
    if (confirm("Are you sure you want to delete this doctor?")) {
        fetch("../backend/delete_doctor.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) fetchDoctors();
        })
        .catch(error => console.error("Error deleting doctor:", error));
    }
}
