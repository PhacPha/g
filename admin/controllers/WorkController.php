<?php
require_once __DIR__ . '/../config.php'; // เพิ่มการเรียก config.php

class WorkController {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function manage() {
        $stmt = $this->pdo->query("SELECT * FROM works");
        $works = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $GLOBALS['works'] = $works;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_work') {
            $title = $_POST['title'];
            $list_item1 = $_POST['list_item1'];
            $list_item2 = $_POST['list_item2'];
            $list_item3 = $_POST['list_item3'];
            $image_url = $this->handleImageUpload('image', $_POST['image_url']);

            if ($image_url) {
                $stmt = $this->pdo->prepare("INSERT INTO works (image_url, title, list_item1, list_item2, list_item3) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$image_url, $title, $list_item1, $list_item2, $list_item3]);
                header("Location: index.php?page=home");
                exit;
            } else {
                echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ');</script>";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_work') {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $list_item1 = $_POST['list_item1'];
            $list_item2 = $_POST['list_item2'];
            $list_item3 = $_POST['list_item3'];
            $image_url = $this->handleImageUpload('image', $_POST['image_url']);

            $stmt = $this->pdo->prepare("SELECT image_url FROM works WHERE id = ?");
            $stmt->execute([$id]);
            $old_work = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($image_url) {
                if ($old_work['image_url'] && file_exists(IMAGE_UPLOAD_DIR . basename($old_work['image_url']))) {
                    unlink(IMAGE_UPLOAD_DIR . basename($old_work['image_url']));
                }

                $stmt = $this->pdo->prepare("UPDATE works SET image_url = ?, title = ?, list_item1 = ?, list_item2 = ?, list_item3 = ? WHERE id = ?");
                $stmt->execute([$image_url, $title, $list_item1, $list_item2, $list_item3, $id]);
                header("Location: index.php?page=home");
                exit;
            } else {
                echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ');</script>";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'delete_work') {
            $id = $_GET['id'];

            $stmt = $this->pdo->prepare("SELECT image_url FROM works WHERE id = ?");
            $stmt->execute([$id]);
            $work = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($work['image_url'] && file_exists(IMAGE_UPLOAD_DIR . basename($work['image_url']))) {
                unlink(IMAGE_UPLOAD_DIR . basename($work['image_url']));
            }

            $stmt = $this->pdo->prepare("DELETE FROM works WHERE id = ?");
            $stmt->execute([$id]);
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