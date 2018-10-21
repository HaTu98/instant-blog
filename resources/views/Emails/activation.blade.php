<h1> Hello </h1>

<p>
	please click the fllowing link to activate your account,

	<a href="{{env('APP_URL')}}/activate/{{ $user->email}}/{{$code}}">activate account</a>
</p>