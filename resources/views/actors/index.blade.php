@extends('layouts.main')
@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-actors">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Polpular Actors
            </h2>
            <div id="all_actor" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5  gap-8">

                @foreach ($popularActors as $actor)
                    <div class="actor mt-8">
                        <a href="{{ route('actors.show' , $actor['id']) }}">
                            <img src="{{ $actor['profile_path'] }}" alt="actor image"
                                class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show' , $actor['id']) }}" class="text-lg hover:text-gray-300">
                                {{ $actor['name'] }}
                            </a>
                            <div class="text-sm truncate text-gray-400">
                                {{ $actor['known_for'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="flex justify-between mt-16 mb-16">
            @if ($previous)
                <a href="/actors/page/{{ $previous }}" class="px-3 py-1 bg-orange-500 rounded">Previous</a>
            @endif
            @if ($next)
                <a href="/actors/page/{{ $next }}" class="px-3 py-1 bg-orange-500 rounded">Next</a>
            @endif

        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        var elem = document.querySelector('#all_actor');
        var infScroll = new InfiniteScroll(elem, {
            path: '/actors/page/@{{ # }}',
            append: '.actor',
            status: '.page-load-status',
            // history: false,
        });
    </script>
@endsection
