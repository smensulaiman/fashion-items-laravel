@extends('admin.layouts.master')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Slider</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Sub-Category</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('admin.sub-category.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="selCategory">Status</label>
                                    <select id="selCategory" class="form-control" name="category">
                                        <option selected disabled>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sub Category Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Status</label>
                                    <select id="inputStatus" class="form-control" name="status">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
