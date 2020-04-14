@extends('layouts.app')

@section('content')
    <html>
    <head>
        <meta name="viewport" content="width=device-width">
        <title>Cloudinary Image Upload</title>
        <meta name="description" content="Prego is a project management app built for learning purposes">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body>
    <div class="sidenav">
        <br><br>

        <a href="#" class=""  role="" aria-expanded="false">
            Welcome
            {{ Auth::user()->name }} <span class=""></span>
        </a>


        <a href="{{ url('files') }}">Files</a>
        <a href="{{ url('cloud') }}">Cloud Files</a>

    </div>

    <div class="container" style="margin-top: 100px;">




            <div class="row">

                <div class="container" style="margin-bottom: 15px;">
                    <div class="row">
                        <br>

                        <div class="card-header col-md-4"><a href="{{ url('/home') }}" class="btn btn-success btn-lg">  <span class="glyphicon glyphicon-upload"></span></a> </div>

                        <h5> CONNECTED CLOUD AND SAVE DATABASE</h5>



                    </div>

                </div>
            </div>




            <div class="container" id="displayImages">
                    <div class="row">
                        <nav class="navbar navbar-expand-sm bg-success navbar-dark">
                            <h4 class="text-center">
                               Search
                            </h4>
                        </nav>
                        <input  class="col-md-12 form-control" style="margin-bottom: 25px;"    type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                    </div>

                    <div class="row">
                        @if($images)
                            <table class="table  table-bordered" id="myTable">
                                <thead>
                                <th> <h3  class="center"> File</h3></th>
                                <th> <h3  class="center"> Name</h3></th>
                                <th><h3></h3></th>
                                </thead>

                                @foreach($images as $image)
                                    <tr>

                                        <td style="min-width: 150px !important;">   <a   href="{{$image->image_url}}" target="_blank" >
                                                <img style="max-height:150px;max-width: 150px; display: block;  margin-left: auto;  margin-right: auto; width: 50%;"
                                                     src="{{asset('uploads/'.$image->image_name)}}" class="img-responsive img-thumbnail center" alt="{{$image->image_name}}">
                                            </a> </td>


                                        <td> <p class="text-center ">{{ $image->image_name }} </p></td>
                                        <td>
                                            <a  href="/Image/destroy/{{ $image->id }}">  <button class="btn"><i class="fa fa-trash"></i></button></a>

                                        </td>

                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </div>


            </div>
    </div>
    </body>
    </html>
@endsection
 <style>
     .center
     {
         display: block;
         margin-left: auto;
         margin-right: auto;
         width: 50%;
     }
     .table td {
         text-align: center;
     }
     table.table-bordered{
         border:0.1px solid darkgreen;
         margin-top:20px;
     }
     table.table-bordered > thead > tr > th{
         border:0.1px solid darkgreen;
     }
     table.table-bordered > tbody > tr > td{
         border:0.1px solid darkgreen;
     }

     .btn {
         background-color: mediumseagreen;
         border: none;
         color: white;
         padding: 12px 16px;
         font-size: 16px;
         cursor: pointer;
     }

     /* Darker background on mouse-over */
     .btn:hover {
         background-color: darkgreen;
     }

 </style>

<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

</script>