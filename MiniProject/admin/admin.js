// var loginForm = document.getElementById('loginForm');

// loginForm.addEventListener('submit', function(event) {
//     event.preventDefault();

//     var formData = new FormData(loginForm);
//     fetch('admin.php', {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.json()) // Parse JSON response
//     .then(data => {
//         if (data.status === 'success') {
//             alert("Login successful!");
//             window.location.href = "admin_home.html";
//         } else {
//             alert("Login failed");
//         }
//     })
//     .catch(error => console.error(error));
// });
