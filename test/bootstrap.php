<?php
/**
 * bootstrap.php
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

ini_set('error_reporting', E_ALL);

$loader = 'vendor/autoload.php';
if (is_readable($loader)) {
    // require composer's autoloader
    require $loader;
} else {
    // composer is not avaliable
    spl_autoload_register(function ($className) {
        $prefix = 'VeritasTest\\';
        $length = strlen($prefix);

        // ignore other namespaces
        if (substr($className, 0, $length) !== $prefix) {
            return;
        }

        // remove namespace prefix
        $className = substr($className, $length);

        // build filename
        $filename  = __DIR__ . DIRECTORY_SEPARATOR;
        $filename .= str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

        // require the class' file if found and readable
        if (is_readable($filename)) {
            require $filename;
        }
    });
}
