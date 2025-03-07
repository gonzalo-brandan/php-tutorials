<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInited6f6a13d027039d99de8108a38dc909
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInited6f6a13d027039d99de8108a38dc909::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInited6f6a13d027039d99de8108a38dc909::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInited6f6a13d027039d99de8108a38dc909::$classMap;

        }, null, ClassLoader::class);
    }
}
