<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Patient Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: #fff;
            width: 90%;
            max-width: 500px;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .header-icons {
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .header-icons i {
            font-size: 2rem;
            color: #00796b;
        }

        h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        .input-group {
            position: relative;
            margin: 15px 0;
        }

        input {
            width: 100%;
            padding: 12px 40px 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #00796b;
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
            font-size: 0.9rem;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #00796b;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s;
        }

        button:hover {
            background: #005f56;
        }

        .switch-form {
            text-align: center;
            margin-top: 20px;
        }

        .switch-form a {
            color: #00796b;
            text-decoration: none;
            font-weight: 500;
        }

        .dark-mode {
            background: #2a2a2a;
            color: white;
        }

        .dark-mode .container {
            background: #363636;
        }

        .dark-mode input {
            background: #444;
            color: white;
            border-color: #555;
        }

        .dark-mode-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            cursor: pointer;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <!-- Sign In Form -->
    <div class="container" id="signin-container">
        <div class="header-icons">
            <i class="fas fa-heartbeat"></i>
            <i class="fas fa-pills"></i>
            <i class="fas fa-hospital-user"></i>
        </div>
        <h1>Patient Sign In</h1>
        <form id="signInForm">
            <div class="input-group">
                <input type="tel" placeholder="Phone Number" pattern="[0-9]{10}" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" required>
                <i class="fas fa-eye toggle-password"></i>
            </div>
            <div class="options">
                <label>
                    <input type="checkbox"> Remember me
                </label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit">Sign In</button>
        </form>
        <div class="switch-form">
            Don't have an account? <a href="#" id="showSignUp">Sign Up</a>
        </div>
    </div>

    <!-- Sign Up Form -->
    <div class="container" id="signup-container" style="display: none;">
        <div class="header-icons">
            <i class="fas fa-heartbeat"></i>
            <i class="fas fa-pills"></i>
            <i class="fas fa-hospital-user"></i>
        </div>
        <h1>Create Patient Account</h1>
        <form id="signUpForm">
            <div class="input-group">
                <input name="fstName" type="text" placeholder="First Name" required>
            </div>
            <div class="input-group">
                <input name="FName" type="text" placeholder="Family Name" required>
            </div>
            <div class="input-group">
                <input name="age" type="text" placeholder="age" required>
            </div>
            <div class="input-group">
                <input name="num" type="tel" placeholder="Phone Number" pattern="[0-9]{10}" required>
            </div>
            <div class="input-group">
                <input name="email" type="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <input name="password" type="password" placeholder="Password" required>
                <i class="fas fa-eye toggle-password"></i>
            </div>
            <button type="submit">Sign Up</button>
        </form>
        <div class="switch-form">
            Already have an account? <a href="#" id="showSignIn">Sign In</a>
        </div>
    </div>

    <div class="dark-mode-toggle">
        <i class="fas fa-moon"></i>
    </div>

    <script>
        // Toggle between forms
        document.getElementById('showSignUp').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('signin-container').style.display = 'none';
            document.getElementById('signup-container').style.display = 'block';
        });

        document.getElementById('showSignIn').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('signup-container').style.display = 'none';
            document.getElementById('signin-container').style.display = 'block';
        });

        // Password Toggle
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', (e) => {
                const input = e.target.previousElementSibling;
                input.type = input.type === 'password' ? 'text' : 'password';
                e.target.classList.toggle('fa-eye-slash');
            });
        });

        // Dark Mode Toggle
        document.querySelector('.dark-mode-toggle').addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            document.querySelector('.dark-mode-toggle i').classList.toggle('fa-sun');
        });

        // Form Validation
        document.getElementById('signInForm').addEventListener('submit', (e) => {
            e.preventDefault();
            if (document.querySelector('#signInForm input[type="tel"]').validity.valid) {
                alert('Sign In Successful!');
            }
        });

        document.getElementById('signUpForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const inputs = e.target.querySelectorAll('input');
            let valid = true;
            inputs.forEach(input => {
                if (!input.validity.valid) valid = false;
            });
            if (valid) alert('Sign Up Successful!');
        });
    </script>
</body>

</html>