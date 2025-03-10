<?php

enum HTTP_STATUS_CODES: int
{
    case OK = 200;
    case CREATED = 201;
    case NO_CONTENT = 204;
    case MOVED_PERMANENTLY = 301;
    case FOUND = 302;
    case SEE_OTHER = 303;
    case BAD_REQUEST = 400;
    case UNAUTHORIZED = 401;
    case FORBIDDEN = 403;
    case NOT_FOUND = 404;
    case METHOD_NOT_ALLOWED = 405;
    case INTERNAL_SERVER_ERROR = 500;
}


$httpStatusMessages = [
    HTTP_STATUS_CODES::OK->value => "OK",
    HTTP_STATUS_CODES::CREATED->value => "Created",
    HTTP_STATUS_CODES::NO_CONTENT->value => "No Content",
    HTTP_STATUS_CODES::MOVED_PERMANENTLY->value => "Moved Permanently",
    HTTP_STATUS_CODES::FOUND->value => "Found",
    HTTP_STATUS_CODES::SEE_OTHER->value => "See Other",
    HTTP_STATUS_CODES::BAD_REQUEST->value => "Bad Request",
    HTTP_STATUS_CODES::UNAUTHORIZED->value => "Unauthorized",
    HTTP_STATUS_CODES::FORBIDDEN->value => "Forbidden",
    HTTP_STATUS_CODES::NOT_FOUND->value => "Not Found",
    HTTP_STATUS_CODES::METHOD_NOT_ALLOWED->value => "Method Not Allowed",
    HTTP_STATUS_CODES::INTERNAL_SERVER_ERROR->value => "Internal Server Error",
];

/**
 * Sends an HTTP error response with the specified error number.
 *
 * This function sets the HTTP response header to the specified error number
 * and its corresponding error message from the global $httpErrors array.
 * After setting the header, the function terminates the script execution.
 *
 * @param int $errorNumber The HTTP error number to send.
 *
 * @global array $httpErrors An associative array mapping HTTP error numbers to their messages.
 *
 * @return void
 */
function sendHttpStatus(HTTP_STATUS_CODES $statusCode)
{
    global $httpStatusMessages;

    header($_SERVER["SERVER_PROTOCOL"] . " $statusCode->value {$httpStatusMessages[$statusCode->value]}");

    return;
}

/**
 * Redirects the user to the specified location.
 *
 * @param string $location The URL to redirect to.
 *
 * @return void
 */
function route(string $location, HTTP_STATUS_CODES $statusCode = HTTP_STATUS_CODES::OK)
{
    sendHttpStatus($statusCode);

    header("Location: $location");

    return;
}
