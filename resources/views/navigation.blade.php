<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">UTas SmartSpend (USS)</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <!-- Check if the user is a guest (not logged in) -->
        @guest
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('home')}}">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('registration')}}">Registration</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('login')}}">Login</a>
        </li>
        @endguest

        <!-- Check if the user is authenticated (logged in) -->
        @auth
        <!--
        <li class="nav-item">
          <a class="nav-link" href="/expense_details">Expense Details</a>
        </li>
        -->

        <li class="nav-item">
          <a class="nav-link" href="{{ route('profile', ['id' => Auth::user()->id]) }}">Welcome <b>{{ Auth::user()->name }}</b></a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-danger" href="{{ route('logout')}}">Logout</a>
        </li>
        @endauth

      </ul>
    </div>
  </div>
</nav>
