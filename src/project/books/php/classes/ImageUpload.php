<?php

class ImageUpload {
    private $uploadDir = 'uploads/';

    public function process($file) {
        if ($file['error'] !== UPLOAD_ERR_OK) return false;

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }

        $filename = time() . '_' . basename($file['name']);
        $targetPath = $this->uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $filename;
        }

        return false;
    }

    public function deleteImage($filename) {
        $path = $this->uploadDir . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
    }
}