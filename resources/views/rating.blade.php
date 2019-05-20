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
            <h2>User of the month: {{$userMonth->name}}</h2>
            <div>
                {!! Form::open(array('method' => 'post', 'id'=>'form' )) !!}
                    {!! Form::select('city', array_merge(['' => 'Please Select'], $cities), null, ['class' => 'form-control']) !!} 
                {!! Form::close() !!} 
            </div>
            <h2 id='res'></h2>
        </div> 
    </div>
<script>
    $('#form option:first').attr('disabled', true);
    
    $('#form select').on('change', () => {
        let data = new FormData();
        data.append('city', $('#form option:selected').val());
        $.ajax({
            type: "POST", 
            url: '{{ route('rating.city') }}',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: data,
            contentType: false,
            processData: false,
            success: function(user){ 
                $("#res").text('User: ' + user['name']);
            }
        });
    });
</script>
@endsection

