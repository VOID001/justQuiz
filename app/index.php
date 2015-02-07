<?php
/**
 * File: index.php
 * Description: Load config files and
 * present the welcome page
 */
session_start();
require_once (dirname(__FILE__)."/config.php");
require_once (dirname(__FILE__)."/welcome.php");

