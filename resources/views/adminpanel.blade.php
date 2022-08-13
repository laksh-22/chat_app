@extends('layouts.app')
@section('content')


<div class="content-wrapper">




@if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
  @endif
  <br>

   


<div class="container mt-4 bg-light">
    <!-- <h1 class="text-center">Agent List</h1> -->

    <!-- <form method="POST" action="toAgentPanel">
        @csrf
        <button type="submit">Agent Panel</button>
    </form> -->
    
    <main class="form-signin text-center">
        <form method="GET" action="/adminpanel">
            @csrf
            <div class="form-floating mt-3 text-right">
            <h1 class="text-center">Agent List</h1> 
                <input type="text" name="search" placeholder="search">
                <button type="submit">Search</button>
            </div>                                  
        </form>
    </main>

</div>




<div class="container col-10 mt-4">
 <table class="table table-bordered text-center">
    <thead class = "table-dark">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($lists as $list)
            <tr>
                <td>{{ $list['id'] }}</td>
                <td>{{ $list['name'] }}</td>
                <td>{{ $list['email'] }}</td>
                <td>
                    <a href = "editagent/{{$list['id']}}/{{$list['name']}}"><button class = "btn btn-primary" type="button">Edit</button></a>
                    <a href = "deleteagent/{{$list['id']}}"><button class = "btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button></a>    
                </td>
            </tr>
        @endforeach
    </tbody>

 </table>
 </div>

<!-- <h1>Hello Admin</h1>
{{session('role')}}
<a href="logout">Logout</a> -->

<!-- <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Starter Page</li>
</ol>
</div>
</div>
</div>
</div> -->


<!-- <div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-4">
            @if(isset($successMessage))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{$successMessage}}</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
           <div class="card">
              <div class="card-body">
                  <h1 class="card-title fw-bold">Add Agent</h1>
                  <p class="card-text">
                
                </p>
<a href="#" class="card-link">Card link</a>
<a href="#" class="card-link">Another link</a>
</div>
</div>
<div class="card card-primary card-outline">
<div class="card-body">
<h5 class="card-title">Card title</h5>
<p class="card-text">
Some quick example text to build on the card title and make up the bulk of the card's
content.
</p>
<a href="#" class="card-link">Card link</a>
<a href="#" class="card-link">Another link</a>
</div>
</div>
</div>

<div class="col-lg-6">
<div class="card">
<div class="card-header">
<h5 class="m-0">Featured</h5>
</div>
<div class="card-body">
<h6 class="card-title">Special title treatment</h6>
<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
<a href="#" class="btn btn-primary">Go somewhere</a>
</div>
</div>
<div class="card card-primary card-outline">
<div class="card-header">
<h5 class="m-0">Featured</h5>
</div>
<div class="card-body">
<h6 class="card-title">Special title treatment</h6>
<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
<a href="#" class="btn btn-primary">Go somewhere</a>
</div>
</div>
</div>

</div>

</div>
</div> -->

</div> 


@endsection