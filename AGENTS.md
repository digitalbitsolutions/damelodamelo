# AGENTS

Estas pautas aplican a todo el repositorio. Sirven para configurar a Codex/GPT como especialista en mantenimiento de la plataforma inmobiliaria y de servicios para el hogar desarrollada con PHP (CodeIgniter), JavaScript, HTML y CSS.

## Stack y alcance
- **PHP 7+/8+ con CodeIgniter** como marco principal para el backend.
- **JavaScript (ES6+)**, **HTML5** y **CSS3** para el frontend.
- El proyecto es un sistema de gestión inmobiliaria y de servicios para el hogar con alta criticidad; se asume que existen bugs graves por la ausencia histórica de control de versiones y agentes de IA.

## Directrices generales
1. Prioriza la seguridad y la corrección funcional sobre la velocidad de entrega.
2. Documenta las suposiciones y riesgos en cada cambio; evita silencios en lógica de negocio.
3. Mantén las dependencias y configuraciones actualizadas y auditadas antes de usar nuevas librerías.
4. Prefiere soluciones simples y explícitas; evita "magia" oculta o optimizaciones prematuras.

## PHP / CodeIgniter
- Respeta la arquitectura MVC; no coloques lógica de negocio en controladores o vistas cuando deba vivir en modelos/servicios.
- Utiliza tipado estricto donde sea posible y validaciones de entrada exhaustivas (filtros XSS/CSRF y reglas de validación de formularios).
- Usa transacciones en operaciones críticas (reservas, pagos, asignaciones de servicios) y registra eventos significativos.
- Maneja errores con excepciones claras y logging estructurado; no silencies errores ni uses `@`.

## JavaScript / HTML / CSS
- Escribe JavaScript modular (ES6+) y evita la contaminación del ámbito global; encapsula lógica en módulos o IIFE.
- En HTML, sigue buenas prácticas de accesibilidad (atributos `aria`, semántica adecuada) y evita contenido inline cuando existan archivos dedicados.
- En CSS, favorece clases descriptivas y evita el uso excesivo de reglas globales que puedan generar efectos secundarios.

## Calidad y pruebas
- Acompaña cada corrección crítica con pruebas unitarias o funcionales relevantes; ejecuta suites de pruebas existentes cuando modifiques código afectado.
- Verifica rutas críticas (alta de propiedades, agenda de servicios, pagos) antes de desplegar.

## Versionado y colaboración
- Redacta commits y Pull Requests con resúmenes claros del problema y la solución; incluye riesgos o limitaciones conocidas.
- No dejes código comentado ni configuraciones temporales en el repositorio.
