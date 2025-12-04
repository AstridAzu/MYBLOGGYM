<?php
// 1) Ejecutar el servicio vía HTTP
$url = 'http://' . $_SERVER['HTTP_HOST'] . '/dashboard/myBlog/services/getGalery.php';
if (ini_get('allow_url_fopen')) {
    $imagenesJson = file_get_contents($url);
} else {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $imagenesJson = curl_exec($ch);
    curl_close($ch);
}

// 2) Decodificar el JSON correctamente en arrays separados
$data = json_decode($imagenesJson, true);
$imagenes = $data['images'] ?? [];
$videos = $data['videos'] ?? [];

// 3) Ruta a los archivos multimedia
$folderPath = 'assets/fotosVictima1/';

// 1) Ejecutar el servicio vía HTTP
$url2 = 'http://' . $_SERVER['HTTP_HOST'] . '/dashboard/myBlog/services/getGalery1.php';
if (ini_get('allow_url_fopen')) {
    $imagenesJson2 = file_get_contents($url2);
} else {
    $ch2 = curl_init($url2);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    $imagenesJson2 = curl_exec($ch2);
    curl_close($ch2);
}

// 2) Decodificar el JSON correctamente en arrays separados
$data2 = json_decode($imagenesJson2, true);
$imagenes2 = $data2['images'] ?? [];
$videos2 = $data2['videos'] ?? [];

// 3) Ruta a los archivos multimedia
$folderPath2 = 'assets/fotosVictima2/';


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/galeryAmigos.css">
 <!--importo el script-->
    <script src="./scripts/cargarImgVid.js"></script>
    
</head>
<body>
<section id="galeria" class="entrenamientoContainer">
 

<!-- victima 2 -->
    <div   class="containerGallery">
        <div class="headerGallery gradient-pink-purple ">
           <H2>ENTRENAMIENTO CON DANIXA</H2>
           <p>
            Increíble sesión de piernas con las chicas.
            Nos retamos con sentadillas pesadas y 
            terminamos con un circuito de quemado.
            </p>
            <div class="containerInfo">
                <div class="containerInfoDetail">
                    <svg  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                    <span>
                        2 personas
                    </span>
                </div>
                <div class="containerInfoDetail">
                <svg   width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-barbell"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M2 12h1" /><path d="M6 8h-2a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h2" /><path d="M6 7v10a1 1 0 0 0 1 1h1a1 1 0 0 0 1 -1v-10a1 1 0 0 0 -1 -1h-1a1 1 0 0 0 -1 1z" /><path d="M9 12h6" /><path d="M15 7v10a1 1 0 0 0 1 1h1a1 1 0 0 0 1 -1v-10a1 1 0 0 0 -1 -1h-1a1 1 0 0 0 -1 1z" /><path d="M18 8h2a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-2" /><path d="M22 12h-1" /></svg>
                    <span>
                        6 ejercicios
                    </span>
                </div>
                <div class="containerInfoDetail">
                    <svg   width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>

                    <span>
                        90 minutos
                    </span>
                </div>
            </div>
            <p>Bienvenido a la galería de imágenes.</p>
        </div>
       
        <div class="gallery">
            <?php if (!empty($imagenes2) && is_array($imagenes2)): ?>
                <?php foreach ($imagenes2 as $imagen): ?>
                    <img 
                        class="media-thumb"
                        data-src="<?php echo $folderPath2 . htmlspecialchars($imagen); ?>"
                        data-type="image"
                        src="<?php echo $folderPath2 . htmlspecialchars($imagen); ?>" 
                        alt="<?php echo htmlspecialchars($imagen); ?>"
                    >
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($videos2) && is_array($videos2)): ?>
                <?php foreach ($videos2 as $video): ?>
                    
                    <video 
                        class="media-thumb"
                        data-type="video"
                        controls 
                        width="320" 
                        height="240"
                        muted
                    >
                        <source src="<?php echo $folderPath2 . htmlspecialchars($video); ?>" 
                                type="video/<?php echo pathinfo($video, PATHINFO_EXTENSION); ?>">
                        Tu navegador no soporta el elemento de video.
                    </video>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (empty($imagenes2) && empty($videos2)): ?>
                <p>No se encontraron imágenes ni videos.</p>
            <?php endif; ?>
        </div>
        

    </div>
<!-- victima 1 -->
    <div class="containerGallery">
        <div class="headerGallery gradient-purple-blue ">
           <H2>ENTRENAMIENTO DE ESPALDA CON JORGE</H2>
           <p>
             Entrenamiento con Jorge,
             un gran amigo y compañero de entrenamiento. 
             Sesión de espalda, trabajamos mucho en la hipertrofia y 
             pude sentir realmente cada ejercicio. ¡Aprendí mucho!
            
            </p>
            <div class="containerInfo">
                <div class="containerInfoDetail">
                    <svg  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                    <span>
                        2 personas
                    </span>
                </div>
                <div class="containerInfoDetail">
                <svg   width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-barbell"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M2 12h1" /><path d="M6 8h-2a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h2" /><path d="M6 7v10a1 1 0 0 0 1 1h1a1 1 0 0 0 1 -1v-10a1 1 0 0 0 -1 -1h-1a1 1 0 0 0 -1 1z" /><path d="M9 12h6" /><path d="M15 7v10a1 1 0 0 0 1 1h1a1 1 0 0 0 1 -1v-10a1 1 0 0 0 -1 -1h-1a1 1 0 0 0 -1 1z" /><path d="M18 8h2a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-2" /><path d="M22 12h-1" /></svg>
                    <span>
                        6 ejercicios
                    </span>
                </div>
                <div class="containerInfoDetail">
                    <svg   width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>

                    <span>
                        90 minutos
                    </span>
                </div>
            </div>
            <p>Bienvenido a la galería de imágenes.</p>
        </div>
       
  
        <div class="gallery">
            <?php if (!empty($imagenes) && is_array($imagenes)): ?>
                <?php foreach ($imagenes as $imagen): ?>
                    <img 
                        class="media-thumb"
                        data-src="<?php echo $folderPath . htmlspecialchars($imagen); ?>"
                        data-type="image"
                        src="<?php echo $folderPath . htmlspecialchars($imagen); ?>" 
                        alt="<?php echo htmlspecialchars($imagen); ?>"
                    >
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($videos) && is_array($videos)): ?>
                <?php foreach ($videos as $video): ?>
                    
                    <video 
                        class="media-thumb"
                        data-type="video"
                        controls 
                        width="320" 
                        height="240"
                        muted
                    >
                        <source src="<?php echo $folderPath . htmlspecialchars($video); ?>" 
                                type="video/<?php echo pathinfo($video, PATHINFO_EXTENSION); ?>">
                        Tu navegador no soporta el elemento de video.
                    </video>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (empty($imagenes) && empty($videos)): ?>
                <p>No se encontraron imágenes ni videos.</p>
            <?php endif; ?>
        </div>


    </div>
    <!-- Modal principal -->
    <div id="mediaModal" class="modal">
        <span class="close">&times;</span>
        <div class="modal-content" id="modalInner"></div>
    </div>

</section>
</body>
</html>