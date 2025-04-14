# upload_latihan
hasil praktek modul PWL upload
Alur program:
Pada saat awal dibuka, aplikasi akan menampilkan file “index.php” dimana pada file tersebut akan ditampilkan form untuk memilih (browse) gambar yang akan diupload. Apabila ditekan tombol submit, maka form akan menjalankan file “upload.php” dan meng-upload file pada server apabila lolos validasi. Adapun validasi yang dilakukan adalah sebagai berikut:
1.	Pertama aplikasi akan mengecek apakah file yang dipilih merupakan file gambar. Apabila ternyata bukan file gambar, maka akan muncul warning “File bukan gambar”. 
2.	Setelah itu aplikasi akan mengecek ekstensi file serta validasi MIME. Jenis file yang boleh diupload hanya jpg, jpeg, png, gif. File lain selain ekstensi tersebut apabila diupload akan muncul warning "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan."   Serta    “Tipe MIME tidak sesuai."
3.	Aplikasi kemudian akan mengecek ukuran file. Apabila melebihi 2MB, maka  akan muncul warning "Ukuran file terlalu besar."
4.	Apabila seluruh validasi berhasil dilewati, maka akan muncul file berhasil diupload. Apabila gagal maka akan muncul warning "Gagal mengupload file."

5.	File gambar yang diupload akan diupload pada 3 lokasi yaitu
/uploads
/uploads/resized/        file name diganti resized_xxxxxx dan ukuran gambar diubah dengan lebar 200px dan tinggi menyesuaikan
/uploads/thumbs/          ukuran gambar diubah dengan lebar 200px dan tinggi menyesuaikan
