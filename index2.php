<?php
// session_start();
// if(isset($_SESSION['idpengguna']) && !empty($_SESSION['idpengguna'])) {
//     $login = "media.php?modul=petaznt";
// } else {
// 	$login = "login.php";
// }
// header("location:$login");
// include_once "config/db.koneksi_pdo.php";
// include_once "config/db.function_pdo.php";
// include_once "config/library.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="./img/logo-magelang.png" type="image/x-icon">
    <title>Peta ZNT - Dashboard</title>
    <link rel="shortcut icon" sizes="363x492" href="assets/img/logo-magelang.png" />

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css" type="text/css">
    <script src="assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/ol-geocoder@latest/dist/ol-geocoder.min.css" rel="stylesheet">
    <!-- <script src="http://maps.google.com/maps/api/js?v=3.7&sensor=false"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/ol-geocoder"></script>
    <!-- <link href="vendor/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" /> -->
    <!-- <script src="vendor/bootstrap-select2/select2.min.js" type="text/javascript"></script> -->

    <!-- datepicker -->
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <link href="assets/css/datepicker.css" rel="stylesheet">
    <script src="assets/js/datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/ol-street-view@2.0.0/dist/css/ol-street-view.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    <script src="https://unpkg.com/ol-street-view@2.0.0"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $(".preloader").fadeOut();
            $('.date').datepicker({
                format: "dd-mm-yyyy",
                todayHighlight: 'TRUE',
                autoclose: true,
            });
        });

        toastr.options = {

            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        html,
        body {
            height: 100%;
        }

        .tooltip {
            position: relative;
            padding: 3px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            opacity: 0.7;
            white-space: nowrap;
            font: 10pt sans-serif;
        }




        .btn-map {
            padding: 6px 10px;
            background: #FF9AA2;
            color: #ffffff;
            border-radius: 2px;
            opacity: 0.9;
        }

        .btn-map-selected {
            padding: 6px 10px;
            background: #ffffff;
            color: #FF9AA2;
            border-radius: 2px;
            opacity: 0.9;
        }

        .btn-map:hover {
            padding: 6px 10px;
            background: #D58187;
            color: #ffffff;
            border-radius: 2px;
            opacity: 0.9;
        }

        .btnedit {
            box-shadow: 0px 1px 0px 0px #fff6af;
            background: linear-gradient(to bottom, #ffec64 5%, #ffab23 100%);
            background-color: #ffec64;
            border-radius: 4px;
            border: 1px solid #ffaa22;
            display: inline-block;
            color: #333333;
            font-family: Arial;
            font-size: 12px;
            font-weight: bold;
            padding: 4px 6px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #ffee66;
        }

        .btnedit:hover {
            background: linear-gradient(to bottom, #ffab23 5%, #ffec64 100%);
            background-color: #ffab23;
        }

        .btndel {
            box-shadow: inset 0px 1px 0px 0px #fff6af;
            background: linear-gradient(to bottom, #ffc766 5%, #ff2424 100%);
            background-color: #ffc766;
            border-radius: 4px;
            border: 1px solid #ff2424;
            display: inline-block;
            cursor: pointer;
            color: #333333;
            font-family: Arial;
            font-size: 12px;
            font-weight: bold;
            padding: 4px 6px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #ffba66;
        }

        .btndel:hover {
            background: linear-gradient(to bottom, #ff2424 5%, #ffc766 100%);
            background-color: #ff2424;
        }

        @media (min-width: 276px) {
            .stylescroll {
                max-height: 200px;
                padding: 1rem;
                overflow-y: auto;
                direction: ltr;
                scrollbar-color: #d4aa70 #e4e4e4;
                scrollbar-width: thin;
            }

            .stylescroll::-webkit-scrollbar {
                width: 10px;
            }

            .stylescroll::-webkit-scrollbar-track {
                background-color: #e4e4e4;
                border-radius: 100px;
            }

            .stylescroll::-webkit-scrollbar-thumb {
                border-radius: 100px;
                border: 6px solid rgba(0, 0, 0, 0.18);
                border-left: 0;
                border-right: 0;
                background-color: #355CCD;
            }

            #legend_ket {
                width: 18%;
            }

            .modal-content {
                position: relative;
                display: flex;
                flex-direction: column;
                width: 100%;
                pointer-events: auto;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid rgba(0, 0, 0, .2);
                border-radius: 0.3rem;
                outline: 0;
                margin-left: 15%;
                margin-right: 1%;
            }

        }

        @media (min-width: 768px) {
            .stylescroll {
                max-height: 200px;
                padding: 1rem;
                overflow-y: auto;
                direction: ltr;
                scrollbar-color: #d4aa70 #e4e4e4;
                scrollbar-width: thin;
            }

            .stylescroll::-webkit-scrollbar {
                width: 10px;
            }

            .stylescroll::-webkit-scrollbar-track {
                background-color: #e4e4e4;
                border-radius: 100px;
            }

            .stylescroll::-webkit-scrollbar-thumb {
                border-radius: 100px;
                border: 6px solid rgba(0, 0, 0, 0.18);
                border-left: 0;
                border-right: 0;
                background-color: #355CCD;
            }

            #legend_ket {
                width: 18%;
            }

            .modal-content {
                position: relative;
                display: flex;
                flex-direction: column;
                width: 100%;
                pointer-events: auto;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid rgba(0, 0, 0, .2);
                border-radius: 0.3rem;
                outline: 0;
                margin-left: auto;
                margin-right: auto;
            }


        }

        @media (min-width: 992px) {
            .stylescroll {
                max-height: 500px;
                padding: 1rem;
                overflow-y: auto;
                direction: ltr;
                scrollbar-color: #d4aa70 #e4e4e4;
                scrollbar-width: thin;
            }

            .stylescroll::-webkit-scrollbar {
                width: 10px;
            }

            .stylescroll::-webkit-scrollbar-track {
                background-color: #e4e4e4;
                border-radius: 100px;
            }

            .stylescroll::-webkit-scrollbar-thumb {
                border-radius: 100px;
                border: 6px solid rgba(0, 0, 0, 0.18);
                border-left: 0;
                border-right: 0;
                background-color: #355CCD;
            }

            #legend_ket {
                width: 16%;
            }

            .modal-content {
                position: relative;
                display: flex;
                flex-direction: column;
                width: 30%;
                pointer-events: auto;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid rgba(0, 0, 0, .2);
                border-radius: 0.3rem;
                outline: 0;
                margin-left: auto;
                margin-right: auto;
            }
        }


        /* Ol general fixes */
        .ol-control button {
            cursor: pointer;
        }

        .ol-control.ol-attribution {
            font-size: 11px;
        }

        .ol-control.ol-attribution a {
            color: #000;
        }

        .ol-control.ol-attribution a:hover {
            color: #0076ff;
        }

        /* http://meyerweb.com/eric/tools/css/reset/ 
   v2.0 | 20110126
   License: none (public domain)
*/
        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        /* HTML5 display-role reset for older browsers */
        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }

        body {
            line-height: 1;
            font-family: sans-serif;
        }

        ol,
        ul {
            list-style: none;
        }

        blockquote,
        q {
            quotes: none;
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: '';
            content: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="assets/img/znt_mgl.png" width="180" height="50" class="d-inline-block align-top" alt="">
        </a>
        <a class="btn btn-outline-success" href="login.php">login</a>
    </nav>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
      <img src="assets/img/znt_mgl.png" width="180" height="50" class="d-inline-block align-top" alt="">
    </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown" id="cari_tahun">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
          Cari Per Tahun
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <div class="form-inline">
    <select class="form-control" id="exampleFormControlSelect1">
      <option>2021</option>
      <option>2022</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
    <button class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
  </div>
        </div>
      </li>
    </ul>
    <form class="form-inline">
    <a class="btn btn-outline-success" href="login.php">login</a>
    </form>
  </div>
</nav> -->


    <div id="preload" style="display: none;">
        <div class="d-flex align-items-center mb-2">
            <strong>Loading...</strong>
            <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
        </div>
    </div>

    <!-- < class="card" id="peta"> -->
    <div id="map" class="map" style="height: 88%;">
        <a href="javascript:void(0)" onClick="ubahBase()" style="position:absolute;z-index:999;margin-left:46px;margin-top:10px;color:#fff" class="btn-map" class="btn-map" data-toggle="tooltip" title="choose base maps"><i class="fa fa-location-arrow"></i></a>
        <a href="javascript:void(0)" onClick="kembali()" id="btnkembali" style="position:absolute;z-index:999;margin-left:85px;margin-top:10px;color:#fff" class="btn-map" class="btn-map" data-toggle="tooltip" title="back"><i class="fa fa-chevron-left"></i></a>
        <a href="#" id="toggle_fullscreen" style="position:absolute;z-index:999;margin-left:117px;margin-top:10px;color:#fff" class="btn-map" data-toggle="tooltip" title="fullscreen"><i class="fa fa-expand"></i></a>
        <a href="javascript:void(0)" id="popup" style="position:absolute;z-index:999;margin-left:187px;margin-top:10px;color:#fff" class="btn-map" class="btn-map" data-toggle="tooltip" title="fullscreen"><i class="fa fa-location-arrow"></i></a>
        <a id="image-download" download="map.png"></a>
        <!-- <div id="export-png" style="position:absolute;z-index:999;margin-left:90px;margin-top:10px;color:#fff" class="btn-map"></div> -->
        <div id="tooltip" class="tooltip"></div>
        <div id="button_peta_bpn" style="display: none;">
            <a href="javascript:void(0)" id="btn-petabpn-show" title="PETA BPN" style="right:10px;position:absolute;z-index:999; margin-top:10px; background: rgba(246, 189, 46, 0.85);" class="btn-map">
                <span><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
            </a>
            <a href="javascript:void(0)" id="btn-petabpn-hide" title="PETA BPN" style="display: none; right:10px;position:absolute;z-index:999; margin-top:10px; background: rgba(246, 189, 46, 0.85);" class="btn-map">
                <span><i class="fa fa-eye" aria-hidden="true"></i></span>
            </a>
            <a href="javascript:void(0)" id="peta_thn" title="Cari Per Tahun" style="display: none; right:55px;position:absolute;z-index:999; margin-top:10px; background: rgba(246, 189, 46, 0.85);" class="btn-map" data-toggle="modal" data-target="#modal_tahun">
                <span><i class="fa fa-search" aria-hidden="true"></i></span>
            </a>
        </div>
    </div>
    <div class="stylescroll" id="legend-ket" style="display: none;font-size:11px; position:absolute;z-index:999;margin:10px;bottom:0;top:35%;background:#fff;padding:12px; border-radius: 10px; box-shadow: 0 0 10px #ccc;">
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalbase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Base Map</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select class="form-control" id="baseId">
                            <option value="">--chooosed maps--</option>
                            <option value="osm">Street Maps</option>
                            <option value="satelite">Satelite Maps</option>
                            <option value="googleMaps">Google Maps</option>
                            <option value="googleSatelite">Google Satelite</option>
                            <option value="restart">Foto Udara</option>
                            <option id='st' value="streetst">StreetView</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        var route = 0;
        var idnya = 0;
        var posisi;
        var kec;
        var kdkel;
        //var tileLayer;

        // document.getElementById('export-png').addEventListener('click', function() {
        //     map.once('rendercomplete', function() {
        //         var mapCanvas = document.createElement('canvas');
        //         var size = map.getSize();
        //         mapCanvas.width = size[0];
        //         mapCanvas.height = size[1];
        //         var mapContext = mapCanvas.getContext('2d');
        //         Array.prototype.forEach.call(
        //             document.querySelectorAll('.ol-layer canvas'),
        //             function(canvas) {
        //                 if (canvas.width > 0) {
        //                     var opacity = canvas.parentNode.style.opacity;
        //                     mapContext.globalAlpha = opacity === '' ? 1 : Number(opacity);
        //                     var transform = canvas.style.transform;
        //                     // Get the transform parameters from the style's transform matrix
        //                     var matrix = transform
        //                         .match(/^matrix\(([^\(]*)\)$/)[1]
        //                         .split(',')
        //                         .map(Number);
        //                     // Apply the transform to the export map context
        //                     CanvasRenderingContext2D.prototype.setTransform.apply(
        //                         mapContext,
        //                         matrix
        //                     );
        //                     mapContext.drawImage(canvas, 0, 0);
        //                 }
        //             }
        //         );
        //         if (navigator.msSaveBlob) {
        //             // link download attribuute does not work on MS browsers
        //             navigator.msSaveBlob(mapCanvas.msToBlob(), 'map.png');
        //         } else {
        //             var link = document.getElementById('image-download');
        //             link.href = mapCanvas.toDataURL();
        //             link.click();
        //         }
        //     });
        //     map.renderSync();
        // });


        var myDom = {
            polygons: {
                text: 'normal',
                align: 'center',
                baseline: 'middle',
                rotation: 0,
                font: 'verdana',
                weight: 'bold',
                placement: 'point',
                maxangle: 45,
                overflow: true,
                size: '15px',
                height: 1,
                offsetX: 0,
                offsetY: 0,
                color: '#ef0000',
                outline: '#ffffff',
                outlineWidth: 3,
                maxreso: 1200,

            },
        };

        var getText = function(feature) {
            if (feature.get('D_KD_KEC') != undefined) {
                var text = feature.get("D_NM_KEC");
            } else if (feature.get('D_KD_KEL') != undefined) {
                var text = feature.get("D_NM_KEL");
            } else if (feature.get('nilai_awal') != undefined) {
                var text = numberWithCommas(feature.get("nilai_awal"));
            } else {
                var text = "";
            }
            return text;
        };

        var createTextStyle = function(feature, resolution, dom) {

            if (feature.get('KD_BLOK') != undefined) {
                var width = 2;
                var size = '20px';
            } else {
                var width = 0.4;
                var size = dom.size.value;
            }

            console.log(size)
            var align = dom.align.value;
            var baseline = dom.baseline.value;
            var height = dom.height.value;
            var offsetX = parseInt(dom.offsetX.value, 10);
            var offsetY = parseInt(dom.offsetY.value, 10);
            var weight = dom.weight.value;
            var placement = dom.placement ? dom.placement.value : undefined;
            var maxAngle = dom.maxangle ? parseFloat(dom.maxangle.value) : undefined;
            var overflow = dom.overflow ? dom.overflow.value == 'true' : undefined;
            var rotation = parseFloat(dom.rotation.value);
            var font = weight + ' ' + size + '/' + height + ' ' + dom.font.value;
            var fillColor = dom.color.value;
            var outlineColor = dom.outline.value;
            var outlineWidth = parseInt(dom.outlineWidth.value, 10);

            return new ol.style.Text({
                // textAlign: align == '' ? undefined : align,
                // textBaseline: baseline,
                font: font,
                text: getText(feature),
                fill: new ol.style.Fill({
                    color: fillColor
                }),
                stroke: new ol.style.Stroke({
                    color: outlineColor,
                    width: width
                }),
                // offsetX: offsetX,
                // offsetY: offsetY,
                placement: placement,
                // maxAngle: maxAngle,
                overflow: overflow,
                // rotation: rotation,
            });
        };

        $(function() {
            $('#ingat').hide();
            $("#cari_tahun").hide();
            $('#toggle_fullscreen').on('click', function() {
                // if already full screen; exit
                // else go fullscreen
                if (
                    document.fullscreenElement ||
                    document.webkitFullscreenElement ||
                    document.mozFullScreenElement ||
                    document.msFullscreenElement
                ) {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen();
                    }
                } else {
                    element = $('#map').get(0);
                    if (element.requestFullscreen) {
                        element.requestFullscreen();
                    } else if (element.mozRequestFullScreen) {
                        element.mozRequestFullScreen();
                    } else if (element.webkitRequestFullscreen) {
                        element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                    } else if (element.msRequestFullscreen) {
                        element.msRequestFullscreen();
                    }
                }
            });
        });

        function ubahBase() {
            $('#modalbase').modal('show');
        }
        //var StreetView = ol - street - view;
        var XYZ = ol.source.XYZ;
        //by google maps
        var tileLayerGomaps = new ol.layer.Tile({
            source: new XYZ({
                attributions: `&copy; ${new Date().getFullYear()} Google Maps <a href="https://www.google.com/help/terms_maps/" target="_blank">Terms of Service</a>`,
                maxZoom: 19,
                url: 'https://mt{0-3}.google.com/vt/?lyrs=r&x={x}&y={y}&z={z}'
            }),
            visible: false,
            title: 'googleMaps'
        });
        var tileLayerView = new ol.layer.Tile({
            source: new XYZ({
                attributions: `&copy; ${new Date().getFullYear()} Google Maps <a href="https://www.google.com/help/terms_maps/" target="_blank">Terms of Service</a>`,
                maxZoom: 19,
                url: 'https://mt{0-3}.google.com/vt/?lyrs=r&x={x}&y={y}&z={z}'
            }),
            visible: true,
            title: 'streetst'
        });
        var tileLayerGosat = new ol.layer.Tile({
            source: new XYZ({
                attributions: `&copy; ${new Date().getFullYear()} Google Maps <a href="https://www.google.com/help/terms_maps/" target="_blank">Terms of Service</a>`,
                maxZoom: 19,
                url: 'http://mt0.google.com/vt/lyrs=s&hl=en&x={x}&y={y}&z={z}'
            }),
            visible: false,
            title: 'googleSatelite'
        });
        var tileLayerSat = new ol.layer.Tile({
            source: new ol.source.Stamen({
                layer: 'terrain'
            }),
            visible: false,
            title: 'satelite'
        });
        var tileLayerOsm = new ol.layer.Tile({
            source: new ol.source.OSM(),
            visible: false,
            title: 'osm'
        });
        var restartLayers = new ol.layer.Tile({
            source: new ol.source.XYZ({
                url: './xyz_tiles/{z}/{x}/{y}.png'
            }),
            visible: false,
            title: 'restart'
        });

        const tileLayer = new ol.layer.Group({
            layers: [
                tileLayerGomaps, tileLayerGosat, tileLayerSat, tileLayerOsm, tileLayerView, restartLayers
            ]
        });

        $('#baseId').on('change', () => {
            $('#modalbase').modal('hide');
            let base = $('#baseId').val();
            tileLayer.getLayers().forEach((e, idx, arr) => {
                let elementBase = e.get('title');
                e.setVisible(elementBase === base);
                if (base == "streetst") {
                    if (kdkel == undefined) {
                        $('#modalbase').hide();
                        Swal.fire('Gunakan StreetView ketika peta menampilan data ZNT dan NOP');
                        $('#baseId').val('googleMaps');
                    } else {
                        jalan();
                        document.getElementById('map').style.marginTop = '5%';
                        street = '1';
                    }
                }
            });
        });


        function tampilOSM() {
            tileLayer.setZIndex(0);
            map.addLayer(tileLayer);
        }

        function removeOSM() {
            map.removeLayer(tileLayer);
        }

        class Drag extends ol.interaction.Pointer {
            constructor() {
                super({
                    handleDownEvent: handleDownEvent,
                    // handleDragEvent: handleDragEvent,
                    handleMoveEvent: handleMoveEvent,
                    handleUpEvent: handleUpEvent,
                });

                /**
                 * @type {import("../src/ol/coordinate.js").Coordinate}
                 * @private
                 */
                this.coordinate_ = null;

                /**
                 * @type {string|undefined}
                 * @private
                 */
                this.cursor_ = 'pointer';

                /**
                 * @type {Feature}
                 * @private
                 */
                this.feature_ = null;

                /**
                 * @type {string|undefined}
                 * @private
                 */
                this.previousCursor_ = undefined;
            }
        }

        /**
         * @param {import("../src/ol/MapBrowserEvent.js").default} evt Map browser event.
         * @return {boolean} `true` to start the drag sequence.
         */
        function handleDownEvent(evt) {
            const map = evt.map;

            const feature = map.forEachFeatureAtPixel(evt.pixel, function(feature) {
                return feature;
            });

            if (feature) {
                this.coordinate_ = evt.coordinate;
                this.feature_ = feature;
            }

            return !!feature;
        }

        /**
         * @param {import("../src/ol/MapBrowserEvent.js").default} evt Map browser event.
         */
        function handleDragEvent(evt) {
            const deltaX = evt.coordinate[0] - this.coordinate_[0];
            const deltaY = evt.coordinate[1] - this.coordinate_[1];

            const geometry = this.feature_.getGeometry();
            geometry.translate(deltaX, deltaY);

            this.coordinate_[0] = evt.coordinate[0];
            this.coordinate_[1] = evt.coordinate[1];
        }

        /**
         * @param {import("../src/ol/MapBrowserEvent.js").default} evt Event.
         */
        function handleMoveEvent(evt) {
            if (this.cursor_) {
                const map = evt.map;
                const feature = map.forEachFeatureAtPixel(evt.pixel, function(feature) {
                    return feature;
                });
                const element = evt.map.getTargetElement();
                if (feature) {
                    if (element.style.cursor != this.cursor_) {
                        this.previousCursor_ = element.style.cursor;
                        element.style.cursor = this.cursor_;
                    }
                } else if (this.previousCursor_ !== undefined) {
                    element.style.cursor = this.previousCursor_;
                    this.previousCursor_ = undefined;
                }
            }
        }

        /**
         * @return {boolean} `false` to stop the drag sequence.
         */
        function handleUpEvent() {
            this.coordinate_ = null;
            this.feature_ = null;
            return false;
        }

        var source = new ol.source.Vector({
            format: new ol.format.GeoJSON()
        })

        var modif = new ol.interaction.Modify({
            source: source
        });
        var geser = new Drag();

        var interactions = new ol.interaction.defaults().extend([modif, geser]);

        var map = new ol.Map({
            interactions: interactions,
            target: 'map',
            // layers: [
            // new ol.layer.Tile({
            // source: new ol.source.OSM()
            // })
            // ],
            view: new ol.View({
                projection: 'EPSG:4326',
            })
        });

        // popup
        var popup = new ol.Overlay({
            element: document.getElementById('popup'),
        });
        map.addOverlay(popup);

        //Instantiate with some options and add the Control
        var geocoder = new Geocoder('nominatim', {
            provider: 'osm',
            lang: 'in_ID',
            placeholder: 'Search for ...',
            limit: 15,
            countrycodes: 'ID',
            debug: false,
            autoComplete: true,
            keepOpen: true
        });
        map.addControl(geocoder);
        //geocoder.getLayer().setVisible(false);
        map.getView().setZoom(9)
        //Listen when an address is chosen
        geocoder.on('addresschosen', function(evt) {
            window.setTimeout(function() {
                popup.show(evt.coordinate, evt.address.formatted);
            }, 3000);
        });

        setTimeout(function() {
            tileLayer.setZIndex(0);
            map.addLayer(tileLayer);
        }, 1000);

        var vectorLayer;
        var vectorLayerBPN;



        // $(function() {
        // 	//loadPeta(1);
        // 	modify.on('modifyend',function(e){
        // 		console.log("feature id is",e.features.getArray());
        // 	});
        // })


        //function tampilVector(geojsonObject){ 
        function polygonStyleFunction(feature, resolution) {

            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'rgba(10, 10, 10, 0.9)',
                    width: 0.4,
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(10, 255, 10, 0.5)',
                }),
                text: createTextStyle(feature, resolution, myDom.polygons),
            });
        }

        function polygonStyleFunctionNoFill(feature, resolution) {

            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'rgba(10, 10, 10, 0.9)',
                    width: 0.4,
                }),
                // text: createTextStyle(feature, resolution, myDom.polygons),
            });
        }


        //function tampilVector(geojsonObject){ 
        function polygonStyleFunctionCustomColor(feature, resolution) {

            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'rgba(10, 10, 10, 0.9)',
                    width: 0.4,
                }),
                fill: new ol.style.Fill({
                    color: feature.get('color'),
                }),
                // text: createTextStyle(feature, resolution, myDom.polygons, feature.get("text")),
            });
        }

        function tampilPetaCustomColor(ini) {
            console.log("tampil")
            // console.log(ini)
            route = 1;
            // idnya = ini.id;
            var gsonFeature = (new ol.format.GeoJSON()).readFeatures(ini);
            var vectorSource = new ol.source.Vector({
                features: gsonFeature
            });

            vectorLayer = new ol.layer.Vector({
                source: vectorSource
            });
            vectorLayer.setZIndex(1);


            vectorLayer.setProperties({
                'id': ini.id,
                'name': ini.name,
                'tipe': 1
            });
            vectorLayer.setStyle(polygonStyleFunctionCustomColor);

            map.addLayer(vectorLayer);
            map.getView().fit(vectorSource.getExtent(), map.getSize());
            // map.getView().animate({
            // zoom: 10
            // });

            setTimeout(function() {
                tileLayer.setZIndex(0);
                map.addLayer(tileLayer);
            }, 1000);
        }

        function tampilPeta(ini) {
            console.log("tampil")
            // console.log(ini)
            route = 1;
            // idnya = ini.id;
            var gsonFeature = (new ol.format.GeoJSON()).readFeatures(ini);
            var vectorSource = new ol.source.Vector({
                features: gsonFeature
            });

            vectorLayer = new ol.layer.Vector({
                source: vectorSource
            });
            vectorLayer.setZIndex(1);


            vectorLayer.setProperties({
                'id': ini.id,
                'name': ini.name,
                'tipe': 1
            });
            vectorLayer.setStyle(polygonStyleFunction);

            map.addLayer(vectorLayer);
            map.getView().fit(vectorSource.getExtent(), map.getSize());
            // map.getView().animate({
            // zoom: 10
            // });

            setTimeout(function() {
                tileLayer.setZIndex(0);
                map.addLayer(tileLayer);
            }, 1000);
        }

        function tampilPetaNoFill(ini) {
            console.log("tampil")
            // console.log(ini)
            route = 1;
            // idnya = ini.id;
            var gsonFeature = (new ol.format.GeoJSON()).readFeatures(ini);
            var vectorSource = new ol.source.Vector({
                features: gsonFeature
            });

            vectorLayer = new ol.layer.Vector({
                source: vectorSource
            });
            vectorLayer.setZIndex(1);


            vectorLayer.setProperties({
                'id': ini.id,
                'name': ini.name,
                'tipe': 1
            });
            vectorLayer.setStyle(polygonStyleFunctionNoFill);

            map.addLayer(vectorLayer);
            map.getView().fit(vectorSource.getExtent(), map.getSize());
            // map.getView().animate({
            // zoom: 10
            // });

            setTimeout(function() {
                tileLayer.setZIndex(0);
                map.addLayer(tileLayer);
            }, 1000);
        }



        function myStyleFunction(feature) {
            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'rgba(0, 102, 255, 0.9)',
                    width: 1,
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(0, 102, 255, 0.4)'
                })
            });
        }

        function tampilPetaZNT(ini) {
            route = 1;
            var gsonFeature = (new ol.format.GeoJSON()).readFeatures(ini);
            var vectorSource = new ol.source.Vector({
                features: gsonFeature
            });

            vectorLayer = new ol.layer.Vector({
                source: vectorSource
            });
            vectorLayer.setZIndex(1);

            vectorLayer.setStyle(myStyleFunction);

            map.addLayer(vectorLayer);
            map.getView().fit(vectorSource.getExtent(), map.getSize());
            // map.getView().animate({
            // zoom: 10
            // });

            setTimeout(function() {
                tileLayer.setZIndex(0);
                map.addLayer(tileLayer);
            }, 1000);
        }


        function myStyleBPN(feature, resolution) {
            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    // color: 'rgba(180, 94, 37, 1)',
                    color: 'rgb(0,60,102)',
                    width: 3,
                }),
                text: createTextStyle(feature, resolution, myDom.polygons),
                // fill: new ol.style.Fill({
                //     color: 'rgba(246, 189, 46, 0.5)'
                // })
            });
        }

        function tampilPetaBPN(ini) {
            route = 1;
            var gsonFeature = (new ol.format.GeoJSON()).readFeatures(ini);
            var vectorSource = new ol.source.Vector({
                features: gsonFeature
            });

            vectorLayerBPN = new ol.layer.Vector({
                source: vectorSource
            });
            vectorLayerBPN.setZIndex(1);

            vectorLayerBPN.setStyle(myStyleBPN);

            map.addLayer(vectorLayerBPN);
            // map.getView().fit(vectorSource.getExtent(), map.getSize());
            // map.getView().animate({
            //     zoom: 10
            // });

            setTimeout(function() {
                tileLayer.setZIndex(0);
                map.addLayer(tileLayer);
            }, 10);
        }
        var street;
        //jalan();

        function jalan() {
            var streetView = new StreetView({
                apiKey: '<?= $apist; ?>',
                language: 'id',
                size: 'md',
                resizable: true,
                sizeToggler: true,
                defaultMapSize: 'compact',
                i18n: {
                    dragToInit: 'geser dan letakkan',
                    exit: "keluar",
                    exitView: "keluar mode StreetView"
                }
            });

            map.addControl(streetView);

            streetView.once('streetViewInit', function() {
                $('#toggle_fullscreen').hide();
                $('#btnkembali').hide();
                $('#peta_thn').hide();
                $('#btn-petabpn-show').hide();
                document.getElementById('map').style.marginTop = '0%';
                street = '1';
                //loadPeta('1');
                $("#legend-ket").hide();
            });

            streetView.once('streetViewExit', function() {
                // Get the panorama instance
                location.reload();
            });

        }
        // peta from mysql
        // ===============
        $(map.getViewport()).on("click", function(e) {
            map.forEachFeatureAtPixel(map.getEventPixel(e), function(feature, layer) {
                // console.log(feature);
                if (feature.get('D_KD_KEC') != undefined) {
                    posisi = "kel";
                    kdkec = feature.get('D_KD_KEC');
                    $.ajax("office/model/peta_kelurahan.php?kode=" + kdkec, {
                        type: 'GET',
                        success: function(data) {
                            clear();
                            tampilPeta(data);
                            map.addOverlay(overlay);
                            map.on('pointermove', displayTooltip);
                        }
                    });
                } else if (feature.get('D_KD_KEL') != undefined) {
                    $("#preload").show();
                    posisi = "blok";
                    clear();
                    kdkel = feature.get('D_KD_KEL');
                    // $.ajax("office/model/peta_blok.php?kode=" + kdkel, {
                    //     type: 'GET',
                    //     success: function(data) {
                    //         tampilPetaNoFill(data);
                    //         map.addOverlay(overlay);
                    //         map.on('pointermove', displayTooltip);
                    //     }
                    // });

                    $('#btncari').on('click', function() {
                        $("#preload").show();
                        clear();
                        var valthn = $('#pilihtahun').val()
                        $.ajax("office/model/peta_zonanilaitanah.php?kode=" + kdkel + "&tahun=" + valthn, {
                            type: 'GET',
                            success: function(result) {
                                $('#st').show();
                                $("#button_peta_bpn").show();
                                $("#peta_thn").show();
                                $("#modal_tahun").modal('hide');
                                // var result = eval('(' + data + ')');
                                var data = result.data;

                                var arr_kd_znt = [];
                                var arr_color_znt = [];
                                var arr_nir_znt = [];
                                for (i = 0; i < data['features'].length; i++) {
                                    var kd_znt = data['features'][i]['properties']['kd_znt'];
                                    for (j = 0; j < result.data_kd_znt.length; j++) {
                                        if (kd_znt === result.data_kd_znt[j]['kd_znt']) {
                                            data['features'][i]['properties']['color'] = result.data_kd_znt[j]['color'];
                                            data['features'][i]['properties']['nir'] = result.data_kd_znt[j]['nir'];
                                            arr_kd_znt.push(kd_znt);
                                            arr_color_znt.push(result.data_kd_znt[j]['color']);
                                            arr_nir_znt.push(result.data_kd_znt[j]['nir']);
                                        }
                                    }
                                }
                                $("#legend-ket").html("");

                                for (z = 0; z < result.data_kd_znt.length; z++) {
                                    var $newRow = $("<div class='row'> \
                                                <div class='col-sm-1'> \
                                                    <div style='width:10px;height:10px;margin-top:2px; background-color:" + result.data_kd_znt[z]['color'] + ";'></div> \
                                                </div> \
                                                <div class='col-sm-10'><span>Kode ZNT : " + result.data_kd_znt[z]['kd_znt'] + "<br>NIR : " + result.data_kd_znt[z]['nir'] + "</span></div> \
                                              </div>");

                                    $("#legend-ket").append($newRow);
                                }
                                // var kd_znt_unique = arr_kd_znt.filter(onlyUnique);
                                // var color_znt_unique = arr_color_znt.filter(onlyUnique);
                                // var nir_znt_unique = arr_nir_znt.filter(onlyUnique);
                                // for (x = 0; x < kd_znt_unique.length; x++) {
                                //     console.log(kd_znt_unique[x]);
                                //     console.log(color_znt_unique[x]);

                                //     var $newRow = $( "<div class='row'> \
                                //                         <div class='col-sm-1'> \
                                //                             <div style='width:10px;height:10px;margin-top:4px; background-color:"+color_znt_unique[x]+";'></div> \
                                //                         </div> \
                                //                         <div class='col-sm-8'><span>"+kd_znt_unique[x]+", NIR : "+nir_znt_unique[x]+"</span></div> \
                                //                       </div>" );

                                //     $( "#legend-ket" ).append( $newRow );

                                // }

                                tampilPetaCustomColor(data);
                                map.addOverlay(overlay);
                                map.on('pointermove', displayTooltip);
                                $("#preload").hide();
                                $("#legend-ket").show();
                            }
                        });
                    })

                    $.ajax("office/model/peta_zonanilaitanah.php?kode=" + kdkel, {
                        type: 'GET',
                        success: function(result) {
                            $('#st').show();
                            $("#button_peta_bpn").show();
                            $("#cari_tahun").show();
                            $("#peta_thn").show();
                            // var result = eval('(' + data + ')');
                            var data = result.data;

                            var arr_kd_znt = [];
                            var arr_color_znt = [];
                            var arr_nir_znt = [];
                            for (i = 0; i < data['features'].length; i++) {
                                var kd_znt = data['features'][i]['properties']['kd_znt'];
                                for (j = 0; j < result.data_kd_znt.length; j++) {
                                    if (kd_znt === result.data_kd_znt[j]['kd_znt']) {
                                        data['features'][i]['properties']['color'] = result.data_kd_znt[j]['color'];
                                        data['features'][i]['properties']['nir'] = result.data_kd_znt[j]['nir'];
                                        arr_kd_znt.push(kd_znt);
                                        arr_color_znt.push(result.data_kd_znt[j]['color']);
                                        arr_nir_znt.push(result.data_kd_znt[j]['nir']);
                                    }
                                }
                            }
                            $("#legend-ket").html("");
                            for (z = 0; z < result.data_kd_znt.length; z++) {
                                var $newRow = $("<div class='row'> \
                                                <div class='col-sm-1'> \
                                                    <div style='width:10px;height:10px;margin-top:2px; background-color:" + result.data_kd_znt[z]['color'] + ";'></div> \
                                                </div> \
                                                <div class='col-sm-10'><span>Kode ZNT : " + result.data_kd_znt[z]['kd_znt'] + "<br>NIR : " + result.data_kd_znt[z]['nir'] + "</span></div> \
                                              </div>");

                                $("#legend-ket").append($newRow);
                            }
                            // var kd_znt_unique = arr_kd_znt.filter(onlyUnique);
                            // var color_znt_unique = arr_color_znt.filter(onlyUnique);
                            // var nir_znt_unique = arr_nir_znt.filter(onlyUnique);
                            // for (x = 0; x < kd_znt_unique.length; x++) {
                            //     console.log(kd_znt_unique[x]);
                            //     console.log(color_znt_unique[x]);

                            //     var $newRow = $( "<div class='row'> \
                            //                         <div class='col-sm-1'> \
                            //                             <div style='width:10px;height:10px;margin-top:4px; background-color:"+color_znt_unique[x]+";'></div> \
                            //                         </div> \
                            //                         <div class='col-sm-8'><span>"+kd_znt_unique[x]+", NIR : "+nir_znt_unique[x]+"</span></div> \
                            //                       </div>" );

                            //     $( "#legend-ket" ).append( $newRow );

                            // }


                            tampilPetaCustomColor(data);
                            map.addOverlay(overlay);
                            map.on('pointermove', displayTooltip);
                            $("#preload").hide();
                            $("#legend-ket").show();
                        }
                    });
                }
            });
        });


        $(function() {
            $('#st').show();
            $("#btn-petabpn-show").on("click", function(e) {
                $("#btn-petabpn-show").hide();
                $("#btn-petabpn-hide").show();

                $.ajax("office/model/peta_znt_bpn.php", {
                    type: 'GET',
                    success: function(data) {
                        tampilPetaBPN(data);
                        map.addOverlay(overlay);
                        // map.on('pointermove', displayTooltip);
                    }
                });
            });

            $("#btn-petabpn-hide").on("click", function(e) {
                $("#btn-petabpn-hide").hide();
                $("#btn-petabpn-show").show();
                hidePetaBPN();
            });
            $('#peta_thn').on('click', function() {
                $('#cari_peta_thn').slideToggle()
            })
        });

        function hidePetaBPN() {
            map.removeLayer(vectorLayerBPN);
        }


        function onlyUnique(value, index, self) {
            return self.indexOf(value) === index;
        }

        function clear() {
            var layerArray, len, layer;
            layerArray = map.getLayers().getArray(),
                len = layerArray.length;

            while (len > 0) {
                layer = layerArray[len - 1];
                map.removeLayer(layer);
                len = layerArray.length;
            }
        }



        var url;

        var tooltip = document.getElementById('tooltip');
        var overlay = new ol.Overlay({
            element: tooltip,
            offset: [10, 0],
            positioning: 'bottom-left'
        });

        function displayTooltip(evt) {
            var pixel = evt.pixel;
            var feature = map.forEachFeatureAtPixel(pixel, function(feature) {
                return feature;
            });
            tooltip.style.display = feature ? '' : 'none';
            if (feature) {
                overlay.setPosition(evt.coordinate);
                // tooltip.innerHTML = "COBA";
                if (feature.get('D_KD_KEC') != undefined) {
                    tooltip.innerHTML = "KODE : " + feature.get('D_KD_KEC') + "<br>KECAMATAN : " + feature.get('D_NM_KEC');
                } else if (feature.get('D_KD_KEL') != undefined) {
                    tooltip.innerHTML = "KODE : " + feature.get('D_KD_KEL') + "<br>KELURAHAN : " + feature.get('D_NM_KEL');
                } else if (feature.get('D_NOP') != undefined) {
                    tooltip.innerHTML = "NOP : " + feature.get('D_NOP') + "<br>KODE ZNT : " + feature.get('kd_znt') + "<br>NIR : " + feature.get('nir');
                } else if (feature.get('nilai_awal') != undefined) {
                    tooltip.innerHTML = "PETA BPN<br>Nilai Awal : " + numberWithCommas(feature.get('nilai_awal'));
                } else {
                    tooltip.innerHTML = "";
                }
                // } else {
                //  var label = feature.get('label');
                //  var tetap = feature.get('penetapan');
                //  var setor = feature.get('penyetoran');
                //  tooltip.innerHTML = label+"<br>Penetapan : "+numberWithCommas(tetap)+"<br>Penyetoran : "+numberWithCommas(setor);
                // }
            }
        };
        $(function() {
            loadPeta();
        })


        function kembali() {
            $("#button_peta_bpn").hide();
            $("#peta_thn").hide();
            $("#btn-petabpn-hide").hide();
            $("#btn-petabpn-show").show();
            hidePetaBPN();

            $("#legend-ket").hide();
            $("#legend-ket").html("");
            if (posisi == 'blok') {
                $.ajax("office/model/peta_kelurahan.php?kode=" + kdkec, {
                    type: 'GET',
                    success: function(data) {
                        clear();
                        tampilPeta(data);
                        map.addOverlay(overlay);
                        map.on('pointermove', displayTooltip);
                    }
                });
                posisi = "kel";
            } else if (posisi == 'kel') {
                clear();
                loadPeta();
            }
        }

        function loadPeta(no = '0') {
            clear();
            $.ajax("office/model/peta_kecamatan.php", {
                type: 'GET',
                success: function(data) {
                    if (no == '1') {
                        tampilPetaNoFill(data);
                    } else {
                        tampilPeta(data);
                    }
                    map.addOverlay(overlay);
                    map.on('pointermove', displayTooltip);
                }
            });
        }
    </script>

    <!-- jsnyaend -->
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
    <script src="assets/js/jquery.md5.min.js" type="text/javascript"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script> -->

    <!-- DataTable -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- jsnya -->
    <!-- Modal -->
    <div class="modal fade" id="modal_tahun" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tahun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="thn_znt" id="thn_znt">
                    <select class="form-control" id="pilihtahun">
                        <option value="">Pilih Tahun</option>
                        <?php $th = oci_parse($c, 'SELECT DISTINCT(THN_NIR_ZNT) FROM DAT_NIR');
                        oci_execute($th);
                        while ($thn = oci_fetch_array($th)) { ?>
                            <option value="<?= $thn['THN_NIR_ZNT'] ?>"><?= $thn['THN_NIR_ZNT'] ?></option>

                        <?php } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btncari"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>