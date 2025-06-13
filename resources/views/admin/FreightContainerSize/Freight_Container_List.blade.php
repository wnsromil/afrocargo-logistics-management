<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CBM Calculator') }}
        </h2>
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Container Dimensions</p>
    </x-slot>

    <form>
        <div class="row">
            <div class="col-12 form-group-customer">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center containerSizeTable">
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
                            @foreach ($containerSizes as $container)
                            <tr>
                                <td class="pe-3">
                                    <input type="text" class="form-control inp" value="{{ $container->container_name }}" readonly style="background-color: #e9ecef;">
                                </td>
                                <td class="pe-4">
                                    <input type="text" class="form-control inp" value="{{ $container->dimensions }}" readonly style="background-color: #e9ecef;">
                                </td>
                                <td>
                                    <input type="number" class="form-control inp" value="{{ $container->length }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control inp" value="{{ $container->breadth }}">
                                </td>
                                <td class="pe-3">
                                    <input type="number" class="form-control inp" value="{{ $container->height }}">
                                </td>
                                <td class="pe-3">
                                    <input type="number" class="form-control inp" value="{{ $container->volume }}" readonly style="background-color: #e9ecef;">
                                </td>
                                <td>
                                    <input type="number" class="form-control inp" value="{{ $container->tare_weight }}" readonly style="background-color: #e9ecef;">
                                </td>
                                <td>
                                    <input type="number" class="form-control inp" value="{{ $container->max_weight }}" readonly style="background-color: #e9ecef;">
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <div class="text-end">

                        <button type="button" class="btn btn-outline-primary">Default Values</button>

                        <button type="submit" class="btn btn-primary ">Update Containers</button>

                    </div>
                </div>
            </div>
        </div>
    </form>




</x-app-layout>
