<div wire:init="readyToLoad">
    <div wire:ignore.self class="card" id="show">
        <div class="card-header">
            <h5 class="card-title mb-3">{{__('Vendors')}}</h5>
        </div>
        <div class="card-datatable table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="row me-2">
                    <div class="col-md-2">
                        <div class="me-3">
                            <div class="dataTables_length" id="DataTables_Table_0_length">
                                @if($readyToLoad)
                                    @if($vendors->total()>10)
                                        <label>{{__('Show')}}
                                            <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select" wire:model="cant">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                @if($vendors->total()>25)
                                                    <option value="50">50</option>
                                                @endif
                                                @if($vendors->total()>50)
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
                            <div class="dt-buttons btn-group flex-wrap">
                                <button class="btn btn-secondary add-new btn-primary mx-1" tabindex="0" data-bs-toggle="modal" data-bs-target="#create">
                                    <span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">{{__('Add vendor')}}</span></span>
                                </button>
                            </div>
                            <div class="">
                                <div class="mb-3">
                                    <input class="form-control" type="file" id="formFile"wire:model="file">
                                </div>
                            </div>
                            <div class="">
                                <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="import" wire:click='import'>
                                    {{__('Import')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead class="border-top">
                    <tr>
                        <th class="text-center">{{__('Image')}}</th>
                        <th class="text-center">{{__('First name')}}</th>
                        <th class="text-center">{{__('Last name')}}</th>
                        <th class="text-center">{{__('Email')}}</th>
                        <th class="text-center">{{__('Phone')}}</th>
                        <th class="text-center">{{__('Dni')}}</th>
                        <th class="text-center">{{__('Actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($vendors as $vendor)
                        <tr>
                            <td class="text-center">
                                @if($vendor->user->profile_photo!=null)
                                    <div class="avatar-wrapper d-flex justify-content-center">
                                        <div class="avatar-xl avatar-lg">
                                            <img src="{{asset('uploads/users/'.$vendor->user->profile_photo)}}" alt="Avatar" class="w-100 h-100 rounded-circle">
                                        </div>
                                    </div>
                                @else
                                    <div class="avatar-wrapper d-flex justify-content-center">
                                        <div class="avatar avatar-lg">
                                            <span class="avatar-initial rounded-circle bg-label-primary">{{$vendor->first_name[0]}}</span>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td class="text-center">{{$vendor->first_name}}</td>
                            <td class="text-center">{{$vendor->last_name}}</td>
                            <td class="text-center">{{$vendor->user->email}}</td>
                            <td class="text-center">{{$vendor->phone}}</td>
                            <td class="text-center">{{$vendor->dni}}</td>
                            <td class="text-center">
                                <div class="d-inline-block text-nowrap">
                                    <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#edit" wire:click="edit({{$vendor}})"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#delete" wire:click="delete({{$vendor}})"><i class="ti ti-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="odd">
                            <td valign="top" colspan="12" class="dataTables_empty text-center">{{$readyToLoad?__('No vendors registered'):__('Loading').'...'}}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                @if ($readyToLoad)
                    @if($vendors->total()!=0)
                        <div class="row mx-2 my-3">
                            <div class="col-md-5">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                    {{__('Showing')}} {{ $vendors->firstItem() }} {{__('to')}} {{ $vendors->lastItem() }} {{__('of')}} {{ $vendors->total() }} {{__('results')}}
                                </div>
                            </div>
                            <div class="col-md-7 d-flex justify-content-end">
                                @if ($vendors->hasPages())
                                    {{$vendors->links('vendor.livewire.bootstrap')}}
                                @endif
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
    @include('vendors.edit')
    @include('vendors.delete')
</div>
