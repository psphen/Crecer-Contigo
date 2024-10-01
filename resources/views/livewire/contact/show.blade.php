<div>
    <div wire:init="readyToLoad">
        <div wire:ignore.self class="card" id="show">
            <div class="card-header">
                <h5 class="card-title mb-3">{{__('Contacts')}}</h5>
            </div>
            <div class="card-datatable table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row me-2">
                        <div class="col-md-2">
                            <div class="me-3">
                                <div class="dataTables_length" id="DataTables_Table_0_length">
                                    @if($readyToLoad)
                                        @if($contacts->total()>10)
                                            <label>{{__('Show')}}
                                                <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select" wire:model="cant">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    @if($contacts->total()>25)
                                                        <option value="50">50</option>
                                                    @endif
                                                    @if($contacts->total()>50)
                                                        <option value="100">100</option>
                                                    @endif
                                                </select>
                                                {{__('entries')}}
                                            </label>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                    <label for="">
                                        <select wire:model="orderBy.field" id="order_by" class="form-select mx-0">
                                            @foreach ($orderByOptions as $value => $label)
                                                <option value="{{ $value }}">{{ __($label) }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    <label for="">
                                        <select wire:model="orderBy.direction" id="order_direction" class="form-select mx-0">
                                            <option value="asc">{{__('Ascendant')}}</option>
                                            <option value="desc">{{__('Descendant')}}</option>
                                        </select>
                                    </label>
                                    <label>
                                        <input type="search" class="form-control" placeholder="{{__('Search')}}.." aria-controls="DataTables_Table_0" wire:model="query">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead class="border-top">
                        <tr>
                            <th class="text-center">{{__('Name')}}</th>
                            <th class="text-center">{{__('Phone')}}</th>
                            <th class="text-center">{{__('Comment')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($contacts as $contact)
                            <tr>
                                <td class="text-center">{{$contact->name}}</td>
                                <td class="text-center">{{$contact->phone}}</td>
                                <td class="text-center">{{$contact->comment}}</td>
                            </tr>
                        @empty
                            <tr class="odd">
                                <td valign="top" colspan="12" class="dataTables_empty text-center">{{$readyToLoad?__('No contact registered'):__('Loading').'...'}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    @if ($readyToLoad)
                        @if($contacts->total()!=0)
                            <div class="row mx-2 my-3">
                                <div class="col-md-5">
                                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                        {{__('Showing')}} {{ $contacts->firstItem() }} {{__('to')}} {{ $contacts->lastItem() }} {{__('of')}} {{ $contacts->total() }} {{__('results')}}
                                    </div>
                                </div>
                                <div class="col-md-7 d-flex justify-content-end">
                                    @if ($contacts->hasPages())
                                        {{$contacts->links('vendor.livewire.bootstrap')}}
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
