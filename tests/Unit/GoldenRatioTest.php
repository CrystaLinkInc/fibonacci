<?php

namespace Tests\Unit;

use App\CustomClasses\GoldenRatio;
use PHPUnit\Framework\TestCase;

// Golden Ratio formula

beforeEach(function() {
    $this->g = new GoldenRatio();
});

test('calc using GR at construct of class with int parameters', function(){
    $gr = new GoldenRatio(6, false);
    expect($gr->answer()->last()['fn'])
        ->toEqual(8)
        ->and($gr->answer()->count())
        ->toEqual(1);
});

test('calc at construct of class with array parameters', function(){
    $gr = new GoldenRatio(['nth' => 6, 'isSeq' => false]);
    expect($gr->answer()->last()['fn'])
        ->toEqual(8)
        ->and($gr->answer()->count())
        ->toEqual(1);
});

test('calc at construct of class with array and bool parameters', function(){
    $gr = new GoldenRatio(['nth' => 6], true);
    expect($gr->answer()->last()['fn'])
        ->toEqual(8)
        ->and($gr->answer()->count())
        ->toEqual(7);
});

test('if Nth is a negative number return NULL', function(){
    expect($this->g->fib(-1))
        ->toBeNull();
});

test('if Nth is not an integer return NULL', function(){
    expect($this->g->fib('not a number'))
        ->toBeNull();
});

test('Nth = 0 return 0 and sequence = 0 0', function(){
    expect($this->g->fib(0))
        ->toEqual(0)
        ->and($this->g->answer()->last())
        ->toEqual(['id'=>0, 'fn'=>0]);
});

test('Nth = 1 return 1 and sequence = 1 1', function(){
    expect($this->g->fib(1))
        ->toEqual(1)
        ->and($this->g->answer()->last())
        ->toEqual(['id'=>1, 'fn'=>1]);
});

test('Nth = 2 return 1 and sequence = 2 1', function(){
    expect($this->g->fib(2))
        ->toEqual(1)
        ->and($this->g->answer()->last())
        ->toEqual(['id'=>2, 'fn'=>1]);
});

test('Nth = 3 return 2 and sequence = 3 2', function(){
    expect($this->g->fib(3))
        ->toEqual(2)
        ->and($this->g->answer()->last())
        ->toEqual(['id'=>3, 'fn'=>2]);
});

test('Nth = 9 return 34 and sequence = 3 2', function(){
    expect($this->g->fib(9))
        ->toEqual(34)
        ->and($this->g->answer()->last())
        ->toEqual(['id'=>9, 'fn'=>34]);
});

test('check for overflow', function(){
    $this->g->isSeq=True;
    expect(fn() => $this->g->fib(93))
        ->toThrow('Too big');
});

test('get sequence of all Fn', function(){
    $this->g->fib(92);
    expect($this->g->answer())
        ->toBeCollection();
});