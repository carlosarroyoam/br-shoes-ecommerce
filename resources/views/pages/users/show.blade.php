@extends('base.app')

@section('content')
<h1 class="text-2xl">{{__('messages.welcome_back', ['Name' => $user->full_name ])}}</h1>
user.show template
@endsection
