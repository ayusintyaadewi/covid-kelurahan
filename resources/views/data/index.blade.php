@extends('layout.master')

@section('title','COVID-19 | BALI')
@section('content')
<main id="main" style="padding: 5%; background-color:#f5f8fd;">
    <section id="why-us" class="why-us wow fadeInUp card shadow p-3 mb-5 bg-white rounded" style="visibility: visible; animation-name: 
        fadeInUp;">
            <div class="col-lg-12 col-md-12 col-12" style="margin-top: 30px">
              <div class="card"><div class="container-fluid">
                <header class="section-header mt-3">
                    <h4 style="margin-bottom: 10px;" style="margin-top: 10px">Tambah/Update Data Kasus COVID-19</h4>                       
                </header>
              </div>
              <div class="card-body">
                   <form action="/data-kabupaten" method="POST">
                    @csrf
                    
                    @if ($kelurahanBelumUpdate->count() > 0)
                    <div class="card card-body">
                    @else
                    <div class="card card-green mt-5">
                    @endif
                   
                    <div class="form-group1">
                        <label for="exampleInputEmail1">Tanggal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group1">
                        <label>Kabupaten</label>
                        <select class="form-control" style="width: 100%;" name="kabupaten" id="selectKabupaten" required>
                            <option value="">Pilih kabupaten</option>
                            @foreach ($kabupaten as $item)
                                <option value="{{$item->id}}">{{ucfirst($item->kabupaten)}}</option>      
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group1">
                        <label>Kecamatan</label>
                        <select class="form-control" style="width: 100%;" name="kecamatan" id="selectKecamatan" required>
                        </select>
                    </div>

                    <div class="form-group1">
                        <label>Kelurahan</label>
                        <select class="form-control" style="width: 100%;" name="kelurahan" id="selectKelurahan" required>
                        </select>
                    </div>
                    
                    
                    <div class="form-group1">
                        <label for="exampleInputEmail1">Jumlah PP-LN</label>
                        <input type="number" name="ppln" class="form-control" required>
                    </div>

                    <div class="form-group1">
                        <label for="exampleInputEmail1">Jumlah PP-DN</label>
                        <input type="number" name="ppdn" class="form-control" required>
                    </div>

                    <div class="form-group1">
                        <label for="exampleInputEmail1">Jumlah TL</label>
                        <input type="number" name="tl" class="form-control" required>
                    </div>

                    <div class="form-group1">
                        <label for="exampleInputEmail1">Jumlah Lainnya</label>
                        <input type="number" name="lainnya" class="form-control" required>
                    </div>

                    <div class="form-group1">
                        <label for="exampleInputEmail1">Jumlah Sembuh</label>
                        <input type="number" name="sembuh" class="form-control" required>
                    </div>

                    <div class="form-group1">
                        <label for="exampleInputPassword1">Jumlah dalam Perawatan</label>
                        <input type="number" name="perawatan" class="form-control" required>
                    </div>
                    <div class="form-group1">
                        <label for="exampleInputPassword1">Jumlah Meninggal</label>
                        <input type="number" name="meninggal" class="form-control" required>
                    </div>
                    
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                
            </div>
        </form>
    </div>
</div>
@endsection


@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
{{-- <script src="/js/app.js"></script> --}}
<script>
    $(document).ready(function() {
        $('.select2').select2();

        $('#selectKabupaten').on('change', function() {
            $.ajax({
                
                url:'getKecamatan',
                type:'get',
                dataType:'json',
                data:{id_kabupaten: this.value},
                success: function(response){
                    var $namaKecamatan = $('#selectKecamatan');
                    $namaKecamatan.empty();
                    console.log(response);
                    for(var i = 0; i < response.length; i++){
                        $namaKecamatan.append('<option id=' + response[i].id + ' value=' + response[i].id + '>' + response[i].kecamatan + '</option>');
                    }
                    $namaKecamatan.change();
                }
            });
        });

        $('#selectKecamatan').on('change', function() {
            $.ajax({
                url:'getKelurahan',
                type:'get',
                dataType:'json',
                data:{id_kecamatan: this.value},
                success: function(response){
                    var $namaKelurahan = $('#selectKelurahan');
                    $namaKelurahan.empty();
                    console.log(response);
                    for(var i = 0; i < response.length; i++){
                        $namaKelurahan.append('<option id=' + response[i].id + ' value=' + response[i].id + '>' + response[i].kelurahan + '</option>');
                    }
                    $namaKelurahan.change();
                }
            });
        });
    });

    
</script>
@endsection