@extends('layouts.app')

@section('wall')
<div class="pt-6 pb-20 max-w-6xl mx-auto"
     style="min-height: 80vh;font-family:'Crafty Girls', cursive;"
     x-data="postLoader()" x-init="loadMore()" x-on:scroll.window="handleScroll">

     <div id="post-grid" class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 gap-6">

        {{-- Initial posts will be here if needed --}}
    </div>
    <div id="loading" x-show="loading"
         class="text-center mt-6 text-sm text-gray-500">
        Loading more posts...
    </div>

    <div x-show="done && loadedOnce"
         class="text-center mt-6 text-gray-500 text-sm">
        No more posts found.
    </div>
</div>
<script>
    function postLoader() {
        return {
            offset: 0,
            loading: false,
            done: false,
            loadedOnce: false,

            async loadMore() {
                if (this.loading || this.done) return;
                this.loading = true;

                try {
                    const res = await fetch(`/wall/load?offset=${this.offset}`);
                    const data = await res.json();

                    this.loadedOnce = true;

                    if (data.done || !data.html) {
                        this.done = true;
                    } else {
                        document.getElementById('post-grid').insertAdjacentHTML('beforeend', data.html);
                        lucide.createIcons();
                        this.offset += 12;
                    }
                } catch (e) {
                    console.error('Load failed', e);
                }

                this.loading = false;
            },

            handleScroll() {
                if ((window.innerHeight + window.scrollY) >= (document.body.offsetHeight - 300)) {
                    this.loadMore();
                }
            }
        };
    }
</script>
@endsection
