<?php
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Cek apakah file benar gambar
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check === false) {
        echo "File bukan gambar.";
        exit;
    }
    // Batasi jenis file
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed)) {
        echo "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        exit;
    }

    // Validasi MIME
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $_FILES['gambar']['tmp_name']);
    if (!in_array($mime, ['image/jpeg', 'image/png', 'image/gif'])) {
        echo "Tipe MIME tidak sesuai.";
        exit;
    }

      // Batasi ukuran file
      if ($_FILES["gambar"]["size"] > 2 * 1024 * 1024) { // max 2MB
        echo "Ukuran file terlalu besar.";
        exit;
    }
    // Upload file
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        echo "File ". htmlspecialchars(basename($_FILES["gambar"]["name"])) . " berhasil
        diupload.";
    } else {
        echo "Gagal mengupload file.";
    }

    //Resize dengan GD Library
   // $src = imagecreatefromjpeg($_FILES['gambar']['tmp_name']);
   
   if ($mime =="image/jpeg"){$src = imagecreatefromjpeg($target_file);}
   else if ($mime =="image/png"){$src = imagecreatefrompng($target_file);}
   else if ($mime =="image/gif"){$src = imagecreatefromgif($target_file);}
    $width = imagesx($src);
    $height = imagesy($src);
    $new_width = 200;
    $new_height = floor($height * ($new_width / $width));
    $tmp = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    imagejpeg($tmp, "uploads/resized/resized_" . basename($_FILES["gambar"]["name"]), 80); //compression
    imagejpeg($tmp, "uploads/thumbs/" . basename($_FILES["gambar"]["name"]), 80); //compression

    $conn = new mysqli("localhost", "root", "", "db_web");
    $nama = basename($_FILES["gambar"]["name"]);
    $lokasi = $target_file;
    $lokasithumbs="uploads/thumbs/".basename($_FILES["gambar"]["name"]);
    $sql = "INSERT INTO gambar (filename, filepath, thumbpath, width, height) VALUES ('$nama', '$lokasi','$lokasithumbs','$width','$height')";
    $conn->query($sql);
?>