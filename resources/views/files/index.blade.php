@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="sidenav">
        <br><br>

        <a href="#" class=""  role="" aria-expanded="false">
            Welcome
            {{ Auth::user()->name }} <span class=""></span>
        </a>


        <a href="{{ url('files') }}">Files</a>
        <a href="{{ url('cloud') }}">Cloud Files</a>

    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="{{ url('files/create') }}" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-upload"></span></a> </div>
<br>
                    <h5>ONLY DATABASE (NOT CONNECTED CLOUD)</h5>

                    <br>
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                    <div class="card-body">
                        @if($files->count())
                            <table class="table" id="myTable">
                                <th>Name</th>
                                <th>Size</th>
                                <th></th>
                                @foreach($files as $file)
                                    <tr>
                                        <td href="{{$file->file_url}}" target="_blank">{{ $file->filename }}</td>
                                        <td>{{ $file->size }} Bytes</td>
                                        <td>
                                            <a  href="/FileEntries/destroy/{{ $file->id }}">  <button class="btn"><i class="fa fa-trash"></i></button></a>
                                        </td>

                                    </tr>
                                @endforeach
                            </table>
                        @else
                            You have no files yet!
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

<style>

    .btn:hover {
        background-color: darkgreen;
    }
    .btn {
        background-color: mediumseagreen;
        border: none;
        color: white;
        padding: 12px 16px;
        font-size: 20px;
        cursor: pointer;
    }



    * {
        box-sizing: border-box;
    }

    #myInput {
        background-image: url('/css/searchicon.png');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
    }

    #myTable {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ddd;
        font-size: 18px;
    }

    #myTable th, #myTable td {
        text-align: left;
        padding: 12px;
    }

    #myTable tr {
        border-bottom: 1px solid #ddd;
    }

    #myTable tr.header, #myTable tr:hover {
        background-color: #f1f1f1;
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
            td = tr[i].getElementsByTagName("td")[0];
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

