@extends('layouts.app')

@section('content')

<div class="sb-page-header pb-10 sb-page-header-dark bg-gradient-primary-to-secondary">
	<div class="container-fluid">
		<div class="sb-page-header-content py-5">
			<h1 class="sb-page-header-title">
				<div class="sb-page-header-icon"><i data-feather="settings"></i></div>
				<span>{{ _lang('General Settings') }}</span>
			</h1>
		</div>
	</div>
</div>

<div class="container-fluid mt-n10">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<ul class="nav nav-tabs">
						<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#general">{{ _lang('General Settings') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#banking">{{ _lang('Banking Settings') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#email">{{ _lang('Email Settings') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#logo">{{ _lang('Logo') }}</a></li>
					</ul>
					<div class="tab-content">
						
						<div id="general" class="tab-pane active">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title panel-title">{{ _lang('General Settings') }}</h4>
									<form method="post" class="appsvan-submit params-panel" autocomplete="off" action="{{ url('admin/administration/general_settings/update') }}" enctype="multipart/form-data">
										{{ csrf_field() }}
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Company Name') }}</label>						
													<input type="text" class="form-control" name="company_name" value="{{ get_option('company_name') }}" required>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Site Title') }}</label>						
													<input type="text" class="form-control" name="site_title" value="{{ get_option('site_title') }}" required>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Phone') }}</label>						
													<input type="text" class="form-control" name="phone" value="{{ get_option('phone') }}">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Email') }}</label>						
													<input type="text" class="form-control" name="email" value="{{ get_option('email') }}" required>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Timezone') }}</label>						
													<select class="form-control select2" name="timezone" required>
														<option value="">{{ _lang('-- Select One --') }}</option>
														{{ create_timezone_option(get_option('timezone')) }}
													</select>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Language') }}</label>						
													<select class="form-control select2" name="language" required>
														{!! load_language( get_option('language') ) !!}
													</select>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Email Verification') }}</label>						
													<select class="form-control" name="email_verification" required>
														<option value="No" {{ get_option('email_verification') == 'No' ? 'selected' : '' }}>{{ _lang('No') }}</option>
														<option value="Yes" {{ get_option('email_verification') == 'Yes' ? 'selected' : '' }}>{{ _lang('Yes') }}</option>
													</select>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Copyright Text') }}</label>						
													<input type="text" class="form-control" name="copyright" value="{{ get_option('copyright') }}">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Address') }}</label>						
													<textarea class="form-control" name="address">{{ get_option('address') }}</textarea>
												</div>
											</div>

											
											<div class="col-md-12">
												<div class="form-group">
													<button type="submit" class="btn btn-primary">{{ _lang('Save Settings') }}</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div id="banking" class="tab-pane">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title panel-title">{{ _lang('Banking Settings') }}</h4>
									<form method="post" class="appsvan-submit params-panel" autocomplete="off" action="{{ url('admin/administration/general_settings/update') }}" enctype="multipart/form-data">
										{{ csrf_field() }}
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Account Number Prefix').' ('._lang('Max 10').')' }}</label>						
													<input type="text" class="form-control" name="account_number_prefix" maxlength="10" value="{{ get_option('account_number_prefix') }}" required>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Next Account Number') }}</label>						
													<input type="number" class="form-control" name="next_account_number" maxlength="10" value="{{ get_option('next_account_number',date('Y').'1001') }}" required>
												</div>
											</div>
			
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Currency') }}</label>	
													<input type="text" class="form-control" name="currency" value="{{ get_option('currency','USD') }}" maxlength="3" minlength="3" required>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Allow Singup') }}</label>						
													<select class="form-control" name="allow_singup" required>
														<option value="yes" {{ get_option('allow_singup') == 'yes' ? 'selected' : '' }}>{{ _lang('Yes') }}</option>
														<option value="no" {{ get_option('allow_singup') == 'no' ? 'selected' : '' }}>{{ _lang('No') }}</option>
													</select>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Transfer Between Accounts Fee') }}</label>						
													<input type="text" class="form-control float-field valid" name="tbu_fee" value="{{ get_option('tbu_fee', 0) }}" required>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Transfer Between Accounts Fee Type') }}</label>						
													<select class="form-control valid" name="tbu_fee_type" required>
														<option value="fixed" {{ get_option('tbu_fee_type') == 'fixed' ? 'selected' : '' }}>{{ _lang('Fixed') }}</option>
														<option value="percent" {{ get_option('tbu_fee_type') == 'percent' ? 'selected' : '' }}>{{ _lang('Percent') }}</option>
													</select>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Card Funding Transfer') }}</label>						
													<input type="text" class="form-control float-field" name="cft_fee" value="{{ get_option('cft_fee', 0) }}" required>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Card Funding Transfer Fee Type') }}</label>						
													<select class="form-control" name="cft_fee_type" required>
														<option value="fixed" {{ get_option('cft_fee_type') == 'fixed' ? 'selected' : '' }}>{{ _lang('Fixed') }}</option>
														<option value="percent" {{ get_option('cft_fee_type') == 'percent' ? 'selected' : '' }}>{{ _lang('Percent') }}</option>
													</select>
												</div>
											</div>
											
											<div class="col-md-12">
												<div class="form-group">
													<button type="submit" class="btn btn-primary">{{ _lang('Save Settings') }}</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>

						
						<div id="email" class="tab-pane fade">
							<div class="card"> 
								<div class="card-body">
									<h4 class="card-title panel-title">{{ _lang('Email Settings') }}</h4>
									<form method="post" class="appsvan-submit params-panel" autocomplete="off" action="{{ url('admin/administration/general_settings/update') }}" enctype="multipart/form-data">
										{{ csrf_field() }}
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Mail Type') }}</label>						
													<select class="form-control niceselect wide" name="mail_type" id="mail_type" required>
														<option value="mail" {{ get_option('mail_type')=="mail" ? "selected" : "" }}>{{ _lang('PHP Mail') }}</option>
														<option value="smtp" {{ get_option('mail_type')=="smtp" ? "selected" : "" }}>{{ _lang('SMTP') }}</option>
													</select>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('From Email') }}</label>						
													<input type="text" class="form-control" name="from_email" value="{{ get_option('from_email') }}" required>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('From Name') }}</label>						
													<input type="text" class="form-control" name="from_name" value="{{ get_option('from_name') }}" required>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('SMTP Host') }}</label>						
													<input type="text" class="form-control smtp" name="smtp_host" value="{{ get_option('smtp_host') }}">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('SMTP Port') }}</label>						
													<input type="text" class="form-control smtp" name="smtp_port" value="{{ get_option('smtp_port') }}">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('SMTP Username') }}</label>						
													<input type="text" class="form-control smtp" autocomplete="off" name="smtp_username" value="{{ get_option('smtp_username') }}">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('SMTP Password') }}</label>						
													<input type="password" class="form-control smtp" autocomplete="off" name="smtp_password" value="{{ get_option('smtp_password') }}">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('SMTP Encryption') }}</label>						
													<select class="form-control smtp" name="smtp_encryption">
														<option value="ssl" {{ get_option('smtp_encryption')=="ssl" ? "selected" : "" }}>{{ _lang('SSL') }}</option>
														<option value="tls" {{ get_option('smtp_encryption')=="tls" ? "selected" : "" }}>{{ _lang('TLS') }}</option>
													</select>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<button type="submit" class="btn btn-primary">{{ _lang('Save Settings') }}</button>
												</div>
											</div>
										</div>	
									</form>
								</div>
							</div>
						</div>
							

						<div id="logo" class="tab-pane fade">
							<div class="card">
								<div class="card-body">
									<form method="post" class="appsvan-submit params-panel" autocomplete="off" action="{{ url('admin/administration/upload_logo') }}" enctype="multipart/form-data">				         
										<h4 class="card-title panel-title">{{ _lang('Logo Upload') }}</h4>
										{{ csrf_field() }}
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">{{ _lang('Upload Logo') }}</label>						
													<input type="file" class="form-control dropify" name="logo" data-max-file-size="8M" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ get_logo() }}" required>
												</div>
											</div>
										</div>	

										<div class="row">	
											<div class="col-md-6">
												<div class="form-group">
													<button type="submit" class="btn btn-primary btn-block">{{ _lang('Upload') }}</button>
												</div>
											</div>	
										</div>
									</form>	
								</div>
							</div>
						</div>		
					</div>  
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
@endsection

