<?php

/**
 * Sanitize data to prevent XSS attacks.
 * 
 * @param mixed $data
 * 
 * @return mixed $sanitizedData Sanitized data
 */
function sanitizeData(mixed $data): mixed
{
    if (is_array($data)) {
        return sanitizeArrayData($data);
    }
    return htmlentities($data);
}

/**
 * Sanitize array data to prevent XSS attacks.
 * 
 * @param array $data
 * 
 * @return array $sanitizedData Sanitized array data
 */
function sanitizeArrayData(array $data): array
{
    $sanitizedData = [];
    foreach ($data as $key => $value) {
        $sanitizedData[$key] = is_array($value) ? sanitizeArrayData($value) : htmlentities($value);
    }
    return $sanitizedData;
}
