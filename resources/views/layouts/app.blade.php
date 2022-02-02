<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ get_option('site_title','Secure PaymentZ') }}</title>

      <meta name="og:title" content="{{ get_option('site_title','Secure PaymentZ') }}"/>
      <meta name="og:type" content="website"/>
      <meta name="og:url" content="{{ url('') }}"/>
      <meta name="og:image" content="{{ get_logo() }}"/>
      <meta name="og:site_name" content="{{ get_option('site_title','Secure PaymentZ') }}"/>
      <meta name="og:description" content="This is the perfect system for business that want to have a banking system, administrator, user accounts, Mobile Banking, affiliate systems, or financial institutions, as well as multi-level businesses."/>

      <!--Css Plugin-->
      <link href="{{ asset('public/css/select2.css') }}" rel="stylesheet">
	  <link href="{{ asset('public/css/toastr.css') }}" rel="stylesheet">
	  <link href="{{ asset('public/css/dropify.min.css') }}" rel="stylesheet">
	  <link href="{{ asset('public/css/fullcalendar.min.css') }}" rel="stylesheet">
	  <link href="{{ asset('public/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
	  <link href="{{ asset('public/css/bootstrap-datepicker.css') }}" rel="stylesheet">
	  <link href="{{ asset('public/css/animate.css') }}" rel="stylesheet">
	  <link href="{{ asset('public/css/summernote.css') }}" rel="stylesheet">
	  <link href="{{ asset('public/css/intlTelInput.css') }}" rel="stylesheet">
	  <!-- endinject -->
	  <!-- plugin css for this page -->
	  
	  <!-- End plugin css for this page -->
      <link href="{{ asset('public/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" crossorigin="anonymous" />
      <link href="{{ asset('public/css/fontawesome.min.css') }}" rel="stylesheet" crossorigin="anonymous" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" rel="stylesheet" />
      <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" rel="stylesheet" />
	  
	  <!-- inject:css -->
	  <link href="{{ asset('public/css/styles.css?v=1.0') }}" rel="stylesheet" />
	  <!-- endinject -->
	  
	  <link rel="shortcut icon" href="{{ asset('public/images/favicon.png') }}" />
      <script type="text/javascript">
	   var direction = "{{ get_option('backend_direction') }}";
	   var _url = "{{ asset('/') }}";
	   var u_s = "{{ get_option('max_upload_size') }}";
	   var active_cur_symbol = "{!! get_currency_symbol( session()->get('currency') ) !!}";
	  </script>
   </head>
   
