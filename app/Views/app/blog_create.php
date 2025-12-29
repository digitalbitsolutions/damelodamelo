<?= $this->extend("layouts/nav") ?>
<?= $this->section("css") ?>
<link rel="stylesheet" href="<?= base_url()."css/app/blog_create_modal.css" ?>">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

<?= $this->endSection() ?>

<?= $this->section("body") ?>
    <div class="container-main">
        <div class="form-container">
            <h2>Crear Nuevo Artículo de Blog</h2>
            <form id="blogPostForm">
                <div class="form-group">
                    <label for="title">Título del Artículo</label>
                    <input type="text" id="title" name="title" placeholder="Introduce el título de tu blog" required>
                </div>
    
                <div class="form-group">
                    <label for="slug">Slug (URL amigable)</label>
                    <input type="text" id="slug" name="slug" placeholder="ej: mi-primer-articulo-de-blog" required>
                </div>
    
                <div class="form-group">
                    <label for="summary">Resumen del Artículo</label>
                    <textarea id="summary" name="summary" placeholder="Escribe un breve resumen de tu artículo..." rows="4" required></textarea>
                </div>
    
                <div class="form-group">
                    <label for="featured_image">Imagen Destacada</label>
                    <input type="file" id="featured_image" name="featured_image" accept="image/*" required>
                    <div class="image-preview-container">
                        <img id="imagePreview" src="#" alt="Previsualización de Imagen" style="display: none;">
                        <span id="imagePlaceholder" class="placeholder-text">No hay imagen seleccionada</span>
                    </div>
                </div>
    
                <div class="form-group">
                    <label for="category">Categoría</label>
                    <select id="category" name="category" required>
                        <option value="">Selecciona una categoría</option>
                        <option value="tecnologia">Tecnología</option>
                        <option value="viajes">Viajes</option>
                        <option value="cocina">Cocina</option>
                        <option value="salud">Salud y Bienestar</option>
                        <option value="negocios">Negocios</option>
                        <option value="personal">Desarrollo Personal</option>
                        <option value="otros">Otros</option>
                    </select>
                </div>


                <div id="summernote"></div>

                <button type="submit" class="submit-button">Publicar Artículo</button>
            </form>
            <div id="feedbackMessage" class="feedback-message"></div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section("js") ?>
    <script>
        $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        document.addEventListener('DOMContentLoaded', () => {
            const editorArea = document.getElementById('editorArea');
            const form = document.getElementById('blogPostForm');
            const feedbackMessage = document.getElementById('feedbackMessage');
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');
            const featuredImageInput = document.getElementById('featured_image');
            const imagePreview = document.getElementById('imagePreview');
            const imagePlaceholder = document.getElementById('imagePlaceholder');

            // Function to generate a slug from the title
            titleInput.addEventListener('input', () => {
                const title = titleInput.value;
                const slug = title
                    .toLowerCase()
                    .trim()
                    .replace(/[^\w\s-]/g, '') /* Remove non-alphanumeric characters */
                    .replace(/[\s_-]+/g, '-') /* Replace spaces and underscores with a single hyphen */
                    .replace(/^-+|-+$/g, ''); /* Remove hyphens from start or end */
                slugInput.value = slug;
            });

            // Function to handle image preview
            featuredImageInput.addEventListener('change', (event) => {
                const file = event.target.files[0]; // Get the selected file

                if (file) {
                    const reader = new FileReader(); // Create a new FileReader object

                    reader.onload = (e) => {
                        // When the file is loaded, set the image source
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block'; // Show the image
                        imagePlaceholder.style.display = 'none'; // Hide the placeholder text
                    };

                    reader.readAsDataURL(file); // Read the file as a data URL
                } else {
                    // If no file is selected, hide the image and show the placeholder
                    imagePreview.src = '#';
                    imagePreview.style.display = 'none';
                    imagePlaceholder.style.display = 'block';
                }
            });

            form.addEventListener('submit', (event) => {
                event.preventDefault(); // Prevent default form submission

                const editorElement = document.getElementById('summernote');
                const editorContent = $(editorElement).summernote('code'); 

                const formData = new FormData(form);
                formData.append("content", editorContent);

                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                }
                
                fetch('/post/blogs/article/save', {
                    method: 'POST',
                    body: formData,
                }).then(response => response.json()).then(data => {
                    location.href = "/post/blogs";
                })
                .catch((error) => {
                    console.error('Error:', error);
                    feedbackMessage.textContent = 'Error publishing article.';
                    feedbackMessage.style.backgroundColor = '#ffe6e6'; // Light red for error
                    feedbackMessage.style.color = '#5e1a1a'; // Darker red for text
                    feedbackMessage.style.display = 'block';
                });
            });
        });
    </script>
<?= $this->endSection() ?>