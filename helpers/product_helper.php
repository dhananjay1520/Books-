<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('book_placeholder_data_uri')) { function book_placeholder_data_uri() { return "data:image/svg+xml;charset=UTF-8,<svg xmlns='http://www.w3.org/2000/svg' width='600' height='800'><rect width='600' height='800' rx='28' fill='%23f3f1ff'/><rect x='70' y='65' width='460' height='590' rx='20' fill='%235b54ea'/><path d='M170 250h260M170 315h260M170 380h190' stroke='white' stroke-width='18' stroke-linecap='round' opacity='.9'/><circle cx='300' cy='170' r='45' fill='white'/><text x='300' y='735' text-anchor='middle' font-family='Arial' font-size='30' font-weight='700' fill='%23172033'>BookSpot</text></svg>"; } }
if (!function_exists('profile_placeholder_data_uri')) { function profile_placeholder_data_uri() { return "data:image/svg+xml;charset=UTF-8,<svg xmlns='http://www.w3.org/2000/svg' width='160' height='160'><circle cx='80' cy='80' r='78' fill='%23eeeafd'/><circle cx='80' cy='62' r='28' fill='%235b54ea'/><path d='M35 137c5-32 22-49 45-49s40 17 45 49' fill='%235b54ea'/></svg>"; } }
if (!function_exists('book_normalize_path')) {
function book_normalize_path($path) { $path=trim((string)$path); if($path==='')return ''; $path=str_replace('\\','/',$path); if(preg_match('#^https?://#i',$path)){$parsed=parse_url($path,PHP_URL_PATH);$path=$parsed?:$path;} return ltrim($path,'/'); }
}
if (!function_exists('book_url_for_file')) {
function book_url_for_file($relative) { $relative=ltrim(str_replace('\\','/',$relative),'/'); $parts=array_values(array_filter(explode('/',$relative),'strlen')); return base_url(implode('/',array_map('rawurlencode',$parts))); }
}
if (!function_exists('book_find_uploaded_file')) {
function book_find_uploaded_file($value,$type='product') {
 $value=book_normalize_path($value); if($value==='')return false; $basename=basename($value);
 $candidates=[$value];
 if($type==='profile'){$candidates=array_merge($candidates,['uploads/profile/'.$value,'uploads/profile/'.$basename,'uploads/admin_profile/'.$value,'uploads/admin_profile/'.$basename,'assets/uploads/'.$value,'assets/uploads/'.$basename]);}
 else {$candidates=array_merge($candidates,['uploads/products/'.$value,'uploads/products/'.$basename,'assets/uploads/'.$value,'assets/uploads/'.$basename]);}
 foreach(array_unique($candidates) as $candidate){ if($candidate!=='' && is_file(FCPATH.str_replace('/',DIRECTORY_SEPARATOR,ltrim($candidate,'/'))))return ltrim(str_replace('\\','/',$candidate),'/'); }
 foreach([FCPATH.'uploads/',FCPATH.'assets/uploads/'] as $root){ if(!is_dir($root)||$basename==='')continue; try{ $it=new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root,FilesystemIterator::SKIP_DOTS)); foreach($it as $file){if($file->isFile()&&strcasecmp($file->getFilename(),$basename)===0){ $full=str_replace('\\','/',$file->getPathname());$base=rtrim(str_replace('\\','/',FCPATH),'/').'/';return ltrim(str_replace($base,'',$full),'/');}} }catch(Throwable $e){} }
 return false;
}
}
if (!function_exists('product_image_url')) { function product_image_url($image) { $found=book_find_uploaded_file($image,'product'); return $found?book_url_for_file($found):book_placeholder_data_uri(); } }
if (!function_exists('book_asset_url')) { function book_asset_url($path) { return product_image_url($path); } }
if (!function_exists('profile_image_url')) { function profile_image_url($image,$admin=false) { $found=book_find_uploaded_file($image,'profile'); return $found?book_url_for_file($found):profile_placeholder_data_uri(); } }
