<?php

// Fibonacci Sequence
// Define F0 = 0, F1 = 1, F2 = 1, F3 = 2, ...

// Sequence formula
// Fn = Fn-1 + Fn-2

use App\CustomClasses\Fibonacci;

beforeEach(function() {
    $this->f = new Fibonacci();
});

test('calc at construct of class with int parameters', function(){
    $ff = new Fibonacci(6, false);
    expect($ff->answer()->last()['fn'])
        ->toEqual(8)
        ->and($ff->answer()->count())
        ->toEqual(1);
});

test('calc at construct of class with array parameters', function(){
    $ff = new Fibonacci(['nth' => 6, 'isSeq' => false]);
    expect($ff->answer()->last()['fn'])
        ->toEqual(8)
        ->and($ff->answer()->count())
        ->toEqual(1);
});

test('calc at construct of class with array and bool parameters', function(){
    $ff = new Fibonacci(['nth' => 6], true);
    expect($ff->answer()->last()['fn'])
        ->toEqual(8)
        ->and($ff->answer()->count())
        ->toEqual(7);
});

test('if Nth is a negative number return NULL', function(){
    expect($this->f->fib(-1))
        ->toBeNull();
});

test('if Nth is not an integer return NULL', function(){
    expect($this->f->fib('not a number'))
        ->toBeNull();
});

test('Nth = 0 return 0 and sequence = 0 0', function(){
    expect($this->f->fib(0))
        ->toEqual(0)
        ->and($this->f->answer()->last())
        ->toEqual(['id'=>0, 'fn'=>0]);
});

test('Nth = 1 return 1 and sequence = 1 1', function(){
    expect($this->f->fib(1))
        ->toEqual(1)
        ->and($this->f->answer()->last())
        ->toEqual(['id'=>1, 'fn'=>1]);
});

test('Nth = 2 return 1 and sequence = 2 1', function(){
    expect($this->f->fib(2))
        ->toEqual(1)
        ->and($this->f->answer()->last())
        ->toEqual(['id'=>2, 'fn'=>1]);
});

test('Nth = 3 return 2 and sequence = 3 2', function(){
    expect($this->f->fib(3))
        ->toEqual(2)
        ->and($this->f->answer()->last())
        ->toEqual(['id'=>3, 'fn'=>2]);
});

test('Nth = 9 return 34 and sequence = 3 2', function(){
    expect($this->f->fib(9))
        ->toEqual(34)
        ->and($this->f->answer()->last())
        ->toEqual(['id'=>9, 'fn'=>34]);
});

test('check for overflow', function(){
    expect(fn() => $this->f->fib(93))
        ->toThrow(OverflowException::class);
});

test('get sequence of all Fn', function(){
    $this->f->fib(92);
    expect($this->f->answer())
        ->toBeCollection();
});
