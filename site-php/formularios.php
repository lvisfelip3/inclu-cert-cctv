<?php 
error_reporting( E_ALL );
session_start();
$formAccion = isset($_GET["form"]) ? $_GET["form"] : '';
$idPerfil = isset($_SESSION["idperfil"]) ? $_SESSION["idperfil"] : '';
$perfilUsuario = isset($_SESSION["nombreperfil"]) ? $_SESSION["nombreperfil"] : '';
$id_usuario = isset($_SESSION["iduser"]) ? $_SESSION["iduser"] : '';
?>

<!DOCTYPE html>
<html lang="es-CL"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Inclusive CCTV</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="CCTV | Formulario Reporte">
    <meta name="author" content="iarcos.cl">
    <meta name="description" content="Sitio php en desarrollo a medida para Inclusive GROUP CCTV">
    <meta name="keywords" content="Seguridad, Sistema de Seguridad y control de monitoreo camaras CCTV"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="./css/adminlte.css"><!--end::Required Plugin(AdminLTE)--><!-- apexcharts -->
    <link rel="icon" href="./assets/img/inclusive.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet"> 
</head> <!--end::Head--> <!--begin::Body-->

<body class="sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> 
        <!--begin::Header-->
        <?php include("./header.php");?>
        <!--end::Header--> 
        
        <!--begin::Sidebar-->
        <div id="sidebar-wrapper" class="position-relative" style="z-index: 2000; width: 250px">
            <?php include_once("main-sidebar.php"); ?>
        </div>
        <!--end::Sidebar--> 
        
        <!--begin::App Main-->
        <main class="app-main"> 
            
            <!--begin::App Content Header-->
            <?php include "./content-header.php";?>
            <!--end::App Content Header--> 
            
            
            <!--begin::App Content-->
            <?php 
            
            
            switch( $formAccion ) {
                case "formularioreporte":
                    include "formularioreporte.php";

                    break;
                case "informe":
                    include "informe.php";
                    break;
                case "usuarios":
                    include "admUsuarios.php";
                    break;
                case "tipoplanta":
                    include "admTipoPlanta.php";
                    break;
                case "comisarias":
                    include "admComisaria.php";
                    break;
                case "plantas":
                    include "admPlanta.php";
                    break;
                case "jornadas":
                    include "admJornada.php";
                    break;
                case "camaras":
                    include "admCamaras.php";
                    break;
                case "perfil":
                    include "admPerfiles.php";
                    break;
                case "turnos":
                    include "admTurnos.php";
                    break;
                case "clientes":
                    include "admClientes.php";
                    break;
                case "periodico":
                    include "reportePeriodico.php";
                    break;
                case "informeperiodico":
                    include "formularioReportePeriodico.php";
                    break;
                case "robo":
                    include "formularioRobo.php";
                    break;
                case "corte_energia":
                    include "formularioCorteEnergia.php";
                    break;
                case "corte_internet":
                    include "formularioCorteInternet.php";
                    break;
                case "novedades":
                    include "formularioNovedades.php";
                    break;
                case "nvr":
                    include "admNVR.php";
                    break;
                case "operador":
                    include "admOperador.php";
                    break;
                case "reporteCompleto":
                    include "admReporteCompleto.php";
                    break;
                case "reporteCompletoForm":
                    include "formularioReporteCompleto.php";
                    break;
            }
            
            
            ;?>
            <!--end::App Content-->

        </main> <!--end::App Main--> 
        
        <!--begin::Footer-->
        <?php include("./footer.php");?>
        <!--end::Footer-->
    </div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>
    <script src="./js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        $('#sidebarToggler').on('click', function() {
            let screenWidth = $(window).width();
            if (screenWidth < 990) {
                $('#sidebar-wrapper').css('width', '0px');
            } else {
                $('#sidebar-wrapper').animate({
                    width: $('#sidebar-wrapper').width() == 250 ? 0 : 250
                }, 300);
            }
        });
    </script>
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script> <!--end::OverlayScrollbars Configure--> 
    <script>
        (() => {
                "use strict";

                const storedTheme = localStorage.getItem("theme");

                const getPreferredTheme = () => {
                    if (storedTheme) {
                    return storedTheme;
                    }

                    return window.matchMedia("(prefers-color-scheme: dark)").matches
                    ? "dark"
                    : "light";
                };

                const setTheme = function (theme) {
                    if (
                    theme === "auto" &&
                    window.matchMedia("(prefers-color-scheme: dark)").matches
                    ) {
                    document.documentElement.setAttribute("data-bs-theme", "dark");
                    } else {
                    document.documentElement.setAttribute("data-bs-theme", theme);
                    }
                };

                setTheme(getPreferredTheme());

                const showActiveTheme = (theme, focus = false) => {
                    const themeSwitcher = document.querySelector("#bd-theme");

                    if (!themeSwitcher) {
                    return;
                    }

                    const themeSwitcherText = document.querySelector("#bd-theme-text");
                    const activeThemeIcon = document.querySelector(".theme-icon-active i");
                    const btnToActive = document.querySelector(
                    `[data-bs-theme-value="${theme}"]`
                    );
                    const svgOfActiveBtn = btnToActive.querySelector("i").getAttribute("class");

                    for (const element of document.querySelectorAll("[data-bs-theme-value]")) {
                    element.classList.remove("active");
                    element.setAttribute("aria-pressed", "false");
                    }

                    btnToActive.classList.add("active");
                    btnToActive.setAttribute("aria-pressed", "true");
                    activeThemeIcon.setAttribute("class", svgOfActiveBtn);
                    const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`;
                    themeSwitcher.setAttribute("aria-label", themeSwitcherLabel);

                    if (focus) {
                    themeSwitcher.focus();
                    }
                };

                window
                    .matchMedia("(prefers-color-scheme: dark)")
                    .addEventListener("change", () => {
                    if (storedTheme !== "light" || storedTheme !== "dark") {
                        setTheme(getPreferredTheme());
                    }
                    });

                window.addEventListener("DOMContentLoaded", () => {
                    showActiveTheme(getPreferredTheme());

                    for (const toggle of document.querySelectorAll("[data-bs-theme-value]")) {
                    toggle.addEventListener("click", () => {
                        const theme = toggle.getAttribute("data-bs-theme-value");
                        localStorage.setItem("theme", theme);
                        setTheme(theme);
                        showActiveTheme(theme, true);
                    });
                    }
                });
                })();
    </script>
    <!--end::Script-->
</body><!--end::Body-->

</html>