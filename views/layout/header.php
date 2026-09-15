<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= html_escape($title ?? 'BookSpot') ?></title>
<link rel="stylesheet" href="<?= base_url('assets/css/bookstore.css') ?>">
<style>
.bs-top{position:sticky;top:0;z-index:20;background:#fff;border-bottom:1px solid #e8e8ef}.bs-nav{max-width:1200px;margin:auto;min-height:72px;display:flex;align-items:center;gap:24px;padding:0 22px}.bs-logo{font:800 26px/1 system-ui;text-decoration:none;color:#182033}.bs-logo span{color:#5b4bdb}.bs-links{display:flex;gap:20px;margin-left:auto}.bs-links a{color:#4b5563;text-decoration:none;font-weight:650;font-size:14px}.bs-links a:hover{color:#5b4bdb}.bs-icon{font-size:22px;line-height:1;display:inline-flex;vertical-align:middle;margin-right:5px}.bs-shell{max-width:1200px;margin:auto;padding:32px 22px}.bs-footer{padding:30px;text-align:center;color:#7b8190;border-top:1px solid #eee}
</style>
</head><body>
<header class="bs-top"><div class="bs-nav"><a class="bs-logo" href="<?= base_url() ?>">Book<span>Spot</span></a><nav class="bs-links"><a href="<?= base_url('category') ?>"><span class="bs-icon">▦</span>Categories</a><a href="<?= base_url('cart') ?>"><span class="bs-icon">🛒</span>Cart</a></nav></div></header>
<main class="bs-shell">
