<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	@include('partials.head')
	@include('partials.stylesheets')
	@yield('stylesheets')
</head>

<body class="sidebar-collapse">
	@include('partials.navbar')
	<div class="wrapper">
		@yield('content')
	</div>
	@include('partials.footer')
</body>

@include('partials.scripts')
@yield('javascripts')
</body>
</html>
