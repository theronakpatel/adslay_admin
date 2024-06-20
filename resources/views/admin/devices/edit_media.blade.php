<x-admin.wrapper>
    <x-slot name="title">
            {{ __('Devices') }}
    </x-slot>

    <div>
        <x-admin.breadcrumb href="{{route('admin.devices.index')}}" title="{{ __('Update media to device') }}">{{ __('<< Back to all devices') }}</x-admin.breadcrumb>
        <x-admin.form.errors />
    </div>
    <div class="w-full py-2 overflow-hidden">

        <form method="POST" action="{{ route('admin.devices.updateMedia', $device->id) }}">
        @csrf
        @method('PUT')

            <div class="py-2">
                <x-admin.form.label for="media_ids" class="{{$errors->has('media_ids') ? 'text-red-400' : ''}}">{{ __('Select Media') }}</x-admin.form.label>
                <select id="media_ids" name="media_ids[]" class="form-control" multiple>
                    @foreach($media as $item)
                        <option value="{{ $item->id }}" {{ in_array($item->id, old('media_ids', $selectedMedia)) ? 'selected' : '' }}>
                            {{ $item->title }} ({{ $item->media_type }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end mt-4">
                <x-admin.form.button>{{ __('Update Media') }}</x-admin.form.button>
            </div>
        </form>
    </div>
</x-admin.wrapper>
