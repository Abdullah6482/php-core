<?php

use Core\Container;

test('it can resolve something out of the container', function () {
    //arrange
    $container = new Container();

    $container->bind('foo',function (){
        return 'foo';
    });

    //act
    $result = $container->resolve('bar');


    //assert/expect
    expect($result)->toEqual('bar');


});
