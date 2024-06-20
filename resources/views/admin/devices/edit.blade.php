<x-admin.wrapper>
    <x-slot name="title">
            {{ __('Devices') }}
    </x-slot>

    <div>
        <x-admin.breadcrumb href="{{route('admin.devices.index')}}" title="{{ __('Update device') }}">{{ __('<< Back to all devices') }}</x-admin.breadcrumb>
        <x-admin.form.errors />
    </div>
    <div class="w-full py-2 overflow-hidden">

        <form method="POST" action="{{ route('admin.devices.update', $device->id) }}">
        @csrf
        @method('PUT')

            <div class="py-2">
                <x-admin.form.label for="device_id" class="{{$errors->has('device_id') ? 'text-red-400' : ''}}">{{ __('Device ID') }}</x-admin.form.label>

                <x-admin.form.input id="device_id" class="{{$errors->has('device_id') ? 'border-red-400' : ''}}"
                                type="text"
                                name="device_id"
                                value="{{ old('device_id', $device->device_id) }}"
                                />
            </div>

            <div class="py-2">
                <x-admin.form.label for="device_name" class="{{$errors->has('device_name') ? 'text-red-400' : ''}}">{{ __('Device name') }}</x-admin.form.label>

                <x-admin.form.input id="device_name" class="{{$errors->has('device_name') ? 'border-red-400' : ''}}"
                                type="device_name"
                                name="device_name"
                                value="{{ old('device_name', $device->device_name) }}"
                                />
            </div>

            <div class="flex justify-end mt-4">
                <x-admin.form.button>{{ __('Update') }}</x-admin.form.button>
            </div>
        </form>
    </div>
</x-admin.wrapper>
