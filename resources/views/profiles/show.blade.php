@extends('components.master')
@section('content')
       <header class="mb-6 relative">

           <div class="relative">
                <img src="/images/banner.jpg" alt="" class="mb-2 border border-gray-300">

                <img src="{{ $user->avatar }}"
                    alt=""
                    class="rounded-full absolute bottom-0 transform -translate-x-1/2 translate-y-1/2"
                    style="left: 50% ;width:20%"
                    width="150"
                >
            </div>
           <div class="flex justify-between items-center mg-4">
              <div>
                  <h2 class="font-bold text-2xl mb-2">{{$user->name}}</h2>
                  <p class="text-sm">Joined {{$user->created_at->diffForHumans() }}</p>
              </div>

              <div class="flex">
            <!-- Chỉ hiện thị Edit Khi User đó login  -->
            @can('edit',$user)
                <a href="{{$user->path('edit')}}" class="rounded-full border border-gray-300 py-2 px-4  text-xs">Edit Profile</a> 
            @endcan    
            <!-- Chỉ hiện thị Follow ở profile bạn bè  -->
            @unless(current_user()->Is($user))
                <form action="{{Route('follow',$user->username)}}" method="post">
                    @csrf
                    <button type="submit" class="bg-blue-500 rounded-full  py-2 px-4 text-white text-xs ml-2">
                        {{current_user()->following($user) ? 'Unfollow Me' : 'Follow me'}}
                    </button>
                </form>
            @endunless

              </div>
           </div>
           <p class="text-sm mt-2">Hello, my name is Matt Lemanski. I am the creator of Speaking of English,
              a blog for intermediate English learners who want to become more fluent in the language.
              I am originally from the United States and I currently live in Germany.
               I have been a teacher since 2008, and specialize in business writing and IELTS preparation. Before becoming a teacher, 
               I worked as a copyeditor for government agencies in Washington DC and as a ghostwriter for startup founders and independent 
               consultants around the world. In my free time, I enjoy hiking, practicing photography, and exploring the city by bike.</p>
       </header>

        @include('_timeline',[
          'tweets'=>$tweets      //$user->tweets
        ])
@endsection
