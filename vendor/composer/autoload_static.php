<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1bd48b9326d9b173fb4e147db9f8f45d
{
    public static $files = array (
        '3f36405be12e98fad2ffd346f1c42231' => __DIR__ . '/../..' . '/inc/template-tags.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' =>
        array (
            'RT\\Fasheno\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'RT\\Fasheno\\' =>
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1bd48b9326d9b173fb4e147db9f8f45d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1bd48b9326d9b173fb4e147db9f8f45d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1bd48b9326d9b173fb4e147db9f8f45d::$classMap;

        }, null, ClassLoader::class);
    }
}