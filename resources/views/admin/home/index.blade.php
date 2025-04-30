@extends('admin.admin_master')


@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
<h4>Home About </h4>
            <a href="{{route('add.about') }}"><button class="btn btn-info">Add About</button> </a>
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
                        
                        <div class="card-header">All About</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"width="5%">SL </th>
                                    <th scope="col"width="15%">Home Title</th>
                                    <th scope="col"width="25%">Short Description</th>
                                    <th scope="col"width="15%">Long Description</th>
                                    <th scope="col"width="1%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($i= 1)
                                @foreach($homeabout as $about)
                                    <tr>
                                        <th scope="row">{{$i++ }}</th>
                                        <td>{{ $about->title ?? 'NA' }}</td>
                                        <td>{{ $about->short_dis ?? 'NA' }}</td>
                                        <td>{{ $about->long_dis ?? 'NA' }}</td>

                                      
                                    <td class="text-right">
                                        <div class="d-flex justify-content-end align-items-center gap-2">
                                            <a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-sm btn-info mr-2">Edit</a>

                                            <form action="{{ url('about/delete/'.$about->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete Slider ID: {{ $about->id }}">Delete</button>
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

