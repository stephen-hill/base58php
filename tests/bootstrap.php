<?php

require_once 'vendor/autoload.php';
date_default_timezone_set("UTC");

// Setting "bcmath.scale" to something other than 0 so that
// we can be sure bcdiv's $scale parameter is working correctly
bcscale(16);
