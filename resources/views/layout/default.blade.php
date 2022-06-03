<!DOCTYPE html>
<html lang="en" dir="{{ App::currentlocale() == 'ar'? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
            @if (App::currentlocale() === 'ar')
                <link href="{{ asset('css/bootstrap.rtl.css') }}" rel="stylesheet">
                @else
                <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
         @endif




        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link href="https://code.jquery.com/jquery-3.3.1.slim.min.js" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link href="{{ asset('css/headers.css') }}" rel="stylesheet">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"  rel="stylesheet"> </script>
        <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>



         <title>{{ config('app.name') }}</title>

</head>

 <body>
 <header class="p-3 mb-3 border-bottom">
       <div class="container">
       <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="{{ route('questions.index') }}" class="nav-link px-2 link-secondary">Questions</a></li>
          @auth
          <li><a href="{{ route('tags.index') }}" class="nav-link px-2 link-dark">Tags</a></li>
          @endauth
          @guest
          <li><a href="{{ route('login') }}" class="nav-link px-2 link-dark">LogIn</a></li>
          <li><a href="{{ route('register') }}" class="nav-link px-2 link-dark">Register</a></li>
          @endguest
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="get" action=" {{ route('questions.index') }}">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search" name="search">
        </form>



             <div class="me-2 dropdown text-end">
                      @auth
                          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset("images/profile_photo")}}/{{ Auth::user()->profile_photo_path }} " alt="mdo" width="32" height="32" class="rounded-circle">
                                                      {{ Auth::user()->name }}

                          </a>
                             <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                     <li><a class="dropdown-item" href="{{ route('show.user', Auth::user()->id) }}"> @lang('Profile') </a></li>
                                     <li><a class="dropdown-item" href="{{ route('questions.create') }}">@lang('add question')</a></li>
                                     <li><a class="dropdown-item" href="{{ URL::current() }}?lang=ar">lang (Ar)</a></li>
                                     <li><a class="dropdown-item" href="{{  URL::current() }}?lang=en">lang (En)</a></li>
                                     <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout.form').submit();">Logout</a></li>
                                     @if (Auth::user()->type == 'admin')
                                      <li><a class="dropdown-item" href="{{ route('all.user') }}">@lang('All-users')</a></li>
                                         @endif



                   @endauth
                             </ul>

           </div>
                               @auth
                      <x-notifications-menu />
                                @endauth

    </div>
</div>


   </header>
      <form id="logout.form" method="POST" action="{{ route('logout')}}"  >
                            @csrf


                          </form>
      <div class="container">
        <h2 class="mb-5 bg-light" style="text-align: center" >@yield('title')</h2>
        @yield('content')


    </div>

</body>

</html>
