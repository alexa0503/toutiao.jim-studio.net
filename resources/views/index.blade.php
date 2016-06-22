@extends('layouts.app')
@section('style')
<style>
	@-ms-viewport { width:device-width; }
	@media only screen and (min-device-width:800px) { html { overflow:hidden; } }
	html { height:100%; }
	body { height:100%; overflow:hidden; margin:0; padding:0; }
</style>
@endsection
@section('headerScripts')
<script src="{{asset('assets/js/jquery-1.9.1.min.js')}}"></script>
@endsection
@section('content')
@endsection
@section('scripts')
<script>
$(document).ready(function() {
	wxShare();
});
</script>
@endsection
