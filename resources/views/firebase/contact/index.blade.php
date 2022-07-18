@extends('firebase.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <h4 class="alert alert-warning mb-2">{{ session('status') }}</h4>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Contact List - Total : {{$totalcontacts}}</h4>
                        <a href="{{ url('add-contact') }}" class="btn btn-primary btn-sm float-end">Add Contact</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @if ($contacts)
                                    @forelse ($contacts as $key => $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item['fname'] }}</td>
                                            <td>{{ $item['lname'] }}</td>
                                            <td>{{ $item['contact'] }}</td>
                                            <td>{{ $item['email'] }}</td>
                                            <td><a href="{{ url('edit/' . $key) }}"
                                                    class="btn btn-sm btn-success">Edit</a></td>
                                            <td><a href="{{ url('delete/' . $key) }}" class="btn btn-sm btn-danger">Delete</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No record found</td>
                                        </tr>
                                    @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
