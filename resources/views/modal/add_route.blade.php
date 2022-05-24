<div class="modal fade" id="addRouteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog small" role="document">
        <div class="modal-content card shadow">
            <div class="modal-header card-header card-header-primary d-flex justify-content-between align-items-center">
                <h5 class="modal-title"> {{ __('Update Route') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('docroutes.create')}}"  id="add_route_form" name="add_route_form">
                {{-- <form> --}}
                    @csrf
                    @method('post')
                    <input type="hidden" name="doc_id" value="{{ __($document->id) }}">
                    {{-- <input type="hidden" name="doc_id" value="{{$document->id}}"> --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="date_received"> {{ __('Date Receieved') }}</label>
                                        <input type="text" id="date_received" name="date_received"
                                            class="form-control datepicker" required="true" aria-required="true">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="focal"> {{ __('Focal Person') }}</label>
                                        <input placeholder="Employee name" data-db="employee" type="text"
                                            id="employee_id" name="focal" class="form-control autocomp" required="true"
                                            aria-required="true">
                                        <input type="hidden" name="employee_id">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="RouteAction"> {{ __('RouteAction') }}</label>
                                        <textarea class="form-control" id="RouteAction" name="action" rows="3"></textarea>
                                        @if ($errors->has('RouteAction'))
                                            <span id="name-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('RouteAction') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="division"> {{ __('Division') }}</label>
                                        <input placeholder="Routing Division" data-db="Division" type="text"
                                            id="division_id" name="division" class="form-control autocomp"
                                            required="true" aria-required="true">
                                        <input type="hidden" name="division_id">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" id="addRoute" class="btn btn-success float-left">Update</button>
                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@push('js')

@endpush
