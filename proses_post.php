<?php
//menghubungkan file konfigurasi database
include 'config.php';

//mulai sesi
session_start();

//mendapatkan id pengguna
$userId = $_SESSION["user_id"];

if (isset($_POST['simpan'])) {
    //mendapatkan data dari form
    $postTitle = $_POST["post_title"];
    $content = $_POST["content"];
    $categoryId = $_POST["category_id"];

    //mengatur direktori
    $imageDir = "assests/img/uploads/";
    $imageName = $_FILES["image"]["name"];
    $imagePath = $imageDir . basename($imageName);

    //memindahkan file gambar yang di unggah ke direktori
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
        // jika unggahan berhasil masukkan
        // data postingan ke dalam database
        $query = "INSERT INTO posts (post_title, content, created_at, category_id, user_id, image_path) VALUES 
        ('$postTitle', '$content', NOW(), $categoryId, $userId, '$imagePath')";

        if ($conn->query($query) === TRUE) {
            // notifikasi berhasil jika postingan berhasil ditambahkan
            $_SESSION['notification'] = [
                'type' => 'primary',
                'message' => 'Post successfully added.'
            ];
        } else {
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Error adding post: ' . $conn->error
            ];
        }
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Failed to upload image.'
        ];
    }

    // arahkan ke halaman dashboard setelah selesai
    header('Location: dashboard.php');
    exit();
}

//proses penghapusan postingan
if (isset($_POST['delete'])) {
    //mengambil id post
    $postID = $_POST['postID'];

    //query untuk menghapus post 
    $exec = mysqli_query($conn, "DELETE FROM posts WHERE id_post='$postID'");

    //menyimpan notifikasi keberhasilan atau kegagalan
    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Post successfully deleted.'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Error deleting post: '. mysqli_error($conn)
        ];
    }

    // kembali ke halaman dashboard
    header('Location: dashboard.php');
    exit();
}