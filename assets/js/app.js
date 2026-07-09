/* ======================================================
        KLINIK YAKUSA
        APP JS
====================================================== */

document.addEventListener("DOMContentLoaded", () => {

    const sidebar = document.querySelector(".sidebar");
    const main = document.querySelector(".main");
    const toggle = document.getElementById("toggleSidebar");

    if (!sidebar || !main || !toggle) return;

    /* =====================================
            TOGGLE SIDEBAR
    ===================================== */

    toggle.addEventListener("click", (e) => {

        e.stopPropagation();

        if (window.innerWidth <= 992) {

            sidebar.classList.toggle("show");

        } else {

            sidebar.classList.toggle("collapsed");

            main.classList.toggle("expanded");

        }

    });

    /* =====================================
            TUTUP SIDEBAR (MOBILE)
    ===================================== */

    document.addEventListener("click", (e) => {

        if (window.innerWidth <= 992) {

            if (
                !sidebar.contains(e.target) &&
                !toggle.contains(e.target)
            ) {

                sidebar.classList.remove("show");

            }

        }

    });

    /* =====================================
            RESIZE
    ===================================== */

    window.addEventListener("resize", () => {

        if (window.innerWidth > 992) {

            sidebar.classList.remove("show");

        }

    });

});