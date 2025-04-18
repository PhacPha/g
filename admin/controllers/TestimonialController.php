<?php
require_once __DIR__ . '/../config.php'; // เพิ่มการเรียก config.php

class TestimonialController {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function manage() {
        $stmt = $this->pdo->query("SELECT * FROM testimonials");
        $testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $GLOBALS['testimonials'] = $testimonials;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_testimonial') {
            $quote = $_POST['quote'];
            $text = $_POST['text'];
            $author_name = $_POST['author_name'];
            $author_location = $_POST['author_location'];
            $avatar_url = $this->handleImageUpload('avatar', $_POST['avatar_url']);

            if ($avatar_url) {
                $stmt = $this->pdo->prepare("INSERT INTO testimonials (quote, text, author_name, author_location, avatar_url) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$quote, $text, $author_name, $author_location, $avatar_url]);
                $GLOBALS['testimonial_message'] = "เพิ่มคอมเมนต์สำเร็จ!";
                header("Location: index.php?page=home");
                exit;
            } else {
                echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ');</script>";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_testimonial') {
            $id = $_POST['id'];
            $quote = $_POST['quote'];
            $text = $_POST['text'];
            $author_name = $_POST['author_name'];
            $author_location = $_POST['author_location'];
            $avatar_url = $this->handleImageUpload('avatar', $_POST['avatar_url']);

            $stmt = $this->pdo->prepare("SELECT avatar_url FROM testimonials WHERE id = ?");
            $stmt->execute([$id]);
            $old_testimonial = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($avatar_url) {
                if ($old_testimonial['avatar_url'] && file_exists(IMAGE_UPLOAD_DIR . basename($old_testimonial['avatar_url']))) {
                    unlink(IMAGE_UPLOAD_DIR . basename($old_testimonial['avatar_url']));
                }

                $stmt = $this->pdo->prepare("UPDATE testimonials SET quote = ?, text = ?, author_name = ?, author_location = ?, avatar_url = ? WHERE id = ?");
                $stmt->execute([$quote, $text, $author_name, $author_location, $avatar_url, $id]);
                $GLOBALS['testimonial_message'] = "แก้ไขคอมเมนต์สำเร็จ!";
                header("Location: index.php?page=home");
                exit;
            } else {
                echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ');</script>";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'delete_testimonial') {
            $id = $_GET['id'];

            $stmt = $this->pdo->prepare("SELECT avatar_url FROM testimonials WHERE id = ?");
            $stmt->execute([$id]);
            $testimonial = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($testimonial['avatar_url'] && file_exists(IMAGE_UPLOAD_DIR . basename($testimonial['avatar_url']))) {
                unlink(IMAGE_UPLOAD_DIR . basename($testimonial['avatar_url']));
            }

            $stmt = $this->pdo->prepare("DELETE FROM testimonials WHERE id = ?");
            $stmt->execute([$id]);
            $GLOBALS['testimonial_message'] = "ลบคอมเมนต์สำเร็จ!";
            header("Location: index.php?page=home");
            exit;
        }
    }

    private function handleImageUpload($fileInputName, $urlInput) {
        if (!empty($urlInput)) {
            return $urlInput;
        }

        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES[$fileInputName];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxFileSize = 5 * 1024 * 1024;

            if (!in_array($file['type'], $allowedTypes)) {
                return false;
            }

            if ($file['size'] > $maxFileSize) {
                return false;
            }

            $fileName = uniqid() . '-' . basename($file['name']);
            $uploadPath = IMAGE_UPLOAD_DIR . $fileName;

            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                return IMAGE_UPLOAD_PATH . $fileName;
            } else {
                return false;
            }
        }

        return false;
    }
}