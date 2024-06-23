<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Registered Devices') }}
    </x-slot>

    @can('adminCreate', \App\Models\User::class)
    {{-- <x-admin.add-link href="{{ route('admin.devices.create') }}">
        {{ __('Add Device') }}
    </x-admin.add-link> --}}
    @endcan

    <div class="py-2">
        <div class="min-w-full  border-base-200 shadow overflow-x-auto">
            {{-- <x-admin.grid.search action="{{ route('admin.devices.index') }}" /> --}}
            <x-admin.grid.table>
                <x-slot name="head">
                    <tr class="bg-base-200">
                        <x-admin.grid.th>
                            @include('admin.includes.sort-link', ['label' => 'Device ID', 'attribute' => 'device_id'])
                        </x-admin.grid.th>
                        <x-admin.grid.th>
                            @include('admin.includes.sort-link', ['label' => 'Model', 'attribute' => 'model'])
                        </x-admin.grid.th>
                        <x-admin.grid.th>
                            @include('admin.includes.sort-link', ['label' => 'Device', 'attribute' => 'device'])
                        </x-admin.grid.th>
                        <x-admin.grid.th>
                            @include('admin.includes.sort-link', ['label' => 'Build ID', 'attribute' => 'buildId'])
                        </x-admin.grid.th>
                        <x-admin.grid.th>
                            @include('admin.includes.sort-link', ['label' => 'Board', 'attribute' => 'board'])
                        </x-admin.grid.th>
                        <x-admin.grid.th>
                            @include('admin.includes.sort-link', ['label' => 'Brand', 'attribute' => 'brand'])
                        </x-admin.grid.th>
                        <x-admin.grid.th>
                            @include('admin.includes.sort-link', ['label' => 'Display', 'attribute' => 'display'])
                        </x-admin.grid.th>
                        <x-admin.grid.th>
                            @include('admin.includes.sort-link', ['label' => 'Hardware', 'attribute' => 'hardware'])
                        </x-admin.grid.th>
                        <x-admin.grid.th>
                            @include('admin.includes.sort-link', ['label' => 'Product', 'attribute' => 'product'])
                        </x-admin.grid.th>
                        <x-admin.grid.th>
                            @include('admin.includes.sort-link', ['label' => 'Manufacturer', 'attribute' => 'manufacturer'])
                        </x-admin.grid.th>
                        <x-admin.grid.th>
                            @include('admin.includes.sort-link', ['label' => 'OS Version', 'attribute' => 'osVersion'])
                        </x-admin.grid.th>
                    </tr>
                </x-slot>
                <x-slot name="body">
                    @foreach ($deviceInfos as $device)
                    <tr>
                        <x-admin.grid.td>
                            <div class="flex w-fit">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $device->device_id }}</span>
                                <button class="copy-btn" onclick="copyToClipboard('{{ $device->device_id }}')">Copy</button>
                            </div>
                        </x-admin.grid.td>
                        <x-admin.grid.td>
                            <div>
                                {{ $device->model }}
                            </div>
                        </x-admin.grid.td>
                        <x-admin.grid.td>
                            <div>
                                {{ $device->device }}
                            </div>
                        </x-admin.grid.td>
                        <x-admin.grid.td>
                            <div>
                                {{ $device->buildId }}
                            </div>
                        </x-admin.grid.td>
                        <x-admin.grid.td>
                            <div>
                                {{ $device->board }}
                            </div>
                        </x-admin.grid.td>
                        <x-admin.grid.td>
                            <div>
                                {{ $device->brand }}
                            </div>
                        </x-admin.grid.td>
                        <x-admin.grid.td>
                            <div>
                                {{ $device->display }}
                            </div>
                        </x-admin.grid.td>
                        <x-admin.grid.td>
                            <div>
                                {{ $device->hardware }}
                            </div>
                        </x-admin.grid.td>
                        <x-admin.grid.td>
                            <div>
                                {{ $device->product }}
                            </div>
                        </x-admin.grid.td>
                        <x-admin.grid.td>
                            <div>
                                {{ $device->manufacturer }}
                            </div>
                        </x-admin.grid.td>
                        <x-admin.grid.td>
                            <div>
                                {{ $device->osVersion }}
                            </div>
                        </x-admin.grid.td>
                    </tr>
                    @endforeach
                    @if($deviceInfos->isEmpty())
                        <tr>
                            <td colspan="3">
                                <div class="flex flex-col justify-center items-center py-4 text-lg">
                                    {{ __('No Result Found') }}
                                </div>
                            </td>
                        </tr>
                    @endif
                </x-slot>
            </x-admin.grid.table>
        </div>
    </div>
    @isset($item['children'])
        @foreach($item['children'] as $child)
            <x-admin.grid.index-category-item :item="$child" :type="$type" :level="($level+1)" />
        @endforeach
    @endisset
</x-admin.wrapper>
<style>
    .copy-btn {
        cursor: pointer;
        border: none;
        background: none;
        color: blue;
        text-decoration: underline;
    }
</style>
<!-- Add JavaScript for the copy functionality -->
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Copied to clipboard: ' + text);
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }
</script>