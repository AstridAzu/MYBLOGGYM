
<?php
// Ruta a la carpeta donde están las imágenes y videos
$folderPath = '../assets/fotosVictima1/'; // Asegúrate de que termina con '/'

// Extensiones permitidas
$imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$videoExtensions = ['mp4', 'webm', 'ogg'];

// Obtener todos los archivos en la carpeta
$files = scandir($folderPath);

// Inicializar arrays
$images = [];
$videos = [];

// Clasificar archivos
foreach ($files as $file) {
    $filePath = $folderPath . $file;
    if (is_file($filePath)) {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        if (in_array($extension, $imageExtensions)) {
            $images[] = $file;
        } elseif (in_array($extension, $videoExtensions)) {
            $videos[] = $file;
        }
    }
}

// Devolver el resultado en JSON
header('Content-Type: application/json');
echo json_encode([
    'images' => $images,
    'videos' => $videos
]);
