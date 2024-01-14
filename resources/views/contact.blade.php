@extends('app')

@section('content')
@if(session('alert_message'))
    <div class="alert alert-success">
        {{ session('alert_message') }}
    </div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger">
          <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
          </ul>
      </div>
    @endif
<div class="container side">

    <div class="pane">
        <h1>Contact</h1>
        <div class="note">
            <p class="justify">You may reach out to me by completing the contact form below. To get a response to your query in the best time possible please ensure you select the most appropriate subject.</p>
            <p class="justify">Please refrain from sending me advertisements or messages irrelevant to the content of the website. Thanks!</p>
        </div>

        {!! NoCaptcha::renderJs() !!}

        <form class="" method="post" action="/contact/send">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{old('name')}}" maxlength="200" />
            </div>
            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="text" class="form-control" id="email" name="email" required value="{{old('email')}}" maxlength="200" />
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <select id="subject" name="subject" class="form-control" required>
                    <option value="general">General</option>
                    <option value="legal">Legal</option>
                    <option value="support">Support</option>
                </select>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea type="text" class="form-control" id="message" placeholder="Enter your message here" name="message" maxlength="10000" required>{{old('message')}}</textarea>
            </div>
            {!! NoCaptcha::display() !!}
            <div class="form-group has-btn">
                <button type="submit" class="btn btn-primary" value="Send">Send</button>
            </div>

        </form>
    </div>
    <div class="pane">
        @include('supporters')
    </div>
</div>
@endsection
