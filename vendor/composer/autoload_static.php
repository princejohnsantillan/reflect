<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite703b5df006354550a6f46d6c2476916
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Princejohnsantillan\\Reflect\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Princejohnsantillan\\Reflect\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite703b5df006354550a6f46d6c2476916::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite703b5df006354550a6f46d6c2476916::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite703b5df006354550a6f46d6c2476916::$classMap;

        }, null, ClassLoader::class);
    }
}
