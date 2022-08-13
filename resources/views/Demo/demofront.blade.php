<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body style="background-color:#eee;">

  <div class="container-fluid col-lg-12" >

    <div class="row">
      <div class="contaier col-lg-12" style = "height:150px;">
        <!-- <h1 class="text-center">FAVEO CHAT</h1> -->
      </div>
    </div>
    <div class="row">

      <div class="container col-lg-12">
        <h3 class="text-center mt-4"style="color:skyblue;">FAVEO CHAT</h3>
      </div>
      <div class="container col-lg-12">
        <h3 class="text-center mt-3">Great to see you</h3>
      </div>

    <div class="contaier col-lg-12" style = "height:551px;">



    







      <div class="container col-lg-4 bg-light" style="margin-top:36px; height:435px;width:594px;">
        
        <main class="form-signin text-center" style="padding-top:80px;padding-right:55px;padding-left:55px;">
          <form method="POST" action="checkuser">
            <!-- <img class="mb-4" src="/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
            <!-- <h1 class="h3 mb-3 fw-bold">Login</h1> -->
          @csrf
            <div class="form-floating">
              <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
              <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mt-3">
              <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
              <label for="floatingPassword">Password</label>
            </div>
  
            <button class="w-100 btn btn-lg btn-primary mt-3 mb-3" type="submit">Login</button>
            <a class="btn btn-primary w-100 mb-3 btn-lg" href="forgotpass" role="button">Forgot Password</a>
            
          </form>
        </main>
      </div>
    </div>
</div>
    <div class="row">
    <div class="contaier col-lg-12" style = "height:150px;"></div>

    </div>
  </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>