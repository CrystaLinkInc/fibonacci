<?php 
// Author: Luke Kendall
// Date: 9-16-2022
// Version: 0.1

// Fibonacci Sequence
// Define F0 = 0, F1 = 1, F2 = 1, F3 = 2, ...

// Sequence formula
// Fn = Fn-1 + Fn-2

namespace App\CustomClasses;

use OverflowException;

class SequenceMethod extends Fibonacci
{
    //
    // Sequence calculation
    //
    protected function calc($nth) : int
    {
        $fn = 0;
        $x0 = self::n0;
        $x1 = self::n1;

        for($idx = 2; $idx <= $nth; $idx++){
            $fn = $x0 + $x1;
            $x0 = $x1;
            $x1 = $fn;

            // Return expecting to be an integer.
            // Throw overfow if $fn type changes to DOUBLE
            if(! is_int($fn)) {
                throw new OverflowException();
            }
            $this->sequence->add(['id' => $idx, 'fn' => $fn]);
        }
        return $fn;
    }

}