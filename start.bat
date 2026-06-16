@echo off
REM Zero-dependency starter (no Composer needed).
REM   start.bat           - run dev server on http://localhost:8000
REM   start.bat 9000      - run on a custom port

setlocal
cd /d "%~dp0"

set "PORT=%~1"
if "%PORT%"=="" set "PORT=8000"

if not exist ".env" (
    if exist ".env.example" (
        copy /Y ".env.example" ".env" >nul
        echo   [+] Created .env from .env.example. Edit it if your DB credentials differ.
    )
)

echo.
echo   Sam Nolan Portfolio  -^>  http://localhost:%PORT%
echo   Press Ctrl+C to stop.
echo.

php -S localhost:%PORT%
