<?php

use PrinceJohn\Reflect\Exceptions\AttributeNotFoundException;
use PrinceJohn\Reflect\Traits\HasEnumTarget;
use Reflect\Tests\Fixtures\Classes\Attributes\Tag;
use Reflect\Tests\Fixtures\Classes\Attributes\Type;
use Reflect\Tests\Fixtures\Classes\Channel;
use Reflect\Tests\Fixtures\Classes\Message;

mutates(HasEnumTarget::class);

it('can check if the attribute is used on the class provided', function () {
    expect(Type::isOnClass(Channel::class))->toBeTrue();
    expect(Tag::isOnClass(Channel::class))->toBeFalse();
});

it('can try to get an instance of the attribute using the class provided otherwise get a null', function () {
    expect(Tag::tryClass(Message::class))->toBeInstanceOf(Tag::class);

    expect(Type::tryClass(Message::class))->toBeNull();
});

it('can get an instance of the attribute using the backed enum provided or fail if not declared', function () {
    expect(Type::onClass(Channel::class))->toBeInstanceOf(Type::class);

    expect(fn () => Tag::onClass(Channel::class))->toThrow(AttributeNotFoundException::class);
});
