<?= $this->extend("layouts/nav") ?>

<?= $this->section("css") ?>
<script src="https://cdn.tailwindcss.com"></script>
<style>
    /* Contenedor del botón y el selector de fechas */
    .custom-button-container {
        position: relative; /* Esencial para posicionar el popup absolutamente */
        display: inline-block; /* Para que el contenedor se ajuste al tamaño del botón */
        text-align: center;
    }

    /* Estilo del botón "Personalizado" */
    .custom-button {
        background-color: #4a67d8; /* Azul primario */
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .custom-button:hover {
        background-color: #3b53b8; /* Azul más oscuro al pasar el ratón */
        transform: translateY(-2px); /* Ligero efecto de elevación */
    }


    
    .date-picker-popup {
        visibility: hidden; /* Oculto por defecto */
        opacity: 0; /* Inicialmente transparente */
        position: absolute;
        top: 100%; /* Posiciona el popup justo debajo del botón */
        left: 0; /* Alinea a la izquierda del botón */
        margin-top: 10px; /* Espacio entre el botón y el popup */
        background-color: #ffffff; /* Fondo blanco */
        border: 1px solid #d1d5db; /* Borde gris claro */
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Sombra suave */
        padding: 15px;
        z-index: 10; /* Asegura que esté por encima de otros elementos */
        display: flex;
        flex-direction: column;
        gap: 10px; /* Espacio entre los elementos del popup */
        transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.3s ease;
        transform: translateY(10px); /* Ligeramente hacia abajo al inicio para el efecto de subida */
    }

    .date-picker-popup.active {
        visibility: visible; /* Visible cuando está activo */
        opacity: 1; /* Completamente opaco */
        transform: translateY(0); /* Posición final */
    }

    .date-picker-popup label {
        font-size: 0.9rem;
        color: #374151;
        text-align: left;
        margin-bottom: -5px; /* Ajuste para acercar la etiqueta al input */
    }

    .date-picker-popup input[type="date"] {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.95rem;
        box-sizing: border-box; /* Incluye padding y border en el ancho */
    }

    .date-picker-popup input[type="date"]:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(66, 153, 225, 0.25);
    }

    .date-picker-popup .filter-button {
        background-color: #10b981; /* Verde */
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.95rem;
        font-weight: 600;
        transition: background-color 0.3s ease;
        margin-top: 5px; /* Espacio superior */
    }

    .date-picker-popup .filter-button:hover {
        background-color: #059669; /* Verde más oscuro */
    }
</style>
<?= $this->endSection() ?>

