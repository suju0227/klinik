<!-- =====================================================
                TOP NAVBAR V4
===================================================== -->

<div class="topbar">

    <!-- ===========================
            LEFT
    ============================ -->

    <div class="topbar-left">

        <!-- Sidebar Toggle -->

        <button class="toggle-sidebar" id="toggleSidebar">

            <i class="fas fa-bars"></i>

        </button>

        <!-- Page Information -->

        <div class="page-header">

            <h3>

                Dashboard

            </h3>

            <div class="breadcrumb-custom">

                <span>

                    <i class="fas fa-house"></i>

                    Home

                </span>

                <i class="fas fa-angle-right"></i>

                <span class="active">

                    Dashboard

                </span>

            </div>

        </div>

    </div>

    <!-- ===========================
            RIGHT
    ============================ -->

    <div class="topbar-right">
                <!-- ==========================================
                    SEARCH BOX
        =========================================== -->

        <div class="search-wrapper">

            <i class="fas fa-search"></i>

            <input
                type="text"
                id="globalSearch"
                placeholder="Cari pasien, dokter, obat, layanan...">

            <kbd>Ctrl + K</kbd>

        </div>

        <!-- ==========================================
                    DATE & TIME
        =========================================== -->

        <div class="datetime-box">

            <div class="date-info">

                <i class="fas fa-calendar-days"></i>

                <span id="tanggalNavbar">

                    <?= date('d F Y'); ?>

                </span>

            </div>

            <div class="time-info">

                <i class="fas fa-clock"></i>

                <span id="jamNavbar">

                    00:00:00

                </span>

            </div>

        </div>

        <!-- ==========================================
                    NOTIFICATION
        =========================================== -->

        <div class="notification-box">

            <button class="notification-btn">

                <i class="far fa-bell"></i>

                <span class="notification-count">

                    3

                </span>

            </button>

        </div>
                <!-- ==========================================
                    PROFILE
        =========================================== -->

        <div class="profile-dropdown">

            <button class="profile-button" type="button">

                <div class="profile-avatar">

                    <i class="fas fa-user-shield"></i>

                </div>

                <div class="profile-detail">

                    <h6>

                        Administrator

                    </h6>

                    <small>

                        System Administrator

                    </small>

                </div>

                <i class="fas fa-chevron-down arrow-down"></i>

            </button>

            <!-- Dropdown -->

            <div class="profile-menu">

                <a href="/klinik/profile/index.php">

                    <i class="fas fa-user"></i>

                    Profil Saya

                </a>

                <a href="/klinik/pengaturan/index.php">

                    <i class="fas fa-gear"></i>

                    Pengaturan

                </a>

                <div class="dropdown-divider"></div>

                <a href="/klinik/auth/logout.php" class="text-danger">

                    <i class="fas fa-right-from-bracket"></i>

                    Logout

                </a>

            </div>

        </div>

    </div>

</div>

<!-- ==========================================
            SCRIPT PROFILE DROPDOWN
========================================== -->

<script>

document.addEventListener("DOMContentLoaded",function(){

    const profile=document.querySelector(".profile-dropdown");

    const button=document.querySelector(".profile-button");

    const menu=document.querySelector(".profile-menu");

    button.addEventListener("click",function(e){

        e.stopPropagation();

        profile.classList.toggle("show");

    });

    document.addEventListener("click",function(){

        profile.classList.remove("show");

    });

});

</script>

<!-- ==========================================
            JAM DIGITAL
========================================== -->

<script>

function updateNavbarClock(){

    const now=new Date();

    const jam=String(now.getHours()).padStart(2,'0');

    const menit=String(now.getMinutes()).padStart(2,'0');

    const detik=String(now.getSeconds()).padStart(2,'0');

    const el=document.getElementById("jamNavbar");

    if(el){

        el.innerHTML=jam+":"+menit+":"+detik;

    }

}

setInterval(updateNavbarClock,1000);

updateNavbarClock();

</script>