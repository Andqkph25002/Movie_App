<div class="ralative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen=false">
    <input wire:model.debounce.500ms="search"
    x-ref="search"
    @keydown.window=*
      if(event.keyCode === 191){
        event.preventDefault();
            $refs.search.focus();
      } 
    *
     @focus="isOpen=true" @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false" @keydown.shift.tab="isOpen = false" type="text"
        class="bg-gray-800 text-sm rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline"
        placeholder="Search">
    <div class="absolute top-0">
        <i class="fa fa-search w-4 fill-current text-gray-500 mt-8 ml-2"></i>
    </div>


    @if (strlen($search >= 2))
        <div class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4" x-show.transition.opacity="isOpen">
            @if ($searchResults->count() > 0)
                <ul>

                    @foreach ($searchResults as $item)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('movies.show', $item['id']) }}"
                                class="block hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out duration-150"
                                @if ($loop->last) @keydown.tab="isOpen = false" @endif>
                                @if ($item['poster_path'])
                                    <img src="https://image.tmdb.org/t/p/w92/{{ $item['poster_path'] }}" alt=""
                                        class="w-8">
                                @else
                                    <img src="https://via.placeholder.com/50x75" alt="" class="w-8">
                                @endif

                                <span class="ml-4">{{ $item['title'] }}</span>
                            </a>
                        </li>
                    @endforeach


                </ul>
            @else
                <div class="px-3 py-3">
                    No results for *{{ $search }}*
                </div>
            @endif

        </div>
    @endif

</div>
