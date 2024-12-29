<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .container input[type="text"], .container input[type="email"], .container input[type="password"], .container select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .container button:hover {
            background-color: #45a049;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            color: #d9534f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form id="registerForm">
            <input type="text" id="fullName" name="fullName" placeholder="Full Name" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" required>
            <select id="userType" name="userType" required>
                <option value="" disabled selected>Select User Type</option>
                <option value="student">Student</option>
                <option value="staff">Staff</option>
            </select>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <div class="message" id="message"></div>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from submitting normally

            const fullName = document.getElementById('fullName').value;
            const email = document.getElementById('email').value;
            const phoneNumber = document.getElementById('phoneNumber').value;
            const userType = document.getElementById('userType').value;
            const password = document.getElementById('password').value;

            if (!fullName || !email || !phoneNumber || !userType || !password) {
                document.getElementById('message').innerText = "All fields are required!";
                return;
            }

            // Send data to the backend (PHP script)
            fetch('/university_transportation/university_transportation/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    fullName: fullName,
                    email: email,
                    phoneNumber: phoneNumber,
                    userType: userType,
                    password: password
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('message').innerText = data.message;
                if (data.message.includes('successful')) {
                    document.getElementById('registerForm').reset(); // Reset the form if registration is successful
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('message').innerText = "An error occurred. Please try again later.";
            });
        });
    </script>
</body>
</html>
