// Get elements
console.log("✅ dashboard.js is loaded");

const openComplaintsCard = document.getElementById('open-complaints-card');
const totalComplaintsCard = document.querySelector('.stat-card:nth-child(2)');
const resolvedComplaintsCard = document.querySelector('.stat-card:nth-child(3)');
const complaintsList = document.getElementById('complaints-list');
const openComplaintsSection = document.getElementById('open-complaints-section');
const complaintsTitle = document.getElementById('complaints-title');

// Function to fetch complaints
function fetchComplaints(type) {
    fetch(`fetch_complaints.php?type=${type}`)
        .then(response => response.json())
        .then(data => {
            complaintsList.innerHTML = '';

            // Show section title
            if (type === 'open') {
                complaintsTitle.textContent = 'Open Complaints';
            } else if (type === 'total') {
                complaintsTitle.textContent = 'All Complaints';
            } else if (type === 'resolved') {
                complaintsTitle.textContent = 'Resolved Complaints';
            }

            // Populate the table
            if (data.length === 0) {
                complaintsList.innerHTML = `<tr><td colspan="4">No complaints found.</td></tr>`;
            } else {
                data.forEach(complaint => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${complaint.student_name}</td>
                        <td>${complaint.room}</td>
                        <td>${complaint.description}</td>
                        <td>${complaint.status}</td>
                    `;
                    complaintsList.appendChild(row);
                });
            }

            // Show the section
            openComplaintsSection.classList.add('active');
        })
        .catch(error => {
            console.error('Error fetching complaints:', error);
        });
}

// Attach events
openComplaintsCard.addEventListener('click', () => fetchComplaints('open'));
//totalComplaintsCard.addEventListener('click', () => fetchComplaints('total'));
// Assuming you have an element with id "totalComplaintsButton"
totalComplaintsCard.addEventListener("click", function() {
    window.location.href = "total_complaints.php";
});
resolvedComplaintsCard.addEventListener('click', () => fetchComplaints('resolved'));
