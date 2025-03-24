document.addEventListener("DOMContentLoaded", function () {
    fetchStaff();

    document.getElementById("addStaffForm").addEventListener("submit", function (event) {
        event.preventDefault();
        
        const formData = new FormData(this);
        fetch("../backend/add_staff.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                fetchStaff();
                this.reset();
            }
        })
        .catch(error => console.error("Error adding staff:", error));
    });
});

function fetchStaff() {
    fetch("../backend/get_staff.php")
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById("staffTableBody");
            tableBody.innerHTML = "";
            data.forEach(staff => {
                const row = `<tr>
                    <td>${staff.id}</td>
                    <td>${staff.name}</td>
                    <td>${staff.role}</td>
                    <td>${staff.contact}</td>
                    <td>${staff.email}</td>
                    <td>
                        <button onclick="deleteStaff(${staff.id})">Delete</button>
                    </td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error("Error fetching staff:", error));
}

function deleteStaff(id) {
    if (confirm("Are you sure you want to delete this staff member?")) {
        fetch("../backend/delete_staff.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) fetchStaff();
        })
        .catch(error => console.error("Error deleting staff:", error));
    }
}
