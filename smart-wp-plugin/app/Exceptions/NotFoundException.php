<?php

namespace SmartWpPlugin\Exceptions;

use Exception;

/**
 * Class NotFoundException
 *
 * @package  SmartWpPlugin\Exceptions
 */
class NotFoundException extends \Exception
{
    /**
     * NotFoundException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($message = 'not_found', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
