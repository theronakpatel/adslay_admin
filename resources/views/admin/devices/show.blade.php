<x-admin.wrapper>
    <x-slot name="title">
            {{ __('Devices') }}
    </x-slot>

    <div class="d-print-none with-border">
        <x-admin.breadcrumb href="{{route('admin.device.index')}}" title="{{ __('View device') }}">{{ __('<< Back to all devices') }}</x-admin.breadcrumb> 
    </div>
    <div class="w-full py-2">
        <div class="min-w-full border-base-200 shadow">
            <table class="table-fixed w-full text-sm">
                <tbody>
                    <tr>
                        <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">{{ __('Device ID') }}</td>
                        <td class="border-b border-slate-100 p-4 text-slate-500">{{$device->device_id}}</td>
                    </tr>
                    <tr>
                        <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">{{ __('Device name') }}</td>
                        <td class="border-b border-slate-100 p-4 text-slate-500">{{$device->device_name}}</td>
                    </tr>
                    <tr>
                    <tr>
                        <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">{{ __('Created') }}</td>
                        <td class="border-b border-slate-100 p-4 text-slate-500">{{$device->added_date->toDateTimeString()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-admin.wrapper>
