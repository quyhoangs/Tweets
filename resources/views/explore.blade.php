@extends('components.master')
@section('content')
    <div>
        @foreach($users as $user)
          <a href="{{$user->path()}}" class="flex items-center mb-5">
          <img src="{{$user->avatar}}" alt="{{$user->username}}" width="60">
            <div>
                <h4 class="font-bold rouded">
                    {{'@'.$user->username}}
                </h4>
            </div>
         </a>
        @endforeach
        {{$users->links()}}
    </div>
@endsection
