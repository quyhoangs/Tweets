
<div class='flex p-4 border-b border-b-gray-400'>

    <div class='mr-2 flex-shrink-0' >
        <a href="{{Route('profile',$tweet->user->name)}}">
            <img src="{{ $tweet->user->avatar }}" alt="" class="rounded-full mr-2" width="40" height="40">
        </a>
    </div>

    <div>
        <a href="{{Route('profile',$tweet->user->name)}}">
            <h5 class='font-bold mb-4'>{{$tweet->user->name}}<h5>
            <p class='text-sm'>{{$tweet->body}}
            </p>
        </a>    
    </div>
</div>