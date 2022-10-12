@extends('layouts.app')
@section('menu', 'transaksi')
@section('submenu', 'program')
@section('title','Program Kegiatan')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">Tambah Data Registrasi Program Posyandu</h1> --}}
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('regispasien.index') }}">Home</a></li> --}}
                        {{-- <li class="breadcrumb-item active">Tambah Data Registrasi Program</li> --}}
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="margin-top: 10px">
                        <div class="panel panel-default">
                            <div class="card-header">
                                <!--/.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card" style="margin-top: 10px;">
                                                    <div class="card-header">
                                                        <div class="float-sm-left">
                                                            <p>Tambah Data Program Kegiatan</p>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                        <form class="form-horizontal" action="/program/store"
                                                            method="post"> {{ csrf_field() }}
                                                            <div class="form-group row">
                                                                <label class="control-label col-sm-2">NIB</label>
                                                                <div class="col-sm-10">
                                                                    <select class="col-sm-12 form-control" name="id_pasien"
                                                                        id="NIB-dropdown">
                                                                        <option value="0" aria-readonly="true">
                                                                            -- Select NIB Balita --</option>
                                                                        @foreach ($pasien as $key => $val)
                                                                            :
                                                                            <option value="<?= $val['id_pasien'] ?>">
                                                                                {{ $val['NIB'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('id_pasien'))
                                                                        <div class="text-danger">
                                                                            {{ $errors->first('id_pasien') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="control-label col-sm-2"> Nama Balita </label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        id="namebalita" disabled placeholder="Nama Balita">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="control-label col-sm-2">Jenis Layanan</label>
                                                                <div class="col-sm-10">
                                                                    <select class="col-sm-12 form-control"
                                                                        name="id_layanankesehatan">
                                                                        @foreach ($lakes as $key => $val)
                                                                            :
                                                                            <option
                                                                                value="<?= $val['id_layanankesehatan'] ?>">
                                                                                {{ $val['nama_layanan'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('id_layanankesehatan'))
                                                                        <div class="text-danger">
                                                                            {{ $errors->first('id_layanankesehatan') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="control-label col-sm-2">Tanggal
                                                                    Datang</label>
                                                                <div class="col-sm-10">
                                                                    <input type="date" class="form-control"
                                                                        name="tanggal_datang">
                                                                        {{-- value="{{ $datenow }}" readonly> --}}

                                                                    <input type="hidden" class="form-control"
                                                                        name="datang_kembali" value="{{ $datang_kembali }}">
                                                                    @if ($errors->has('tanggal_datang'))
                                                                        <div class="text-danger">
                                                                            {{ $errors->first('tanggal_datang') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="control-label col-sm-2">Keterangan Pemeriksaan</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        name="hasil_periksa">
                                                                    @if ($errors->has('hasil_periksa'))
                                                                        <div class="text-danger">
                                                                            {{ $errors->first('hasil_periksa') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-offset-5 col-sm-10">
                                                                    <p><button type="submit"
                                                                            class="btn btn-outline-primary" onclick="return confirm('Yakin anda ingin menyimpan data tersebut?')">Simpan</button>
                                                                        {{-- <a href="/cetakprogram" class="btn btn-outline-danger">Kembali</a> --}}
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#NIB-dropdown').on('change', function() {
            var id_pasien = this.value;

            $("#name-dropdown").html('');
            //console.log(id_pasien);
            $.ajax({
                url: "{{ url('api/fetchname') }}",
                type: "GET",
                data: {
                    id: id_pasien
                },
                dataType: "json",
                success: function(result) {
                    $('#namebalita').val(result[0].nama_pasien);

                }
            });
        });
    });
</script>
