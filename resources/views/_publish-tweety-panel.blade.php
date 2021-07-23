<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
            <form action="/tweets" method="POST">
                @csrf 

                <textarea   name="body" 
                            class="w-full" 
                            placeholder="Hôm nay bạn thấy thế nào!" 
                            required
                ></textarea>
                
                <hr class="my-4">

                <footer class="flex justify-between">
                      <img src="{{ auth()->user()->avatar }}" alt="avt" class="rounded-full mr-2" width="50" height="50">
                      <button type="submit"  class="bg-blue-500 hover:bg-blue-600 rounded-lg shadow px-10 text-sm text-white h-10">Đăng bài</button>
                </footer>

            </form>
    <div>
        @error('body')
         <p class="text-red-400 text-sm">{{$message}}</p>
        @enderror
    </div>
</div>