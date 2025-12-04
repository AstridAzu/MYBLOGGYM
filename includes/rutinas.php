<?php
// visual-routines.php
?>
<?php
// Cargar datos directamente desde el archivo JSON
$json = file_get_contents('includes/rutinas.json');
$data = json_decode($json, true);

// Separar datos por tipo de tren
$tren_superior = $data['tren_superior'] ?? [];
$tren_inferior = $data['tren_inferior'] ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Rutinas Visuales</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="./styles/rutinas.css">
</head>
<body>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
        const modal     = document.getElementById("mediaModal");
        const modalInner = document.getElementById("modalInner");
        const closeBtn  = modal.querySelector(".close");

        // Función que abre el modal con la media adecuada
        function openModal(type, src) {
            // Limpia contenido previo
            modalInner.innerHTML = "";

            if (type === "image") {
                const img = new Image();
                img.src = src;
                img.style.maxWidth  = "100%";
                img.style.maxHeight = "100%";
                modalInner.appendChild(img);

            } else if (type === "video") {
                const video = document.createElement("video");
                video.controls = true;
                video.autoplay = true;
                video.style.maxWidth  = "100%";
                video.style.maxHeight = "100%";

                const source = document.createElement("source");
                source.src  = src;
                // Determina el tipo MIME según la extensión
                const ext      = src.split('.').pop().toLowerCase();
                source.type   = `video/${ext === 'mp4' ? 'mp4' : ext}`;

                video.appendChild(source);
                modalInner.appendChild(video);
            }
            // // Posicionamiento según scroll
            // const scrollTop = window.scrollY || window.pageYOffset;
            // const viewportHeight = window.innerHeight;
            // modal.style.position = "absolute";
            // modal.style.top = `${(scrollTop/ 2) +(viewportHeight+200  )}px`;
            
            // Muestra el modal como flex para centrar contenido
            modal.style.display = "flex";
        }

        // Cierra el modal
        closeBtn.addEventListener("click", () => {
            modal.style.display = "none";
            // Pausa cualquier vídeo que estuviese reproduciéndose
            const v = modalInner.querySelector("video");
            if (v) v.pause();
        });
        // Cierra al clicar fuera del contenido
        modal.addEventListener("click", e => {
            if (e.target === modal) {
                modal.style.display = "none";
                const v = modalInner.querySelector("video");
                if (v) v.pause();
            }
        });

        // Asocia el evento click a todas las miniaturas
        document.querySelectorAll(".media-thumb").forEach(el => {
            el.addEventListener("click", () => {
                const type = el.getAttribute("data-type");
                const src  = el.getAttribute("data-src")
                          || el.querySelector("source")?.getAttribute("src");
                if (type && src) {
                    openModal(type, src);
                } else {
                    console.warn("Miniatura sin data-type o data-src:", el);
                }
            });
        });
    });
    </script>
     <!-- Modal principal -->
    <div id="mediaModal" class="modal">
        <span class="close">&times;</span>
        <div class="modal-content" id="modalInner"></div>
    </div>
  <div id="rutinas"  class="tabs-container">
    <div class="tabs-list">
      <button class="tab-button active" data-tab="glutes">Tren inferior
      </button>
      <button class="tab-button" data-tab="upper">Tren Superior</button>
      
    </div>

    <!-- Rutina Tren inferior -->
    <div class="tab-content active" id="glutes">
      <div class="card   text-white">
        <div class="card-header">
          <h2>Rutina Tren inferior</h2>
          <p>Enfocada en activación y fuerza</p>
        </div>
        <div class="sectionrutina">
          <?php foreach ($tren_inferior as $dia => $ejercicios): ?>
            <div class="day">
              <h3><?= ucfirst($dia) ?></h3>
              <?php foreach ($ejercicios as $ejercicio): ?>
                <div class="cardRutina">
                  <div class="rutinainfo">
                    <div class="contenedoorEjercicios">
                      <div>
                          <svg  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"   ><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M5 20l5 -.5l1 -2" /><path d="M18 20v-5h-5.5l2.5 -6.5l-5.5 1l1.5 2" /></svg>  
                          <h4><?= $ejercicio['nombre'] ?></h4>
                        </div>
                        
                        <div>
                          <?php if (!empty($ejercicio['series_repeticiones'])): ?>
                            <svg     width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  ><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M13 21l1 -9l7 -6" /><path d="M3 11h6l5 1" /><path d="M11.5 8.5l4.5 -3.5" /></svg>
                          
                            <p><strong>Series y repeticiones:</strong> <?= $ejercicio['series_repeticiones'] ?></p>
                          <?php endif; ?>

                        </div>
                    </div>
                   
                  </div>
                  <?php if (!empty($ejercicio['variaciones'])): ?>
                    <p class="titleVariaciones"><strong>Variaciones:</strong></p>
                    <div class="variaciones">
                      <?php foreach ($ejercicio['variaciones'] as $var): ?>
                        <span>
                        ✅ <?= $var ?>
                        </span>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                  <div class="galeriaRutina">
                  
                    <?php if (!empty($ejercicio['imagenes'])): ?>
                      <?php foreach ($ejercicio['imagenes'] as $var): ?>
                      <div class="itemGaleria">
                   
                        <img 
                        data-src="<?= $var ?>" 
                        data-type="image"
                        
                        src="<?= $var ?>"
                         alt="Imagen de <?= $ejercicio['nombre'] ?>" class="imagenRutina media-thumb">
                         
                      </div>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endforeach; ?>
        </div>
        <div>
             
        </div>
      </div>
    </div>

    <!-- Rutina de Tren Superior -->
    <div class="tab-content" id="upper">
      <div class="card gradient-purple-blue text-white">
        <div class="card-header">
          <h2>Rutina de Tren Superior</h2>
          <p>Para tonificación y fuerza</p>
        </div>
        <div class="sectionrutina">
          <?php foreach ($tren_superior as $dia => $ejercicios): ?>
            <div class="day">
              <h3><?= ucfirst($dia) ?> </h3>
              <?php foreach ($ejercicios as $ejercicio): ?>
                <div class="cardRutina">
                  <div class="rutinainfo">
                     <div class="contenedoorEjercicios">
                      <div>
                          <svg  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"   ><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M5 20l5 -.5l1 -2" /><path d="M18 20v-5h-5.5l2.5 -6.5l-5.5 1l1.5 2" /></svg>  
                          <h4><?= $ejercicio['nombre'] ?></h4>
                        </div>
                        
                        <div>
                          <?php if (!empty($ejercicio['series_repeticiones'])): ?>
                            <svg     width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  ><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M13 21l1 -9l7 -6" /><path d="M3 11h6l5 1" /><path d="M11.5 8.5l4.5 -3.5" /></svg>
                          
                            <p><strong>Series y repeticiones:</strong> <?= $ejercicio['series_repeticiones'] ?></p>
                          <?php endif; ?>

                        </div>
                    </div>
                  </div>
                  <?php if (!empty($ejercicio['variaciones'])): ?>
                    <p class="titleVariaciones"><strong>Variaciones:</strong></p>
                    <div class="variaciones">
                      <?php foreach ($ejercicio['variaciones'] as $var): ?>
                        <span>
                        ✅ <?= $var ?>
                        </span>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                  <div class="galeriaRutina">
                  
                    <?php if (!empty($ejercicio['imagenes'])): ?>
                      <?php foreach ($ejercicio['imagenes'] as $var): ?>
                      <div class="itemGaleria">
                   
                        <img 
                        data-src="<?= $var ?>" 
                        data-type="image"
                        src="<?= $var ?>" 
                        alt="Imagen de <?= $ejercicio['nombre'] ?>" 
                        class="imagenRutina   media-thumb"">
                         
                      </div>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    

  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const buttons = document.querySelectorAll(".tab-button");
      const contents = document.querySelectorAll(".tab-content");

      buttons.forEach(button => {
        button.addEventListener("click", () => {
          buttons.forEach(btn => btn.classList.remove("active"));
          contents.forEach(content => content.classList.remove("active"));

          button.classList.add("active");
          const tabId = button.getAttribute("data-tab");
          document.getElementById(tabId).classList.add("active");
        });
      });

      if (buttons.length) buttons[0].click();
    });
  </script>
</body>
</html>
