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

  <link href="{{ asset('public/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" crossorigin="anonymous" />
  
  <link rel="shortcut icon" href="{{ asset('public/images/favicon.png') }}" />
  
  <!-- FontAwesome JS-->
  <script defer src="{{ asset('public/user_portal/assets/plugins/fontawesome/js/all.min.js') }}"></script>

  <!-- App CSS -->  
  <link id="theme-style" rel="stylesheet" href="{{ asset('public/user_portal/assets/css/portal.css?v=1.0') }}">
  
  <script type="text/javascript">
   var direction = "{{ get_option('backend_direction') }}";
   var _url = "{{ asset('/') }}";
   var u_s = "{{ get_option('max_upload_size') }}";
   var active_cur_symbol = "{!! get_currency_symbol( session()->get('currency') ) !!}";
  </script>
</head>
   
<body class="app">
  	<!-- Main Modal -->
	<div id="main_modal" class="modal animated bounceInDown" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"></h5>

		  
			<button type="button" class="btn-sm app-btn-secondary" data-dismiss="modal" aria-label="Close">
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
	
	<header class="app-header fixed-top">	   	            
        <div class="app-header-inner">  
	        <div class="container-fluid py-2">
		        <div class="app-header-content"> 
		            <div class="row justify-content-between align-items-center">
			        
				    <div class="col-auto">
					    <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
						    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>Menu</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
					    </a>
				    </div><!--//col-->

		            <div class="col">
		                <small class="text-success">{{ _lang('Last Login') .': '. date('M d, Y h:m A',strtotime(auth()->user()->last_login_at)) }}</small>
		            </div><!--//app-search-box-->
		            
		            <div class="app-utilities col-auto">		            		
			            
			            <div class="app-utility-item app-user-dropdown dropdown">
				            <a class="dropdown-toggle" id="user-dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><img src="{{ profile_picture() }}" alt="user profile"></a>
				            <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
								<li><a class="dropdown-item" href="{{ url('profile/edit') }}">{{ _lang('Profile Settings') }}</a></li>
								<li><a class="dropdown-item" href="{{ url('user/overview') }}">{{ _lang('Profile Overview') }}</a></li>
								<li><a class="dropdown-item" href="{{ url('profile/change_password') }}">{{ _lang('Change Password') }}</a></li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="{{ url('logout') }}">{{ _lang('Log Out') }}</a></li>
							</ul>
			            </div><!--//app-user-dropdown--> 
		            </div><!--//app-utilities-->
		        </div><!--//row-->
	            </div><!--//app-header-content-->
	        </div><!--//container-fluid-->
        </div><!--//app-header-inner-->
        <div id="app-sidepanel" class="app-sidepanel"> 
	        <div id="sidepanel-drop" class="sidepanel-drop"></div>
	        <div class="sidepanel-inner d-flex flex-column">
		        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
		        <div class="app-branding text-center">
		            <a class="app-logo" href=""><img class="logo-icon mr-2" src="{{ get_logo() }}" alt="logo"></a>
	
		        </div><!--//app-branding-->  
		        
			    <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
				    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
					    <!--Include Menu-->
						@include('layouts.menus.'.Auth::user()->user_type)				    
				    </ul><!--//app-menu-->
			    </nav><!--//app-nav-->
				
			    <div class="app-sidepanel-footer">
				    <nav class="app-nav app-nav-footer">
					    <ul class="app-menu footer-menu list-unstyled">
						    <li class="nav-item">
						        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
						        <a class="nav-link" href="{{ url('logout') }}">
							        <span class="nav-icon">
							            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										  <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
										  <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
										</svg>
							        </span>
			                        <span class="nav-link-text">{{ _lang('Log Out') }}</span>
						        </a><!--//nav-link-->
						    </li><!--//nav-item-->

					    </ul><!--//footer-menu-->
				    </nav>
			    </div><!--//app-sidepanel-footer-->
		       
	        </div><!--//sidepanel-inner-->
	    </div><!--//app-sidepanel-->
    </header><!--//app-header-->
	
	 <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
			@if(Auth::user()->user_type == 'user' && Auth::user()->account_status != 'Verified' && Auth::user()->document_submitted_at == '')
			  <div class="alert alert-danger">
				 <strong><i class="mdi mdi-information-outline"></i> {!! _lang('Still your Account is not fully verified. Please submit all necessary documents by').' <a href="'.url('user/submit_documents').'">'._lang('Clicking Here').'</a>' !!}</strong>
			  </div>
			@endif			
			
			@yield('content')  
	    </div><!--//app-content-->
	    
	    <footer class="app-footer">
		    <div class="container text-center py-3">
				<small class="copyright">Free Version: <a href="https://securepaymentz.com/price">Secure Paymentz</a></small>   
		    </div>
	    </footer><!--//app-footer-->
	    
    </div><!--//app-wrapper-->
	
  
  <script src="{{ asset('public/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('public/user_portal/assets/plugins/popper.min.js') }}"></script>
  <script src="{{ asset('public/user_portal/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>  
  
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
  <script src="{{ asset('public/user_portal/assets/js/app.js') }}"></script> 
  <script src="{{ asset('public/js/app.js?v=1.0') }}"></script>

  
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