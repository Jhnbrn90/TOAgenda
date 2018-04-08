@extends ('admin.master') 
@section('content')

<div class="container">
    @include ('layouts.flash')

    <div>
        <ol class="breadcrumb">
            <li><a href="/admin">Homepage</a></li>
            <li class="active">Gebruikers</li>
        </ol>
    </div>

    <h3>Gebruikers ({{ $users->total() }})</h3>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Aangemaakt</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td><a href="/admin/users/{{ $user->id }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <center>
        <div class="add-user">
            <a href="/admin/users/create" class="btn btn-lg btn-primary">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                Gebruiker toevoegen
            </a>
        </div>

        {{ $users->links() }}
    </center>


</div>
@endsection