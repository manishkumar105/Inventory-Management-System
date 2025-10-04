@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Login</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
    
        @foreach($errors->all() as $error)
          <ul class = "alert alert-danger">
              {{$error}}  
            </ul>
        @endforeach
   
    @endif
    <form method="POST" action="{{ route('auth.login') }}">
        
        @csrf
       
        <input type="text" name="email" placeholder="Enter Email" class="form-control mb-2">
        <input type="password" name="password" placeholder="Enter Password" class="form-control mb-2">
        
        <button class="btn btn-success">Login</button>
    </form>
    Don't have an account?<a href="{{route('auth.showRegistration')}}"> Sign Up</a>
</div>
@endsection
