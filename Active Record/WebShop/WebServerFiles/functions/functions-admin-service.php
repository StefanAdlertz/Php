<?php
function SanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');

    if (preg_match('/[\'"\\\;#]/', $data)) {
        throw new Exception("Invalid input: potential SQL injection characters detected.");
    }

    if (!is_string($data) || strlen($data) > 1000) {
        throw new Exception("Invalid input: string is too long or of the wrong type.");
    }

    return $data;
}

function SanitizeEmail($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');

    if (preg_match('/[\'"\\\;#]/', $data)) {
        throw new Exception("Invalid input: potential SQL injection characters detected.");
    }

    if (!is_string($data) || strlen($data) > 1000) {
        throw new Exception("Invalid input: string is too long or of the wrong type.");
    }
    if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid input: not a valid email address.");
    }

    return $data;
}

function getFirstPage()
{
    return "<h2>Welcome to the SA Education Demo Shop Admin Tool!</h2>
    <br/><p>This platform is designed for educational purposes and is not intended for commercial use. Developed in PHP and My SQL Server, it serves as a self-learning project for myself to understand the fundamentals of web development and e-commerce management. 
    <br/><br/>The admin tool allows you to manage products, categories, and customer information efficiently. Explore features like adding, updating, and deleting entries, all within a user-friendly interface. Please note, this is a demo environment, and any data entered is for practice and learning only. Kindly use respectful language and have fun exploring and improving your web development skills!
    <br/><br/>Feel free to visit the Web Shop: <a href='https://adlertz.se/shop/'>https://adlertz.se/shop/</a>
    </p>";
}
