<li class="nav-item">
	<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
	<a class="nav-link" href="{{ url('dashboard') }}">
		<span class="nav-icon">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
			  <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
			  <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z"/>
			</svg>
		</span>
		<span class="nav-link-text">{{ _lang('Account Overview') }}</span>
	</a><!--//nav-link-->
</li><!--//nav-item-->

<li class="nav-item has-submenu">
	<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
	<a class="nav-link submenu-toggle" href="#" data-toggle="collapse" data-target="#transfer" aria-expanded="false" aria-controls="submenu-1">
		<span class="nav-icon">
		<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
		  <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
		</svg>
		 </span>
		 <span class="nav-link-text"> {{ _lang('Money Transfer') }}</span>
		 <span class="submenu-arrow">
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
			</svg>
		 </span><!--//submenu-arrow-->
	</a><!--//nav-link-->
	<div id="transfer" class="collapse submenu transfer" data-parent="#menu-accordion">
		<ul class="submenu-list list-unstyled">
			<li class="submenu-item"><a class="submenu-link" href="{{ url('user/transfer_between_users') }}">{{ _lang('Between Users') }}</a></li>
			<li class="submenu-item"><a class="submenu-link" href="{{ url('user/card_funding_transfer') }}">{{ _lang('Card Funding Transfer') }}</a></li>
		</ul>
	</div>
</li><!--//nav-item-->


<li class="nav-item has-submenu">
	<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
	<a class="nav-link submenu-toggle" href="#" data-toggle="collapse" data-target="#reports" aria-expanded="false" aria-controls="reports">
		<span class="nav-icon">
		<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
		<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bar-chart-line" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
		  <path fill-rule="evenodd" d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z"/>
		</svg>
		 </span>
		 <span class="nav-link-text"> {{ _lang('Reports') }}</span>
		 <span class="submenu-arrow">
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
			</svg>
		 </span><!--//submenu-arrow-->
	</a><!--//nav-link-->
	<div id="reports" class="collapse submenu reports" data-parent="#menu-accordion">
		<ul class="submenu-list list-unstyled">
			<li class="submenu-item"><a class="submenu-link" href="{{ url('user/reports/all_transaction') }}">{{ _lang('All Transaction') }}</a></li>
		</ul>
	</div>
</li><!--//nav-item-->