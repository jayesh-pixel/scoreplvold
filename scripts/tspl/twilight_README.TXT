-------------------------------------------------------------------------------------------------------------
README.TXT:
-------------------------------------------------------------------------------------------------------------
This file contains instructions on using your new encrypted file.  

In order to use your encrypted file, you need a loader installed on your server.  Most hosting companies already 
have the correct loader installed. The reason you need the loader is that it is compiled byte code for your specific 
server type.  This byte code is the key to making sure that nobody can read your encrypted file. This is a second
layer of protection in addition to our proprietary encryption.  We have decieded to bundle the bytecode encryption 
from ioncube as they are the industry leader in php bytecode loaders.  We are a fully licenced ioncube customer, so
you can be sure that all future ioncube loader updates will support our code. 

If for some reason your hosting company does not already provide the ioncube loader, you can get the correct 
loader for your system below:
-------------------------------------------------------------------------------------------------------------
The Loaders:
-------------------------------------------------------------------------------------------------------------
For Windows X86: 	      http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_win_x86_ipf.zip
Windows (Non-TS) (x86): http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_win_nonts_x86_ipf.zip
Linux (x86): 		        http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_lin_x86_ipf.zip
Linux (x86-64):		      http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64_ipf.zip
Linux (ppc):		        http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_lin_ppc_ipf.zip
Linux (ppc64):		      http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_lin_ppc64_ipf.zip
DragonFly (x86):	      http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_dra_x86_ipf.zip
FreeBSD 4 (x86):	      http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_fre_4_x86_ipf.zip
FreeBSD 6 (x86):	      http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_fre_6_x86_ipf.zip
FreeBSD 6 (x86-64):	    http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_fre_6_x86-64_ipf.zip
FreeBSD 7 (x86-64):	    http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_fre_7_x86-64_ipf.zip
BSDi (x86):		          http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_bsd_x86_ipf.zip
NetBSD (x86):		        http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_net_x86_ipf.zip
NetBSD (x86-64):	      http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_net_x86-64_ipf.zip
OpenBSD 3.7 (x86-64)	  http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_ope_3.7_x86-64_ipf.zip
OpenBSD 3.9 (x86-64)	  http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_ope_3.9_x86-64_ipf.zip
OpenBSD 3.8 (x86)	      http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_ope_3.8_x86_ipf.zip
OpenBSD 4.2 (x86)	      http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_ope_4.2_x86_ipf.zip
OS X (ppc):		          http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_dar_ppc_ipf.zip
OS X (x86):		          http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_dar_x86_ipf.zip
OS X (x86-64):		      http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_dar_x86-64_ipf.zip
Solaris (sparc):	      http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_sun_sparc_ipf.zip
Solaris (x86):		      http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_sun_x86_ipf.zip
Or get All platforms:	  http://downloads2.ioncube.com/loader_downloads/ioncube_loaders_all_platforms.zip
-------------------------------------------------------------------------------------------------------------
Installing The Loader:
-------------------------------------------------------------------------------------------------------------
There are two ways to use this file, requiring different installation methods: run-time Loading and via the php.ini file.

Explanation of terminology

