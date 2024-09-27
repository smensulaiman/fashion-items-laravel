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
                            <h4>Edit Category</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('admin.child-category.update', $childCategory->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="selCategory">Category</label>
                                    <select id="selCategory" class="form-control" name="category">
                                        <option selected disabled>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$category->id === $childCategory->subCategory->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sub Category</label>
                                    <select class="form-control" name="sub_category" id="selSubCategory">
                                        <option value="{{ $childCategory->subCategory->id }}"
                                                selected>{{ $childCategory->subCategory->name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="childCategory">Child Category</label>
                                    <input class="form-control" type="text" name="name" id="childCategory"
                                           value="{{ $childCategory->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Status</label>
                                    <select id="inputStatus" class="form-control" name="status">
                                        <option value="1" {{$childCategory->status ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{$childCategory->status ? '' : 'selected'}}>Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('body').on('change', '#selCategory', function (e) {
                let selectedCategoryId = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: '{{ route('admin.sub-category.by-category') }}',
                    data: {
                        category_id: selectedCategoryId
                    },
                    success: function (data) {
                        //console.log(data);
                        $('#selSubCategory').html('<option selected disabled>Select Subcategory</option>');
                        $.each(data, function (index, val) {
                            console.log(val.id)
                            $('#selSubCategory').append(`<option value="${val.id}">${val.name}</option>`)
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush

