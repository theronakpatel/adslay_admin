<x-admin.wrapper>
    <x-slot name="title">
            {{ __('Media') }}
    </x-slot>

    <div>
        <x-admin.breadcrumb href="{{route('admin.media.index')}}" title="{{ __('Upload Video') }}">{{ __('<< Back to all Media') }}</x-admin.breadcrumb>
        <x-admin.form.errors />
    </div>
    <div class="w-full py-2 overflow-hidden">

        <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data">
        @csrf
            {{-- <div class="py">
                <x-admin.form.label for="type" class="{{$errors->has('type') ? 'text-red-400' : ''}}">{{ __('Type') }}</x-admin.form.label>

                <select name="type" class="input input-bordered w-full">
                    @foreach (media_type_as_options() as $key => $name)
                    <option value="{{ $key }}" @selected(old('type') == $key)>
                        {!! $name !!}
                    </option>
                    @endforeach
                </select>
            </div> --}}

            <div class="py-2">
                <x-admin.form.label for="title" class="{{$errors->has('title') ? 'text-red-400' : ''}}">{{ __('Title') }}</x-admin.form.label>

                <x-admin.form.input id="title" class="{{$errors->has('title') ? 'border-red-400' : ''}}"
                                    type="text"
                                    name="title"
                                    value="{{ old('title') }}"
                                    />
            </div>
{{-- 
            <div class="py-2">
                <x-admin.form.label for="alt" class="{{$errors->has('alt') ? 'text-red-400' : ''}}">{{ __('Alternative Text') }}</x-admin.form.label>

                <x-admin.form.input id="alt" class="{{$errors->has('alt') ? 'border-red-400' : ''}}"
                                    type="text"
                                    name="alt"
                                    value="{{ old('alt') }}"
                                    />
            </div> --}}

            <div class="py-2">
                <x-admin.form.label for="video" class="{{$errors->has('video') ? 'text-red-400' : ''}}">{{ __('Video') }}</x-admin.form.label>

                <x-admin.form.input id="video" class="{{$errors->has('video') ? 'border-red-400' : ''}}"
                                type="file"
                                name="video"
                                required
                                accept="video/mp4"
                                />
            </div>

            <div class="flex justify-end mt-4">
                <x-admin.form.button>{{ __('Create') }}</x-admin.form.button>
            </div>
        </form>
    </div>
</x-admin.wrapper>