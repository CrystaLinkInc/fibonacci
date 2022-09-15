<?php

namespace App\Http\Controllers;

use App\CustomClasses\Fibonacci;
use OverflowException;

class FibonacciController extends Controller
{
    public function index()
    {
        return inertia('fibonacci');
    }

    public function store()
    {
        $form = request()->validate([
            'nth' => ['required', 'integer', 'Numeric'],
            'isSeq' => []
        ]);
        try{
            $f = new Fibonacci($form);

            // Should format in a resource
            return inertia('fibonacci', 
                ['fib' => $f->answer(),
                'ans' => $f->answer()->last(),
                'ov' => ''
            ]);
        }  catch(OverflowException){
            // Quick and dirty overflow catch
            return  inertia('fibonacci', ['ov' => 'Exceeded maximum for a 64-bit integer.']);
        }
    }
}
