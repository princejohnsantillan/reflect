<?php

use PrinceJohn\Reflect\Class\Reflect;
use PrinceJohn\Reflect\Exceptions\AttributeNotFoundException;
use Reflect\Tests\Fixtures\Classes\Attributes\Tag;
use Reflect\Tests\Fixtures\Classes\Attributes\Type;
use Reflect\Tests\Fixtures\Classes\Channel;

mutates(Reflect::class);

it('can check existence of attribute on a class', function () {
    $channelClass = new Channel;

    expect(Reflect::on($channelClass)
        ->hasAttribute(Tag::class))->toBeFalse();

    expect(Reflect::on($channelClass)
        ->hasAttribute(Type::class))->toBeTrue();
});

it('can get attribute instance on a class', function () {
    $channelClass = new Channel;

    $attribute = Reflect::on($channelClass)
        ->getAttributeInstance(Type::class);

    expect($attribute)->toBeInstanceOf(Type::class);
});

it('will thrown a not found exception when getting an instance of undeclared attribute on a class', function () {
    $channelClass = new Channel;

    Reflect::on($channelClass)
        ->getOrFailAttributeInstance(Tag::class);

})->throws(AttributeNotFoundException::class, "Reflect\Tests\Fixtures\Classes\Attributes\Tag not found.");
