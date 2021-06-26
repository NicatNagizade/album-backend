<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;

class Controller extends BaseController
{
    public function success($data = null, int $status = 200)
    {
        return new Response($data, $status);
    }

    public function error($errors = null, string $message = '', int $status = 400)
    {
        $count_args = func_num_args();
        if ($count_args === 0) {
            $message = 'Something went wrong';
            $errors = [];
        } else if ($errors instanceof MessageBag) {
            $errors = $errors->toArray();
            if ($count_args === 1) {
                $message = 'The given data was invalid.';
            }
            if ($count_args < 3) {
                $status = 422;
            }
        } else if ($count_args === 1 && is_string($errors)) {
            $message = (string) $errors;
            $errors = [];
        }
        $data = ['message' => $message, 'errors' => $errors];
        return new Response($data, $status);
    }
}
