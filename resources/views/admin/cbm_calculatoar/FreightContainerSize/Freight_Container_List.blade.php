<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CBM Calculator') }}
        </h2>
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head">Container Dimensions</p>
    </x-slot>

    <form action="{{ route('admin.cbm_calculator.container-sizes.update') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 form-group-customer">
                <div class="table-responsive">
                    <table id="containerTable" class="table table-bordered align-middle text-center containerSizeTable">
                        <thead class="text-left">
                            <tr>
                                <th class="col-3">Container</th>
                                <th>Dimensions</th>
                                <th>Length</th>
                                <th>Breadth</th>
                                <th>Height</th>
                                <th>Volume</th>
                                <th>Tare Wt (Kg)</th>
                                <th class="lastchildth">Max Wt (Kg)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($containerSizes as $index => $container)
                                <tr>
                                    <input type="hidden" name="id[]" value="{{ $container->id }}">

                                    <td>
                                        <input type="text" name="container_name[]" class="form-control"
                                            value="{{ $container->container_name }}" readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="dimensions[]" class="form-control"
                                            value="{{ $container->dimensions }}" readonly>
                                    </td>

                                    <td>
                                        <input type="number" name="length[]" class="form-control length"
                                            value="{{ old('length.' . $index, $container->length) }}">
                                        @error('length.' . $index)
                                            <span class="text-danger small">The length field is required.</span>
                                        @enderror
                                    </td>

                                    <td>
                                        <input type="number" name="breadth[]" class="form-control breadth"
                                            value="{{ old('breadth.' . $index, $container->breadth) }}">
                                        @error('breadth.' . $index)
                                            <span class="text-danger small">The breadth field is required.</span>
                                        @enderror
                                    </td>

                                    <td>
                                        <input type="number" name="height[]" class="form-control height"
                                            value="{{ old('height.' . $index, $container->height) }}">
                                        @error('height.' . $index)
                                            <span class="text-danger small">The height field is required.</span>
                                        @enderror
                                    </td>

                                    <td>
                                        <input type="number" name="volume[]" class="form-control volume"
                                            value="{{ old('volume.' . $index, $container->volume) }}" readonly>
                                        @error('volume.' . $index)
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </td>

                                    <td>
                                        <input type="number" name="tare_weight[]" class="form-control"
                                            value="{{ $container->tare_weight }}" readonly>
                                    </td>

                                    <td>
                                        <input type="number" name="max_weight[]" class="form-control"
                                            value="{{ $container->max_weight }}" readonly>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end gap-3 mt-3">
                    <button type="button" id="load-defaults" class="btn btn-outline-primary">Default Values</button>
                    <button type="submit" class="btn btn-primary">Update Containers</button>
                </div>
            </div>
        </div>
    </form>

    @section('script')
        <script>
            $(document).ready(function () {
                $('tr').each(function () {
                    const $row = $(this);
                    const $length = $row.find('.length');
                    const $breadth = $row.find('.breadth');
                    const $height = $row.find('.height');
                    const $volume = $row.find('.volume');

                    function updateVolume() {
                        const length = parseFloat($length.val()) || 0;
                        const breadth = parseFloat($breadth.val()) || 0;
                        const height = parseFloat($height.val()) || 0;

                        const volume = ((length * breadth * height) / 1000000).toFixed(2); // mm³ → m³
                        $volume.val(volume);
                    }

                    $length.on('change keyup', updateVolume);
                    $breadth.on('change keyup', updateVolume);
                    $height.on('change keyup', updateVolume);
                });
            });
        </script>
        <script>
            $('#load-defaults').on('click', function () {
                $.ajax({
                    url: "{{ route('default.container.sizes') }}",
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        let rows = $('#containerTable tbody tr');

                        rows.each(function (index) {
                            if (data[index]) {
                                let container = data[index];
                                let $row = $(this);

                                $row.find('input[name="length[]"]').val(container.length);
                                $row.find('input[name="breadth[]"]').val(container.breadth);
                                $row.find('input[name="height[]"]').val(container.height);
                                $row.find('input[name="volume[]"]').val(container.volume);
                                $row.find('input[name="tare_weight[]"]').val(container.tare_weight);
                                $row.find('input[name="max_weight[]"]').val(container.max_weight);
                            }
                        });
                    },
                    error: function (xhr) {
                        alert("Failed to load default values.");
                        console.error(xhr.responseText);
                    }
                });
            });

        </script>
    @endsection


</x-app-layout>