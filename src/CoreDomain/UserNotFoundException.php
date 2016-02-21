<?php

namespace CoreDomain;

use Exception;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class UserNotFoundException indicates a request can not be done because the specified username do not exists.
 *
 * @package CoreDomain
 */
class UserNotFoundException extends Exception
{
    public function __construct($username)
    {
        parent::__construct("Username '" . $username . "' was not found !!!", Response::HTTP_NOT_FOUND);
    }
}
