@ECHO OFF

if exist C:\xampp\php\php.exe (
    echo [*] Press Ctrl+C to stop BOTster Web.
    echo [*] Document root is: %~dp0\src

    cd %~dp0\src
    C:\xampp\php\php.exe -S 127.0.0.1:5000 -c %~dp0\config\php-xampp.ini
    cd %CD%
) else (
    echo [!] Unable to locate "php.exe" in "C:\xampp\php\". Please install PHP using XAMPP.
)
