console.log("swipe.js cargado correctamente");

const DECISION_THRESHOLD = 75;
let isAnimating = false;
let pullDeltaX = 0; // Distancia que se arrastra la tarjeta

// Función para obtener un nuevo cliente aleatorio y mostrarlo
async function obtenerClienteAleatorio(respaldo = false) {
    try {
        const response = await fetch("../controllers/obtener_cliente.php");
        const data = await response.json();

        console.log("Datos recibidos del backend:", data); // 🔹 Depuración

        if (!data.cliente) {
            console.error("Error: Cliente no encontrado en la respuesta del servidor.");
            document.querySelector(".cards").innerHTML = `<span>Error al cargar cliente</span>`;
            return;
        }

        // Guardar el ID del usuario actual para usar en registrarAccion
        window.usuarioActualId = data.usuario_actual;
        console.log("ID del usuario actual asignado correctamente:", window.usuarioActualId);

        const cliente = data.cliente;

        const nuevaTarjeta = document.createElement("article");
        nuevaTarjeta.classList.add("card", "article");

        nuevaTarjeta.innerHTML = `
            <img src="${cliente.imagen}" alt="${cliente.nombre}" onerror="this.src='uploads/default.jpg';" />
            <h2>${cliente.nombre}</h2>
            <p><strong>Industria:</strong> ${cliente.industria}</p>
            <p><strong>País:</strong> ${cliente.pais}</p>
            <p><strong>Ciudad:</strong> ${cliente.ciudad}</p>
            <p><strong>Intereses:</strong> ${cliente.intereses}</p>
            <div class="choice nope">NOPE</div>
            <div class="choice like">LIKE</div>
        `;
        nuevaTarjeta.dataset.id = cliente.id;

        if (respaldo) {
            nuevaTarjeta.style.display = "none"; 
        }

        document.querySelector(".cards").appendChild(nuevaTarjeta);

        nuevaTarjeta.addEventListener("mousedown", startDrag);
        nuevaTarjeta.addEventListener("touchstart", startDrag, { passive: true });

    } catch (error) {
        console.error("Error al obtener el cliente:", error);
    }
}





// Función para manejar el arrastre de tarjetas
function startDrag(event) {
    if (isAnimating) return;

    const actualCard = event.target.closest("article");
    if (!actualCard) return;

    const startX = event.pageX ?? event.touches[0].pageX;

    document.addEventListener("mousemove", onMove);
    document.addEventListener("mouseup", onEnd);
    document.addEventListener("touchmove", onMove, { passive: true });
    document.addEventListener("touchend", onEnd, { passive: true });

    function onMove(event) {
        const currentX = event.pageX ?? event.touches[0].pageX;
        pullDeltaX = currentX - startX;

        if (pullDeltaX === 0) return;

        isAnimating = true;

        const deg = pullDeltaX / 14;
        actualCard.style.transform = `translateX(${pullDeltaX}px) rotate(${deg}deg)`;
        actualCard.style.cursor = "grabbing";

        const opacity = Math.abs(pullDeltaX) / 100;
        const isRight = pullDeltaX > 0;

        const choiceEl = isRight
            ? actualCard.querySelector(".choice.like")
            : actualCard.querySelector(".choice.nope");

        choiceEl.style.opacity = opacity;
    }

    function onEnd() {
        document.removeEventListener("mousemove", onMove);
        document.removeEventListener("mouseup", onEnd);
        document.removeEventListener("touchmove", onMove);
        document.removeEventListener("touchend", onEnd);

        const decisionMade = Math.abs(pullDeltaX) >= DECISION_THRESHOLD;

        if (decisionMade) {
            const goRight = pullDeltaX >= 0;
            actualCard.classList.add(goRight ? "go-right" : "go-left");

            actualCard.addEventListener("transitionend", (event) => {
                if (event.propertyName !== "transform") return;
                const action = goRight ? "like" : "dislike";
                const clienteId = actualCard.dataset.id;
                registrarAccion(clienteId, action);
                actualCard.remove();
                isAnimating = false;
                const tarjetaRespaldo = document.querySelector(".card[style='display: none;']");
                if (tarjetaRespaldo) {
                    tarjetaRespaldo.style.display = "";
                    console.log("Tarjeta de respaldo activada.");
                }
                obtenerClienteAleatorio();
                });
                } else {
                    console.log("Swipe cancelado, tarjeta vuelve a su posición.");


            actualCard.classList.remove("go-right", "go-left");
            actualCard.classList.add("reset");
            actualCard.style.transform = "translateX(0) rotate(0deg)";

            actualCard.addEventListener("transitionend", () => {
                actualCard.removeAttribute("style");
                actualCard.classList.remove("reset");
                pullDeltaX = 0;
                isAnimating = false;
            });
        }

        actualCard.querySelectorAll(".choice").forEach(el => (el.style.opacity = 0));
    }
}

function registrarAccion(clienteId, accion) {
    const idEmisor = window.usuarioActualId; // El ID del usuario que inició sesión
     if (!idEmisor || !clienteId || !accion) {
        console.error("Error: Datos inválidos al registrar acción:", { idEmisor, clienteId, accion });
        return;
    }

    console.log("Enviando datos al backend:", { idEmisor, clienteId, accion });

    fetch("../controllers/guardar_accion.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ idEmisor, clienteId, accion })
    })
    .then(response => response.json())
    .then(data => {
        console.log("Respuesta del servidor:", data);
        if (data.error) {
            alert("Error: " + data.error);
        } else {
            console.log("Acción registrada correctamente");
        }
    })
    .catch(error => {
        console.error("Error en la petición:", error);
    });
}


// Llamar la función para cargar un cliente al iniciar la página
document.addEventListener("DOMContentLoaded", () => {
    obtenerClienteAleatorio();
});
