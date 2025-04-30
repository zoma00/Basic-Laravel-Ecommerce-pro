@extends('admin.admin_master')


@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
<h4> Admin Message </h4>
            


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
                        
                        

                        <div class="card-header">All Message Data</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"width="5%">SL </th>
                                    <th scope="col"width="15%"> Name</th>
                                    <th scope="col"width="25%">Email</th>
                                    <th scope="col"width="15%">Subject</th>
                                   <th scope="col"width="15%">Message</th>

                                    <th scope="col"width="1%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($i= 1)
                                @foreach($messages as $mess)
                                    <tr>
                                        <th scope="row">{{$i++ }}</th>
                                        <td>{{ $mess->name ?? 'NA' }}</td>
                                        <td>{{ $mess->email ?? 'NA' }}</td>
                                        <td>{{ $mess->subject ?? 'NA' }}</td>
                                        <td>{{ $mess->message ?? 'NA' }}</td>


                                      
                                    <td class="text-right">
                                        <div class="d-flex justify-content-end align-items-center gap-2">

                                            <form action="{{ url('contact/delete/'.$mess->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete Slider ID: {{ $mess->id }}">Delete</button>
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

