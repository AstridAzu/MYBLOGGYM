# myBlog - Cloudflare Pages

Sitio web personal desplegado en Cloudflare Pages.

## 🚀 Configuración para Cloudflare Pages

### Build Settings en Cloudflare Pages:

- **Framework preset:** None
- **Build command:** `bash build.sh`
- **Build output directory:** `public`
- **Root directory:** `/`

### Variables de entorno (si es necesario):
```
PHP_VERSION=8.1
```

## 💻 Desarrollo Local

### Prerrequisitos:
- XAMPP instalado (para PHP)
- Git

### Ejecutar localmente:

1. Inicia XAMPP y asegúrate de que Apache esté corriendo
2. Abre en tu navegador: `http://localhost/dashboard/myBlog/`

### Generar build local:

```bash
# En Git Bash o WSL
bash build.sh

# O en PowerShell
.\build.ps1
```

## 📦 Deploy en Cloudflare Pages

### Opción 1: Conectar repositorio de GitHub

1. Sube tu código a GitHub
2. Ve a [Cloudflare Pages](https://pages.cloudflare.com/)
3. Conecta tu repositorio
4. Configura los build settings (ver arriba)
5. Deploy automático en cada push

### Opción 2: Deploy directo con Wrangler

```bash
# Instalar Wrangler
npm install -g wrangler

# Login en Cloudflare
wrangler login

# Deploy
wrangler pages deploy public
```

## 📁 Estructura del Proyecto

```
myBlog/
├── public/          # Build output (generado)
├── assets/          # Imágenes y archivos multimedia
├── includes/        # Componentes PHP
├── scripts/         # JavaScript
├── styles/          # CSS
├── services/        # Servicios PHP
├── build.sh         # Script de build para Cloudflare
├── build.ps1        # Script de build para Windows
└── index.php        # Punto de entrada
```

## 🔧 Notas Técnicas

- El sitio se genera como HTML estático desde PHP
- Los archivos PHP se procesan en tiempo de build
- Cloudflare Pages sirve los archivos HTML estáticos resultantes
- Asegúrate de que todos los includes de PHP funcionen correctamente

## 📝 TODO

- [ ] Verificar que todas las rutas sean relativas
- [ ] Optimizar imágenes para producción
- [ ] Configurar redirects si es necesario
- [ ] Añadir _headers para seguridad
