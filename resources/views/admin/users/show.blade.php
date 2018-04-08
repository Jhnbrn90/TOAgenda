@extends ('admin.master') 
@section('content')
<div class="container">
    <div>
        <ol class="breadcrumb">
            <li><a href="/admin">Homepage</a></li>
            <li><a href="/admin/users">Gebruikers</a></li>
            <li class="active">{{ $user->name }}</li>
        </ol>
    </div>
    @include('layouts.errors')

    <center>
        <div class="panel panel-default" style="max-width: 400px;">
            <div class="panel-body">
                <form class="form" action="/admin/users/{{ $user->id }}" method="POST">
                    {{ csrf_field() }} {{ method_field('patch') }}
                    <div class="form-group">
                        <label for="username">Naam</label>
                        <input name="username" style="text-align: center;" type="text" class="form-control" id="username" value="{{ $user->name }}"
                            placeholder="{{ $user->name }}" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" style="text-align: center;" type="email" class="form-control" id="email" placeholder="{{ $user->email }}"
                            value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Wachtwoord</label>
                        <input type="password" style="text-align:center;" name="password" class="form-control" id="password" placeholder="Laat dit veld leeg om niet te wijzigen.">
                    </div>
                    <button type="submit" class="btn btn-success">Wijzigingen opslaan</button>
                </form>
                <hr>
                <form class="form" action="/admin/users/{{ $user->id }}" method="POST">
                    {{ csrf_field() }} {{ method_field('delete') }}
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger" onClick="return confirm('Zeker weten?');">Gebruiker verwijderen</button>
                    </div>
                </form>
            </div>
        </div>
    </center>
</div>
@endsection