<?php
/*kai*/
function di()
{
    dd(Input::all());
}

function e($value)
{
    try {
        return htmlentities($value, ENT_QUOTES, "UTF-8", false);
    } catch (Exception $e) {
        return '';
    }
}

function dd($value, $value2 = null, $value3 = null)
{
    print "
<script
  src='https://code.jquery.com/jquery-2.2.4.js'
  integrity='sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI='
  crossorigin='anonymous'></script>
    <script>
    $(function(){
       $('html,body').css('background','#2a2a2a').css('color','white');
        });
    </script>
    <pre style='font-size:13px;font-family: monospace'>";
    print '<h2>Value:</h2>';
    if (!$value) {
        print "<span style='color:blue;'>null</span>";
    }
    $debug = print_r($value, 1);
    $debug = str_replace('=>', '<span style="color:cyan">=></span>', $debug);
    $debug = str_replace('[', '<span style="color:#A6E22E;;">[</span><span style="font-weight: bolder;color:#A6E22E;">',
        $debug);
    $debug = str_replace(']', '</span><span style="color:#A6E22E;;">]</span>', $debug);
    print $debug;

    if ($value2) {
        print '<h2>Value 2:</h2>';
        $debug = print_r($value2, 1);
        $debug = str_replace('=>', '<span style="color:cyan">=></span>', $debug);
        $debug = str_replace('[',
            '<span style="color:#A6E22E;;">[</span><span style="font-weight: bolder;color:#A6E22E;">', $debug);
        $debug = str_replace(']', '</span><span style="color:#A6E22E;;">]</span>', $debug);
        print $debug;
    }

    if ($value3) {
        print '<h2>Value 3:</h2>';
        $debug = print_r($value3, 1);
        $debug = str_replace('=>', '<span style="color:cyan">=></span>', $debug);
        $debug = str_replace('[',
            '<span style="color:#A6E22E;;">[</span><span style="font-weight: bolder;color:#A6E22E;">', $debug);
        $debug = str_replace(']', '</span><span style="color:#A6E22E;;">]</span>', $debug);
        print $debug;
    }

    die();
}

function db()
{
    print "<meta charset='UTF-8'/>";
    $last = last(DB::getQueryLog());

    $str = $last['query'];
    $replace = $last['bindings'];

    $temp = explode("?", $str);
    $result = "";
    foreach ($temp as $k => $v) {
        $result .= $v;
        if ($k != count($temp) - 1) {
            $result .= !is_numeric($replace[$k]) ? '"' . $replace[$k] . '"' : $replace[$k];
        }
    }

    dd($result);
}

function scan_dir($dir)
{
    $ignored = array('.', '..', '.svn', '.htaccess');

    $files = array();
    foreach (scandir($dir) as $file) {
        if (in_array($file, $ignored)) continue;
        $files[$file] = filemtime($dir . '/' . $file);
    }

    arsort($files);
    $files = array_keys($files);

    return ($files) ? $files : false;
}




/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
