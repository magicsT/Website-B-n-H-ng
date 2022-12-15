@extends('layouts.admin')

@section('title')
<title>Category</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Category' , 'key' => 'Edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                <form action="{{route('categories.update',['id'=>$category->id])}}"  method="post">
                    @csrf
                    <div class="form-group">
                        <label>Tên Danh Mục</label>
                        <input type="text" class="form-control" name="name" value="{{$category->name}}" placeholder="Nhập tên danh mục">
                        <div class="form-group">
                            <label>Chọn Danh mục cha </label>
                            <select class="form-control" name="parent_id">
                                <option value="0">Chọn danh mục cha</option>
                                {!! $htmlOption !!}
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