<?= $this->section("body") ?>
<div class="w-full mx-auto rounded-lg  p-2">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Estadísticas de la Propiedad</h1>

        <!-- Pestañas de Navegación -->
        <div class="flex border-b border-gray-200 mb-2">
            <button class="tab-button py-3 px-6 text-lg font-medium text-blue-600 border-b-2 border-blue-600 focus:outline-none" data-tab="estadisticas">Estadísticas</button>
            <button class="tab-button py-3 px-6 text-lg font-medium text-gray-600 hover:text-blue-600 hover:border-blue-600 focus:outline-none" data-tab="contactos">Contactos Recibidos</button>
        </div>

        <!-- Contenido de la Pestaña de Estadísticas -->
        <div id="estadisticas" class="tab-content">
            <!-- Filtros de Tiempo -->
            <div class="flex space-x-4 mb-8">
                <?php if (!empty($date_start) || !empty($date_end)){ ?>
                    <form action="" method="get">
                        <button class="flex gap-x-2 time-filter-button bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 1024 1024"><path fill="#ffffff" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64"/><path fill="#ffffff" d="m237.248 512l265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312z"/></svg>
                            Volver a filtros rápidos
                        </button>
                    </form>
                <?php }else{ ?>
                    <button class="time-filter-button bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-300" data-days="0">Hoy</button>
                    <button class="time-filter-button bg-gray-200 text-gray-800 px-4 py-2 rounded-lg shadow-md hover:bg-gray-300 transition duration-300" data-days="7">7 días</button>
                    <button class="time-filter-button bg-gray-200 text-gray-800 px-4 py-2 rounded-lg shadow-md hover:bg-gray-300 transition duration-300" data-days="30">30 días</button>
                    <button class="time-filter-button bg-gray-200 text-gray-800 px-4 py-2 rounded-lg shadow-md hover:bg-gray-300 transition duration-300" data-days="90">90 días</button>
                <?php } ?>

                <div class="custom-button-container">
                    <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg shadow-md hover:bg-gray-300 transition duration-300 flex items-center" id="personalizadoButton">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        Personalizado
                    </button>

                    <form action="" method="get" id="datePickerPopup" class="date-picker-popup">
                        <label for="startDate">Fecha Inicio:</label>
                        <input type="date" name="ds" id="startDate" value="<?= $date_start ?? '' ?>">
                        <label for="endDate">Fecha Fin:</label>
                        <input type="date" name="de" id="endDate" value="<?= $date_end ?? '' ?>">
                        <button id="filterButton" class="filter-button">Filtrar</button>
                    </form>
                </div>
            </div>

            <!-- Resumen de Impactos y Acciones -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-blue-50 p-6 rounded-lg shadow-inner">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-2">Total de Impactos</h2>
                    <p class="text-5xl font-extrabold text-blue-700" id="totalImpacts">7734</p>
                    <p class="text-gray-500"> (Suma de vistas y acciones realizadas con tus anuncios)</p>
                </div>
                <div class="bg-green-50 p-6 rounded-lg shadow-inner">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-2">Acciones sobre Anuncio</h2>
                    <p class="text-5xl font-extrabold text-green-700" id="totalActions">4913</p>
                    <p class="text-gray-500"> (Interacciones directas con la publicación)</p>
                </div>
            </div>

            <!-- Métricas Detalladas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center">
                    <p class="text-4xl font-bold text-gray-800" id="viewsListings">2757</p>
                    <p class="text-gray-600">Vistas en Listados</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center">
                    <p class="text-4xl font-bold text-gray-800" id="viewsSearch"><?= "" ?></p>
                    <p class="text-gray-600">Vistas en Búsqueda</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center">
                    <p class="text-4xl font-bold text-gray-800" id="viewsDetail"><?= "" ?></p>
                    <p class="text-gray-600">Vistas en Detalle</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center">
                    <p class="text-4xl font-bold text-gray-800" id="whatsappClicks"><?= "" ?></p>
                    <p class="text-gray-600">Clicks WhatsApp</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center">
                    <p class="text-4xl font-bold text-gray-800" id="phoneCalls"><?= "" ?></p>
                    <p class="text-gray-600">Llamadas al Propietario</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center">
                    <p class="text-4xl font-bold text-gray-800" id="sharedFB"><?= "" ?></p>
                    <p class="text-gray-600">Compartido en Facebook</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center">
                    <p class="text-4xl font-bold text-gray-800" id="copiedLink"><?= "" ?></p>
                    <p class="text-gray-600">Link Copiado</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center">
                    <p class="text-4xl font-bold text-gray-800" id="sharedFriends"></p>
                    <p class="text-gray-600">Compartido con amigos</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center">
                    <p class="text-4xl font-bold text-gray-800" id="emailOwner"></p>
                    <p class="text-gray-600">Email al propietario</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center">
                    <p class="text-4xl font-bold text-gray-800" id="savedFavorites">5</p>
                    <p class="text-gray-600">Guardado en Favoritos</p>
                </div>
            </div>

            <!-- Gráfico de Impactos -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Gráfico de Impactos</h2>
            <div class="flex flex-wrap gap-4 mb-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600 rounded" value="totalImpacts" checked>
                    <span class="ml-2 text-gray-700">Total de impactos</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600 rounded" value="viewsDetail">
                    <span class="ml-2 text-gray-700">Vistas en detalle</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600 rounded" value="viewsListings">
                    <span class="ml-2 text-gray-700">Vistas en listados</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600 rounded" value="whatsappClicks">
                    <span class="ml-2 text-gray-700">Clicks WhatsApp</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600 rounded" value="phoneCalls">
                    <span class="ml-2 text-gray-700">Llamadas al Propietario</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600 rounded" value="sharedFB">
                    <span class="ml-2 text-gray-700">Compartido en Facebook</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600 rounded" value="copiedLink">
                    <span class="ml-2 text-gray-700">Link Copiado</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600 rounded" value="savedFavorites">
                    <span class="ml-2 text-gray-700">Guardado en Favoritos</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600 rounded" value="viewsSearch">
                    <span class="ml-2 text-gray-700">Vistas en Búsqueda</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600 rounded" value="sharedFriends">
                    <span class="ml-2 text-gray-700">Compartido con amigos</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600 rounded" value="emailOwner">
                    <span class="ml-2 text-gray-700">Email al propietario</span>
                </label>
            </div>
            <!-- Contenedor para el gráfico con altura fija -->
            <div class="relative w-full h-[400px]">
                <canvas id="statsChart"></canvas>
            </div>
        </div>

        <!-- Contenido de la Pestaña de Contactos Recibidos (Placeholder) -->
        <div id="contactos" class="tab-content hidden">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Detalle de Mensajes Recibidos</h2>
            <div class="mt-4 p-4 bg-gray-50 rounded-lg shadow-sm">
                <?php 
                    foreach ($messages as $message):
                        $user = $message['user'] ?? [];
                        $userName = !empty($user) ? $user['name'] : 'Usuario Anónimo';
                        $userEmail = !empty($user) ? $user['email'] : 'No disponible';
                        $userPhoto = !empty($user) ? $user['photo'] : 'https://placehold.co/50x50/8B5CF6/ffffff?text=DM';
                        $createdAt = date('d/m/Y', strtotime($message['created_at']));
                ?>
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 mb-4 flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <img src="<?= $userPhoto ?>" alt="Foto de Perfil" class="w-12 h-12 rounded-full object-cover shadow-md">
                    </div>
                    <div class="flex-grow">
                        <div class="flex justify-between items-center mb-1">
                            <p class="font-semibold text-gray-900"><?= !empty($user) ? $user['name'] : 'Usuario Anónimo' ?></p>
                            <p class="text-sm text-gray-500"><?= date('d/m/Y', strtotime($message['created_at'])) ?></p>
                        </div>
                        <p class="text-sm text-gray-600 mb-0">Tipo: <span class="font-medium text-purple-700">Correo Electrónico</span></p>
                        <p class="text-sm text-gray-600 mb-2">Email: <span class="font-medium text-purple-700"><?= $userEmail ?></span></p>
                        <p class="text-gray-800">Mensaje: "<?= $message["message"] ?>"</p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section("js") ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Datos de ejemplo para las estadísticas (simulando datos reales)
        const mockStatsData = <?= json_encode($stats_json) ?>;

        let statsChart; // Variable para almacenar la instancia del gráfico

        // Función para actualizar las métricas en la interfaz
        function updateMetrics(data) {
            document.getElementById('totalImpacts').textContent = data.totalImpacts;
            document.getElementById('totalActions').textContent = data.totalActions;
            document.getElementById('viewsListings').textContent = data.viewsListings;
            document.getElementById('viewsDetail').textContent = data.viewsDetail;
            document.getElementById('whatsappClicks').textContent = data.whatsappClicks;
            document.getElementById('phoneCalls').textContent = data.phoneCalls;
            document.getElementById('sharedFB').textContent = data.sharedFB;
            document.getElementById('copiedLink').textContent = data.copiedLink;
            document.getElementById('savedFavorites').textContent = data.savedFavorites;
            document.getElementById('viewsSearch').textContent = data.viewsSearch;
            document.getElementById('sharedFriends').textContent = data.sharedFriends;
            document.getElementById('emailOwner').textContent = data.emailOwner;
        }

        // Función para renderizar o actualizar el gráfico
        function renderChart(chartData, selectedMetrics) {
            const ctx = document.getElementById('statsChart').getContext('2d');

            // Destruir el gráfico existente si lo hay para evitar superposiciones
            if (statsChart) {
                statsChart.destroy();
            }

            const datasets = selectedMetrics.map(metric => {
                let label = '';
                let color = '';
                switch (metric) {
                    case 'totalImpacts': label = 'Total de Impactos'; color = 'rgba(59, 130, 246, 0.8)'; break; // blue-600
                    case 'viewsDetail': label = 'Vistas en Detalle'; color = 'rgba(239, 68, 68, 0.8)'; break; // red-500
                    case 'viewsListings': label = 'Vistas en Listados'; color = 'rgba(16, 185, 129, 0.8)'; break; // emerald-500
                    case 'whatsappClicks': label = 'Clicks WhatsApp'; color = 'rgba(34, 197, 94, 0.8)'; break; // green-500
                    case 'phoneCalls': label = 'Llamadas al Propietario'; color = 'rgba(245, 158, 11, 0.8)'; break; // amber-500
                    case 'sharedFB': label = 'Compartido en Facebook'; color = 'rgba(59, 89, 152, 0.8)'; break; // facebook blue
                    case 'copiedLink': label = 'Link Copiado'; color = 'rgba(100, 116, 139, 0.8)'; break; // slate-500
                    case 'savedFavorites': label = 'Guardado en Favoritos'; color = 'rgba(234, 179, 8, 0.8)'; break; // yellow-500
                    case 'viewsSearch': label = 'Vistas en Búsqueda'; color = 'rgba(139, 92, 246, 0.8)'; break; // violet-500
                    case 'sharedFriends': label = 'Compartido con Amigos'; color = 'rgba(99, 102, 241, 0.8)'; break; // indigo-500
                    case 'emailOwner': label = 'Email al Propietario'; color = 'rgba(156, 163, 175, 0.8)'; break; // gray-500
                    default: label = metric; color = 'rgba(0,0,0,0.8)';
                }
                return {
                    label: label,
                    data: chartData.map(d => d[metric]),
                    borderColor: color,
                    backgroundColor: color.replace('0.8', '0.2'), // Color más claro para el área
                    fill: true,
                    tension: 0.3 // Suaviza las líneas del gráfico
                };
            });

            statsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.map(d => d.date),
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Permite que el gráfico se ajuste al contenedor
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    size: 14
                                }
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Fecha',
                                font: {
                                    size: 16
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Cantidad',
                                font: {
                                    size: 16
                                }
                            }
                        }
                    }
                }
            });
        }

        // Manejador de eventos para los filtros de tiempo
        document.querySelectorAll('.time-filter-button').forEach(button => {
            button.addEventListener('click', function() {
                // Remover clase activa de todos los botones
                document.querySelectorAll('.time-filter-button').forEach(btn => {
                    btn.classList.remove('bg-blue-600', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-800');
                });
                // Añadir clase activa al botón clickeado
                this.classList.add('bg-blue-600', 'text-white');
                this.classList.remove('bg-gray-200', 'text-gray-800');

                const days = this.dataset.days;
                const data = mockStatsData[days];
                if (data) {
                    updateMetrics(data);
                    // Obtener las métricas seleccionadas por los checkboxes
                    const selectedMetrics = Array.from(document.querySelectorAll('.form-checkbox:checked')).map(cb => cb.value);
                    renderChart(data.chartData, selectedMetrics);
                }
            });
        });

        // Manejador de eventos para los checkboxes del gráfico
        document.querySelectorAll('.form-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const currentDays = document.querySelector('.time-filter-button.bg-blue-600').dataset.days;
                const data = mockStatsData[currentDays];
                if (data) {
                    const selectedMetrics = Array.from(document.querySelectorAll('.form-checkbox:checked')).map(cb => cb.value);
                    renderChart(data.chartData, selectedMetrics);
                }
            });
        });

        // Manejador de eventos para las pestañas
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                // Remover clase activa de todas las pestañas
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('text-blue-600', 'border-blue-600');
                    btn.classList.add('text-gray-600', 'hover:text-blue-600', 'hover:border-blue-600');
                });
                // Añadir clase activa a la pestaña clickeada
                this.classList.add('text-blue-600', 'border-blue-600');
                this.classList.remove('text-gray-600', 'hover:text-blue-600', 'hover:border-blue-600');

                // Ocultar todos los contenidos de las pestañas
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });
                // Mostrar el contenido de la pestaña clickeada
                document.getElementById(this.dataset.tab).classList.remove('hidden');

                // Si se vuelve a la pestaña de estadísticas, asegurar que el gráfico se renderice correctamente
                if (this.dataset.tab === 'estadisticas') {
                    const currentDays = document.querySelector('.time-filter-button.bg-blue-600').dataset.days;
                    const data = mockStatsData[currentDays];
                    if (data) {
                        const selectedMetrics = Array.from(document.querySelectorAll('.form-checkbox:checked')).map(cb => cb.value);
                        renderChart(data.chartData, selectedMetrics);
                    }
                }
            });
        });

        // Inicializar la vista con los datos de "30 días" y el gráfico de "Total de impactos"
        window.onload = function() {
            // Activar el botón de 30 días al cargar
            document.querySelector('.time-filter-button[data-days="30"]')?.click();
            // Asegurarse de que el checkbox de "Total de impactos" esté marcado y el gráfico se dibuje
            document.querySelector('.form-checkbox[value="totalImpacts"]').checked = true;
            const initialData = mockStatsData["30"];
            updateMetrics(initialData);
            renderChart(initialData.chartData, ['totalImpacts']);
        };
    </script>
    <script> 
        const personalizadoButton = document.getElementById('personalizadoButton');
        const datePickerPopup = document.getElementById('datePickerPopup');
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');
        const filterButton = document.getElementById('filterButton');

        // Función para alternar la visibilidad del popup
        personalizadoButton.addEventListener('click', (event) => {
            event.stopPropagation(); // Evita que el clic se propague al documento y cierre el popup inmediatamente
            datePickerPopup.classList.toggle('active');
        });

        // Cierra el popup si se hace clic fuera de él
        document.addEventListener('click', (event) => {
            if (!datePickerPopup.contains(event.target) && !personalizadoButton.contains(event.target)) {
                datePickerPopup.classList.remove('active');
            }
        });

    </script>
<?= $this->endSection() ?>