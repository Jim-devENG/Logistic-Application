<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
       <div class="container">
        <div class="col-lg-6 pt-5">
            @if($message = Session::get("success"))

            <p> {{$message}}</p>
         @else
           <form action="" method="post">
            @csrf
               
          
        
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text"  name="name" class="form-control" id="exampleFormControlInput1"  placeholder="">
              </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" name="email"  class="form-control" id="exampleFormControlInput1" placeholder="">
              </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">account</label>
                <input type="number"  name="account" class="form-control" id="exampleFormControlInput1" placeholder="">
              </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">password</label>
                <input type="password"  name="password" class="form-control" id="exampleFormControlInput1" placeholder="">
              </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">status</label>
                <input type="text"  name="status" class="form-control" id="exampleFormControlInput1" placeholder="">
              </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">logic</label>
                <input type="text"  name="logic" class="form-control" id="exampleFormControlInput1" placeholder="">
              </div>
              
              <button type="submit"   class="btn btn-primary">submit</button>
           </form>

           @endif

        </div>
        

        <table class="table mt-3">
            <thead>
                <th>S/N</th>
                <th>Name</th>
                <th>Email</th>
                <th>Accont</th>
                <th>Password</th>
                <th>Logic</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </thead>

            <tbody>
                @foreach ($data_s as $data)
                <tr>
                   
                        
                  
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->password}}</td>
                    <td>{{$data->status}}</td>
                    <td>{{$data->logic}}</td>
                    <td>{{$data->account}}</td>
                    <td>{{$data->created_at}}</td>
                    <td><button class="btn btn-danger"><a href="/delete?id={{$data->id}}">Delete</a></button></td>

                   
                </tr>

                @endforeach
            </tbody>
        </table>
       </div>
</body>
</html>