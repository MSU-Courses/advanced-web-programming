<?php

/**
 * Handles the rendering of the home page.
 *
 * This function generates and outputs the HTML for the home page of the
 * Simple Auth System. It displays a welcome message and dynamically adjusts
 * the content based on the user's authentication status.
 *
 * - If the user is authenticated, it shows their name and a logout button.
 * - If the user is not authenticated, it provides links to the login and
 *   registration pages.
 */
function homeHandler()
{
    $user = getCurrentUser();

    $html = "
        <div>
            <h1>Welcome to the Simple Auth System.</h1>
            <p>You are logged in as: " . ($user ? $user["name"] : "Guest") . "</p>
    ";

    if (isAuthenticated()) {
        $html .= "
            <form method='POST' action='/logout'>
                <button type='submit'>Logout</button>
            </form>
        ";
    } else {
        $html .= "
            <p><a href='/login'>Login</a></p>
            <p><a href='/register'>Register</a></p>
        ";
    }

    $html .= "
        </div>
        ";

    echo $html;
}

/**
 * Handles the "About" page request.
 *
 * This function generates and displays the HTML content for the "About" page.
 * It retrieves the current user's information and displays a welcome message
 * along with the user's name if logged in, or "Guest" if no user is logged in.
 *
 * @return void
 */
function aboutHandler()
{
    $user = getCurrentUser();

    $html = "
        <div>
            <h1>Welcome to the Simple Auth System.</h1>
            <p>You are logged in as: " . ($user ? $user["name"] : "Guest") . "</p>
        </div>
    ";

    echo $html;
}
