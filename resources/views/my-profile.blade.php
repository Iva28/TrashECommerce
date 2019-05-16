@extends('layout')

@section('title', 'My Profile')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>My Profile</span>
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

    <div class="products-section container">
        <div class="sidebar">
            <ul>
              <li class="active"><a href="{{ route('users.edit') }}">My Profile</a></li>
              <li><a href="{{ route('orders.index') }}">My Orders</a></li>
              <li><a href="{{ route('trash.index') }}">My Trash</a></li>
            </ul>
        </div> <!-- end sidebar -->
        <div class="my-profile">
            <div class="products-header">
                <h1 class="stylish-heading">My Profile</h1>
            </div>
                <div style="width: 350px;">
                    <img id="user-avatar" src="storage/{{$user->avatar}}">
                    {!! Form::open(['method' => 'post', 'files' => true, 'id' => 'upload_form']) !!}
                    {!! Form::file('fileToUpload',  ['class' => 'custom-file-input', "accept" => ".jpeg,.png,.jpg,.gif,.svg", 'onchange' => '$(this).closest("form").submit()']) !!}
                    {!! Form::close() !!}
                    <script>
                        //function send() {
                        $('#upload_form').submit(function(event) {
                            event.preventDefault();
                            var data = new FormData($(this)[0]);
                            data.append('fileToUpload', $('#upload_form')[0].children[1].files[0]);
                            $.ajax({
                                type: 'POST',
                                url: '{{ route('users.upload-image') }}',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')                                    
                                },
                                enctype: 'multipart/form-data',
                                data: data,
                                contentType: false,
                                processData: false,
                                mimeType: "multipart/form-data",
                                success: function (response) {
                                    // $( '#user-avatar' ).attr('src', response);
                                    $( '#user-avatar' ).attr('src', "storage/".concat(response));
                                    $('input[name="avatar"]').attr('value', response);
                                }
                            });
                        });
                    </script>
                </div>

            <div>
                <form action="{{ route('users.update') }}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="form-control">
                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Name" required>
                    </div>

                    <div class="form-control">
                        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" required>
                    </div>
                    <div class="form-control">
                        <input id="password" type="password" name="password" placeholder="Password">
                        <div class="psw">Leave password blank to keep current password</div>
                    </div>
                    <div class="form-control">
                        <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                    <div class="form-control">
                        <input id="phone" type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="994 00 123 45 67" required>
                    </div>
                    <input type="hidden" id="avatar" name="avatar" value="{{ old('avatar', $user->avatar) }}" >
                    <div>
                        <button type="submit" class="my-profile-button">Update Profile</button>
                    </div>
                </form>
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
