document.addEventListener("DOMContentLoaded", function () {
    // Fetch available doctors for appointment booking
    if (document.getElementById("doctor")) {
        document.getElementById("specialty").addEventListener("change", function () {
            let specialty = this.value;
            let doctorDropdown = document.getElementById("doctor");

            doctorDropdown.innerHTML = '<option value="">Loading...</option>'; // Loading indicator

            fetch(`../backend/fetch_doctors.php?specialty=${specialty}`)
                .then(response => response.json())
                .then(data => {
                    doctorDropdown.innerHTML = '<option value="">--Select Doctor--</option>';
                    data.forEach(doctor => {
                        let option = document.createElement("option");
                        option.value = doctor.id;
                        option.textContent = doctor.name;
                        doctorDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    doctorDropdown.innerHTML = '<option value="">Error loading doctors</option>';
                    console.error('Error:', error);
                });
        });
    }

    // Fetch patient's appointment history
    if (document.getElementById("appointmentList")) {
        fetch("../backend/fetch_appointments.php")
            .then(response => response.json())
            .then(data => {
                let tableBody = document.getElementById("appointmentList");
                tableBody.innerHTML = "";
                data.forEach(app => {
                    let row = `<tr>
                        <td>${app.date}</td>
                        <td>${app.doctor}</td>
                        <td>${app.specialty}</td>
                    </tr>`;
                    tableBody.innerHTML += row;
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Fetch patient's prescription history
    if (document.getElementById("prescriptionList")) {
        fetch("../backend/fetch_prescriptions.php")
            .then(response => response.json())
            .then(data => {
                let tableBody = document.getElementById("prescriptionList");
                tableBody.innerHTML = "";
                data.forEach(pres => {
                    let row = `<tr>
                        <td>${pres.date}</td>
                        <td>${pres.doctor}</td>
                        <td>${pres.details}</td>
                    </tr>`;
                    tableBody.innerHTML += row;
                });
            })
            .catch(error => console.error('Error:', error));
    }
});
