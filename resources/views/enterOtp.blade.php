<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>OTP</title>
  </head>
  <body>

  <!-- @if(isset($errorMessage))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>{{$errorMessage}}</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
    @endif -->

    @if(isset($successMessage))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{$successMessage}}</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
    @endif

    <!-- <div class="container mt-4 col-lg-4 bg-light">
       
       <main class="form-signin text-center">
         <form method="POST" action="checkotp">
           <h1 class="h3 mb-3 mt-4 fw-bold">Enter OTP</h1>
        
           @csrf

           <p class="mb-3">Enter the 6 Digit OTP sent on your mail for verification.</p>

           <div class="form-floating">
             <input type="text" class="form-control" id="floatingInput" name="otp" placeholder="Enter OTP" required>
             <label for="floatingInput">Enter OTP</label>
           </div>

           <button class="w-100 btn btn-lg btn-primary mt-3 mb-3" type="submit">Submit</button>
        
           
         </form>
       </main>
</div>
    -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>