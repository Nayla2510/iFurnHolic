<?php
function regristrasi($data) {
    global $koneksi;

    $username = strtolower(stripslashes($data['username']));
    $pasword = mysqli_real_escape_string($koneksi, $data["password"]);
    $pasword2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $status = "customer"; // Default status customer

    // Ambil ID terakhit dari tb_user
    $auto = mysqli_query($koneksi, "SELECT MAX(id_user) AS max_code FROM tb_user");
    $hasil = mysqli_fetch_array($auto);
    $code = $hasil['max_code'];

    // Menghasilkan ID baru dengan format U001, U002, dst.
    $urutan = (int)substr($code, 1 , 3);
    $urutan++;
    $huruf = "U";
    $id_user = $huruf . sprintf("%03s", $urutan);

    // Cek apakah username sudah ada
    $result = mysqli_query($koneksi, "SELECT username FROM tb_user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Username sudah terdaftar');
        </script>";
        return false;
    }

    // Cek konfirmasi password
     if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Konfirmasi password tidak sesuai');
        </script>";
        return false;
    }

    // Enkripsi password
    $pasword =password_hash($pasword, PASSWORD_DEFAULT);

    // Tamabhkan user baru ke database
    $query = "INSERT INTO tb_user (id_user, username, password, status) VALUES ('$id_user', '$username', '$pasword', '$status')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
?>
