const ciudadesPorPais = {
    "Estados Unidos": ["Nueva York", "Los Ángeles", "Chicago", "Houston", "San Francisco"],
    "China": ["Pekín", "Shanghái", "Cantón", "Shenzhen", "Chongqing"],
    "India": ["Delhi", "Bombay", "Bangalore", "Chennai", "Hyderabad"],
    "Alemania": ["Berlín", "Múnich", "Hamburgo", "Colonia", "Fráncfort"],
    "Reino Unido": ["Londres", "Manchester", "Birmingham", "Liverpool", "Glasgow"],
    "Francia": ["París", "Marsella", "Lyon", "Toulouse", "Niza"],
    "Japón": ["Tokio", "Osaka", "Yokohama", "Nagoya", "Sapporo"],
    "Brasil": ["São Paulo", "Río de Janeiro", "Brasilia", "Belo Horizonte", "Recife"],
    "Canadá": ["Toronto", "Vancouver", "Montreal", "Calgary", "Ottawa"],
    "Italia": ["Roma", "Milán", "Nápoles", "Turín", "Florencia"],
    "Rusia": ["Moscú", "San Petersburgo", "Novosibirsk", "Ekaterimburgo", "Kazan"],
    "Corea del Sur": ["Seúl", "Busan", "Incheon", "Daegu", "Daejeon"],
    "México": ["Ciudad de México", "Guadalajara", "Monterrey", "Puebla", "Cancún"],
    "Indonesia": ["Yakarta", "Surabaya", "Bandung", "Medan", "Bekasi"],
    "Australia": ["Sídney", "Melbourne", "Brisbane", "Perth", "Adelaida"],
    "España": ["Madrid", "Barcelona", "Valencia", "Sevilla", "Bilbao"],
    "Arabia Saudita": ["Riad", "Yeda", "La Meca", "Medina", "Dammam"],
    "Sudáfrica": ["Johannesburgo", "Ciudad del Cabo", "Durban", "Pretoria", "Port Elizabeth"],
    "Turquía": ["Estambul", "Ankara", "Esmirna", "Bursa", "Antalya"],
    "Argentina": ["Buenos Aires", "Córdoba", "Rosario", "Mendoza", "La Plata"],
    "Colombia": ["Bogotá", "Medellín", "Cali", "Barranquilla", "Cartagena", "Pereira", "Bucaramanga", "Cúcuta", "Palermo", "Soledad", "Villavicencio", "Bello", "Valledupar", "Ibagué", "Montería", "Soacha", "Santa Marta", "Manizales", "Buenaventura", "Pasto", "Neiva", "Palmira", "Armenia", "Popayán", "Floridablanca", "Sincelejo", "Itagüí", "Envigado", "Tuluá", "Tumaco", "Barrancabermeja", "Uripa", "Zipaquirá", "Florencia", "Turbo", "Dosquebradas", "Riohacha", "Ipiales", "Tunja", "Girón", "Facatativa", "Cartago", "Rionegro", "Quibdo", "Jamundí", "Girardot", "Cienaga", "Guadalajara de buga"],
    "Chile": ["Santiago", "Valparaíso", "Concepción", "La Serena", "Antofagasta"],
    "Emiratos Árabes Unidos": ["Dubái", "Abu Dabi", "Sharjah", "Ajman", "Al Ain"],
    "Egipto": ["El Cairo", "Alejandría", "Gizeh", "Shubra El-Kheima", "Port Said"],
    "Nigeria": ["Lagos", "Abuya", "Ibadan", "Kano", "Benín"],
    "Vietnam": ["Hanói", "Ciudad Ho Chi Minh", "Da Nang", "Hai Phong", "Can Tho"],
    "Tailandia": ["Bangkok", "Chiang Mai", "Phuket", "Pattaya", "Nakhon Ratchasima"],
    "Países Bajos": ["Ámsterdam", "Róterdam", "La Haya", "Utrecht", "Eindhoven"],
    "Suiza": ["Zúrich", "Ginebra", "Berna", "Basilea", "Lausana"],
    "Singapur": ["Singapur"],
    "Suecia": ["Estocolmo", "Gotemburgo", "Malmö", "Upsala", "Västerås"]
};

function actualizarCiudades() {
    const paisSeleccionado = document.getElementById("pais").value;
    const ciudadSelect = document.getElementById("ciudad");
    
    // Limpiar opciones previas
    ciudadSelect.innerHTML = "<option value=''>Seleccione una ciudad</option>";

    // Verificar si el país tiene ciudades registradas
    if (ciudadesPorPais[paisSeleccionado]) {
        ciudadesPorPais[paisSeleccionado].forEach(ciudad => {
            let nuevaOpcion = document.createElement("option");
            nuevaOpcion.value = ciudad;
            nuevaOpcion.textContent = ciudad;
            ciudadSelect.appendChild(nuevaOpcion);
        });
    }
}

// Event listener para detectar cambio en el país seleccionado
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("pais").addEventListener("change", actualizarCiudades);
});