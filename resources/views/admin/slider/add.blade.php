@extends('layouts.admin')

@section('title')
    <title>Menus</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/add/slider.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'Slider', 'key' => 'Add'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên Slider</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" placeholder="Nhập tên Slider" value="{{old('name')}}">

                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror"  rows="4">{{old('description')}}</textarea>

                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <input type="file" class="form-control-file @error('image_path') is-invalid @enderror" name="image_path" >

                                @error('image_path')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                            </div>
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
