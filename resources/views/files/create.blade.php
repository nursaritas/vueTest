@extends('layouts.app')

@section('content')
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
                    <div class="card-header"></div>

                    <div class="card-body">
                        <upload-files :input_name="'users[]'" :post_url="'files/upload-file'" ></upload-files>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
