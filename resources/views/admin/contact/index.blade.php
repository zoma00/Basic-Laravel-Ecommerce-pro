@extends('admin.admin_master')


@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
<h4>Contact Page </h4>
            <a href="{{route('add.contact') }}"><button class="btn btn-info">Add Contact</button> </a>
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
                        
                        <div class="card-header">All Contact Data</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"width="5%">SL </th>
                                    <th scope="col"width="15%"> Contact address</th>
                                    <th scope="col"width="25%">Contact email</th>
                                    <th scope="col"width="15%">Contact phone</th>
                                    <th scope="col"width="1%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($i= 1)
                                @foreach($contacts as $con)
                                    <tr>
                                        <th scope="row">{{$i++ }}</th>
                                        <td>{{ $con->address ?? 'NA' }}</td>
                                        <td>{{ $con->email ?? 'NA' }}</td>
                                        <td>{{ $con->phone ?? 'NA' }}</td>

                                      
                                    <td class="text-right">
                                        <div class="d-flex justify-content-end align-items-center gap-2">
                                            <a href="{{ url('contact/edit/'.$con->id) }}" class="btn btn-sm btn-info mr-2">Edit</a>

                                            <form action="{{ url('contact/delete/'.$con->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete Slider ID: {{ $con->id }}">Delete</button>
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

