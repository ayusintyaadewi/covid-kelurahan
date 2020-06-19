@extends('layout.master')

@section('title','COVID-19 | BALI')
@section('content')

<main id="main" style="padding: 5%; background-color:#f5f8fd;">
    <section id="why-us" class="why-us wow fadeInUp card shadow p-3 mb-5 bg-white rounded" style="visibility: visible; animation-name: fadeInUp;">
        <div class="container-fluid">
            <header class="section-header mt-3">
                <h3 style="margin-bottom: 10px;">Monitoring Data COVID-19 Provinsi Bali</h3>                       
            </header>
        </div>
      
        <div class="container">
            <div class="row counters">  
              <div class="col-lg-12 col-md-12 col-12" style="margin-top: 30px" >
                    <div class="card">
                    <form action="/search" method="POST">
                        @csrf
                            <div class="form-group">
                              <label for="exampleFormControlInput1">Masukkan tanggal yang ingin diketahui informasinya</label>
                              <input type="date" class="form-control lebar" name="tanggal" id="tanggalSearch"  @if(isset($tanggal)) value="{{$tanggal}}" @endif><br>
                            
                            <button type="submit" class="btn btn-success btn-flat">Search</button>
                        </div>
                      </form>
                    </div>
                  </div>

              <div class="col-lg-12 col-md-12 col-12" style="margin-top: 40px">
                    <div class="card">
                        
                        <div class="row sub" style="padding:10px; ">
                            <div class="col-md-3 col-6 text-center ">
                                <span style="color: #E5000D;  font-size: 48px;">{{$totalPositif[0]->total}}</span>
                                <h4 class="text-center" style="margin-top:10px; color: #E5000D;">Positif</h4>
                            </div>
                            <div class="col-md-3 col-6 text-center ">
                                <span style="color: #5d62b5;  font-size: 48px;">{{$totalDirawat[0]->perawatan}}</span>
                                <h4 class="text-center" style="margin-top:10px; color: #5d62b5;">Dirawat</h4>
                            </div>
                             <div class="col-md-3 col-6 text-center ">
                                <span class="text-success" style=" font-size: 48px;">{{$totalSembuh[0]->sembuh}}</span>
                                <h4 class="text-success" style="margin-top:10px; color: #5d62b5;">Sembuh</h4>
                            </div>
                            <div class="col-md-3 col-6 text-center ">
                                <span class="text-dark" style=" font-size: 48px;">{{$totalMeninggal[0]->meninggal}}</span>
                                <h4 class="text-center" style="margin-top:10px; color: #000000;">Meninggal</h4>
                            </div>
                        </div>
                    </div>
                  </div>

              <div class="col-lg-12 col-md-12 col-12" style="margin-top: 50px"> 
        <div class="card">
        <div class="container-fluid">
            <header class="section-header mt-3">
                <h4 style="margin-bottom: 10px;" style="margin-top: 10px">Peta Persebaran COVID-19 di setiap Kelurahan Tanggal {{$tanggalSekarang}}</h4>                       
            </header>
        </div>
        <div class="card-body">
          <div class="card-body no-padding p-0">
            <div class="row">
              <div class="col-12">
                <div class="pad">
                  <div id="mapid" style="height: 500px"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="container" style="margin-top:30px" style="margin-bottom:30px">
    <div class="row mt-4">
        <div class="col-sm-12">
            <div class="card">
            <div class="container-fluid">
            <header class="section-header mt-3">
                <h4 style="margin-bottom: 10px;" style="margin-top: 10px">Data Persebaran COVID-19 setiap Kabupaten/Kota Tanggal {{$tanggalSekarang}}</h4>                       
            </header>
            </div>
                <div class="card-body">
                <div class="table-responsive">
                  <table id="example" class="table table-striped rounded" >
                    <thead style="text-align: center">
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Kabupaten</th>
                        <th scope="col">Sembuh</th>
                        <th scope="col">Positif</th>
                        <th scope="col">Dalam Perawatan</th>
                        <th scope="col">Meninggal</th>
                      </tr>
                    </thead>
                    <tbody style="text-align: center">
                        @foreach ($data as $item)
                        <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->kabupaten }}</td>
                        <td>{{ $item->sembuh }}</td>
                        <td>{{ $item->total }}</td>
                        <td>{{ $item->perawatan }}</td>
                        <td>{{ $item->meninggal }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
                </div>
              </div> 
        </div>
    </div>
</div>


@endsection
@section("js")
<script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>
<script src="https://pendataan.baliprov.go.id/assets/frontend/map/leaflet.markercluster-src.js"></script>
<script src="http://leaflet.github.io/Leaflet.label/leaflet.label.js" charset="utf-8"></script>
<script>
  $(document).ready(function () {
    var showMap=null;
    var colour=null;
    var mapColour=[
      "edff6b",
      "dcec5d",
      "ccd950",
      "bcc743",
      "acb436",
      "9ba128",
      "8b8f1b",
      "7b7c0e",
      "6b6a01"
    ];
    var tanggal = $('#tanggalSearch').val();
    $.ajax({
      async:false,
      url:'getDataMap',
      type:'get',
      dataType:'json',
      data:{date: tanggal},
      success: function(response){
        showMap = response["dataMap"];
        colour = response["dataColor"];
      }
    });
    console.log(showMap);
    var map = L.map('mapid',{
      fullscreenControl:true,
    });
    
    $('#btnGenerateColor').on('click',function(e){
      var startColour = $('#colorStart').val();
      var endColour = $('#colorEnd').val();
      $.ajax({
        async:false,
        url:'/create-pallete',
        type:'get',
        dataType:'json',
        data:{start: startColour, end:endColour},
        success: function(response){
          mapColour = response;
          setMapAttr();
        }
      });
      
    });
    
    
    map.setView(new L.LatLng(-8.500410, 115.195839),10);
    var OpenTopoMap = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 20,
            id: 'mapbox/streets-v11',
            accessToken: 'pk.eyJ1Ijoid2lkaWFuYXB3IiwiYSI6ImNrNm95c2pydjFnbWczbHBibGNtMDNoZzMifQ.kHoE5-gMwNgEDCrJQ3fqkQ',
        }).addTo(map);
    OpenTopoMap.addTo(map);
    var defStyle = {opacity:'1',color:'#000000',fillOpacity:'0',fillColor:'#CCCCCC'};
    setMapAttr();

    function setMapAttr(){
      var showMarker = L.icon({
        iconUrl: '/img/mark.png',
        iconSize: [40, 40],
      });
      
      var kmzParser = new L.KMZParser({
          
          onKMZLoaded: function (kmz_layer, name) {
            
              control.addOverlay(kmz_layer, name);
              var markerWilayah = L.markerClusterGroup();
              var layers = kmz_layer.getLayers()[0].getLayers();
              console.log(layers[0]);
              layers.forEach(function(layer, index){
                var showKabupaten  = layer.feature.properties.NAME_2;
                var showKecamatan =  layer.feature.properties.NAME_3;
                var showKelurahan = layer.feature.properties.NAME_4;
                var parameter;
              
                var STYLE = {opacity:'1',color:'#000',fillOpacity:'1'};
                var lightGreen = {opacity:'1',color:'#000',fillOpacity:'1', fillColor:'#81F781'};
                var darkGreen = {opacity:'1',color:'#000',fillOpacity:'1', fillColor:'#088A08'};
                var yellow = {opacity:'1',color:'#000',fillOpacity:'1', fillColor:'#FFFF00'};
                var pink = {opacity:'1',color:'#000',fillOpacity:'1', fillColor:'#F78181'};
                var red = {opacity:'1',color:'#000',fillOpacity:'1', fillColor:'#B40404'};
                if(!Array.isArray(showMap) || !showMap.length == 0){
                    var searchResult = showMap.filter(function(it){
                      return it.kecamatan.replace(/\s/g,'').toLowerCase() === showKecamatan.replace(/\s/g,'').toLowerCase() &&
                              it.kelurahan.replace(/\s/g,'').toLowerCase() === showKelurahan.replace(/\s/g,'').toLowerCase();
                    });
                    if(!Array.isArray(searchResult) || !searchResult.length ==0){
                      var item = searchResult[0];
                      if(item.total == 0 ){
                        layer.setStyle(lightGreen);  
                      }else if(item.perawatan == 0 && item.total>0 && item.sembuh >= 0 && item.meninggal >=0){
                        layer.setStyle(darkGreen);
                      }else if(item.ppln ==1 && item.perawatan == 1 && item.total == 1 && item.tl==0 || item.ppdn ==1 && item.perawatan == 1 && item.total == 1 && item.tl==0){
                        layer.setStyle(yellow);
                      }else if((item.ppln >1 && item.perawatan <= item.ppln && item.sembuh <= item.ppln && item.tl == 0) || (item.ppdn >1 && item.perawatan <= item.ppdn && item.sembuh <= item.ppdn && item.tl == 0)  ){
                        layer.setStyle(pink);
                      }else{
                        layer.setStyle(red);
                      }
                      parameter = '<table width="300">';
                      parameter +='  <tr>';
                      parameter +='    <th colspan="2">Keterangan</th>';
                      parameter +='  </tr>';
                    
                      parameter +='  <tr>';
                      parameter +='    <td>Kabupaten</td>';
                      parameter +='    <td>: '+showKabupaten+'</td>';
                      parameter +='  </tr>';              
      
                      parameter +='  <tr >';
                      parameter +='    <td>Kecamatan</td>';
                      parameter +='    <td>: '+showKecamatan+'</td>';
                      parameter +='  </tr>';

                      parameter +='  <tr>';
                      parameter +='    <td>Kelurahan</td>';
                      parameter +='    <td>: '+showKelurahan+'</td>';
                      parameter +='  </tr>';

                      parameter +='  <tr>';
                      parameter +='    <td>PP-LN</td>';
                      parameter +='    <td>: '+item.ppln+'</td>';
                      parameter +='  </tr>';

                      parameter +='  <tr>';
                      parameter +='    <td>PP-DN</td>';
                      parameter +='    <td>: '+item.ppdn+'</td>';
                      parameter +='  </tr>';

                      parameter +='  <tr>';
                      parameter +='    <td>TL</td>';
                      parameter +='    <td>: '+item.tl+'</td>';
                      parameter +='  </tr>';

                      parameter +='  <tr>';
                      parameter +='    <td>Lainnya</td>';
                      parameter +='    <td>: '+item.lainnya+'</td>';
                      parameter +='  </tr>';

                      parameter +='  <tr style="color:green">';
                      parameter +='    <td>Sembuh</td>';
                      parameter +='    <td>: '+item.sembuh+'</td>';
                      parameter +='  </tr>';

                      parameter +='  <tr style="color:blue">';
                      parameter +='    <td>Dalam Perawatan</td>';
                      parameter +='    <td>: '+item.perawatan+'</td>';
                      parameter +='  </tr>';

                      parameter +='  <tr style="color:red">';
                      parameter +='    <td>Meninggal</td>';
                      parameter +='    <td>: '+item.meninggal+'</td>';
                      parameter +='  </tr>';
                    }else{
                      console.log(showKelurahan.replace(/\s/g,'').toLowerCase());
                      console.log(showKecamatan.replace(/\s/g,'').toLowerCase());
                      parameter = '<table width="300">';
                      parameter +='  <tr>';
                      parameter +='    <th colspan="2">Keterangan</th>';
                      parameter +='  </tr>';
                    
                      parameter +='  <tr>';
                      parameter +='    <td>Kabupaten</td>';
                      parameter +='    <td>: '+showKabupaten+'</td>';
                      parameter +='  </tr>';              
      
                      parameter +='  <tr style="color:red">';
                      parameter +='    <td>Kecamatan</td>';
                      parameter +='    <td>: '+showKecamatan+'</td>';
                      parameter +='  </tr>';

                      parameter +='  <tr style="color:red">';
                      parameter +='    <td>Kelurahan</td>';
                      parameter +='    <td>: '+showKelurahan+'</td>';
                      parameter +='  </tr>';
                    }
                }else{
                  // var parameter = "missing data on that date"
                  layer.setStyle(defStyle);
                  parameter = '<table width="300">';
                      parameter +='  <tr>';
                      parameter +='    <th colspan="2">Keterangan</th>';
                      parameter +='  </tr>';
                    
                      parameter +='  <tr>';
                      parameter +='    <td>Kabupaten</td>';
                      parameter +='    <td>: '+showKabupaten+'</td>';
                      parameter +='  </tr>';              
      
                      parameter +='  <tr>';
                      parameter +='    <td>Kecamatan</td>';
                      parameter +='    <td>: '+showKecamatan+'</td>';
                      parameter +='  </tr>';

                      parameter +='  <tr>';
                      parameter +='    <td>Kelurahan</td>';
                      parameter +='    <td>: '+showKelurahan+'</td>';
                      parameter +='  </tr>';  
                }
                layer.bindPopup(parameter);
                markerWilayah.addLayer( 
                  L.marker(layer.getBounds().getCenter(),{
                    icon: showMarker
                  }).bindPopup(parameter)
                );
              });
              map.addLayer(markerWilayah);
              kmz_layer.addTo(map);
          }
      });
      kmzParser.load('bali-kelurahan.kmz');
      var control = L.control.layers(null, null, {
          collapsed: true
      }).addTo(map);
      $('.leaflet-control-layers').hide();

    }
  });
</script>
@endsection