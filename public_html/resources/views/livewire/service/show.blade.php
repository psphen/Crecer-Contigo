<div>
    <div wire:init="loadView">
        <div wire:ignore.self class="card" id="show">
            <div class="card-header">
                <h5 class="card-title mb-3">{{__('Services')}}</h5>
            </div>
            <div class="card-datatable table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row me-2">
                        <div class="col-md-2">
                            <div class="me-3">
                                <div class="dataTables_length" id="DataTables_Table_0_length">
                                    @if($readyToLoad)
                                        @if($services->total()>10)
                                            <label>{{__('Show')}}
                                                <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select" wire:model="cant">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    @if($services->total()>25)
                                                        <option value="50">50</option>
                                                    @endif
                                                    @if($services->total()>50)
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
                                        <input type="search" class="form-control" placeholder="{{__('Search')}}.." wire:model.live="query">
                                    </label>
                                </div>
                                <div class="dt-buttons btn-group flex-wrap">
                                    <button class="btn btn-secondary add-new btn-primary mx-1" tabindex="0" data-bs-toggle="modal" data-bs-target="#create">
                                        <span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">{{__('Add service')}}</span></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead class="border-top">
                            <tr>
                                <th class="text-center">{{__('Name')}}</th>
                                <th class="text-center">{{__('Description')}}</th>
                                <th class="text-center">{{__('Sections')}}</th>
                                <th class="text-center">{{__('Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $service)
                                <tr>
                                    <td class="text-center">{{$service->name}}</td>
                                    <td class="text-center">{{$service->description}}</td>
                                    <td class="text-center">{{$service->sections}}</td>
                                    <td class="text-center">
                                        <div class="d-inline-block text-nowrap">
                                            <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#edit" wire:click="edit({{$service}})">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#delete" wire:click="delete({{$service}})">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="odd">
                                    <td valign="top" colspan="12" class="dataTables_empty text-center">{{$readyToLoad?__('No services registered'):__('Loading').'...'}}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if ($readyToLoad)
                        @if($services->total()!=0)
                            <div class="row mx-2 my-3">
                                <div class="col-md-5">
                                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                        {{__('Showing')}} {{ $services->firstItem() }} {{__('to')}} {{ $services->lastItem() }} {{__('of')}} {{ $services->total() }} {{__('results')}}
                                    </div>
                                </div>
                                <div class="col-md-7 d-flex justify-content-end">
                                    @if ($services->hasPages())
                                        {{$services->links('vendor.livewire.bootstrap')}}
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        @include('services.edit')
        @include('services.delete')
    </div>
</div>