@section('js-script')
<script>
(function($) {
    "use strict";
	
	if($("#mail_type").val() != "smtp"){
		$(".smtp").prop("disabled",true);
	}
	$(document).on("change","#mail_type",function(){
		if( $(this).val() != "smtp" ){
			$(".smtp").prop("disabled",true);
		}else{
			$(".smtp").prop("disabled",false);
		}
	});
	
	$("#paypal_active").val("{{ get_option('paypal_active','No') }}");
	$("#paypal_mode").val("{{ get_option('paypal_mode','sandbox') }}");
	$("#stripe_active").val("{{ get_option('stripe_active','No') }}");
	$("#blockchain_active").val("{{ get_option('blockchain_active','No') }}");
	$("#wire_transfer_active").val("{{ get_option('wire_transfer_active','No') }}");
	$("#sms_notification").val("{{ get_option('sms_notification','no') }}");

	$('.nav-tabs a').on('shown.bs.tab', function(event){
		var tab = $(event.target).attr("href");
		var url = "{{ url('admin/administration/general_settings') }}";
	    history.pushState({}, null, url + "?tab=" + tab.substring(1));
	});

	@if(isset($_GET['tab']))
	   $('.nav-tabs a[href="#{{ $_GET['tab'] }}"]').tab('show');
	@endif
		   
})(jQuery);
</script>
@endsection

