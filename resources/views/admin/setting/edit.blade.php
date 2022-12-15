@extends('layouts.admin')

@section('title')
    <title>Setting</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'Settings', 'key' => 'Edit'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('settings.update', ['id' => $setting->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Config Key</label>
                                <input type="text" class="form-control @error('config_key') is-invalid @enderror "
                                    name="config_key" placeholder="Nhập Config Key" value="{{ $setting->config_key }}">
                            </div>
                            @error('config_key')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            @if (request()->type === 'Text')
                                <div class="form-group">
                                    <label>Config Value</label>
                                    <input type="text" class="form-control @error('config_value') is-invalid @enderror"
                                        name="config_value" placeholder="Nhập Config Value"
                                        value="{{ $setting->config_value }}">
                                </div>
                                @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            @elseif(request()->type === 'Textarea')
                                <div class="form-group">
                                    <label>Config Value</label>
                                    <textarea type="text" class="form-control @error('config_value') is-invalid @enderror" name="config_value"
                                        placeholder="Nhập Config Value" rows="5">
                                        {{ $setting->config_value }}
                                    </textarea>
                                </div>
                                @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            @endif

                            <button type="submit" class="btn btn-primary m-2">Submit</button>
                        </form>

                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
