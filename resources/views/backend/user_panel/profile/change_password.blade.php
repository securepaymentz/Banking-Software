@extends('layouts.user')

@section('content')
<div class="container-xl">
	<h1 class="app-page-title text-center">{{ _lang('Change Password') }}</h1>
	<div class="row">
		<div class="col-lg-6 offset-lg-3">
			<div class="card">
				<div class="card-body">
					<form action="{{ url('profile/update_password') }}" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
						@csrf
						<div class="form-group mb-3">
							<label>{{ _lang('Old Password') }}</label>
							<input type="password" class="form-control" name="oldpassword" required>
						</div>
						<div class="form-group mb-3">
							<label>{{ _lang('New Password') }}</label>
							<input type="password" class="form-control" name="password" required>							
						</div>
						<div class="form-group mb-3">
							<label>{{ _lang('Confirm Password') }}</label>
							<input type="password" class="form-control" id="password-confirm" name="password_confirmation" required>
						</div>
						<div class="form-group mb-3">
							<button type="submit" class="btn app-btn-primary">{{ _lang('Update Password') }}</button>	
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

