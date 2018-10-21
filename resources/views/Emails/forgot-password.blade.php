<h1> Hello </h1>

<p>
	please click the fllowing link to activate your account,

	<a href="{{env('APP_URL')}}/reset/{{ $user->email}}/{{$code}}">reset account</a>
</p>