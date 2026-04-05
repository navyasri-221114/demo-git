@echo off
echo ==============================================================
echo Copying images to the project so they can be viewed in XAMPP!
echo ==============================================================

if not exist "%~dp0images" (
    mkdir "%~dp0images"
)

echo Copying logo.png...
copy "C:\Users\Navya Sri\Pictures\Saved Pictures\logo.png" "%~dp0images\" >nul

echo Copying Trio_music.jpg...
copy "C:\Users\Navya Sri\Pictures\Saved Pictures\Trio_music.jpg" "%~dp0images\" >nul

echo Copying Music.webp...
copy "C:\Users\Navya Sri\Pictures\Saved Pictures\Music.webp" "%~dp0images\" >nul

echo Copying Tambura.avif...
copy "C:\Users\Navya Sri\Pictures\Saved Pictures\Tambura.avif" "%~dp0images\" >nul

echo Copying all_2.jpg...
copy "C:\Users\Navya Sri\Pictures\Saved Pictures\all_2.jpg" "%~dp0images\" >nul

echo.
echo All images copied successfully! You can press any key to close this.
pause