<body class="sb-nav-fixed">
  	<!-- Main Modal -->
	<div id="main_modal" class="modal animated bounceInDown" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"></h5>

		  
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  
		  <div class="alert alert-danger" style="display:none; margin: 15px;"></div>
		  <div class="alert alert-success" style="display:none; margin: 15px;"></div>			  
		  <div class="modal-body" style="overflow:hidden;"></div>
		  
		</div>
	  </div>
	</div>
	

    <div id="preloader">
    	<div class="lds-ring"><div></div><div></div><div></div><div></div></div>
	</div>
	
	<nav class="sb-topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
		<a class="navbar-brand" href="{{ url('dashboard') }}"><img src="{{ get_logo() }}"/></a>
		<button class="btn sb-btn-icon sb-btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"><i data-feather="menu"></i></button>

		<div class="mr-auto d-none d-lg-block"></div>

		<ul class="navbar-nav align-items-center">
			<li class="nav-item dropdown no-caret mr-3 sb-dropdown-user">
				<a class="btn sb-btn-icon sb-btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="{{ profile_picture() }}"/></a>
				<div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
					<h6 class="dropdown-header d-flex align-items-center">
						<img class="sb-dropdown-user-img" src="{{ profile_picture() }}" />
						<div class="sb-dropdown-user-details">
							<div class="sb-dropdown-user-details-name">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</div>
							<div class="sb-dropdown-user-details-email">{{ Auth::user()->email }}</div>
						</div>
					</h6>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="{{ url('profile/edit') }}"><div class="sb-dropdown-item-icon"><i data-feather="settings"></i></div>{{ _lang('Profile Settings') }}</a>
					
					<a class="dropdown-item" href="{{ url('profile/change_password') }}"><div class="sb-dropdown-item-icon"><i data-feather="repeat"></i></div>{{ _lang('Change Password') }}</a>

					@if(Auth::user()->user_type == 'user')
						@if(Auth::user()->account_type == 'business')
							<a class="dropdown-item" href="{{ url('user/merchant_api') }}"><div class="sb-dropdown-item-icon"><i data-feather="key"></i></div>{{ _lang('Merchant API') }}</a>
						@endif
						
						<a class="dropdown-item" href="{{ url('user/profile/referral_link') }}"><div class="sb-dropdown-item-icon"><i data-feather="link"></i></div>{{ _lang('Referral Link') }}</a>
					@endif

					<a class="dropdown-item" href="{{ url('logout') }}"><div class="sb-dropdown-item-icon"><i data-feather="log-out"></i></div>{{ _lang('Logout') }}</a>
				</div>
			</li>
		</ul>
	</nav>
	
	<div id="layoutSidenav">
		<div id="layoutSidenav_nav">
			<nav class="sb-sidenav sb-shadow-right sb-sidenav-light">
				<div class="sb-sidenav-menu">
					<div class="nav accordion" id="accordionSidenav">
						<div class="sb-sidenav-menu-heading text-center">{{ get_option('site_title','Secure PaymentZ') }}</div>

						<!--Include Menu-->
						@include('layouts.menus.'.Auth::user()->user_type)
						
					</div>
				</div>
			</nav>
		</div>
		<div id="layoutSidenav_content">
			<main>
				@if(Auth::user()->user_type == 'user' && Auth::user()->account_status != 'Verified' && Auth::user()->document_submitted_at == '')
				  <div class="alert alert-danger">
					 <strong><i class="mdi mdi-information-outline"></i> {!! _lang('Still your Account is not fully verified. Please submit all necessary documents by').' <a href="'.url('user/submit_documents').'">'._lang('Clicking Here').'</a>' !!}</strong>
				  </div>
				@endif
				
				@yield('content')		
			</main>
			<footer class="sb-footer py-4 mt-auto sb-footer-light">
				<div class="container-fluid">
					<div class="d-flex align-items-center justify-content-between small">
						<div>Free Version: <a href="https://securepaymentz.com/price">Secure Paymentz</a></div>
					</div>
				</div>
			</footer>
		</div>
	</div>
 

  <!-- plugins:js -->
  <script src="{{ asset('public/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
  <!-- endinject -->
  
  <!-- inject:js -->
  <script src="{{ asset('public/js/off-canvas.js') }}"></script>
  <script src="{{ asset('public/js/misc.js') }}"></script>

  <!--DataTable-->
  <script src="{{ asset('public/js/datatables.min.js') }}"></script>
  <script src="{{ asset('public/js/pdfmake.min.js') }}"></script>
  <script src="{{ asset('public/js/vfs_fonts.js') }}"></script>
  <!--End Datatable-->
  
  <script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('public/js/moment.min.js') }}"></script>
  <script src="{{ asset('public/js/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('public/js/bootstrap-datetimepicker.min.js') }}"></script>
  <script src="{{ asset('public/js/select2.min.js') }}"></script>
  <script src="{{ asset('public/js/jquery.mask.min.js') }}"></script>
  <script src="{{ asset('public/js/dropify.min.js') }}"></script>
  <script src="{{ asset('public/js/toastr.js') }}"></script>
  <script src="{{ asset('public/js/summernote.js') }}"></script>
  <script src="{{ asset('public/js/sweetalert.min.js') }}"></script>
  <script src="{{ asset('public/js/intlTelInput-jquery.min.js') }}"></script>
  <script src="{{ asset('public/js/print.js') }}"></script>
  <script src="{{ asset('public/js/scripts.js') }}"></script>
  <script src="{{ asset('public/js/app.js?v=1.0') }}"></script>

  <!-- endinject -->
  @if(Request::is('dashboard') && Auth::user()->user_type != 'user')
	  <!-- Custom js for this page-->
	  <script src="{{ asset('public/js/Chart.min.js') }}"></script>
      <script src="{{ asset('public/assets/charts/month_wise_deposit.js') }}"></script>
      <script src="{{ asset('public/assets/charts/month_wise_withdraw.js?v=1.0') }}"></script>
	  <!-- End custom js for this page-->		 
  @endif
  
  @yield('js-script')
  
	 <script type="text/javascript">		
		$(document).ready(function() {	
		    @if( ! Request::is('dashboard'))
				$(".page-title").html($(".panel-title").html()); 
			@else
				$(".page-title").html('{{ _lang('Dashboard') }}');
			@endif
			
			if ($(".data-table").length) {
				$(".data-table").DataTable({
					responsive: true,
					"bAutoWidth":false,
					stateSave: true,
					"ordering": false,
					"language": {
					   "decimal":        "",
					   "emptyTable":     "{{ _lang('No Data Found') }}",
					   "info":           "{{ _lang('Showing') }} _START_ {{ _lang('to') }} _END_ {{ _lang('of') }} _TOTAL_ {{ _lang('Entries') }}",
					   "infoEmpty":      "{{ _lang('Showing 0 To 0 Of 0 Entries') }}",
					   "infoFiltered":   "(filtered from _MAX_ total entries)",
					   "infoPostFix":    "",
					   "thousands":      ",",
					   "lengthMenu":     "{{ _lang('Show') }} _MENU_ {{ _lang('Entries') }}",
					   "loadingRecords": "{{ _lang('Loading...') }}",
					   "processing":     "{{ _lang('Processing...') }}",
					   "search":         "{{ _lang('Search') }}",
					   "zeroRecords":    "{{ _lang('No matching records found') }}",
					   "paginate": {
						  "first":      "{{ _lang('First') }}",
						  "last":       "{{ _lang('Last') }}",
						  "next":       "{{ _lang('Next') }}",
						  "previous":   "{{ _lang('Previous') }}"
					  },
					  "aria": {
						  "sortAscending":  ": activate to sort column ascending",
						  "sortDescending": ": activate to sort column descending"
					  }
				  },
				});
			}
			
			if ($(".report-table").length) {
				var report_table = $(".report-table").DataTable({
					responsive: true,
					"bAutoWidth":false,
					"ordering": false,
					"lengthChange": false,
					"language": {
					   "decimal":        "",
					   "emptyTable":     "{{ _lang('No Data Found') }}",
					   "info":           "{{ _lang('Showing') }} _START_ {{ _lang('to') }} _END_ {{ _lang('of') }} _TOTAL_ {{ _lang('Entries') }}",
					   "infoEmpty":      "{{ _lang('Showing 0 To 0 Of 0 Entries') }}",
					   "infoFiltered":   "(filtered from _MAX_ total entries)",
					   "infoPostFix":    "",
					   "thousands":      ",",
					   "lengthMenu":     "{{ _lang('Show') }} _MENU_ {{ _lang('Entries') }}",
					   "loadingRecords": "{{ _lang('Loading...') }}",
					   "processing":     "{{ _lang('Processing...') }}",
					   "search":         "{{ _lang('Search') }}",
					   "zeroRecords":    "{{ _lang('No matching records found') }}",
					   "paginate": {
						  "first":      "{{ _lang('First') }}",
						  "last":       "{{ _lang('Last') }}",
						  "next":       "{{ _lang('Next') }}",
						  "previous":   "{{ _lang('Previous') }}"
					  },
					  "aria": {
						  "sortAscending":  ": activate to sort column ascending",
						  "sortDescending": ": activate to sort column descending"
					  }
				  },
				  //dom: 'Blfrtip',
				  buttons: [
				  'copy', 'excel','pdf',
				  {
						extend: 'print',
						title: '',
						customize: function ( win ) {
							$(win.document.body)
								.css( 'font-size', '10pt' )
								.prepend(
									'<div style="text-align:center">'+
									$(".report-header").html()+
									'</div>'
								);
		 
							$(win.document.body).find( 'table' )
								.addClass( 'compact' )
								.css( 'font-size', 'inherit' );
								 
						}
					}
				  ],
				});
				
				report_table.buttons().container()
				  .appendTo('#DataTables_Table_0_wrapper .col-md-6:eq(0)');
			 	  
            }
		}); 	
			
	
		//Show Success Message
		@if(Session::has('success'))
		   toastr.success("{{ session('success') }}")
		@endif
		
		//Show Single Error Message
		@if(Session::has('error'))
		   toastr.error("{{ session('error') }}")
		@endif
		
		
		@php $i = 0; @endphp

		@foreach ($errors->all() as $error)
			toastr.error("{{ $error }}")
			
			var name = "{{$errors->keys()[$i] }}";
			
			$("input[name='"+name+"']").addClass('error');
			$("select[name='"+name+"'] + span").addClass('error');
			
			$("input[name='"+name+"'], select[name='"+name+"']").parent().append("<span class='v-error'>{{$error}}</span>");
			
			@php $i++; @endphp
		
		@endforeach
            
	 </script>
  
</body>
</html>