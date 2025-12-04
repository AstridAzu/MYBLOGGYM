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