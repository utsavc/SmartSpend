<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <title>UTas SmartSpend (USS)- Initial</title>
</head>
<body>

  @include('navigation')


  @yield('content')
</div>


<script>
        // Automatically hide all elements with the "alert" class after 5 seconds
  setTimeout(function() {
    var alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
      alert.style.display = 'none';
    });
        }, 5000); // 5000 milliseconds = 5 seconds
      </script>

<!-- 
 <footer class="container p-3 text-center" style="position:absolute; bottom:0">
  <span>&copy; Web Development Conference <a href="">Privacy</a> <a href="">Terms</a></span>
</footer> -->



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>
</html>