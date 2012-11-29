EdenPHP-Translator
==================

Create a secure and graphic interface for translating your lang package in EdenPHP

Install
=======

1/ Dowload the files

2/ Uplad the files on the same server as your EdenPHP project

3/ Configure Apache for have an access to EdenPHP-Translator home page

4/ Change the constants in config.php :

    - LANG : Path to your LANG folder, containing all your langages packages
    - PASSWORD : Define a password for securing your translate interface
    
5/ Change the chmod to 777 for the "cache" folder

6/ Enjoy

How To create a lang package ?
=================================

A langage package is a folder in your LANG EdenPHP directory :

For adding a german package
     
     |- /lang/
          |- /lang.title.xml
          |- /lang.text.xml
          |- /lang.error.xml
          |- /lang.success.xml
          | /mail/
      
Don't forget to put those files in chmod 777.

Open your EdenPHP-translator and your file will be automatically filled up.