#!/bin/bash

# Build script para Cloudflare Pages
echo "🚀 Generando sitio estático para Cloudflare Pages..."

# Limpiar directorio de salida
rm -rf public
mkdir -p public

# Detectar PHP (Cloudflare Pages incluye PHP en su entorno de build)
if command -v php &> /dev/null; then
    PHP_CMD="php"
else
    echo "⚠️  PHP no encontrado. Usando configuración local..."
    PHP_CMD="c:/xampp/php/php.exe"
fi

# Generar index.html desde PHP
echo "📄 Generando index.html..."
$PHP_CMD -f index.php > public/index.html

# Copiar archivos estáticos
echo "📁 Copiando assets..."
[ -d "assets" ] && cp -r assets public/

echo "🎨 Copiando styles..."
[ -d "styles" ] && cp -r styles public/

echo "⚡ Copiando scripts..."
[ -d "scripts" ] && cp -r scripts public/

# Copiar datos JSON
if [ -f "includes/rutinas.json" ]; then
    echo "📊 Copiando rutinas.json..."
    mkdir -p public/includes
    cp includes/rutinas.json public/includes/
fi

# Copiar archivos de servicios PHP como estáticos (si son necesarios)
if [ -d "services" ]; then
    echo "🔧 Procesando servicios..."
    mkdir -p public/services
    # Aquí podrías procesar archivos PHP de servicios si es necesario
fi

echo ""
echo "✅ Build completado exitosamente!"
echo "📦 Directorio de salida: public/"
echo "🌐 Listo para deploy en Cloudflare Pages"
