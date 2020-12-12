<link rel="stylesheet" href="{{ asset('vendor/octopyid/boundary/app.css') }}">
<script type="text/javascript">
    window.boundaryConfig = @json(
	    $boundary->all(), config('app.debug') ? JSON_PRETTY_PRINT : null
	);
</script>
<script type="text/javascript" src="{{ asset('vendor/octopyid/boundary/app.js') }}"></script>