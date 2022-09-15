<?php
// Author: Luke Kendall
// Date: 9-14-2022
// Version: 0.1

// Fibonacci Sequence
// Define F0 = 0, F1 = 1, F2 = 1, F3 = 2, ...

// Sequence formula
// Fn = Fn-1 + Fn-2

namespace App\CustomClasses;

use OverflowException;

class Fibonacci
{
    const n0 = 0;
    const n1 = 1;

    protected $sequence;

    //
    // Parameter $form can be array from request input 'nth' and/or 'isSeq' or 'nth' INT
    // Parameter isSeq: bool - return all results from N0 to Nth
    //
    public function __construct(array|int $form = NULL, public bool $isSeq = false )
    {
        $this->sequence = collect([
            ['id' => 0, 'fn' => self::n0], 
            ['id' => 1, 'fn' => self::n1]
        ]);
        $this->isSeq = $form['isSeq'] ?? $isSeq;
        $this->fib($form['nth'] ?? $form);
    }
    
    //
    //Init sequence for calc
    //
    public function fib($nth = 0)
    {
        if ($nth < 0 || !is_int($nth)) {
            return NULL;
        }

        if($nth == 0){
            $this->sequence->pop();
        }

        return match ($nth){
            0 => self::n0,
            1 => self::n1,
            default => $this->calc($nth),
        };
    }

    //
    // Sequence calculation
    //
    protected function calc($nth)
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

    //
    // Return answer
    //
    public function answer()
    {
        return $this->isSeq ? $this->sequence : collect([$this->sequence->last()]);
    }
}
