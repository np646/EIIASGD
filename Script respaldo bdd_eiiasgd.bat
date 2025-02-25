@echo off
setlocal enabledelayedexpansion

for /f "tokens=2-4 delims=/ " %%a in ('date /t') do set FECHA=%%c%%b%%a

set HORA=%time:~0,2%
set MIN=%time:~3,2%
set SEG=%time:~6,2%

if "%HORA:~0,1%"==" " set HORA=0%HORA:~1,1%

mysqldump -u root -proot bdd_eiiasgd > C:\Users\Nataly\Desktop\Backups\Backup_%FECHA%_%HORA%%MIN%%SEG%.sql

echo Respaldo completado
pause
exit
