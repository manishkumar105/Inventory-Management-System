@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registrations</h2>
    @if($errors->any())
    
        @foreach($errors->all() as $error)
          <ul class = "alert alert-danger">
              {{$error}}  
            </ul>
        @endforeach
   
    @endif
    <form method="POST" action="{{ route('auth.registration') }}">
        @csrf
        <input type="text" name="name" placeholder="Enter Name" class="form-control mb-2">
        <input type="text" name="email" placeholder="Enter Email" class="form-control mb-2">
        <input type="password" name="password" placeholder="Enter Password" class="form-control mb-2">
        <input type="password" name="password_confirmation" placeholder="Enter Confirm Password" class="form-control mb-2">
        <button class="btn btn-primary">Register</button>
    </form>
</div>
@endsection
