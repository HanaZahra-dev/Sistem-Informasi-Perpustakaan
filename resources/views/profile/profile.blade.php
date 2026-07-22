@extends('admin-lte.app')

@section('content')
<div class="container">
    <h3>Profil Admin</h3>

    <div class="card">
        <div class="card-body">
            <p><b>Nama:</b> {{ auth()->user()->name }}</p>
            <p><b>Email:</b> {{ auth()->user()->email }}</p>
        </div>
    </div>
</div>
@endsection