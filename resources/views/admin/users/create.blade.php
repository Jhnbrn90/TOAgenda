@extends('admin.master') 
@section('content')
<div class="container">

    <div>
        <ol class="breadcrumb">
            <li><a href="/admin">Homepage</a></li>
            <li><a href="/admin/users">Gebruikers</a></li>
            <li class="active">Nieuwe gebruiker</li>
        </ol>
    </div>
    @include ('layouts.errors')

    <center>
        <h3>Nieuwe gebruiker aanmaken</h3>
        <div class="panel" style="max-width: 350px;">
            <div class="panel-body">
                <form action="/admin/users" method="POST" class="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="username">Naam</label>
                        <input type="text" name="username" class="form-control" autofocus required>
                    </div>

                    <div class="form-group">
                        <label for="password">Wachtwoord</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">Gebruiker opslaan</button>
                    </div>
                </form>
            </div>
        </div>
    </center>

</div>
@endsection