<?php

const VALID_USERNAME_PATTERN =  '/^[a-zA-Z0-9_-]{3,20}$/';
const INVALID_USERNAME_PATTERN = '/^(?!^[a-zA-Z0-9_-]{3,20}$).+$/';
const VALID_PASSWORD_PATTERN = '/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?`~]).{8,}$/';
const INVALID_PASSWORD_PATTERN = '/^(?!^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?`~]).{8,}$).+$/';

const MAX_NUMBER_OF_TRIES = 3;

function isValidUsername($username)
{
    return boolval(preg_match(VALID_USERNAME_PATTERN, $username));
}


function isValidPassword($password)
{
    return boolval(preg_match(VALID_PASSWORD_PATTERN, $password));
}
