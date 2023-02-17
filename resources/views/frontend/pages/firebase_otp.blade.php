@extends('frontend.layouts.app')
@section('content')

<section style="margin: 108px 0; padding: 100px;">
  
<form>
    <label>Enter Phone Number</label><br>
    <input type="text" id="number" placeholder="+919815330449"> 
    <br>
    <br>
    <div id="recaptha-container"></div><br>
    <button type="button" onclick="sendCode();">Send OTP</button>
    <br>
    <br>
    <label>Enter OTP</label><br>
    <input type="number" id="number-otp"> 
    <br>
    <a onclick="verifyCode();">Verify Code</a> 

</form>
<div id="error" style="color: #f00;display: none;"></div>
<div id="sentMessage" style="color: green;display: none;"></div>
<div id="sucessMessage" style="color: green;display: none;"></div>

</section>


@endsection    