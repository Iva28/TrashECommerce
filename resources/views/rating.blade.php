

@extends('layout')

@section('title', 'Rating')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="#">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Rating</span>
    @endcomponent

    <div class="container">
        <div>
            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <h2>Total trashes: {{$totalTrashes}}</h2>
            <h2>Total trashes: {{$totalTrashes}}</h2>
            <h2>Total trashes: {{$totalTrashes}}</h2>

            
            </div> <!-- end cart-table -->

        </div>

    </div> <!-- end cart-section -->


@endsection

