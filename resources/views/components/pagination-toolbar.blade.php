<div class="row col-md-12 d-flex mt-4 p-2 input-box align-items-center">
    <div class="col-md-6 d-flex p-2 align-items-center">
        <h3 class="profileUpdateFont fw-medium me-2">Show</h3>
        <select class="form-select input-width form-select-sm opacity-50" id="pageSizeSelect"
            onchange="location.href='{{ request()->url() }}?{{ $queryKey }}=' + this.value">
            @foreach($perPageOptions as $option)
                <option value="{{ $option }}" {{ request($queryKey, $defaultPerPage) == $option ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
        <h3 class="profileUpdateFont fw-medium ms-2">Entries</h3>
    </div>
    <div class="col-md-6">
        <div class="float-end">
            <div class="bottom-user-page mt-3">
                {!! $pagination->appends([$queryKey => request($queryKey, $defaultPerPage)])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>
