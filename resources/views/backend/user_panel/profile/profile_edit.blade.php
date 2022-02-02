@extends('layouts.user')

@section('content')
<div class="container-xl">
	<h1 class="app-page-title">{{ _lang('Update Profile') }}</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body p-4">
					<form action="{{ url('profile/update')}}" autocomplete="off" class="validate" enctype="multipart/form-data" method="post">		
						<div class="row">
							<div class="col-md-6">
								@csrf
								<div class="form-group mb-3">
									<label class="control-label">{{ _lang('First Name') }}</label>
									<input type="text" class="form-control" name="first_name" value="{{ $profile->first_name }}" required>
								</div>
								<div class="form-group mb-3">
									<label class="control-label">{{ _lang('Last Name') }}</label>
									<input type="text" class="form-control" name="last_name" value="{{ $profile->last_name }}" required>
								</div>
								
								@if(Auth::user()->user_type == 'user' && $profile->account_type== 'business')
								<div class="form-group mb-3">
									<label class="control-label">{{ _lang('Business Name') }}</label>
									<input type="text" class="form-control" name="business_name" value="{{ $profile->business_name }}" required>
								</div>
								@endif
								
								
								<div class="form-group mb-3">
									<label class="control-label">{{ _lang('Email') }}</label>
									<input type="text" class="form-control" name="email" value="{{ $profile->email }}" required>
								</div>
								<div class="form-group mb-3">
									<label class="control-label">{{ _lang('Phone') }}</label>
									<input type="tel" class="form-control telephone" name="phone" value="{{ $profile->phone }}" required>
								</div>
								
								<div class="form-group mb-3">
									<label class="control-label">{{ _lang('Language') }}</label>
									<select class="form-control select2" name="language" required>
										{!! load_language( $profile->language != null ? $profile->language : get_option('language') ) !!}
									</select>
								</div>
                                
                                @if(Auth::user()->user_type == 'user')
									 <div class="form-group mb-3">
										<label class="control-label">{{ _lang('Date Of Birth') }}</label>						
										<input type="text" class="form-control datepicker" name="date_of_birth" value="{{ $profile->user_information->date_of_birth }}" required>
									 </div>

									 <div class="form-group mb-3">
										<label class="control-label">{{ _lang('Passport') }}</label>						
										<input type="text" class="form-control" name="passport" value="{{ $profile->user_information->passport }}" required>
									 </div>

									 <div class="form-group mb-3">
										<label class="control-label">{{ _lang('Country Of Residence') }}</label>						
										<select class="form-control" name="country_of_residence">
											<option value="">{{ _lang('Select Country Of Residence') }}</option>
							                {{ get_country_list($profile->user_information->country_of_residence) }}
										</select>
									 </div>

									 <div class="form-group mb-3">
										<label class="control-label">{{ _lang('Country Of Citizenship') }}</label>						
										<select class="form-control" name="country_of_citizenship">
											<option value="">{{ _lang('Select Country Of Citizenship') }}</option>
							                {{ get_country_list($profile->user_information->country_of_citizenship) }}
										</select>
									 </div>
								 @endif

								 <div class="form-group mb-3">
									<button type="submit" class="btn app-btn-primary">{{ _lang('Update Profile') }}</button>	
								</div>

							</div>
							<div class="col-md-6">
                                @if(Auth::user()->user_type == 'user')
								 <div class="form-group mb-3">
									<label class="control-label">{{ _lang('Address') }}</label>						
									<input type="text" class="form-control" name="address" value="{{ $profile->user_information->address }}" required>
								 </div>


								 <div class="form-group mb-3">
									<label class="control-label">{{ _lang('City') }}</label>						
									<input type="text" class="form-control" name="city" value="{{ $profile->user_information->city }}" required>
								 </div>

								 <div class="form-group mb-3">
									<label class="control-label">{{ _lang('State') }}</label>						
									<input type="text" class="form-control" name="state" value="{{ $profile->user_information->state }}" required>
								 </div>

								 <div class="form-group mb-3">
									<label class="control-label">{{ _lang('Zip') }}</label>						
									<input type="text" class="form-control" name="zip" value="{{ $profile->user_information->zip }}" required>
								 </div>
                                @endif
                                
								 <div class="form-group mb-3">
									<label class="control-label">{{ _lang('Profile Picture') }}</label>
									<input type="file" class="form-control dropify" data-default-file="{{ $profile->profile_picture != "" ? asset('public/uploads/profile/'.$profile->profile_picture) : '' }}" name="profile_picture" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG">
								</div>

							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

