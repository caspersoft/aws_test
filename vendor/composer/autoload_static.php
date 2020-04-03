<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit84d05a841986cd6209fe9ebbbf8e5b09
{
    public static $files = array (
        'acd2fa9a243aa6d59f19df37b68db5aa' => __DIR__ . '/../..' . '/src/Config/config.db.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Router\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Router\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Libs/Router',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
            1 => __DIR__ . '/../..' . '/src/Config',
            2 => __DIR__ . '/../..' . '/src/Controllers',
            3 => __DIR__ . '/../..' . '/src/Libs',
            4 => __DIR__ . '/../..' . '/src/Models',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit84d05a841986cd6209fe9ebbbf8e5b09::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit84d05a841986cd6209fe9ebbbf8e5b09::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
