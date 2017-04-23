# EasyDateTime

EasyDateTime is a Jalali/Shamsi and Gregorian class based on <a target="_blank" href="https://github.com/VSG24/jDateTimePlus/">jDateTimePlus</a> that aims to simplify common DateTime tasks by abstracting the complex layers. It's probably the **simplest** solution for Jalali/Shamsi calendar issues in PHP.

# About this class

EasyDateTime is directly based on `jDateTimePlus` 1.0.0 which is itself based on `jDateTime` 2.2.0

# Requirements

* **PHP >= 5.4**.
* Being based on <a href="https://github.com/VSG24/jDateTimePlus/">jDateTimePlus</a>, this package has a dependency on jDateTimePlus 1.0.0+

#  Installation

## Using Composer

You can install this package using [composer](https://getcomposer.org). Add this package to your `composer.json`:  

```
"require": {
	"vsg24/easydatetime": "dev-master"
}
```

or if you prefer command line, change directory to project root and:

```
php composer.phar require "vsg24/easydatetime":"dev-master"
```

## Manual Installation

Get a copy of package source code. You can do this in two ways:

1. Download ZIP version of the source code and unzip it in desired location  
2. Run `git clone https://github.com/vsg24/easydatetime.git` to clone this repository

After getting a copy of source code, it is enough to include `easydatetime.class.php` where you need to use it.

```php
require_once 'path/to/source/easydatetime.class.php';
```

# Examples

Please take a look at [examples.php](examples.php) or see [examples-compiled.html](examples-compiled.html) for working examples.

**Important Note:**
If you want to do more complicated things, you can access an instance of `jDatetimePlus` from an EasyDateTime object:

  `$edtObj->$jDatetimePlus`

# Contributors:
- [Vahid Amiri Motlagh](http://atvsg.com)

## License
EasyDateTime was created by [Vahid Amiri Motlagh](http://atvsg.com) and released under the [MIT License](http://opensource.org/licenses/mit-license.php).

Copyright (C) 2016 [Vahid Amiri Motlagh](http://atvsg.com)
  


    The MIT License (MIT)
    
    Copyright (C) 2016 Vahid Amiri Motlagh

    Permission is hereby granted, free of charge, to any person obtaining a
    copy of this software and associated documentation files (the "Software"),
    to deal in the Software without restriction, including without limitation
    the rights to use, copy, modify, merge, publish, distribute, sublicense,
    and/or sell copies of the Software, and to permit persons to whom the
    Software is furnished to do so, subject to the following conditions:

    1- The above copyright notice and this permission notice shall be included
    in all copies or substantial portions of the Software.
    
    2- THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
    OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
    FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
    DEALINGS IN THE SOFTWARE.
