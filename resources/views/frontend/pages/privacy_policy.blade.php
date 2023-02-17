@extends('frontend.layouts.app')
@section('content')

<section class="terms_conditions" style="margin-top: 100px; margin-bottom: 60px;">
<div class="container">  
<h3 style="font-size: 22px; font-weight: 600;">Privacy Policy</h3>
{!! $content->privacy !!}
</div>
</section>

@endsection    