@extends('base.app')

@section('content')
<h1 class="text-2xl">{{__('messages.welcome_back', ['Name' => $user->getFullNameAttribute() ])}}</h1>
user.show template
@endsection
