<?php
/**
 * autoload.php
 *
 * Include this file in your bootstrap script if not using composer.
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

spl_autoload_register(function ($className) {
    $prefix = 'texdc\\veritas\\';
    $length = strlen($prefix);

    // ignore other namespaces
    if (substr($className, 0, $length) !== $prefix) {
        return;
    }

    // remove namespace prefix
    $className = substr($className, $length);

    // build filename
    $filename  = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
    $filename .= str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    // include the class' file if found and readable
    if (is_readable($filename)) {
        include_once $filename;
    }
});
