<?php

/**
 * Handles the login process for users.
 *
 * This function checks if the user is already authenticated and redirects them
 * to the home page if they are. If the request method is POST, it attempts to
 * authenticate the user using the provided email, password, and "remember me"
 * option. If authentication is successful, the user is redirected to the home
 * page. Otherwise, error messages are displayed.
 *
 * The function also renders a login form for GET requests.
 *
 * @return void
 */
function loginHandler()
{
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

    $html = "
        <form method='POST' action=''>
            <label for='email'>Email:</label>
            <input type='email' name='email' id='email' required>
            <br>
            <label for='password'>Password:</label>
            <input type='password' name='password' id='password' required>
            <br>
            <label for='remember'>Remember me:</label>
            <input type='checkbox' name='remember' id='remember'>
            <br>
            <button type='submit'>Login</button>
        </form>
        <p>Don't have an account? <a href='/register'>Register</a></p>
    ";

    echo $html;
}

/**
 * Handles user registration.
 *
 * This function displays a registration form and processes the form submission.
 * If the user is already authenticated, they are redirected to the home page.
 * On form submission, it validates the input, checks if the email is already
 * registered, hashes the password, and saves the user to the database.
 * If registration is successful, the user is redirected to the login page.
 *
 * @return void
 */
function registerHandler()
{
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
    $html = "
        <form method='POST' action=''>
            <label for='name'>Name:</label>
            <input type='text' name='name' id='name' required>
            <br>
            <label for='email'>Email:</label>
            <input type='email' name='email' id='email' required>
            <br>
            <label for='password'>Password:</label>
            <input type='password' name='password' id='password' required>
            <br>
            <button type='submit'>Register</button>
        </form>
        <p>Already have an account? <a href='/login'>Login</a></p>
    ";

    echo $html;
}

/**
 * Handles the user logout process by terminating the current session
 * and redirecting the user to the login page.
 *
 * This function calls the `logout()` function to perform the logout
 * operation, then redirects the user to the `/login` page using an
 * HTTP header. The script execution is terminated immediately after
 * the redirection to ensure no further code is executed.
 *
 * @return void
 */
function logoutHandler()
{
    logout();
    header('Location: /login');
    exit;
}
