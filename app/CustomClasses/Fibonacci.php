<?php
// Author: Luke Kendall
// Date: 9-16-2022
// Version: 0.11

// Fibonacci Sequence
// Define F0 = 0, F1 = 1, F2 = 1, F3 = 2, ...

// Sequence formula
// Fn = Fn-1 + Fn-2

namespace App\CustomClasses;

abstract class Fibonacci
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
    
    abstract protected function calc($nth) : int;

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
    // Return answer
    //
    public function answer()
    {
        return $this->isSeq ? $this->sequence : collect([$this->sequence->last()]);
    }
}
