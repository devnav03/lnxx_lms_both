@extends('frontend.layouts.app')
@section('content')

<section class="terms_conditions" style="margin-top: 100px;margin-bottom: 60px;">
<div class="container">  
<img src="{!! asset($article->image)  !!}" class="img-responsive">	
<h3 style="font-size: 22px;font-weight: 600;margin-top: 20px;margin-bottom: 10px;">{{ $article->title }}</h3>
{!! $article->content !!}
</div>
</section>

@endsection    