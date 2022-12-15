@extends('layouts.admin')

@section('title')
    <title>List Slider</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/add/slider.css') }}">
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'Slider', 'key' => 'List'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('slider.create') }}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên Slider</th>
                                    <th scope="col">Descipttion</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <th scope="row">{{ $slider->id }}</th>
                                        <td>{{ $slider->name }}</td>
                                        <td>{{ $slider->description }}</td>
                                        <td>
                                            <img class="image_slider" src="{{ $slider->image_path }}"
                                                alt="{{ $slider->image_name }}">
                                        </td>
                                        <td>
                                            <a href="{{ route('slider.edit', ['id' => $slider->id]) }}" data-url=""
                                                class="btn btn-default">Edit</a>

                                            <a href="" data-url="{{ route('slider.delete', ['id' => $slider->id]) }}"
                                                class="btn btn-danger action_delete">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $sliders->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
