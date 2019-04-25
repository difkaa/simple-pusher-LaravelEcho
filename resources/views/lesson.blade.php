@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">Read Lesson</div>

            <div class="card-body">
                <ul class="item-group">
                    @foreach ($lesson as $less)
                        <li class="list-group-item">
                            <h2>{{$less->title}}</h2>
                            <hr>
                            {{$less->body}}
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>

@endsection
