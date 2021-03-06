<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5ca246b25f802c821c110c80437da304
{
    public static $prefixLengthsPsr4 = array (
        'J' =>
        array (
            'jewelrana\\PasswordPolicy\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'jewelrana\\PasswordPolicy\\' =>
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit5ca246b25f802c821c110c80437da304::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5ca246b25f802c821c110c80437da304::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5ca246b25f802c821c110c80437da304::$classMap;

        }, null, ClassLoader::class);
    }
}
