<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
    #map { height: 90vh; width: 100%; }
        .legend { background: white; padding: 10px; border-radius: 8px; font-size: 14px; }
        .marker-popup img { width: 100%; border-radius: 8px; margin-bottom: 10px; }

    .sidebar_derecha { height: 100vh; overflow-y: auto; background: #fff; padding: 15px; }
    .floating-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: linear-gradient(135deg, #00b894, #0984e3);
        color: #fff; border: none; border-radius: 50%;
        width: 60px; height: 60px; font-size: 32px;
        z-index: 1500;
    }
</style>


<!-- Botón flotante -->
<button class="floating-btn" data-toggle="modal" data-target="#modalReporte">+</button>

<!-- Modal para agregar reporte -->
<?= view('reporte/vw_reporte_modal_mantenimiento'); ?>


<div class="content-wrapper">
    
    <section class="content pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9 p-0">
                    <div id="map"></div>
                </div>
                <!-- Columna lateral -->
                <div class="col-md-3 sidebar_derecha">
                    <!-- <h5>Reportes Activos</h5>
                    <ul>
                        <?php foreach($conteo as $c): ?>
                        <li><?= ucfirst($c['rep_estado']) ?>: <?= $c['total'] ?></li>
                        <?php endforeach; ?>
                    </ul> -->
                    <h6 class="mt-1">Filtrar por Tipo</h6>
                    <div class="btn-group mb-3">
                        <button class="btn btn-sm btn-primary" onclick="filtrar('todos')">Todos</button>
                        <button class="btn btn-sm btn-outline-primary" onclick="filtrar('agua')">Agua</button>
                        <button class="btn btn-sm btn-outline-primary" onclick="filtrar('aire')">Aire</button>
                        <button class="btn btn-sm btn-outline-primary" onclick="filtrar('residuos')">Residuos</button>
                    </div>
                    <div id="listaReportes">
                        <?php foreach($reportes as $r): ?>
                        <div class="card mb-2" onclick="verDetalle(<?= $r['codreporte'] ?>)">
                            <img src="<?= base_url(''.$r['imagen']) ?>" class="card-img-top">
                            <div class="card-body">
                                <h6><?= esc($r['titulo']) ?></h6>
                                <p><?= esc($r['descripcion']) ?></p>
                                <span class="badge bg-danger"><?= ucfirst($r['nivel']) ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.heat/dist/leaflet-heat.js"></script>
<script>
const map = L.map('map').setView([-5.1945, -80.6328], 14);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '© Ecovisión | OpenStreetMap'
}).addTo(map);

const reportes = <?= json_encode($reportes) ?>;

// === Heatmap data ===
const heatData = reportes.map(r => [r.latitud, r.longitud, 0.4]);
L.heatLayer(heatData, {
    radius: 25,
    blur: 15,
    maxZoom: 17
}).addTo(map);

// === Marcadores de colores ===
const nivelColor = {
    'Bajo': 'green',
    'Moderado': 'orange',
    'Alto': 'red',
    'Crítico': 'darkred'
};

// Limpiamos los marcadores previos
var markers = [];

reportes.forEach(r => {
    // Determina color según el nivel de contaminación
    const color = nivelColor[r.nivel] || 'blue';

    // Ícono circular moderno con color dinámico
    const icon = L.divIcon({
        html: `
            <div style="
                background:${color};
                width:20px; height:20px;
                border-radius:50%;
                border:2px solid white;
                box-shadow:0 0 6px ${color};
            "></div>`,
        className: '',
        iconSize: [20, 20],
        iconAnchor: [10, 10]
    });

    // Contenido del popup
    const popupContent = `
        <div class="marker-popup">
            <img src="${base_url}${r.imagen}" alt="${r.titulo}">
            <h6>${r.titulo}</h6>
            <p><strong>Tipo:</strong> ${r.tipo}</p>
            <p><strong>Nivel:</strong> ${r.nivel}</p>
            <p><strong>Dirección:</strong> ${r.direccion}</p>
            <p><small><i>${r.fecha}</i></small></p>
        </div>
    `;

    // Crear el marcador con ícono personalizado
    const marker = L.marker([r.latitud, r.longitud], { icon })
        .bindPopup(popupContent)
        .addTo(map);

    // Vincular evento click → detalle
    marker.on('click', () => verDetalle(r.codreporte));
    markers.push(marker);
});



// === Leyenda ===
const legend = L.control({
    position: 'bottomright'
});
legend.onAdd = function() {
    const div = L.DomUtil.create('div', 'legend');
    div.innerHTML = `
            <strong>Nivel de Severidad</strong><br>
            <i style="background:green;width:10px;height:10px;display:inline-block;border-radius:50%;"></i> Bajo<br>
            <i style="background:orange;width:10px;height:10px;display:inline-block;border-radius:50%;"></i> Moderado<br>
            <i style="background:red;width:10px;height:10px;display:inline-block;border-radius:50%;"></i> Alto<br>
            <i style="background:darkred;width:10px;height:10px;display:inline-block;border-radius:50%;"></i> Crítico
        `;
    return div;
};
legend.addTo(map);





function verDetalle(id) {
    fetch('mapa/detalle/' + id)
        .then(res => res.json())
        .then(data => {
            let html = `
            <button class="btn btn-link" onclick="location.reload()">← Volver a la lista</button>
            <img src="${base_url}${data.imagen}" class="img-fluid rounded mb-3">
            <h5>${data.titulo}</h5>
            <p>${data.descripcion}</p>
            <span class="badge bg-danger">${data.nivel}</span>
            <p><b>Fecha:</b> ${data.fecha}</p>`;
            document.getElementById('listaReportes').innerHTML = html;
        });
}

function filtrar(tipo) {
    fetch('mapa/filtrar/' + tipo)
        .then(res => res.json())
        .then(data => {
            document.getElementById('listaReportes').innerHTML = '';
            data.forEach(r => {
                document.getElementById('listaReportes').innerHTML += `
                <div class="card mb-2" onclick="verDetalle(${r.codreporte})">
                    <img src="${base_url}${r.imagen}" class="card-img-top">
                    <div class="card-body">
                        <h6>${r.titulo}</h6>
                        <p>${r.descripcion}</p>
                        <span class="badge bg-danger">${r.nivel}</span>
                    </div>
                </div>`;
            });
        });
}
</script>

    

