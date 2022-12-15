@extends('layouts.admin')

@section('title')
    <title>Add Product</title>
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admins/product/add/add.css') }}">
@endsection


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'Product', 'key' => 'Edit'])
        <form action="{{ route('product.update',['id'=>$product->id])}}" method="POST" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm" value="{{$product->name}}">
                            </div>
                            <div class="form-group">
                                <label>Giá Sản Phẩm</label>
                                <input type="text" class="form-control" name="price" placeholder="Nhập giá sản phẩm" value="{{$product->price}}">
                            </div>
                            <div class="form-group">
                                <label>Ảnh Sản Phẩm</label>
                                <input type="file" class="form-control-file" name="feature_image_path">
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <img class="image_product_avt" src="{{$product->feature_image_path}}" alt="">
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label>Ảnh Chi Tiết Sản Phẩm</label>
                                <input type="file" multiple class="form-control-file" name="image_path[]">
                            </div>
                            
                            <div class="col-md-12 ">
                                <div class="row">
                                    @foreach($product-> productImages as $productImageItem)
                                    <div class="col-md-3">
                                        <img class="image_detail_product" src="{{$productImageItem->image_path}}" alt="">
                                    </div>
                                    @endforeach 
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Chọn Danh mục </label>
                                <select class="form-control select2_init" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Nhập tags cho sản phẩm </label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                                    @foreach($product->tags as $tagItem)
                                    <option value="{{$tagItem->name}}" selected>{{$tagItem->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nhập Nội dung</label>
                                <textarea name="contents" class="form-control tinymce_editor_init" rows="8">{{$product->content}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary m-2">Submit</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>

    <script src="https://cdn.tiny.cloud/1/plddvkdvh895uafp050jrf726lvpzzcuk7nhjho9u4q1wxhm/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="{{ asset('admins/product/add/add.js') }}"></script>
@endsection
