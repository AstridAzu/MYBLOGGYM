# Script para generar archivos HTML estáticos desde PHP
Write-Host "Generando archivos HTML estáticos..." -ForegroundColor Green

# Crear directorio de salida si no existe
if (!(Test-Path -Path "dist")) {
    New-Item -ItemType Directory -Path "dist" | Out-Null
}

# Ruta al ejecutable de PHP
$phpBin = "C:\xampp\php\php.exe"

# Verificar si PHP está disponible
if (!(Test-Path $phpBin)) {
    Write-Host "Error: PHP no encontrado en $phpBin" -ForegroundColor Red
    Write-Host "Asegúrate de que XAMPP esté instalado correctamente." -ForegroundColor Yellow
    exit 1
}

# Generar index.html
Write-Host "Generando index.html..." -ForegroundColor Cyan
& $phpBin -f index.php | Out-File -FilePath "dist\index.html" -Encoding UTF8

# Copiar archivos estáticos (CSS, JS, imágenes)
Write-Host "Copiando archivos estáticos..." -ForegroundColor Cyan

if (Test-Path "assets") {
    Copy-Item -Path "assets" -Destination "dist\assets" -Recurse -Force
}

if (Test-Path "styles") {
    Copy-Item -Path "styles" -Destination "dist\styles" -Recurse -Force
}

if (Test-Path "scripts") {
    Copy-Item -Path "scripts" -Destination "dist\scripts" -Recurse -Force
}

# Copiar rutinas.json si existe
if (Test-Path "includes\rutinas.json") {
    if (!(Test-Path "dist\includes")) {
        New-Item -ItemType Directory -Path "dist\includes" | Out-Null
    }
    Copy-Item -Path "includes\rutinas.json" -Destination "dist\includes\" -Force
}

Write-Host "`n¡Build completado! " -ForegroundColor Green -NoNewline
Write-Host "Los archivos están en el directorio 'dist/'" -ForegroundColor White
Write-Host "Puedes abrir dist\index.html en tu navegador." -ForegroundColor Yellow
