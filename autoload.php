<?php
/**
 * autoload.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

// Include this file in your bootstrap script if not using composer.

spl_autoload_register(function ($className) {
    $prefix = 'Veritas\\';
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

    // require the class' file if found and readable
    if (is_readable($filename)) {
        require $filename;
    }
});
