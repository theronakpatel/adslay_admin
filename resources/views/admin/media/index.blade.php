<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Media') }}
    </x-slot>

    @can('adminCreate', \Plank\Mediable\Media::class)
    <x-admin.add-link href="{{ route('admin.media.create') }}">
        {{ __('Add Media') }}
    </x-admin.add-link>
    @endcan

    <div class="py-2">
        <div class="min-w-full  border-base-200 shadow overflow-x-auto">
            {{-- <x-admin.grid.search action="{{ route('admin.media.index') }}" /> --}}
            <x-admin.grid.table>
                <x-slot name="head">
                    <tr class="bg-base-200">
                        <x-admin.grid.th>
                            {{ __('Title') }}
                        </x-admin.grid.th>
                        <x-admin.grid.th>
                            {{ __('Type') }}
                        </x-admin.grid.th>
                        <x-admin.grid.th>
                            {{ __('Media') }}
                        </x-admin.grid.th>
                        <x-admin.grid.th>
                            {{ __('Created') }}
                        </x-admin.grid.th>
                        @canany(['adminDelete'], new \Plank\Mediable\Media)
                        <x-admin.grid.th>
                            {{ __('Actions') }}
                        </x-admin.grid.th>
                        @endcanany
                    </tr>
                </x-slot>
                <x-slot name="body">
                @foreach($mediaItems as $media)
                    <tr>
                        <x-admin.grid.td>
                                {{ $media->title }}
                        </x-admin.grid.td>
                        <x-admin.grid.td>
                                @if(strtoupper($media->media_type) === 'IMAGE')
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">IMAGE</span>
                                @elseif(strtoupper($media->media_type) === 'VIDEO')
                                    <span class="bg-pink-100 text-pink-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">VIDEO</span>
                                @else
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">OTHER</span>
                                @endif
                        </x-admin.grid.td>
                        <x-admin.grid.td>
                            <a target="_blank" href="{{ $media->cloudfront_url }}">{{ $media->cloudfront_url }}</a>
                                @if(strtoupper($media->media_type) === 'IMAGE')
                                    <img src="{{ $media->cloudfront_url }}" alt="{{ $media->title }}" class="w-28">
                                @elseif(strtoupper($media->media_type) === 'VIDEO')
                                    <div class="w-40">
                                        <video height="100" controls>
                                            <source src="{{ $media->cloudfront_url }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @else
                                    Unsupported media type: {{ $media->media_type }}
                                @endif
                        </x-admin.grid.td>
                        <x-admin.grid.td>
                            {{ $media->created_at->toDateTimeString() }}
                        </x-admin.grid.td>
                        @canany([ 'adminDelete'], $media)
                        <x-admin.grid.td>
                            <form action="{{ route('admin.media.destroy', $media->id) }}" method="POST">
                                <div>
                                   
                                    @can('adminDelete', $media)
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-square btn-ghost" onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                        </svg>
                                    </button>
                                    @endcan
                                </div>
                            </form>
                        </x-admin.grid.td>
                        @endcanany
                    </tr>
                    @endforeach
                    @if($mediaItems->isEmpty())
                        <tr>
                            <td colspan="2">
                                <div class="flex flex-col justify-center items-center py-4 text-lg">
                                    {{ __('No Result Found') }}
                                </div>
                            </td>
                        </tr>
                    @endif
                </x-slot>
            </x-admin.grid.table>
        </div>
        <div class="py-8">
            {{ $mediaItems->appends(request()->query())->links() }}
        </div>
    </div>
</x-admin.wrapper>
