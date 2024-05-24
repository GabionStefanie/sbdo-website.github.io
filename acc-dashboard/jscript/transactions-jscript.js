document.addEventListener('DOMContentLoaded', function() {
    // Fetch and display transactions
    function fetchTransactions(patientId) {
        fetch(`fetch_transactions.php?patient_id=${patientId}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched transactions:', data); // Debugging output
                const tableBody = document.getElementById('transactionHistoryBody');
                tableBody.innerHTML = ''; // Clear existing rows
                
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

// Toggle content display
function toggleContent() {
    var content = document.getElementById('content');
    if (content.style.display === 'none' || content.style.display === '') {
        content.style.display = 'block';
    } else {
        content.style.display = 'none';
    }
}

// Show modal by type
function showModal(modalType) {
    var overlay = document.getElementById('overlay');
    var modal = document.getElementById('modal' + modalType.charAt(0).toUpperCase() + modalType.slice(1)); // Capitalize first letter

    // Close all modals first
    closeModal();

    // Display the overlay and modal
    overlay.style.display = 'block';
    modal.style.display = 'block';
}

// Close all modals
function closeModal() {
    var overlay = document.getElementById('overlay');
    var modals = document.querySelectorAll('.modal');

    // Hide the overlay and all modals
    overlay.style.display = 'none';
    modals.forEach(function(modal) {
        modal.style.display = 'none';
    });
}

// Handle submission of the profile picture change form
function submitProfilePicture(event) {
    event.preventDefault(); // Prevent default form submission

    // Get the form element
    const form = document.getElementById('formChangeProfilePicture');
    
    // Create a FormData object from the form
    const formData = new FormData(form);
    
    // Send the form data to the server using fetch
    fetch('upload_profile_picture.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Profile picture uploaded successfully
            console.log('Profile picture uploaded successfully:', data.message);
            closeModal();
            // Optionally, update the profile picture displayed on the page
        } else {
            // Handle upload error
            console.error('Error uploading profile picture:', data.message);
        }
    })
    .catch(error => {
        console.error('Error uploading profile picture:', error);
    });
}


// Show change profile picture modal
function showChangeProfilePictureModal() {
    showModal('ChangeProfilePicture');
}
