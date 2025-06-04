<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Container Wise Freight') }}
        </h2>
    </x-slot>


    <div class="container">
        <h3 class="mb-4">Container Sizes</h3>
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="text-left">
                    <tr>
                        <th class="col-3 fw-light text-start">Container</th>
                        <th class="col-1 fw-light text-start">Dimensions</th>
                        <th class="fw-light text-start">Length</th>
                        <th class="fw-light text-start">Breadth</th>
                        <th class="fw-light text-start">Height</th>
                        <th class="fw-light text-start">Volume</th>
                        <th class="fw-light text-start">Tare Wt (Kg)</th>
                        <th class="fw-light text-start bg-transparent table-last-column">Max Wt (Kg)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($containerSizes as $container)
                        <tr>
                            <td>
                                <input type="text" class="form-control" value="{{ $container->container_name }}" readonly
                                    style="background-color: #e9ecef;">
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{ $container->dimensions }}" readonly
                                    style="background-color: #e9ecef;">
                            </td>
                            <td>
                                <input type="number" class="form-control" value="{{ $container->length }}">
                            </td>
                            <td>
                                <input type="number" class="form-control" value="{{ $container->breadth }}">
                            </td>
                            <td>
                                <input type="number" class="form-control" value="{{ $container->height }}">
                            </td>
                            <td>
                                <input type="number" class="form-control" value="{{ $container->volume }}" readonly
                                    style="background-color: #e9ecef;">
                            </td>
                            <td>
                                <input type="number" class="form-control" value="{{ $container->tare_weight }}" readonly
                                    style="background-color: #e9ecef;">
                            </td>
                            <td>
                                <input type="number" class="form-control" value="{{ $container->max_weight }}" readonly
                                    style="background-color: #e9ecef;">
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end gap-3 mt-3">
            <button class="btn btn-secondary bg-button-color ">Default Values</button>
            <button class="btn btn-secondary bg-button-color ">Update Containers</button>
        </div>
    </div>




</x-app-layout>