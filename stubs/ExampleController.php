<?php
namespace App\Domains\Example\Controllers;

use App\Domains\Example\Requests\ExampleRequest;
use App\Http\Controllers\Controller;

class ExampleController extends Controller
{
    public function example(ExampleRequest $request)
    {
        // Do something with your request

        return response('I am working example');
    }
}
