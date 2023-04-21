<div class="panel panel-default address-panel-wrapper mb-4">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#addAddressFormCollapse">
                Add more address?
            </a>
        </h4>
    </div>
    <div id="addAddressFormCollapse" class="panel-collapse collapse">
        <div class="panel-body">
            <form action="{{ route('customer.info.address.add') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="citySelect" class="form-label">City(*)</label>
                            <select id="citySelect" class="form-control" name="city"></select>
                            @error('city')
                                <div class="alert alert-danger mt-1" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="districtSelect" class="form-label">District(*)</label>
                            <select id="districtSelect" class="form-control" name="district"></select>
                            @error('district')
                                <div class="alert alert-danger mt-1" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="wardSelect" class="form-label">Ward(*)</label>
                            <select id="wardSelect" class="form-control" name="ward"></select>
                            @error('ward')
                                <div class="alert alert-danger mt-1" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="specificAddress" class="form-label">Specific Address(*)</label>
                            <input id="specificAddress" class="form-control" name="specificAddress"
                                placeholder="Specific address..." required>
                            @error('specificAddress')
                                <div class="alert alert-danger mt-1" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="addressTypeSelect" class="form-label">Type(*)</label>
                            <select id="addressTypeSelect" class="form-control" name="addressType">
                                <option value="{{ AddressType::HOME }}">{{ AddressType::HOME }}</option>
                                <option value="{{ AddressType::OFFICE }}">{{ AddressType::OFFICE }}</option>
                            </select>
                            @error('defaultFlag')
                                <div class="alert alert-danger mt-1" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="defaultFlagSelect" class="form-label">Default(*)</label>
                            <select id="defaultFlagSelect" class="form-control" name="defaultFlag">
                                <option value="false">No</option>
                                <option value="true">Yes</option>
                            </select>
                            @error('defaultFlag')
                                <div class="alert alert-danger mt-1" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn action-btn register-btn mt-3">Add address</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('assets/js/load-address-province-api.js') }}"></script>
@endpush
