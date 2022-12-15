@extends('layouts.admin')

@section('title')
<title>Menus</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Menus' , 'key' => 'Add'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                <form action="{{route('menus.store')}}"  method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Tên Menus</label>
                        <input type="text" class="form-control" name="name" placeholder="Nhập tên Menu">
                        <div class="form-group">
                            <label>Chọn Menus cha </label>
                            <select class="form-control" name="parent_id">
                                <option value="0">Chọn menu cha</option>
                                {!!$optionSelect!!}
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