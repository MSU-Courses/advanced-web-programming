<?php

require_once __DIR__ . '/src/core/config.php';
require_once __DIR__ . '/src/helpers/auth.php';
require_once __DIR__ . '/src/helpers/token.php';
require_once __DIR__ . '/src/helpers/session.php';
require_once __DIR__ . '/src/models/user.php';
require_once __DIR__ . '/src/core/database.php';
require_once __DIR__ . '/src/core/auth.php';

// set the httpOnly flag for the session cookie
session_set_cookie_params([
    'httpOnly' => true,
]);

// start the session
session_start();

if (!isAuthenticated()) {
    tryLoadUserFromToken();
}

// simple routing with switch statement
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url) {
    case '/':
        $user = getCurrentUser();

        echo "
            <div>
                <h1>Welcome to the Simple Auth System.</h1>
                <p>You are logged in as: " . ($user ? $user["name"] : "Guest") . "</p>
            </div>
        ";
        break;
    case '/about':
        $user = getCurrentUser();

        echo "
            <div>
                <h1>About</h1>
                <p>This is a simple authentication system.</p>
                <p>You are logged in as: " . ($user ? $user["name"] : "Guest") . "</p>
            </div>
        ";
        break;
    case '/login':
        redirectIfAuthenticated('/');

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
            $remember = isset($_POST['remember']);

            $errors = tryAttemp(
                $email,
                $password,
                $remember
            );

            if (!$errors) {
                echo "Login successful!";
                header('Location: /');
                exit;
            }

            foreach ($errors ?? [] as $error) {
                echo "<p style='color: red;'>$error</p>";
            }
        }

        // Display login form
        echo "
            <form method='POST' action=''>
                <input type='email' name='email' placeholder='Email' required>
                <input type='password' name='password' placeholder='Password' required>
                <label for='remember'>Remember me</label>
                <input type='checkbox' name='remember' id='remember'>
                <button type='submit'>Login</button>
            </form>
            <p>Don't have an account? <a href='/register'>Register</a></p>
        ";
        break;
    case '/register':
        redirectIfAuthenticated('/');

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = $_POST['name'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            if (userExists($email)) {
                echo "<p style='color: red;'>Email already registered.</p>";
            }

            if ($name && $email && $password) {
                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                // Save user to database
                saveUser($name, $email, $hashedPassword);
                echo "Registration successful!";
                header('Location: /login');
                exit;
            } else {
                echo "<p style='color: red;'>Please fill in all fields.</p>";
            }
        }


        // Display registration form
        echo "
            <form method='POST' action=''>
                <input type='text' name='name' placeholder='Name' required>
                <input type='email' name='email' placeholder='Email' required>
                <input type='password' name='password' placeholder='Password' required>
                <button type='submit'>Register</button>
            </form>
        ";
        break;
    case '/logout':
        logout();
        header('Location: /login');
        break;
    default:
        http_response_code(404);
        echo '404 Not Found';
        break;
}
