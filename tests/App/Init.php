<?php

require_once '../vendor/SplClassLoader.php';

$classloader = new SplClassLoader('SON', '../vendor');
$classloader->register();

$classloader = new SplClassLoader('App', '../');
$classloader->register();
