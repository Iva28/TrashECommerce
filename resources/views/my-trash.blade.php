@extends('layout')

@section('title', 'My Trash')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>My Trash</span>
    @endcomponent

    <div class="container">
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
    </div>

    <div class="products-section my-orders container">
        <div class="sidebar">
            <ul>
              <li><a href="{{ route('users.edit') }}">My Profile</a></li>
              <li><a href="{{ route('orders.index') }}">My Orders</a></li>
              <li class="active"><a href="{{ route('trash.index') }}">My Trash</a></li>
            </ul>
        </div> <!-- end sidebar -->
        <div class="my-profile">
            <div class="products-header">
                <h1 class="stylish-heading">My Trash</h1>
            </div>

            <div>
                Total coins: {{$totalCoins}}
                <br />
                <br />

                <ul>
                    @foreach ($trashes as $trash)
                        <li>Address: {{$trash->city}}, {{$trash->address}}. Date: {{ $trash->created_at->format('d/m/Y H:i')}}. Coins: {{$trash->coins}} </li>
                    @endforeach
                </ul>
            </div>
            <div class="spacer"></div>
        </div>
    </div>

@endsection

@section('extra-js')
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection
