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
    const userId = "?";

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

