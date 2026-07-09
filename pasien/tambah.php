<?php
include "../config/koneksi.php";
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

                                <i class="fas fa-user-injured"></i>

                                Tambah Data Pasien

                            </h3>

                            <small>Silakan lengkapi seluruh data pasien di bawah ini.</small>

                        </div>

                        <div class="card-body p-4">

                            <form action="simpan.php" method="POST">

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">Nama Pasien</label>

                                        <input type="text"

                                            name="nama_pasien"

                                            class="form-control"

                                            placeholder="Masukkan nama pasien"

                                            required>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">Jenis Kelamin</label>

                                        <select

                                            name="jenis_kelamin"

                                            class="form-select"

                                            required>

                                            <option value="">-- Pilih --</option>

                                            <option>Laki-laki</option>

                                            <option>Perempuan</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">Umur</label>

                                        <input

                                            type="number"

                                            name="umur"

                                            class="form-control"

                                            placeholder="Masukkan umur"

                                            required>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">No HP</label>

                                        <input

                                            type="text"

                                            name="no_hp"

                                            class="form-control"

                                            placeholder="08xxxxxxxxxx"

                                            required>

                                    </div>

                                </div>

                                <div class="mb-4">

                                    <label class="form-label">Alamat</label>

                                    <textarea

                                        name="alamat"

                                        rows="4"

                                        class="form-control"

                                        placeholder="Masukkan alamat lengkap"

                                        required></textarea>

                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-end">

                                    <a href="index.php"

                                        class="btn btn-secondary">

                                        <i class="fas fa-arrow-left"></i>

                                        Kembali

                                    </a>

                                    <button

                                        type="submit"

                                        class="btn btn-success">

                                        <i class="fas fa-save"></i>

                                        Simpan Data

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