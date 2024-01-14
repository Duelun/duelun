@extends('app')

@section('content')
<div class="container side">
    <div class="pane">
        <h1>Veryify Email Address</h1>

        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
        </form>
    </div>
    <div class="pane">
        <h2>Supporters</h2>

        @include('supporters')
    </div>

    
</div>
@endsection
