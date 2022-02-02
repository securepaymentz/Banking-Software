@extends('layouts.user')

@section('content')
<div class="container mt-3">
	<div class="nav-wrapper shadow">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link py-3 px-2 h-100 active" data-toggle="tab" href="#account-overview">{{ _lang('Account Statement') }}</a>
			</li>
			<li class="nav-item">
				<a class="nav-link py-3 px-2 h-100" data-toggle="tab" href="#all-transactions">{{ _lang('All Transaction') }}</a>
			</li>
			<li class="nav-item">
				<a class="nav-link py-3 px-2 h-100" data-toggle="tab" href="#my-referred-users">{{ _lang('My Referred Users') }}</a>
			</li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div id="account-overview" class="container tab-pane bg-white py-2 px-3 p-lg-5 active">
				<form class="validate" autocomplete="off" method="post" action="{{ url('user/reports/account_statement/view') }}">
					@csrf
					<div class="table-responsive">
						<div class="table-content">
							<table class="table table-borderless">
								<thead>
									<tr>
										<th scope="col" width='32px'></th>
										<th scope="col">{{ _lang('Select Account') }} *</th>
										<th scope="col">{{ _lang('From') }} *</th>
										<th scope="col">{{ _lang('To') }} *</th>
										<th scope="col">{{ _lang('Status') }} *</th>
										<th scope="col" width='154px'></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td scope="row align-middle">
											<div class="d-flex justify-content-center">
												<div
													class="icon blue d-flex align-items-center justify-content-center">
													<img class="w-100" src="{{ asset('public/user_portal/assets/icons/card.png') }}"
														alt="triangle with equal sides"
														srcset="{{ asset('public/user_portal/assets/icons/card.svg') }}">
												</div>
											</div>
										</td>
										<td>
											<select class="form-control custom-select" name="account" required>
												@foreach(\App\Account::where('user_id',Auth::id())->get() as $user_account )
													<option value="{{ $user_account->id }}">{{ $user_account->account_number.' - '.$user_account->account_type->account_type.' ('.$user_account->account_type->currency->name.')' }}</option>
												@endforeach
											</select>
										</td>
										<td>
											<input type="text" class="form-control datepicker" name="date1" value="{{ isset($date1) ? $date1 : old('date1') }}" readOnly="true" placeholder="{{ _lang('From') }}">
										</td>
										<td>
											<input type="text" class="form-control datepicker" name="date2" value="{{ isset($date1) ? $date1 : old('date1') }}" readOnly="true" placeholder="{{ _lang('To') }}">
										</td>
										<td>
											<select class="form-control custom-select" name="status" required>
												<option value="all">{{ _lang('All') }}</option>
												<option value="complete">{{ _lang('Completed') }}</option>
												<option value="pending">{{ _lang('Pending') }}</option>								
												<option value="reject">{{ _lang('Rejected') }}</option>	
											</select>
										</td>
										<td>
											<button type="submit" class="btn bg-gray rounded py-2">{{ _lang('View Report') }}</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</form>
				
				
				<!-- Account Statement Report-->
				@if(isset($account_statement_reports))
					<div class="table container mt-4">
						<div class="table-wrapper shadow container bg-white px-5 py-4">
							<div class="d-flex align-items-center justify-content-between mb-4">
								<h5 class="mb-0">{{ _lang('Account Statement') }}</h5>
							</div>
							<div class="report-header mt-2 d-none">
								<h5>{{ isset($account) ? _lang('Account Statement of').' '.$acc->account_number.' - '.$acc->account_type->account_type : _lang('Account Statement') }}</h5>
								<h6>{{ isset($date1) ? date('d M, Y',strtotime($date1)).' '._lang('to').' '.date('d M, Y',strtotime($date2)) : '-------------  '._lang('to').'  -------------' }}</h6>
							</div>
							<table class="table table-borderless report-table">
								<thead>
									<tr>
										<th scope="col">{{ _lang('Date') }}</th>
										<th scope="col">{{ _lang('Account') }}</th>
										<th scope="col">{{ _lang('DR/CR') }}</th>
										<th scope="col">{{ _lang('Amount') }}</th>
										<th scope="col">{{ _lang('Type') }}</th>
										<th scope="col">{{ _lang('Status') }}</th>
										<th scope="col">{{ _lang('Details') }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($account_statement_reports as $transaction)
										<tr>
											<td class="font-weight-bold">{{ $transaction->created_at }}</td>
											<td class="text-gray">{{ $transaction->account->account_number }}</td>
											<td>
												@if($transaction->dr_cr == 'dr')
													<span class="badge badge-red">{{ _lang('Debit') }}</span>
												@elseif($transaction->dr_cr == 'cr')
													<span class="badge badge-green">{{ _lang('Credit') }}</span>
												@endif
											</td>
											<td class="font-weight-bold {{ $transaction->dr_cr == 'cr' ? 'text-green' : 'text-red' }} {{ $transaction->status == 'reject' ? 'text-rejected' : '' }}"><b>{{ $transaction->account->account_type->currency->name.' '.decimalPlace($transaction->amount) }}</b></td>
											<td class="text-gray">{{ ucwords(str_replace('_',' ',$transaction->type)) }}</td>
											<td>
												@if($transaction->status == 'pending')
													<span class="badge badge-gray">{{ _lang('Pending') }}</span>
												@elseif($transaction->status == 'complete')
													<span class="badge badge-green">{{ _lang('Completed') }}</span>
												@elseif($transaction->status == 'reject')
													<span class="badge badge-red">{{ _lang('Rejected') }}</span>
												@endif
											</td>
											<td><button class="btn bg-gray btn-sm ajax-modal" data-title="{{ _lang('View Transaction Details') }}" data-href="{{ url('user/view_transaction/' . $transaction->id) }}">{{ _lang('Details') }}</button></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				@endif
				
			</div>
			<div id="all-transactions" class="container tab-pane bg-white py-2 px-3 p-lg-5 fade">
				<form class="validate" method="post" action="{{ url('user/reports/all_transaction/view?tab=all-transactions') }}">
					@csrf
					<div class="table-responsive">
						<div class="table-content">
							<table class="table table-borderless">
								<thead>
									<tr>
										<th scope="col">{{ _lang('From') }} *</th>
										<th scope="col">{{ _lang('To') }} *</th>
										<th scope="col">{{ _lang('Transition Type') }} *</th>
										<th scope="col">{{ _lang('Status') }} *</th>
										<th scope="col" width='154px'></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<input type="text" class="form-control datepicker" name="date1" value="{{ isset($date1) ? $date1 : old('date1') }}" readOnly="true" placeholder="{{ _lang('From') }}" required>
										</td>
										<td>
											<input type="text" class="form-control datepicker" name="date2" value="{{ isset($date1) ? $date1 : old('date1') }}" readOnly="true" placeholder="{{ _lang('To') }}" required>
										</td>
										<td>
											<select class="form-control custom-select" name="type" id="type" required>
												<option value="all">{{ _lang('All') }}</option>
												<option value="deposit">{{ _lang('Deposit') }}</option>
												<option value="withdraw">{{ _lang('Withdraw') }}</option>							
												<option value="transfer">{{ _lang('Transfer') }}</option>							
												<option value="payment">{{ _lang('Payment') }}</option>							
												<option value="revenue">{{ _lang('Revenue') }}</option>							
												<option value="wire_transfer">{{ _lang('Wire Transfer') }}</option>	
											</select>
										</td>
										<td>
											<select class="form-control custom-select" name="status" id="status" required>
												<option value="all">{{ _lang('All') }}</option>
												<option value="complete">{{ _lang('Completed') }}</option>
												<option value="pending">{{ _lang('Pending') }}</option>								
												<option value="reject">{{ _lang('Rejected') }}</option>	
											</select>
										</td>
										<td>
											<button type="submit" class="btn bg-gray rounded py-2">{{ _lang('View Report') }}</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</form>
				
				<!-- All Transaction Report-->
				@if(isset($all_transaction_reports))
					<div class="table container mt-4">
						<div class="table-wrapper shadow container bg-white px-5 py-4">
							<div class="d-flex align-items-center justify-content-between mb-4">
								<h5 class="mb-0">{{ _lang('Account Statement') }}</h5>
							</div>
							<div class="report-header mt-2 d-none">
								<h5>{{ _lang('All Transaction') }}</h5>
								<h6>{{ isset($date1) ? date('d M, Y',strtotime($date1)).' '._lang('to').' '.date('d M, Y',strtotime($date2)) : '-------------  '._lang('to').'  -------------' }}</h6>
							</div>
							<table class="table table-borderless report-table">
								<thead>
									<tr>
										<th scope="col">{{ _lang('Date') }}</th>
										<th scope="col">{{ _lang('Account') }}</th>
										<th scope="col">{{ _lang('DR/CR') }}</th>
										<th scope="col">{{ _lang('Amount') }}</th>
										<th scope="col">{{ _lang('Type') }}</th>
										<th scope="col">{{ _lang('Status') }}</th>
										<th scope="col">{{ _lang('Details') }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($all_transaction_reports as $transaction)
										<tr>
											<td class="font-weight-bold">{{ $transaction->created_at }}</td>
											<td class="text-gray">{{ $transaction->account->account_number }}</td>
											<td>
												@if($transaction->dr_cr == 'dr')
													<span class="badge badge-red">{{ _lang('Debit') }}</span>
												@elseif($transaction->dr_cr == 'cr')
													<span class="badge badge-green">{{ _lang('Credit') }}</span>
												@endif
											</td>
											<td class="font-weight-bold {{ $transaction->dr_cr == 'cr' ? 'text-green' : 'text-red' }} {{ $transaction->status == 'reject' ? 'text-rejected' : '' }}"><b>{{ $transaction->account->account_type->currency->name.' '.decimalPlace($transaction->amount) }}</b></td>
											<td class="text-gray">{{ ucwords(str_replace('_',' ',$transaction->type)) }}</td>
											<td>
												@if($transaction->status == 'pending')
													<span class="badge badge-gray">{{ _lang('Pending') }}</span>
												@elseif($transaction->status == 'complete')
													<span class="badge badge-green">{{ _lang('Completed') }}</span>
												@elseif($transaction->status == 'reject')
													<span class="badge badge-red">{{ _lang('Rejected') }}</span>
												@endif
											</td>
											<td><button class="btn bg-gray btn-sm ajax-modal" data-title="{{ _lang('View Transaction Details') }}" data-href="{{ url('user/view_transaction/' . $transaction->id) }}">{{ _lang('Details') }}</button></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				@endif
				
			</div>
			<div id="my-referred-users" class="container tab-pane bg-white py-2 px-3 p-lg-5 fade">
				<div class="d-flex align-items-center justify-content-between mb-4">
					<h5 class="mb-0">{{ _lang('My Referred Users') }}</h5>
				</div>
				
				<table class="table table-borderless report-table">
					<thead>
						<tr>
							<th scope="col">{{ _lang('Created') }}</th>
							<th scope="col">{{ _lang('ID') }}</th>
							<th scope="col">{{ _lang('Account Type') }}</th>
							<th scope="col">{{ _lang('Name') }}</th>
							<th scope="col">{{ _lang('Email') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach(\App\User::where('refer_user_id',Auth::id())
										  ->orderBy('id','desc')
										  ->get() as $user)
							<tr>
								<td class="font-weight-bold">{{ date('d M, Y h:iA',strtotime($user->created_at)) }}</td>
								<td class="text-gray">{{ $user->id }}</td>
								<td class="font-weight-bold">{{ ucwords($user->account_type) }}</td>
								<td class="font-weight-bold">{{ $user->first_name.' '.$user->last_name }}</td>
								<td class="text-gray">{{ $user->email }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js-script')
<script>
	document.title = "{{ _lang('Reports') }}";
	$("#status").val("{{ isset($status) ? $status : 'all' }}");
	$("#type").val("{{ isset($type) ? $type : 'all' }}");
	
	$('.nav-tabs a').on('shown.bs.tab', function(event){
		var tab = $(event.target).attr("href");
		var url = "{{ url('user/reports') }}";
	    history.pushState({}, null, url + "?tab=" + tab.substring(1));
	});
	
	@if(isset($_GET['tab']))
	   $('.nav-tabs a[href="#{{ $_GET['tab'] }}"]').tab('show');  	   
	@endif
	
	$('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $($.fn.dataTable.tables( true ) ).css('width', '100%');
        $($.fn.dataTable.tables( true ) ).DataTable().columns.adjust().draw();
    });
	
</script>
@endsection


