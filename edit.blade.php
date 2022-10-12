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
                    {{-- <h1 class="m-0">Ubah Data Registrasi Program Posyandu</h1> --}}
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="margin-top: 10px;">
                    <div class="card-header">
                        <div class="float-sm-left">
                            <p>Ubah Data Program Kegiatan</p>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-horizontal" action="/program/edit/{{ $program->id_program }}"
                            method="post"> {{ csrf_field() }}
                            <input type="hidden" name="_method" value="POST">
                            <div class="form-group row">
                                <label class="control-label col-sm-2">NIB Anak</label>
                                <div class="col-sm-10">
                                    <select class="col-sm-12 form-control" name="id_pasien" id="NIB-dropdown">
                                        <option value="0" aria-readonly="true">
                                            -- Select NIB Anak --</option>
                                        @foreach ($pasien as $key => $val)
                                            :
                                        <option value="<?= $val['id_pasien'] ?>">
                                                {{ $val['NIB'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2"> Nama Anak </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                         id="namewarga" disabled placeholder="Nama Anak">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2">Jenis Layanan</label>
                                <div class="col-sm-10">
                                    <select class="col-sm-12 form-control" name="id_layanankesehatan">
                                        @foreach ($lakes as $key => $val)
                                            <option value="<?= $val['id_layanankesehatan'] ?>"
                                                {{ $val->lakes === $program->id_layanankesehatan ? 'selected' : '' }}>
                                                {{ $val['nama_layanan'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2">Terakhir Datang</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal_datang">
                                        {{-- value="{{ $datenow }}" readonly> --}}
                                    <input type="hidden" class="form-control" name="datang_kembali"
                                        value="{{ $datang_kembali }}">
                                    @if ($errors->has('terakhir_datang'))
                                        <div class="text-danger">
                                            {{ $errors->first('terakhir_datang') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2">Keterangan Pemeriksaan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="hasil_periksa"
                                        value="{{ $program->hasil_periksa }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="submit" class="btn btn-outline-primary"
                                        onclick="return confirm('Yakin anda ingin mengubah data tersebut?')">Perbaharui
                                        Data</button>
                                    <a href="{{ route('program.index') }}" class="btn btn-outline-danger">Batal</a>
                                </div>
                            </div>
                        </form>
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
            console.log(id_pasien);
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
