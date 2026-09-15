<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['paypal_client_id'] = getenv('PAYPAL_CLIENT_ID') ?: 'YOUR_PAYPAL_SANDBOX_CLIENT_ID';
$config['paypal_secret']   = getenv('PAYPAL_SECRET') ?: 'YOUR_PAYPAL_SANDBOX_SECRET';
$config['paypal_base_url'] = 'https://api-m.sandbox.paypal.com';
$config['currency'] = 'INR';
