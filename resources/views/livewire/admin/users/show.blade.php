@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h3>Пользователь: {{ $user->name }}</h3>
        @livewire('admin.users.user-detail', ['userId' => $user->id])
    </div>

    <script>
       document.addEventListener('success', function (event) {
            toastr.success(event.detail.message);
        });
    </script>
@endsection
