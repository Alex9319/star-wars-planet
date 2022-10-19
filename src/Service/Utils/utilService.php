<?php

namespace App\Service\Utils;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Validation;

class utilService
{
    /**
     * Function from have a format to response
     *
     * @param bool $status
     * @param array $data
     * @param integer $statusCode
     * @param string|null $error
     * @return void
     */
    function sendResponse(bool $status, array $data, int $statusCode, string $error = null){

        $result = [
            'data'       => $data,
            'status'     => $status,
            'statusCode' => $statusCode
        ];

        if(!is_null($error)){
            $result['error'] = $error;
        }

        return $result;
    }

}