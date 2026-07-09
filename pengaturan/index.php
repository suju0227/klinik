<?php
include "../config/koneksi.php";

$settings_file = "../config/settings.json";

$status = "";

// Jika form dikirim (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_settings = [
        'nama_klinik' => htmlspecialchars($_POST['nama_klinik']),
        'alamat' => htmlspecialchars($_POST['alamat']),
        'telepon' => htmlspecialchars($_POST['telepon']),
        'email' => htmlspecialchars($_POST['email']),
        'jam_buka' => htmlspecialchars($_POST['jam_buka']),
        'jam_tutup' => htmlspecialchars($_POST['jam_tutup'])
    ];

    if (file_put_contents($settings_file, json_encode($new_settings, JSON_PRETTY_PRINT))) {
        $status = "berhasil";
    } else {
        $status = "gagal";
    }
}

// Membaca pengaturan saat ini
if (file_exists($settings_file)) {
    $settings = json_decode(file_get_contents($settings_file), true);
} else {
    $settings = [
        'nama_klinik' => 'Klinik Yakusa',
        'alamat' => 'Jl. Imam Inlu Amal No.1947',
        'telepon' => '0856-5619-1731',
        'email' => 'info@klinikyakusa.com',
        'jam_buka' => '08:00',
        'jam_tutup' => '21:00'
    ];
}

include "../layout/header.php";
?>

<div class="wrapper">

    <?php include "../layout/sidebar.php"; ?>

    <div class="main">

        <?php include "../layout/navbar.php"; ?>

        <div class="container-fluid py-4">

            <div class="row justify-content-center">

                <div class="col-lg-8">

                    <div class="card card-glass shadow border-0 rounded-4">

                        <div class="card-header bg-success text-white rounded-top-4">

                            <h3 class="mb-0">

                                <i class="fas fa-gear"></i>

                                Pengaturan Klinik

                            </h3>

                            <small>Konfigurasi informasi umum Klinik Yakusa</small>

                        </div>

                        <div class="card-body p-4">

                            <form action="index.php" method="POST">

                                <div class="mb-3">

                                    <label class="form-label">Nama Klinik</label>

                                    <input type="text"

                                        name="nama_klinik"

                                        class="form-control"

                                        value="<?= htmlspecialchars($settings['nama_klinik']); ?>"

                                        required>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">Nomor Telepon</label>

                                        <input type="text"

                                            name="telepon"

                                            class="form-control"

                                            value="<?= htmlspecialchars($settings['telepon']); ?>"

                                            required>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">Email Klinik</label>

                                        <input type="email"

                                            name="email"

                                            class="form-control"

                                            value="<?= htmlspecialchars($settings['email']); ?>"

                                            required>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">Jam Buka</label>

                                        <input type="time"

                                            name="jam_buka"

                                            class="form-control"

                                            value="<?= htmlspecialchars($settings['jam_buka']); ?>"

                                            required>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">Jam Tutup</label>

                                        <input type="time"

                                            name="jam_tutup"

                                            class="form-control"

                                            value="<?= htmlspecialchars($settings['jam_tutup']); ?>"

                                            required>

                                    </div>

                                </div>

                                <div class="mb-4">

                                    <label class="form-label">Alamat Klinik</label>

                                    <textarea name="alamat"

                                        rows="3"

                                        class="form-control"

                                        required><?= htmlspecialchars($settings['alamat']); ?></textarea>

                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-end">

                                    <button type="submit" class="btn btn-success">

                                        <i class="fas fa-save"></i>

                                        Simpan Perubahan

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include "../layout/footer.php"; ?>

<?php if ($status == "berhasil") { ?>

<script>

    Swal.fire({

        icon: 'success',

        title: 'Berhasil',

        text: 'Pengaturan klinik berhasil diperbarui.',

        confirmButtonColor: '#16a34a'

    });

</script>

<?php } elseif ($status == "gagal") { ?>

<script>

    Swal.fire({

        icon: 'error',

        title: 'Gagal',

        text: 'Pengaturan klinik gagal diperbarui.',

        confirmButtonColor: '#dc3545'

    });

</script>

<?php } ?>
