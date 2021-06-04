<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	@include('front.layout.styles')
	@stack('styles')

	<title>NAK interview</title>

</head>
<body dir="rtl">

@yield('content')

@include('front.layout.scripts')
@stack('scripts')

</body>
</html>