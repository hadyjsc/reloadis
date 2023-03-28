@extends('layouts.app-stisla')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ ucfirst($role->name) }} Detail</h1>
        {{ Breadcrumbs::render('roles.show', $role) }}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <th scope="col" width="20%">Name</th>
                                <th scope="col" width="1%">Guard</th>
                            </thead>

                            @foreach($rolePermissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->guard_name }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="row">
                        <form method="post" action="{{ route('roles.destroy', $role->id) }}">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('roles.index')}}" class="btn btn-warning"><i class="fa fa-times"></i> Cancel</a>
                            <a href="{{route('roles.edit', $role->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Update</a>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
