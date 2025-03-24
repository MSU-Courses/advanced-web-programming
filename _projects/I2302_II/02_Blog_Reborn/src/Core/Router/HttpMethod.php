<?php

namespace App\Core\Router;

enum HttpMethod
{
    case GET;
    case POST;
    case PUT;
    case DELETE;
    case PATCH;
    case OPTIONS;
    case HEAD;
    case TRACE;
    case CONNECT;
}
