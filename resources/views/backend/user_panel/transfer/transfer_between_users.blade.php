@extends('layouts.user')

@section('content')
<div class="container-xl">
	<h1 class="app-page-title text-center">{{ _lang('Transfer Between Users') }}</h1>
	<div class="row">
		<div class="col-lg-8 offset-lg-2">

			@if(Session::has('success'))
				<div class="alert alert-success alert-dismissible fade show">
	                <strong>{{ session('success') }}</strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>	
			@endif

			<div class="card">
				<div class="card-body p-4">
					<form method="post" class="validate" autocomplete="off" action="{{ url('user/transfer_between_users') }}">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-12 mb-3">
								<div class="form-group">
									<label class="control-label">{{ _lang('Debit Account') }}</label>						
									<select class="form-control auto-select" name="debit_account" data-selected="{{ old('debit_account') }}" required>
										<option value="">{{ _lang('Select Account') }}</option>
										@foreach(\App\Account::where('user_id',Auth::id())->where('status',1)->get() as $debit_account )
											<option value="{{ $debit_account->id }}">{{ $debit_account->account_number }}</option>
										@endforeach
									</select>
								</div>
							</div>
							
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="control-label">{{ _lang('User Email') }}</label>						
									<input type="email" class="form-control" name="user_email" value="{{ old('user_email') }}" required>
								</div>
							</div>
							
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="control-label">{{ _lang('Account Number') }}</label>						
									<input type="text" class="form-control" name="credit_account" value="{{ old('credit_account') }}" required>
								</div>
							</div>

							<div class="col-md-12 mb-3">
								<div class="form-group">
									<label class="control-label">{{ _lang('Amount') }}</label>						
									<input type="text" class="form-control float-field" name="amount" value="{{ old('amount') }}" required>
								</div>
							</div>

							<div class="col-md-12 mb-3">
								<div class="form-group">
									<label class="control-label">{{ _lang('Note') }}</label>						
									<textarea class="form-control" name="note">{{ old('note') }}</textarea>
								</div>
							</div>

							<div class="col-md-12 mb-3">
								<div class="form-group text-center">
									<button type="submit" class="btn app-btn-primary">{{ _lang('Make Transfer') }}</button>
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

