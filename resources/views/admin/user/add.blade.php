@extends('layouts.admin')

@section('title')
    <title>Menus</title>
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <style>
        .select2-selection__choice{
            background-color: black !important;
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script>
        $('.select2_init').select2({
            'placeholder' : 'chọn vai trò'
        })
    </script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'User', 'key' => 'Add'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên </label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên"
                                    value="{{ old('name') }}">

                            </div>

                            <div class="form-group">
                                <label>Email </label>
                                <input type="email" class="form-control" name="email" placeholder="Nhập email"
                                    value="{{ old('email') }}">

                            </div>

                            <div class="form-group">
                                <label>Password </label>
                                <input type="password" class="form-control" name="password" placeholder="Nhập password"
                                    value="">

                            </div>

                            <div class="form-group">
                                <label>Chọn Vai Trò </label>
                                <select name="role_id[]" class="form-control select2_init" multiple>
                                    <option value=""></option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach

                                </select>

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
