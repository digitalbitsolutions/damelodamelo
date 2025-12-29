<?php
use CodeIgniter\HTTP\Files\UploadedFile;

/**
 * Convierte una imagen a WebP con compresión del 60%
 * 
 * @param string $sourcePath Ruta completa del archivo original
 * @param string $targetDir Directorio de destino relativo a FCPATH
 * @return string|null Ruta del archivo WebP o null si falla
 */

 if (!function_exists('convert_to_webp')) {
    function convert_to_webp(string $sourcePath, string $targetDir = 'uploads/images'): ?string
        {
            // Verificar si GD está instalado
            if (!extension_loaded('gd')) {
                log_message('error', 'GD library no está instalada');
                return null;
            }

            $targetPath = FCPATH . $targetDir;
            $imageInfo = @getimagesize($sourcePath);
            
            if (!$imageInfo) {
                log_message('error', 'No se pudo leer la información de la imagen: ' . $sourcePath);
                return null;
            }

            $mimeType = $imageInfo['mime'];
            $image = null;

            try {
                // Crear imagen según el tipo MIME
                switch ($mimeType) {
                    case 'image/jpeg':
                        $image = imagecreatefromjpeg($sourcePath);
                        break;
                    case 'image/png':
                        $image = imagecreatefrompng($sourcePath);
                        imagepalettetotruecolor($image);
                        imagealphablending($image, true);
                        imagesavealpha($image, true);
                        break;
                    default:
                        log_message('error', 'Formato no soportado para conversión WebP: ' . $mimeType);
                        return null;
                }

                if (!$image) {
                    log_message('error', 'No se pudo crear la imagen GD desde: ' . $sourcePath);
                    return null;
                }

                // Generar nombre único para el WebP (mismo nombre pero con extensión .webp)
                $webpFilename = pathinfo($sourcePath, PATHINFO_FILENAME) . '.webp';
                $webpFullPath = $targetPath . '/' . $webpFilename;

                // Convertir y guardar como WebP con 60% de calidad
                $success = imagewebp($image, $webpFullPath, 60);
                imagedestroy($image);

                if ($success) {
                    // Eliminar el archivo original después de la conversión exitosa
                    @unlink($sourcePath);
                    return $targetDir . '/' . $webpFilename;
                }
                
                log_message('error', 'Error al guardar WebP: ' . $webpFullPath);
                return null;
            } catch (\Throwable $e) {
                if ($image) imagedestroy($image);
                log_message('error', 'Error en convert_to_webp: ' . $e->getMessage());
                return null;
            }
        }
}
/**
 * Guarda imágenes subidas con opción de conversión a WebP
 * 
 * @param mixed $files Archivos a subir
 * @param string $targetDir Directorio de destino
 * @param array $allowedTypes Tipos permitidos
 * @param bool $convertToWebp Si se debe convertir a WebP
 * @return array Resultados
 */
