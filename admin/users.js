function createOrUpdateUser() {
    const userName = document.getElementById('UserName').value;
    const userEmail = document.getElementById('UserEmail').value;
    const userPassword = document.getElementById('userPassword').value;
    const status = document.getElementById('status').value;

    fetch('your-backend-endpoint', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            UserName: userName,
            UserEmail: userEmail,
            userPassword: userPassword,
            status: status
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
           
            window.location.href = '?success=true';
        } else {
           
            alert('Error al guardar el usuario');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}