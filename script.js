// Feature 1: Admin Login
function login() {
    const user = document.getElementById('adminUser').value;
    const pass = document.getElementById('adminPass').value;
    if(user === 'admin' && pass === 'admin123') {
        document.getElementById('loginPage').style.display = 'none';
        document.getElementById('mainDashboard').style.display = 'block';
        loadResults();
    } else alert("Error Credentials");
}

// Feature 2, 3, 4, 6: Add, Edit, Marks Entry, Calculations
document.getElementById('studentForm').onsubmit = async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    await fetch('process.php?action=save', { method: 'POST', body: formData });
    e.target.reset();
    loadResults();
};

// Feature 7: Display All Results
async function loadResults() {
    const res = await fetch('process.php?action=list');
    const data = await res.json();
    let table = `<table><tr><th>Roll</th><th>Name</th><th>Total</th><th>%</th><th>Grade</th><th>Action</th></tr>`;
    data.forEach(s => {
        table += `<tr><td>${s.roll_number}</td><td>${s.full_name}</td><td>${s.total}</td>
                  <td>${s.percentage}%</td><td><b>${s.grade}</b></td>
                  <td><button class="del-btn" onclick="deleteStudent(${s.id})">Delete</button></td></tr>`;
    });
    document.getElementById('resultsTable').innerHTML = table + "</table>";
}

// Feature 5: Search
async function searchStudent() {
    const roll = document.getElementById('searchRoll').value;
    const res = await fetch(`process.php?action=search&roll=${roll}`);
    const s = await res.json();
    document.getElementById('searchOutput').innerHTML = s ? 
        `<p style="color:green">Student: ${s.full_name} | Grade: ${s.grade}</p>` : `<p style="color:red">Not Found</p>`;
}

// Feature 7: Delete
async function deleteStudent(id) {
    if(confirm('Delete record?')) {
        await fetch(`process.php?action=delete&id=${id}`);
        loadResults();
    }
}