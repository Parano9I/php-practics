<?php
declare(strict_types=1);
error_reporting(E_ALL);

mb_internal_encoding('utf-8');

session_start();

define('ROOT_PATH', dirname(__FILE__));
const SALT = '6834_@#%ghjtiodjkghjdlvbjg';
const USERS_JSON_PATH = ROOT_PATH . '/resources/users.json';

