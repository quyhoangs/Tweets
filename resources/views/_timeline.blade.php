<div class="border border-gray-300 rounded-lg">
                  @forelse($tweets as $tweet)
                     @include('_tweety')
                  @empty
                     <p class="p-4">Chưa có bài đăng nào</p>   
                  @endforelse
 {{$tweets->links()}}                  
</div>