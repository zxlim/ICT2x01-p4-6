@ECHO OFF

if exist C:\xampp\php\php.exe (
    echo [*] Press Ctrl+C to stop BOTster Web.
    echo [*] Document root is: %~dp0src\public

    cd %~dp0src\public
    C:\xampp\php\php.exe -S 127.0.0.1:5000 -c %~dp0config\php-xampp.ini
    cd %CD%
) else (
    echo [!] Unable to locate "php.exe" in "C:\xampp\php\". Please install PHP using XAMPP.
)
