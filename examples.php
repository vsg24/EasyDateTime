<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
        <title>EasyDateTime examples</title>
        <style>
            .text-center {
                text-align: center;
                color: red;
            }
            .text-author {
                color: dodgerblue;
                font-weight: bold;
            }
            code {
                background-color: azure;
            }
            footer {
                text-align: center;
            }
        </style>
    </head>
    <body>
    <a href="https://github.com/VSG24/EasyDateTime" target="_blank"><h2 class="text-center text-red">
            EasyDateTime examples <small>v1.0.0</small></h2></a>
    <br>

<?php

require_once __DIR__ . '/vendor/autoload.php';

echo 'All input dates are expected in the <b>UTC</b> format, the methods will try to convert them into the timezone of 
the object. If you don\'t want this behaviour you need to set the timezone property to \'UTC\'.';

echo '<hr>';

// Instantiate
echo '<code>$edt = new <b>EasyDateTime</b>(\'Asia/Tehran\', \'jalali\');</code>';
$edt = new EasyDateTime('Asia/Tehran', 'jalali');


echo '<hr>';

echo '<code>$edt-><b>date</b>();</code><br><b>Gets the current datetime - no need for any parameters!</b><br><br>';
echo $edt->date();

echo '<hr>';

echo '<code>$edt-><b>date</b>(\'d l M\');</code><br><br>';
echo  $edt->date('d l M');

echo '<hr>';

echo '<code>$edt-><b>date</b>(\'Y-m-d H:i:s\', 1467851310);</code><br><b>Timestamp is in UTC, but the function 
converts it to the current EasyDateTime object\'s timezone.</b><br><br>';
echo  $edt->date('Y-m-d H:i:s', 1467851310);

echo '<hr>';

echo '<code>$edt-><b>convertNumbers</b>($edt->date());</code><br><br>';
echo $edt->convertNumbers($edt->date());

echo '<hr>';

echo '<code>$edt-><b>timezone</b> = \'America/Los_Angeles\';</code><br><b>Changing timezone can be done 
easily at runtime</b><br><br>';
$edt->timezone = 'America/Los_Angeles';
echo $edt->date();

echo '<hr>';

echo '<code>$edt-><b>gregorianStringToJalaliString</b>(\'2016-07-07 00:45\', \'Y-m-d H:i\', \'Y-m-d H:i\');
</code><br><b>Converting Gregorian date-times to Jalali, is a trivial task</b><br><br>';
$edt->timezone = 'Asia/Tehran';
echo $edt->gregorianStringToJalaliString('2016-07-07 00:45', 'Y-m-d H:i', 'Y-m-d H:i');

echo '<hr>';

echo '<code>$edt-><b>jalaliStringToGregorianString</b>(\'1395-04-17 01:14\', \'Y-m-d H:i\');
</code><br><b>The opposite (Jalali to Gregorian) is as easy, though more limited (Read the phpdocs for the method)
</b><br><br>';
echo $edt->jalaliStringToGregorianString('1395-04-17 01:14', 'Y-m-d H:i');

echo '<hr>';

echo '<code>$edt-><b>convertTimeZone</b>(\'2016-07-07 00:00:00\', \'America/Los_Angeles\', \'Asia/Tehran\', \'Y/m/d 
H:i:s\');</code><br><b>Converting between timezones is easy and doesn\'n depend on the timezone of the EasyDateTime 
object</b><br><br>';
echo $edt->convertTimeZone('2016-07-07 00:00:00', 'America/Los_Angeles', 'Asia/Tehran', 'Y/m/d H:i:s');

echo '<hr>';


?>
    <footer>
        This project is provided AS IS. It's completely free of charge. This project is licensed under <a href="https://opensource
        .org/licenses/MIT">MIT</a> license.
        <br>
        <a href="https://github.com/vsg24">vsg24 on Github</a> - <a href="http://atvsg.com" target="_blank" class="text-author">Vahid Amiri
            Motlagh</a>
        <br><br>
    </footer>
    </body>
</html>
