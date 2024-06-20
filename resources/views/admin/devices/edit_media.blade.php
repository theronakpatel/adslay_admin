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

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#media_ids').select2({
            placeholder: "Select media",
            allowClear: true
        });
    });
</script>
<style>
    .select2-container {
        width: 100% !important;
    }
</style>