if (!function_exists('save_uploaded_images')) {
    /**
     * Saves uploaded image files, with optional WebP conversion.
     *
     * @param array|\CodeIgniter\HTTP\Files\UploadedFile $files       The uploaded file(s) instance(s).
     * @param string                                     $targetDir   The target directory relative to FCPATH.
     * @param array                                      $allowedTypes Array of allowed file extensions (e.g., ['jpg', 'jpeg', 'png', 'gif', 'webp']).
     * @param bool                                       $convertToWebp Whether to convert non-WebP images to WebP.
     * @param bool                                       $keepOriginal  Whether to keep the original file after WebP conversion.
     * @return array                                     An associative array with 'success' (paths) and 'errors' (messages).
     */
    function save_uploaded_images(
        $files,
        string $targetDir = 'uploads/images',
        array $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'], // Added gif, webp should be explicitly allowed if needed
        bool $convertToWebp = false,
        bool $keepOriginal = false // Added missing parameter
    ): array {
        $result = ['success' => [], 'errors' => []];
        $targetPath = FCPATH . $targetDir;

        // Ensure the directory exists
        if (!is_dir($targetPath)) {
            // Use 0777 for broader permissions, or 0755 if more restrictive for web server user.
            // true for recursive directory creation.
            if (!mkdir($targetPath, 0755, true)) {
                $result['errors'][] = "Failed to create target directory: {$targetPath}";
                return $result; // Exit early if directory creation fails
            }
        }

        // Normalize $files to always be an array of UploadedFile instances
        if (!is_array($files)) {
            $files = [$files];
        }

        foreach ($files as $file) {
            // Check if it's a valid UploadedFile instance and if it was actually uploaded successfully
            if (!$file instanceof \CodeIgniter\HTTP\Files\UploadedFile || !$file->isValid()) {
                $errorString = '';
                if ($file instanceof \CodeIgniter\HTTP\Files\UploadedFile) {
                     // Get specific upload error for better debugging
                    $errorString = $file->getErrorString();
                } else {
                    $errorString = 'Invalid file instance or not an uploaded file.';
                }
                $result['errors'][] = "Error with file: " . ($file->getName() ?? 'unknown file') . " - " . $errorString;
                continue;
            }

            // Check for file upload errors (e.g., UPLOAD_ERR_INI_SIZE)
            if ($file->hasMoved()) {
                $result['errors'][] = "File '{$file->getName()}' has already been moved.";
                continue;
            }
            if ($file->getError() !== UPLOAD_ERR_OK) {
                $result['errors'][] = "Upload error for '{$file->getName()}': " . $file->getErrorString();
                continue;
            }


            $ext = strtolower($file->getExtension());
            // It's good practice to ensure 'webp' is in allowed types if you plan to convert or accept it.
            if (!in_array($ext, $allowedTypes)) {
                $result['errors'][] = "Disallowed file type for '{$file->getName()}'. Allowed types: " . implode(', ', $allowedTypes);
                continue;
            }

            $newName = $file->getRandomName(); // CI4's built-in method for unique names
            $originalFullPath = $targetPath . '/' . $newName; // Full path to the original saved file

            try {
                // Move the uploaded file
                $file->move($targetPath, $newName);
                $relativePath = $targetDir . '/' . $newName; // Relative path for storage in DB/usage

                // If the original file is already a WebP, just add it to success and continue
                if ($ext === 'webp') {
                    $result['success'][] = $relativePath;
                }
                // Attempt conversion for other formats if requested
                elseif ($convertToWebp) {
                    // Assuming convert_to_webp exists and returns the relative path on success
                    // and handles deletion of original if specified (or we do it here)
                    $webpPath = convert_to_webp($originalFullPath, $targetDir, $keepOriginal);

                    if ($webpPath) {
                        $result['success'][] = $webpPath;
                        // If convert_to_webp doesn't delete, uncomment this
                        // if (!$keepOriginal) {
                        //     unlink($originalFullPath);
                        // }
                    } else {
                        // If conversion failed, keep the original and report error
                        $result['success'][] = $relativePath; // Still return the original path
                        $result['errors'][] = "Failed to convert '{$file->getName()}' to WebP. Original saved.";
                    }
                } else {
                    // No conversion requested, just return the original path
                    $result['success'][] = $relativePath;
                }
            } catch (\Throwable $e) {
                // Catch any exceptions during move or conversion
                $result['errors'][] = "Error saving or processing '{$file->getName()}': " . $e->getMessage();
            }
        }

        return $result;
    }
}

// if (!function_exists('save_uploaded_images')) {
//     function save_uploaded_images($files, string $targetDir = 'uploads/images', array $allowedTypes = ['jpg', 'jpeg', 'png', 'webp']): array{
//         $result = ['success' => [], 'errors' => []];
//         $targetPath = FCPATH . $targetDir;

//         if (!is_dir($targetPath)) {
//             mkdir($targetPath, 0755, true);
//         }

//         // Normaliza a array
//         $files = is_array($files) ? $files : [$files];

//         foreach ($files as $file) {
//             if ($file instanceof UploadedFile && $file->isValid()) {
//                 $ext = strtolower($file->getExtension());

//                 if (!in_array($ext, $allowedTypes)) {
//                     $result['errors'][] = "Tipo no permitido: {$file->getName()}";
//                     continue;
//                 }

//                 $newName = $file->getRandomName();
//                 try {
//                     $file->move($targetPath, $newName);
//                     $result['success'][] = $targetDir . '/' . $newName;
//                 } catch (\Throwable $e) {
//                     $result['errors'][] = "Error al guardar {$file->getName()}: " . $e->getMessage();
//                 }
//             } else {
//                 $result['errors'][] = "Archivo inválido.";
//             }
//         }

//         return $result;
//     }
// }
