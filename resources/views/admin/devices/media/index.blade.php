<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Devices') }}
    </x-slot>

    <div>
        <x-admin.breadcrumb href="{{route('admin.devices.index')}}" title="{{ __('Order Media for Device') }}">{{ __('<< Back to all devices') }}</x-admin.breadcrumb>
        <x-admin.form.errors />
    </div>
    <div class="w-full py-2 overflow-hidden">

        <form method="POST" action="{{ route('admin.devices.media.updateOrder', $device->id) }}">
        @csrf
        @method('POST')

                <div class="py-2">

                <ul id="media-list" class="list-group divide-y divide-gray-200  w-full">
                    @foreach($media as $item)
                        <li class="pb-3 sm:pb-4 list-group-item p-1 border mb-2 w-full" data-id="{{ $item->id }}">
                            <div class="flex items-center space-x-4 rtl:space-x-reverse w-full border-gray-600 justify-between">
                                <div class="flex-1 min-w-0 p-2 flex w-2/3">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ strtoupper($item->media_type) }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate ml-2">
                                        {{ $item->title }}
                                    </p>
                                </div>
                                <div class="flex items-center w-1/3">
                                    <p class="font-bold p-2"> {{ strtoupper($item->media_type) == 'IMAGE'  ? 'Seconds' : 'Repeat X' }}: </p>
                                    <p class="p-1">
                                        <input type="number" id="number-input" aria-describedby="helper-text-explanation" class="repeat-count bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $item->pivot->repeat_count ?? 1 }}" data-media-id="{{ $item->pivot->id }}" required />
                                    </p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                </ul>
            </div>
            <div class="flex justify-end mt-4">
                <x-admin.form.button id="save-order">{{ __('Update Media') }}</x-admin.form.button>
            </div>
        </form>
    </div>
</x-admin.wrapper>
<!-- Example with jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
li.list-group-item.ui-sortable-handle {
    cursor: all-scroll;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(function() {
        $("#media-list").sortable();

        $("#save-order").click(function(e) {
            e.preventDefault();
            var order = [];
            $("#media-list li").each(function(index, element) {
                order.push($(element).data('id'));
            });

            $.ajax({
                url: "{{ route('admin.devices.media.updateOrder', ['device' => $device->id]) }}",
                method: 'POST',
                data: {
                    order: order,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        alert('Media order updated successfully.');
                    } else {
                        alert('Failed to update media order.');
                    }
                },
                error: function() {
                    alert('Error occurred while updating media order.');
                }
            });
        });

        $("#media-list").on('change', '.repeat-count', function() {
                var mediaId = $(this).data('media-id');
                var repeatCount = $(this).val();

                $.ajax({
                    url: "{{ route('admin.devices.media.updateRepeatCount') }}",
                    method: 'POST',
                    data: {
                        media_id: mediaId,
                        repeat_count: repeatCount,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Media updated successfully.');
                        } else {
                            alert('Failed to update media.');
                        }
                    },
                    error: function() {
                        alert('Error occurred while updating media.');
                    }
                });
            });
    });
</script>
