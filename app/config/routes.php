<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Main Configuration Routes */
$route['default_controller'] = 'user_controller/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
/* Main Configuration Routes END */

/* User Screen Routes */
$route['login'] = 'user_controller/login';
$route['edit'] = 'user_controller/edit';
/* User Screen Routes END */
