<?php
/**
 * bootstrap.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

ini_set('error_reporting', E_ALL);

$loader = require 'vendor/autoload.php';
if (!isset($loader)) {
    throw new RuntimeException('vendor/autoload.php could not be found.');
}
