<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/bootstrap-social.css">
    <link rel="stylesheet" href="http://leaflet.github.io/Leaflet.label/leaflet.label.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
    <link rel="stylesheet" href="https://pendataan.baliprov.go.id/assets/frontend/map/MarkerCluster.css" />
    <link rel="stylesheet" href="https://pendataan.baliprov.go.id/assets/frontend/map/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

    <style>
    html,
    body,
    #map {
        height: 500px;
        width: 100%;
        padding: 0;
        margin: 0;
    }
    .hero {
        width: 100%;
        height: 40vh;
        background: #f3f3f3;
        border-bottom: 2px solid #e2e2e2;
        margin: 0 0 0 0;
        background-image: url('https://cdn2.tstatic.net/palu/foto/bank/images2/ilustrasi-virus-corona-baru-covid-19-67.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .services .icon-box {
      padding: 10px;
      position: relative;
      overflow: hidden;
      margin: 0 0 0 0;
      opacity: 0.8;
      background: #f3f3f3;
      box-shadow: 0 10px 29px 0 rgba(68, 88, 144, 0.1);
      transition: all 0.3s ease-in-out;
      border-radius: 10px;
      text-align: center;
      border-bottom: 3px solid #f3f3f3;
    }

    .section-header h3 {
      font-size: 36px;
      color: #413e66;
      text-align: center;
      font-weight: 700;
      position: relative;
      font-family: "Montserrat", sans-serif;
    }

    .section-header h4 {
      font-size: 24px;
      color: #413e66;
      text-align: center;
      font-weight: 500;
      position: relative;
      font-family: "Montserrat", sans-serif;
    }

    #why-us .sub span {
      font-family: "Montserrat", sans-serif;
      font-weight: bold;
      font-size: 30px;
      display: block;
      color: #555186;
    }

    .form-group{
      text-align: center;
      vertical-align: middle;
    }

    .lebar{
      width:50%;
      margin-left:270px;
      
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a id="nav-logo-bali-top" class="navbar-brand" ></a>
         <div class="container">
            <div>
              <a id="nav-logo-bali-top" class="navbar-brand" >
              <img src="https://4.bp.blogspot.com/-ELlrLdH0frM/WSz4AjqIWaI/AAAAAAAAASY/EF5ayA5zXn05TXw53cRUVTJeh6lzUJDDwCLcB/s400/Lambang%2BDaerah%2BProvinsi%2BBali%2B2.png" alt="" class="src" style="width: 40px;"> 
              </a>
            </div>
          <div class="col-9 p-0">
                    <h6 style="margin: 5px 0px 0px 0px;font-weight: 400; font-size: 12px; color: #413e66;  white-space: nowrap;">Pemerintah Provinsi Bali</h6>
                    <span class="font-weight-bold" style="color: #413e66;">Tanggap <span style="color: #ff7f63;">COVID-19</span></span>
                </div>
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="">
      <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="col-md-10">
              <ul class="navbar-nav ml-auto" style="">
                  <li class="nav-item active">
                      <a class="nav-link" href="/"> Beranda <span class="sr-only">(current)</span>
                      </a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="/data-kabupaten">Data</a>
                  </li>
              </ul>
          </div>
      </div>
  </div>
</nav>

<section id="hero" class="services d-flex align-items-center">
  <div class="hero">
        <div class="container">
            <div class="row" style="">
              <div class="col-lg-12 pt-3 pt-lg-3">
                <h1><span style="color: rgb(245,214,213)"> Bali </span><span style="color: rgb(250,0,0)">COVID-19</span></h1>
              </div>
            </div>
          
        <div class="row pt-0 aos-init aos-animate" data-aos="fade-zoom-out">
          <div class="col-md-6 col-lg-6 d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box">
                <h3 class="title" style="color: rgb(0,0,0)">Update informasi persebaran COVID-19 di Provinsi Bali sampai tanggal {{$tanggalSekarang}}.</h3>
                </div>
              </div>
          </div>
        </div>
        </div>
      </div>
</section>

            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                    {{-- <router-view></router-view> --}}
                </div>
            </div>
            
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}
    
    <script src="/js/app.js"></script>
    @yield('js')
</body>

</html>