@extends('admin.admin_master')


@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

    <!--=========Toastr at the admin_master blade file instead of if session-->

                        
                        <div class="card-header">All Categories</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brands as $brand)
                                    <tr>
                                        <th scope="row">{{ $brands->firstItem() + $loop->index }}</th>
                                        <td>{{ $brand->brand_name ?? 'NA' }}</td>
                                        <td> 
                                            <img src="{{ asset($brand->brand_image) }}" style="height:40px; width:70px;" alt="Brand Image">
                                        <td> 
                                            @if($brand->created_at == NULL)
                                                <span class="text-danger">No Date Set</span>
                                            @else
                                                {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                                                <form action="{{ url('brand/delete/'.$brand->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure to delete?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Delete Brand ID: {{ $brand->id }}">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    {{ $brands->links('vendor.pagination.bootstrap-4') }}

                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Brand</div>
                        <div class="card-body">
                            <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf 
                                <div class="form-group">
                                    <label for="categoryName">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="categoryName" value="{{ old('category_name') }}">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="categoryName">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="categoryName" value="{{ old('category_name') }}">
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endsection

