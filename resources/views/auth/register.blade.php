@extends('layouts.login')

@section('content')
<div class="signup-section auth-section">

	<div class="row m-0 h-100">
		<div class="auth-col-main bg-white col-12 col-lg-8 order-2 h-100 align-self-stretch">
			<div class="curve-container">
				<div class="curve-top"></div>
				<div class="curve-bottom"></div>
			</div><!--//curve-container-->
			<div class="over-curve">
				<div class="auth-col-main-inner mx-auto px-5">
					<div class="auth-option text-center text-lg-right pt-4 mb-5">
					{{ _lang('Already have an account?') }} <a class="ml-2 more-link" href="{{ url('login') }}">Sign in <strong>&rarr;</strong></a>              
					</div>
					
					<div class="site-logo mb-4 text-center"><a class="navbar-brand" href=""><img class="logo-icon mr-2" src="{{ get_logo() }}" alt="logo"></a></div>   
					
					<div class="auth-wrapper mx-auto">
						<h2 class="auth-heading text-center mb-4">{{ _lang('Create an account') }}</h2>
						
						<div class="auth-form-container text-left mx-auto"> 
							<form method="POST" class="auth-form signup-form validate" autocomplete="off" action="{{ route('register') }}" novalidate>
								@csrf
								
								<div class="form-group row">
									<div class="col-md-12">
										<select class="form-control" id="account_type" name="account_type" required>
										  <option value="">{{ _lang('Select Account Type') }}</option>
										  <option value="personal" {{ old('account_type') == 'personal' ? 'selected' : '' }}>{{ _lang('Personal') }}</option>
										  <option value="business" {{ old('account_type') == 'business' ? 'selected' : '' }}>{{ _lang('Business') }}</option>
										</select>
										@if ($errors->has('account_type'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('account_type') }}</strong>
											</span>
										@endif
									</div>
								</div>
								
								<div class="form-group row {{ old('account_type') == 'business' ? '' : 'd-none' }}" id="business_name">
								   <div class="col-md-12">
										<input type="text" placeholder="{{ _lang('Business Name') }}" class="form-control{{ $errors->has('business_name') ? ' is-invalid' : '' }}" name="business_name" value="{{ old('business_name') }}">

										@if ($errors->has('business_name'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('business_name') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row">

									<div class="col-md-6">
										<input id="first_name" type="text" placeholder="{{ _lang('First Name') }}" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

										@if ($errors->has('first_name'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('first_name') }}</strong>
											</span>
										@endif
									</div>

									<div class="col-md-6">
										<input id="last_name" type="text" placeholder="{{ _lang('Last Name') }}" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>

										@if ($errors->has('last_name'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('last_name') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row">

									<div class="col-md-12">
										<input id="email" type="email" placeholder="{{ _lang('E-Mail Address') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

										@if ($errors->has('email'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
										@endif
									</div>
								</div>
								
								<div class="form-group row">

									<div class="col-md-12">
										<input type="phone" placeholder="{{ _lang('Mobile') }}" class="form-control phone{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone','+1') }}" required>

										@if ($errors->has('phone'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('phone') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row">

									<div class="col-md-6">
										<input id="password" type="password" placeholder="{{ _lang('Password') }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

										@if ($errors->has('password'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('password') }}</strong>
											</span>
										@endif
									</div>
								
								   <div class="col-md-6">
										<input id="password-confirm" type="password" class="form-control" placeholder="{{ _lang('Confirm Password') }}" name="password_confirmation" required>
									</div>
								</div>

								<div class="form-group row">

									<div class="col-md-6">
										<input id="date_of_birth" type="text" placeholder="{{ _lang('Date Of Birth') }}" class="form-control datepicker{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" value="{{ old('date_of_birth') }}" required="true" readonly="true">

										@if ($errors->has('date_of_birth'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('date_of_birth') }}</strong>
											</span>
										@endif
									</div>

									<div class="col-md-6">
										<input id="passport" type="text" placeholder="{{ _lang('Passport') }}" class="form-control{{ $errors->has('passport') ? ' is-invalid' : '' }}" name="passport" value="{{ old('passport') }}" required>

										@if ($errors->has('passport'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('passport') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<div class="col-md-6">
										<select id="country_of_residence" class="form-control select2{{ $errors->has('country_of_residence') ? ' is-invalid' : '' }}" name="country_of_residence" required>
										   <option value="">{{ _lang('Country Of Residence') }}</option>
										   {{ get_country_list(old('country_of_residence')) }}
										</select>

										@if ($errors->has('country_of_residence'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('country_of_residence') }}</strong>
											</span>
										@endif
									</div>

									<div class="col-md-6">
										<select id="country_of_citizenship" class="form-control select2{{ $errors->has('country_of_citizenship') ? ' is-invalid' : '' }}" name="country_of_citizenship" required>
										   <option value="">{{ _lang('Country Of Citizenship') }}</option>
										   {{ get_country_list(old('country_of_citizenship')) }}
										</select>

										@if ($errors->has('country_of_citizenship'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('country_of_citizenship') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<div class="col-md-12">
										<textarea id="address" type="text" placeholder="{{ _lang('Address') }}" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" required>{{ old('address') }}</textarea>

										@if ($errors->has('address'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('address') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row">

									<div class="col-md-12">
										<input type="text" placeholder="{{ _lang('City') }}" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" required>

										@if ($errors->has('city'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('city') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row">

									<div class="col-md-12">
										<input type="text" placeholder="{{ _lang('State') }}" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ old('state') }}" required>

										@if ($errors->has('state'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('state') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row">

									<div class="col-md-12">
										<input type="text" placeholder="{{ _lang('Zip') }}" class="form-control{{ $errors->has('zip') ? ' is-invalid' : '' }}" name="zip" value="{{ old('zip') }}" required>

										@if ($errors->has('zip'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('zip') }}</strong>
											</span>
										@endif
									</div>
								</div>
								
								<input type="hidden" name="ref" value="{{ isset($_GET['ref']) ? $_GET['ref'] : '' }}"/>
												
								<div class="legal-note mb-4 text-center">By signing up, you agree to our <a href="#" class="theme-link">terms of service</a> and <a href="#" class="theme-link">privacy policy</a>.</div>
								<div class="text-center">
									<button type="submit" class="btn btn-gradient btn-submit theme-btn mx-auto">Create an account today</button>
								</div>
							</form><!--//auth-form-->
						</div><!--//auth-form-container-->
						
						<div class="divider my-5">
							<span class="or-text">{{ _lang('OR') }}</span>
						</div><!--//divider-->
						
						<div class="social-auth text-center mx-auto">                        
							<ul class="social-buttons list-unstyled">
								<li class="mb-3">
									<a href="{{ url('login') }}" class="btn btn-social btn-block">
										<span class="btn-text">{{ _lang('Login to your account') }}</span>
									</a>
								</li>
								<!--<li class="mb-3"><a href="#" class="btn btn-social btn-block"><span class="icon-holder"><span class="icon-holder"><img src="assets/images/social/twitter-logo.svg" alt=""></span></span><span class="btn-text">Sign up with Twitter</span></a></li>
								<li class="mb-3"><a href="#" class="btn btn-social btn-block"><span class="icon-holder"><span class="icon-holder"><img src="assets/images/social/github-logo.svg" alt=""></span></span><span class="btn-text">Sign up with Github</span></a></li>-->
							</ul>
						</div><!--//social-auth-->
						
						<div class="auth-footer py-5 mt-5 text-center">
							<div class="copyright mb-2">
								Free Version: <a href="https://securepaymentz.com/price">Secure Paymentz</a>
							</div>
							<div class="legal">
								<ul class="list-inline">
									<li class="list-inline-item"><a class="theme-link" href="#">{{ _lang('Privacy Policy') }}</a></li>
									<li class="list-inline-item">|</li>
									<li class="list-inline-item"><a class="theme-link" href="#">{{ _lang('Terms of Services') }}</a></li>
								</ul>
							</div>
						</div><!--//auth-footer-->
						
					</div><!--//auth-wrapper-->
				</div><!--//auth-col-main-inner-->
			</div><!--//over-curve-->
		</div><!--//col-auth-->
		
		<div class="auth-col-promo theme-bg-gradient p-4 p-xl-5 col-lg-4 d-none d-lg-block order-1 align-self-stretch">
			<div class="auth-col-promo-inner h-100">
				<div class="curve-container">
					<div class="curve-top"></div>
					<div class="curve-bottom"></div>
				</div><!--//curve-container-->
				
				<div class="auth-promo-content over-curve text-white text-center">
					<h4 class="autho-promo-heading text-center text-white mb-4">{{ _lang('#1 Banking Software') }}</h4>
					<div class="auth-promo-desc mx-auto d-inline-block">
						<ul class="list-unstyled mx-auto text-left">
							<li class="mb-3"><span class="theme-check-icon icon dripicons-checkmark mr-2"></span> {{ _lang('Unlimited Accounts') }}</li>
							<li class="mb-3"><span class="theme-check-icon icon dripicons-checkmark mr-2"></span> {{ _lang('100% White-Labeled') }}</li>
							<li class="mb-3"><span class="theme-check-icon icon dripicons-checkmark mr-2"></span> {{ _lang('API Banking Network') }}</li>
							<li class="mb-3"><span class="theme-check-icon icon dripicons-checkmark mr-2"></span> {{ _lang('Card System Adaptable') }}</li>
							
						</ul>
					</div><!--//auth-promo-desc-->
					
					<div class="auth-logos pt-5">
						<div class="row justify-content-center text-center">

							<div class="col-6 col-xl-4 mb-4">
								<img class="company-logo" src="{{ asset('public/login_assets/images/brands/visa.png?v=1.0') }}" alt="">
							</div>
							
							<div class="col-6 col-xl-4 mb-4">
								<img class="company-logo" src="{{ asset('public/login_assets/images/brands/master-card.png?v=1.0') }}" alt="">
							</div>
							
							<div class="col-6 col-xl-4 mb-4">
								<img class="company-logo" src="{{ asset('public/login_assets/images/brands/amex.png?v=1.0') }}" alt="">
							</div>
							
							<div class="col-6 col-xl-4 mb-4">
								<img class="company-logo" src="{{ asset('public/login_assets/images/brands/discover.png?v=1.0') }}" alt="">
							</div>
						
							<div class="col-6 col-xl-4 mb-4">
								<img class="company-logo" src="{{ asset('public/login_assets/images/brands/paypal.png?v=1.0') }}" alt="">
							</div>
							
							<div class="col-6 col-xl-4 mb-4">
								<img class="company-logo" src="{{ asset('public/login_assets/images/brands/bitcoin.png?v=1.0') }}" alt="">
							</div>
						</div>
					</div><!--//auth-logos-->
				</div><!--//auth-promo-content-->
			</div><!--//auth-col-promo-inner-->
		</div><!--//auth-col-promo-->
	</div><!--//row-->
</div><!--//signup-section-->

@endsection

@section('js-script')

<script>
$(document).on('change','#account_type',function(){
	if($(this).val() == 'business'){
		$("#business_name").removeClass('d-none');
	}else{
		$("#business_name").addClass('d-none');
	}
});
</script>
@endsection
