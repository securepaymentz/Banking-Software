@extends('layouts.user')

@section('content')

<div class="container-xl">
	<h1 class="app-page-title">{{ _lang('Profile Overview') }}</h1>
	<div class="row">
		<div class="col-md-12">
			<div class="card p-3">
				<div class="card-body">
					<table class="table table-bordered">
						<tr><td colspan="2" class="text-center"><img class="img-thumbnail" src="{{ $user->profile_picture != "" ? asset('public/uploads/profile/'.$user->profile_picture) : asset('public/images/avatar.png') }}"></td></tr>
						<tr><td>{{ _lang('First Name') }}</td><td>{{ $user->first_name }}</td></tr>
						<tr><td>{{ _lang('Last Name') }}</td><td>{{ $user->last_name }}</td></tr>
						<tr><td>{{ _lang('ID Number') }}</td><td>{{ $user->id_number }}</td></tr>
						<tr><td>{{ _lang('Email') }}</td><td>{{ $user->email }}</td></tr>
						<tr><td>{{ _lang('Phone') }}</td><td>{{ $user->phone }}</td></tr>	
						<tr><td>{{ _lang('User Type') }}</td><td>{{ ucwords($user->user_type) }}</td></tr>	
						<tr><td>{{ _lang('Status') }}</td><td>{!! $user->status == 1 ? status(_lang('Active'),'success') : status(_lang('In-Active'),'danger') !!}</td></tr>	
						<tr><td>{{ _lang('Account Status') }}</td><td>{!! $user->account_status == 'Verified' ? status(_lang('Verified'),'success') : status(_lang('Unverified'),'danger') !!}</td></tr>	
						<tr><td>{{ _lang('Date Of Birth') }}</td><td>{{ $user->user_information->date_of_birth }}</td></tr>
						<tr><td>{{ _lang('Passport') }}</td><td>{{ $user->user_information->passport }}</td></tr>
						<tr><td>{{ _lang('Country Of Residence') }}</td><td>{{ $user->user_information->country_of_residence }}</td></tr>
						<tr><td>{{ _lang('Country Of Citizenship') }}</td><td>{{ $user->user_information->country_of_citizenship }}</td></tr>
						<tr><td>{{ _lang('Address') }}</td><td>{{ $user->user_information->address }}</td></tr>
						<tr><td>{{ _lang('City') }}</td><td>{{ $user->user_information->city }}</td></tr>
						<tr><td>{{ _lang('State') }}</td><td>{{ $user->user_information->state }}</td></tr>
						<tr><td>{{ _lang('Zip') }}</td><td>{{ $user->user_information->zip }}</td></tr>
						
						@if($user->user_information->others != '')
						
							@php 
								$others = unserialize($user->user_information->others); 
							@endphp

							@foreach($others as $key => $val)
								<tr><td>{{ str_replace("_"," ",$key) }}</td><td>{{ $val }}</td></tr>
							@endforeach

						@endif

					</table>
					
					<table class="table app-table-hover">
						<thead>
							<th>{{ _lang('Account') }}</th>
							<th>{{ _lang('Type') }}</th>
							<th class="text-right">{{ _lang('Current Balance') }}</th>
							<th>{{ _lang('Status') }}</th>
							<th class="text-center">{{ _lang('Details') }}</th>
						</thead>
						<tbody>
							@foreach($user->accounts as $account)
								<tr>
									<td>{{ $account->account_number }}</td>
									<td>{{ $account->account_type->account_type }}</td>
									<td class="text-right">{{ $account->account_type->currency->name.' '.get_account_balance($account->id, $account->user_id) }}</td>
									<td>{{ $account->status == 1 ? _lang('Active') : _lang('Blocked') }}</td>
									<td class="text-center"><button class="btn-sm app-btn-secondary ajax-modal" data-title="{{ _lang('View Account Details') }}" data-href="{{ url('user/accounts/'.$account->id) }}">{{ _lang('View') }}</button></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


