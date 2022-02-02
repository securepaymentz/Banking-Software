@extends('layouts.user')

@section('content')
<div class="container-xl">
	<h1 class="app-page-title">{{ _lang('My Referral Link') }}</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Referral Link') }}</label>
								<input type="text" class="form-control" value="{{ url('register?ref=' . md5(Auth::id())) }}" readonly="true">
							</div>
						</div>	
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

