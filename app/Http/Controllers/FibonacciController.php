<?php

namespace App\Http\Controllers;

use App\CustomClasses\GoldenRatio;
use App\CustomClasses\SequenceMethod;
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
            'isSeq' => [],
            'formula' => [],
        ]);
        try{
            $f = $form["formula"] == 'seq' ? new SequenceMethod($form) : new GoldenRatio($form);

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
