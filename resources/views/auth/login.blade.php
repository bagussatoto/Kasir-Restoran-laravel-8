@extends('auth.main2')
@section('title','Login')

@push('css')
<style>
	.card {
		background-color: rgba(255, 255, 255, 0.5);
	}
	.form-control {
		background: rgba(255, 255, 255, 0.8);
	    box-shadow: 0 1px 5px -2px rgba(0,0,0,.2);
	}
</style>
@endpush

@section('content')
<div class="container">

	<div class="row pt-5">
		<div class="col-md-8">
			<div class="intro text-white">
				<h2><b><u>Aplikasi Table Service Restaurant.</u></b></h2>
				<b>Sebuah Aplikasi Table Service yang Dirancang dengan Sistem POS (Point Of Sales), yang Dimana didalamnya Berisikan Sistem Client Server</b>
			</div>
		</div>

		<div class="col-md-4">
          <div class="card bg-light-lightest shadow-md rounded">
            <div class="card-header bg-info-darkest pb-1">
                <h5 class="text-center text-white"><span class="oi oi-account-login"></span> <strong>Login Account</strong></h5>
            </div>
            <div class="card-body">
              <form class="form-auth-small" method="POST" action="{{ route('login') }}">
					@csrf
					<div class="form-group">
						<input type="text" class="form-control border-info {{$errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="Username..." required autofocus>

						@if ($errors->has('username'))
			            <span class="invalid-feedback" role="alert">
			                <strong>{{ $errors->first('username') }}</strong>
			            </span>
			        	@endif
					</div>
					<div class="form-group">
						<input type="password" class="form-control border-info {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" placeholder="Password..." required>

						@if ($errors->has('password'))
			            <span class="invalid-feedback" role="alert">
			                <strong>{{ $errors->first('password') }}</strong>
			            </span>
			       		@endif
					</div>
					<!-- <div class="form-group row">
                      <div class="col-sm-9">
                        <div class="form-check">
                          <input class="border-info" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                          <label class="form-check-label text-white">
                            Remember Me
                          </label>
                        </div>
                      </div>
                    </div> -->
					<button type="submit" class="btn btn-info btn-lg btn-block"><span class="oi oi-account-login"></span> <b>LOGIN</b></button>

			        @if (Route::has('password.request'))
					<div class="bottom">
						<span class="helper-text"><i class="oi oi-lock"></i> <a class="text-white" href="{{ route('password.request') }}">Lupa password?</a></span>
						<span class="helper-text"><i class="oi oi-lock"></i> <a class="text-primary-darker" href="{{ route('register') }}"><u>Register Akun</u></a></span>
					</div>
					@endif
				</form>
            </div>
            </div>

		</div>
	</div>

	
</div>
@endsection