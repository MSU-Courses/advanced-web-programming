# Simple Authentication System

This project demonstrates a basic authentication system implemented in PHP. It includes features such as user registration, login, logout, and a "Remember Me" functionality using cookies and sessions.

## Features

- **User Registration**: Allows users to create an account with a name, email, and password.
- **User Login**: Authenticates users using their email and password.
- **Session Management**: Tracks logged-in users using PHP sessions.
- **"Remember Me" Functionality**: Keeps users logged in across browser sessions using secure cookies.
- **Logout**: Ends the user session and clears cookies.
- **Password Hashing**: Ensures secure storage of passwords using `password_hash()` and `password_verify()`.

## Project Structure

```
project/
    ├── config/
    │   ├── database.php          # Database configuration
    │   ├── session.php           # Session configuration
    ├── src/
    │   ├── core/
    │   │   ├── auth.php          # Core authentication logic
    │   │   ├── database.php      # Database connection setup
    │   ├── helpers/
    │   │   ├── auth.php          # Helper functions for authentication
    │   │   ├── session.php       # Session management functions
    │   │   ├── token.php         # Token management for "Remember Me"
    │   ├── models/
    │   │   ├── user.php          # User model for database interactions
    ├── index.php                 # Main entry point
    ├── readme.md                 # Project documentation
```

## Installation

1. Clone the repository:

   ```bash
   git clone <repository-url>
   cd _samples/10_auth/10_01_simple_auth
   ```

2. Configure the database:

   - Make clone of `config/database.sample.php` to `config/database.php`.
   - Update `config/database.php` with your database credentials.
   - Import the SQL schema for the `users` table:
     ```sql
     CREATE TABLE users (
         id INT AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(255) NOT NULL,
         email VARCHAR(255) UNIQUE NOT NULL,
         password VARCHAR(255) NOT NULL,
         remember_token VARCHAR(255) DEFAULT NULL
     );
     ```

3. Start a local PHP server:

   ```bash
   php -S localhost:8000 -t . index.php
   ```

4. Open your browser and navigate to `http://localhost:8000`.

## Usage

### Registration

- Visit `/register` to create a new account.

### Login

- Visit `/login` to log in with your email and password.
- Optionally, check the "Remember Me" box to stay logged in across sessions.

### Logout

- Visit `/logout` to log out and clear your session.

### Protected Routes

- Access the home page (`/`) to see the logged-in user's details.
- If not logged in, the system will attempt to authenticate using the "Remember Me" token.

## Security Features

- **Password Hashing**: Passwords are hashed using `password_hash()` for secure storage.
- **Session Regeneration**: Session IDs are regenerated after login to prevent session fixation attacks.
- **HttpOnly Cookies**: Cookies are set with the `HttpOnly` flag to prevent JavaScript access.
- **Token-Based Authentication**: The "Remember Me" functionality uses secure, randomly generated tokens.

## Configuration

### Database Configuration

Update the `config/database.php` file with your database credentials.

### Session Configuration

Modify session settings in `config/session.php`:

- `remember_token_name`: Name of the cookie for the "Remember Me" token.
- `remember_token_expiry`: Expiration time for the "Remember Me" token (in seconds).

## License

This project is for educational purposes. Use at your own risk.
