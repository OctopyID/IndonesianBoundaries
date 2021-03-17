<script type="text/javascript">
    window.boundaries = @json(
	    $boundary, config('app.debug', false) ? JSON_PRETTY_PRINT : null
	);
</script>
<script type="text/javascript" src="{{ asset('vendor/octopyid/boundary/app.js') }}"></script>