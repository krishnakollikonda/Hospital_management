document.addEventListener("DOMContentLoaded", function () {
    fetchInventory();

    document.getElementById("addInventoryForm").addEventListener("submit", function (event) {
        event.preventDefault();
        
        const formData = new FormData(this);
        fetch("../backend/add_inventory.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                fetchInventory();
                this.reset();
            }
        })
        .catch(error => console.error("Error adding inventory:", error));
    });
});

function fetchInventory() {
    fetch("../backend/get_inventory.php")
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById("inventoryTableBody");
            tableBody.innerHTML = "";
            data.forEach(item => {
                const row = `<tr>
                    <td>${item.id}</td>
                    <td>${item.item_name}</td>
                    <td>${item.category}</td>
                    <td>${item.quantity}</td>
                    <td>${item.supplier}</td>
                    <td>
                        <button onclick="deleteInventory(${item.id})">Delete</button>
                    </td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error("Error fetching inventory:", error));
}

function deleteInventory(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        fetch("../backend/delete_inventory.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) fetchInventory();
        })
        .catch(error => console.error("Error deleting inventory:", error));
    }
}
