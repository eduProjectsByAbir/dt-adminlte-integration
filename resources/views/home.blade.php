@extends('layout.app')

@section('content')
<section class="landing">
    <div class="landing-inner">
      <img src="https://image.ibb.co/f4vhyS/logo.png" />
      <p>A social network for developers</p>
      <a href="{{ route('login') }}"><h1 style="color: white;">Login Here</h1></a>
      <div class="countdown"></div>
    </div>
  </section>
@endsection
