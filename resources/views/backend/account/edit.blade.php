@extends('layouts.app')

@section('content')
<div class="sb-page-header pb-10 sb-page-header-dark bg-gradient-primary-to-secondary">
	<div class="container-fluid">
		<div class="sb-page-header-content py-5">
			<h1 class="sb-page-header-title">
				<div class="sb-page-header-icon"><i data-feather="edit"></i></div>
				<span>{{ _lang('Update Account') }}</span>
			</h1>
		</div>
	</div>
</div>


<div class="container-fluid mt-n10">
	<div class="row">
		<div class="col-lg-6">
			<div class="card">		
				<div class="card-body">
					<h4 class="card-title">{{ _lang('Update Account') }}</h4>
					<form method="post" class="validate" autocomplete="off" action="{{action('AccountController@update', $id)}}" enctype="multipart/form-data">
						{{ csrf_field()}}
						<input name="_method" type="hidden" value="PATCH">				
						<div class="col-lg-12">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">{{ _lang('Account Number') }}</label>						
									<input type="text" class="form-control" name="account_number" value="{{ $account->account_number }}" required>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">{{ _lang('Account Owner') }}</label>						
									<select class="form-control select2" name="user_id" required>
						                <option value="">{{ _lang('Select User') }}</option>
						                @foreach ( \App\User::where('status',1)->where('user_type','user')->get() as $user )
											<option value="{{ $user->id }}" {{ $account->user_id == $user->id ? 'selected' : '' }}>{{ $user->first_name.' '.$user->last_name }}</option>
						                @endforeach
									</select>	
								</div>
							</div>
						    
						    <div class="col-md-12">
								<div class="form-group">
									<label class="control-label">{{ _lang('Status') }}</label>						
									<select class="form-control" name="status" required>
						                 <option value="1" {{ $account->status == '1' ? 'selected' : '' }}>{{ _lang('Active') }}</option>
						                 <option value="0" {{ $account->status == '0' ? 'selected' : '' }}>{{ _lang('Blocked') }}</option>
									</select>	
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">{{ _lang('Description') }}</label>						
									<textarea class="form-control" name="description">{{ $account->description }}</textarea>
								</div>
							</div>
						
							<div class="col-md-12">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
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


