@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h3>Список пользователей</h3>
        @livewire('admin.users.user-table')
    </div>
@endsection
