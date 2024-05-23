function toggleContent() {
    var content = document.getElementById('content');
    if (content.style.display === 'none' || content.style.display === '') {
        content.style.display = 'block';
    } else {
        content.style.display = 'none';
    }
}

function showModal(modalType) {
    var overlay = document.getElementById('overlay');
    var modal = document.getElementById('modal' + modalType.charAt(0).toUpperCase() + modalType.slice(1)); // Capitalize first letter

    // Close all modals first
    closeModal();

    // Display the overlay and modal
    overlay.style.display = 'block';
    modal.style.display = 'block';
}

function closeModal() {
    var overlay = document.getElementById('overlay');
    var modals = document.querySelectorAll('.modal');

    // Hide the overlay and all modals
    overlay.style.display = 'none';
    modals.forEach(function(modal) {
        modal.style.display = 'none';
    });
}

// Function to handle submission of the profile picture change form
function submitProfilePicture(event) {
    event.preventDefault(); // Prevent default form submission

    // Add your logic here to handle the form submission
    // For example, you can upload the selected profile picture to the server

    // After the profile picture is uploaded successfully, close the modal
    closeModal();
}



// Function to show the change profile picture modal
function showChangeProfilePictureModal() {
    var overlay = document.getElementById('overlay');
    var modal = document.getElementById('modalChangeProfilePicture');

    // Close all modals first
    closeModal();

    // Display the overlay and modal
    overlay.style.display = 'block';
    modal.style.display = 'block';
}


// Function to show the reset password modal
function showModal(modalType) {
    var overlay = document.getElementById('overlay');
    var modal = document.getElementById('modal' + modalType.charAt(0).toUpperCase() + modalType.slice(1)); // Capitalize first letter

    // Close all modals first
    closeModal();

    // Display the overlay and modal
    overlay.style.display = 'block';
    modal.style.display = 'block';
}


document.addEventListener('DOMContentLoaded', function() {
    // Function to fetch transactions
    function fetchTransactions(patientId) {
        fetch(`fetch_transactions.php?patient_id=${patientId}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched transactions:', data); // Debugging output
                const tableBody = document.getElementById('transactionHistoryBody');
                if (data.error) {
                    console.error('Error from server:', data.error);
                    tableBody.innerHTML = `<tr><td colspan="4">${data.error}</td></tr>`;
                    return;
                }
                if (data.length === 0) {
                    tableBody.innerHTML = '<tr><td colspan="4">No transactions found</td></tr>';
                    return;
                }
                data.forEach(transaction => {
                    const row = document.createElement('tr');

                    const dateCell = document.createElement('td');
                    dateCell.textContent = transaction.date;
                    row.appendChild(dateCell);

                    const nameCell = document.createElement('td');
                    nameCell.textContent = transaction.name;
                    row.appendChild(nameCell);

                    const amountCell = document.createElement('td');
                    amountCell.textContent = transaction.amount;
                    row.appendChild(amountCell);

                    const statusCell = document.createElement('td');
                    statusCell.className = `status-${transaction.status.toLowerCase()}`;
                    statusCell.textContent = transaction.status;
                    row.appendChild(statusCell);

                    tableBody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error fetching transaction data:', error); // Debugging output
                const tableBody = document.getElementById('transactionHistoryBody');
                tableBody.innerHTML = '<tr><td colspan="4">Failed to load transactions</td></tr>';
            });
    }

    // Replace this with the actual user_id from your application
    const userId = 123; 

    // Fetch transactions for the specified user_id
    fetchTransactions(userId);
});