The Loader is a .dll file or .so file (depending on the server's operating system) which PHP uses to decode.  PHP has the ability to open .dll (or .so) files at the moment a script is run. The dl function in PHP is used for this purpose. This mechanism, when used to launch the ionCube Loader, is called run-time loading.

When the web server first launches PHP, a configuration file called php.ini is read. It is possible to add a line to this file to instruct PHP to load the loader.

We shall explain how to install Loaders using both of these methods in the following sections.

Run-time Loading Installation

The run-time loading method is the easiest way to run encoded files, and lets encoded files locate and install the correct Loader when needed.

Provided that run-time loading is supported on the target system, encoded scripts and Loaders can be bundled together without the user having to install any Loader or update their system configuration, and without having to know about the PHP version or operating system used.

For run-time loading to work, a directory called 'ioncube' containing the Loaders should be placed in or above the top directory of encoded files. For example, if you have encoded files in or below '/var/www/htdocs/', you might place the 'ioncube' directory in '/var/www/htdocs' or '/var/www'. If you have an application or library to distribute, you could place the ioncube directory within the top directory

Troubleshooting Run-time Loading

If encoded files fail to run with run-time loading, you can test this by using the helper PHP script 'ioncube-loader-helper.php' that's included in the Loader download archive.

Copy the 'ioncube-loader-helper.php' and 'ioncube-encoded-file.php' PHP scripts to a directory where you expect encoded files to be working.
Access the 'ioncube-loader-helper.php' script from a web server or with a PHP cli or cgi executable.
Choose the 'Run-time Loading Compatibility Test' option.
The script will try to locate and install the required Loader, and will produce output as it runs.
Once complete the script will either report that run-time loading is working, will provide instructions for how to correct any issue with the server configuration, or will report that Loaders must be installed in the php.ini file.
Using the ionCube Install Assistant

Installing in the php.ini file is also simple, and offers the best performance for encoded scripts. It is also required for systems that use safe mode, or if PHP has been built with thread support, e.g. on Windows.

The 'php.ini Install Assistant' link on the installation helper PHP script is provided to assist with this. Access the script from a web server or a PHP cli or cgi executable and it should tell you which Loader to install, which file to edit and what you need to add (it's just a one line change).

If you wish to install without using the assistant script then please read the following section.

Manual Installation in the php.ini File

Before installing, you need to know:

Which operating system you are using.
Which PHP version you are using.
Is your PHP build threaded or not?
Where your php.ini file is.
The 'Server System Information' link in the helper script will give you the required information.

Example

Suppose the following information is contained in the sysinfo.php script output:

PHP Version => 4.3.0
System => Linux pod 2.2.16 #1 Sat Sep 30 22:47:40 BST 2000 i686
Build Date => May 28 2003 13:41:42
Configure Command => './configure' 
Server API => Command Line Interface
Virtual Directory Support => disabled
Configuration File (php.ini) Path => /usr/local/lib/php.ini
PHP API => 20020918
PHP Extension => 20020429
Zend Extension => 20021010
Debug Build => no
Thread Safety => disabled
This shows that:

The system is Linux
PHP is PHP 4.3.0
PHP is not threaded (thread safety disabled)
The php.ini file is in /usr/local/lib
Using this information we may install the Loaders. The method depends on whether your server is running Unix (e.g. Linux) or Windows.

Installation on a Unix Server

If your PHP is not threaded you need a Loader called:

ioncube_loader_<os type>_<php flavour>.so
If your PHP is threaded you need a Loader called:

ioncube_loader_<os type>_<php flavour>_ts.so
<os type> will be 'lin' for Intel Linux, 'fre' for FreeBSD, 'sun' for Sparc Solaris, 'ope' for OpenBSD, 'dar' for OSX and 'net' for NetBSD.

<php flavour> will be 4.0, 4.1, 4.2 or 4.3 - i.e the first 2 digits of your PHP version.

Edit your php.ini file and for non-threaded PHP add:

zend_extension = /<path>/ioncube_loader_<os type>_<php flavour>.so
and for threaded PHP add:

zend_extension_ts = /<path>/ioncube_loader_<os type>_<php flavour>_ts.so
Replace <os type> and <php flavour> with whatever is right for your system, and <path> with the path to where the Loader is installed, e.g. /usr/local/ioncube

If there are other zend_extension entries in the php.ini file place this new entry before the existing entries.

For example, with Linux running PHP 4.1.2 and Apache 1, you might add:

zend_extension = /usr/local/ioncube/ioncube_loader_lin_4.1.so
For FreeBSD running threaded PHP 4.3.1 with Apache 2, you might add:

zend_extension_ts = /usr/local/ioncube/ioncube_loader_fre_4.3_ts.so
Installation on a Windows Server

You need a Loader called

ioncube_loader_win_<php flavour>.dll
<php flavour> will be 4.1, 4.2 or 4.3 - i.e the first 2 digits of your PHP version.

Edit your php.ini file and add:

zend_extension_ts = "<drive>:\<path>\ioncube_loader_win_<php flavour>.dll"
where <drive> and <path> locate the Loader, and <php flavour> is whatever the correct value is for your system. If there are other zend_extension entries in the php.ini file place this new entry before the existing entries.

e.g.

zend_extension_ts = c:\WINNT\ioncube_loader_win_4.3.dll

For additional loader help, see the help file at: 
http://www.referhush.com/?rh=d794fa3c&t=http://www.ioncube.com/loaders.php

OR 

http://www.referhush.com/?rh=683ab003&t=http://www.ioncube.com/loader_installation.php
-------------------------------------------------------------------------------------------------------------
After you have installed the loader?
-------------------------------------------------------------------------------------------------------------
Once you have the loader installed, you just have to make sure you have the file twilight_loader.php in the same
directory as your encrypted files and everything should just work like magic.  

If you have any problems, feel free to email us.  We will attempt to figure out what is going wrong.  Be warned 
that since this product is free of charge, support may be limited.  

If you need full support, and various other features, take a look at our blog for full product reviews of all 
of the competing non-free encryption solutions.

Thanks!

EncryptedPHP.com Administration