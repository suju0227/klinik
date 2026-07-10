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

    const syncMobileLock = () => {
        if (window.innerWidth <= 992 && sidebar.classList.contains("show")) {
            document.body.style.overflow = "hidden";
            return;
        }

        document.body.style.overflow = "";
    };

    toggle.addEventListener("click", (e) => {
        e.stopPropagation();

        if (window.innerWidth <= 992) {
            sidebar.classList.toggle("show");
        } else {
            sidebar.classList.toggle("collapsed");
            main.classList.toggle("expanded");
        }

        syncMobileLock();
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
                syncMobileLock();

            }

        }

    });

    /* =====================================
            RESIZE
    ===================================== */

    window.addEventListener("resize", () => {

        if (window.innerWidth > 992) {

            sidebar.classList.remove("show");
            document.body.style.overflow = "";

        } else {

            sidebar.classList.remove("collapsed");
            main.classList.remove("expanded");

        }

        syncMobileLock();
    });

    sidebar.querySelectorAll("a").forEach((link) => {
        link.addEventListener("click", () => {
            if (window.innerWidth <= 992) {
                sidebar.classList.remove("show");
                syncMobileLock();
            }
        });
    });

});
