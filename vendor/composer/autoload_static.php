<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfd381afc1bd2ee2c8a519d80dbbac8c1
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfd381afc1bd2ee2c8a519d80dbbac8c1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfd381afc1bd2ee2c8a519d80dbbac8c1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfd381afc1bd2ee2c8a519d80dbbac8c1::$classMap;

        }, null, ClassLoader::class);
    }
}
