@extends('layouts.base')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile - Keyboard Shop</title>
    <link rel="stylesheet" href="styles.css">
</head>

<style>
:root {
    --primary-color: #2b2d42;
    --secondary-color: #7209b7;
    --accent-color: #4361ee;
    --background-color: #f8f9fa;
    --card-bg: #ffffff;
    --text-primary: #2b2d42;
    --text-secondary: #6c757d;
    --error-color: #ef233c;
    --success-color: #06d6a0;
    --border-radius: 12px;
    --box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
}

body {
    background: var(--background-color);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-primary);
    background-image: 
        linear-gradient(45deg, rgba(67, 97, 238, 0.05) 25%, transparent 25%),
        linear-gradient(-45deg, rgba(67, 97, 238, 0.05) 25%, transparent 25%),
        linear-gradient(45deg, transparent 75%, rgba(67, 97, 238, 0.05) 75%),
        linear-gradient(-45deg, transparent 75%, rgba(67, 97, 238, 0.05) 75%);
    background-size: 20px 20px;
    background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
}

.container {
    width: 100%;
    max-width: 800px;
    padding: 2rem;
}

.profile-card {
    background: var(--card-bg);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 3rem;
    position: relative;
    overflow: hidden;
}

.profile-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
}

h1 {
    text-align: center;
    color: var(--primary-color);
    margin-bottom: 2.5rem;
    font-size: 2.2rem;
    font-weight: 700;
    letter-spacing: -0.5px;
}

.profile-image {
    text-align: center;
    margin-bottom: 2.5rem;
    position: relative;
}

.profile-image img {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 1.5rem;
    border: 4px solid var(--card-bg);
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.profile-image img:hover {
    transform: scale(1.05);
}

#profile-upload {
    display: none;
}

.upload-btn {
    background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
    color: white;
    padding: 0.8rem 1.5rem;
    border-radius: var(--border-radius);
    cursor: pointer;
    display: inline-block;
    transition: all 0.3s ease;
    font-weight: 500;
    font-size: 0.95rem;
}

.upload-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
}

.form-group {
    margin-bottom: 1.5rem;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--text-primary);
    font-weight: 600;
    font-size: 0.95rem;
}

input, select {
    width: 100%;
    padding: 0.8rem 1rem;
    border: 2px solid #e9ecef;
    border-radius: var(--border-radius);
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
    color: var(--text-primary);
}

input:focus, select:focus {
    outline: none;
    border-color: var(--accent-color);
    background: white;
    box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
}

.save-btn {
    background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: var(--border-radius);
    cursor: pointer;
    width: 100%;
    font-size: 1.1rem;
    font-weight: 600;
    margin-top: 2rem;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.save-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(67, 97, 238, 0.4);
}

.save-btn:active {
    transform: translateY(0);
}

/* Modern Form Layout */
@media (min-width: 768px) {
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
}

/* Animated Input Focus */
input:not(:placeholder-shown):valid {
    border-color: var(--success-color);
}

input:not(:placeholder-shown):invalid {
    border-color: var(--error-color);
}

/* Password Strength Indicator */
.password-strength {
    height: 4px;
    margin-top: 0.5rem;
    border-radius: 2px;
    background: #e9ecef;
    overflow: hidden;
}

.password-strength::before {
    content: '';
    display: block;
    height: 100%;
    width: 0;
    background: linear-gradient(90deg, var(--error-color), var(--success-color));
    transition: width 0.3s ease;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }

    .profile-card {
        padding: 2rem;
    }

    h1 {
        font-size: 1.8rem;
    }

    .profile-image img {
        width: 150px;
        height: 150px;
    }

    .save-btn {
        padding: 0.8rem 1.5rem;
        font-size: 1rem;
    }
}

/* Modern Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: var(--accent-color);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--secondary-color);
}

/* Custom Select Styling */
select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%236c757d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 1em;
}

/* Input Placeholder Animation */
input::placeholder {
    transition: transform 0.2s ease, opacity 0.2s ease;
}

input:focus::placeholder {
    transform: translateX(10px);
    opacity: 0.5;
}

/* Card Hover Effect */
.profile-card:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
}

    
    </style>
<body>
    <div class="container">
        <div class="profile-card">
            <h1>Customer Profile</h1>
            <div class="profile-image">
                <img id="preview" src="https://via.placeholder.com/150" alt="Profile Picture">
                <input type="file" id="profile-upload" accept="image/*" onchange="previewImage(this)">
                <label for="profile-upload" class="upload-btn">Upload Photo</label>
            </div>
            <form id="profile-form">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" min="18" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="tel" id="contact" name="contact" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="save-btn">Save Profile</button>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('profile-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your form submission logic here
            alert('Profile updated successfully!');
        });
    </script>
</body>
</html>