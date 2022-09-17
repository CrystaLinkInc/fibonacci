<?php 
// Author: Luke Kendall
// Date: 9-16-2022
// Version: 0.1

// Fibonacci Sequence
// Define F0 = 0, F1 = 1, F2 = 1, F3 = 2, ...

// Golden Ratio formula
// g = (1+sqrt(5))/2
// Fn = (g^n + (1-g)^n)/sqrt(5)

namespace App\CustomClasses;

use OverflowException;

class GoldenRatio extends Fibonacci
{
    
    //
    // Golden Ratio calculation
    //
    protected function calc($nth) : int
    {
        $gr = (1+sqrt(5))/2;
        $idx = $this->isSeq ? 2 : $nth;

        if (!$this->isSeq){
            $this->sequence->pop(0);
        }

        while($idx<=$nth){
            $fn = (int)round(($gr**$idx + (1-$gr)**$idx) / sqrt(5));
            // Return expecting to be an integer.
            // Throw overfow if $fn type changes to DOUBLE
            $this->sequence->add(['id' => $idx++, 'fn' => $fn]);
            if($fn < 0) {
                throw new OverflowException('Too big');
            }
        }
        return $fn;

    }
}