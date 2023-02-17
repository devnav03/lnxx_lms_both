@extends('frontend.layouts.app')
@section('content')

<section class="terms_conditions" style="margin-top: 100px; margin-bottom: 60px;">
<div class="container">  
<h3 style="font-size: 22px; font-weight: 600;">Terms and Conditions</h3>
{!! $content->terms_conditions !!}
</div>
</section>

@endsection    