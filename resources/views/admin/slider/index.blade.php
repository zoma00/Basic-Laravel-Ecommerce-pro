@extends('admin.admin_master')


@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
<h4>Home Slider </h4>
            <a href="{{route('add.slider') }}"><button class="btn btn-info">Add Slider</button> </a>
            <br><br>


                <div class="col-md-12">
                    <div class="card">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        
                        <div class="card-header">All Slider</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"width="5%">SL </th>
                                    <th scope="col"width="15%">Slider Title</th>
                                    <th scope="col"width="25%">Description</th>
                                    <th scope="col"width="15%">Image</th>
                                    <th scope="col"width="1%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($i= 1)
                                @foreach($sliders as $slider)
                                    <tr>
                                        <th scope="row">{{$i++ }}</th>
                                        <td>{{ $slider->title ?? 'NA' }}</td>
                                        <td>{{ $slider->description ?? 'NA' }}</td>

                                        <td> 
                                            <img src="{{ asset($slider->image) }}" style="height:40px; width:70px;" alt="Brand Image">
                                        </td>

                                                                            <td class="text-right">
                                        <div class="d-flex justify-content-end align-items-center gap-2">
                                            <a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-sm btn-info mr-2">Edit</a>

                                            <form action="{{ url('slider/delete/'.$slider->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete Slider ID: {{ $slider->id }}">Delete</button>
                                            </form>
                                        </div>
                                    </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>




                
        
            </div>
        </div>

        @endsection

