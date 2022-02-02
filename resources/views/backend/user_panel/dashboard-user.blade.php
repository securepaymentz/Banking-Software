@extends('layouts.user')

@section('content')
<div class="container-xl">

	<h1 class="app-page-title">{{ _lang('Dashboard') }}</h1>
	
	<div class="row g-4 mb-4">
		<div class="col-12 col-lg-6">
			<div class="app-card app-card-progress-list h-100 shadow-sm">
				<div class="app-card-header p-3">
					<div class="row justify-content-between align-items-center">
						<div class="col-auto">
							<h4 class="app-card-title">{{ _lang('Account Overview') }}</h4>
						</div><!--//col-->
					</div><!--//row-->
				</div><!--//app-card-header-->
				<div class="app-card-body p-3">

					@php $currency = currency(true); @endphp
					
					<div class="table-responsive">
						<table class="table">
							<thead>
								<th>{{ _lang('Account') }}</th>
								<th class="text-right">{{ _lang('Balance') }}</th>
								<th>{{ _lang('Status') }}</th>
								<th class="text-center">{{ _lang('Details') }}</th>
							</thead>
							<tbody>
								@foreach($accounts as $account)
								<tr>
									<td>{{ $account->account_number }}</td>
									<td class="text-nowrap text-right"><b>{{ decimalPlace($account->balance, $currency) }}</b></td>
									<td>{{ $account->status == 1 ? _lang('Active') : _lang('Blocked') }}</td>
									<td class="text-center"><button class="btn-sm app-btn-secondary ajax-modal" data-title="{{ _lang('View Account Details') }}" data-href="{{ url('user/accounts/'.$account->id) }}">{{ _lang('View') }}</button></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>

				</div><!--//app-card-body-->
			</div><!--//app-card-->
		</div><!--//col-->
		
		<div class="col-12 col-lg-6">
			<div class="app-card app-card-progress-list h-100 shadow-sm">
				<div class="app-card-header p-3">
					<div class="row justify-content-between align-items-center">
						<div class="col-auto">
							<h4 class="app-card-title">{{ _lang('My Cards') }}</h4>
						</div><!--//col-->
					</div><!--//row-->
				</div><!--//app-card-header-->
				<div class="app-card-body p-3">
					
					<div class="table-responsive">
						<table class="table">
							<thead>
								<th>{{ _lang('Card Number') }}</th>
								<th>{{ _lang('Status') }}</th>
								<th>{{ _lang('CVV') }}</th>
								<th>{{ _lang('Expiry') }}</th>
								<th class="text-nowrap text-right">{{ _lang('Balance') }}</th>
							</thead>
							<tbody>
								@foreach($cards as $card)
								<tr>
									<td>{{ $card->card_number }}</td>
									<td>{{ $card->status == 1 ? _lang('Active') : _lang('Blocked') }}</td>
									<td>{{ $card->cvv }}</td>
									<td>{{ date('d/M/Y',strtotime($card->expiration_date)) }}</td>
									<td class="text-nowrap text-right"><b>{{ decimalPlace($card->balance, $currency) }}</b></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>

				</div><!--//app-card-body-->
			</div><!--//app-card-->
		</div><!--//col-->	
	</div><!--//row-->
	
</div><!--//container-fluid-->                        
@endsection
