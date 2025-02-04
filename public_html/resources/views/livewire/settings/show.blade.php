<div>
    <div wire:ignore.self class="row" id="show">
        <div class="col-md-12">
            <h4 class="fw-bold py-3 mb-4">{{__('Settings system')}}</h4>
            <form wire:submit.prevent="save" enctype="multipart/form-data">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">{{__('General')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3 g-3">
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label" for="app_name">{{__('App Name')}}</label>
                                <input type="text" class="form-control" id="app_name" placeholder="" wire:model="configs.app_name">
                            </div>
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label" for="subtitle">{{__('Subtitle')}}</label>
                                <input type="text" class="form-control" id="subtitle" placeholder="" wire:model="configs.subtitle">
                            </div>
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label" for="description">{{__('Description')}}</label>
                                <textarea  class="form-control" id="description" placeholder="" wire:model="configs.description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">{{__('Images')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3 g-3">
                            <div class="col-12">
                                <div class="">
                                    @if ($faviconUrl)
                                        <img src="{{ $faviconUrl }}" alt="Favicon Preview" style="max-width: 200px;">
                                    @elseif($configs['favicon'])
                                        <img src="{{ asset('uploads/settings/'.$configs['favicon']) }}" alt="Logo Preview" style="max-width: 200px;">
                                    @endif
                                </div>
                                <label class="col-sm-2 col-form-label" for="favicon">{{__('Favicon')}}</label>
                                <input type="file" class="form-control" id="favicon" wire:model="configs.favicon">
                            </div>
                            <div class="col-12">
                                <div class="">
                                    @if ($logoUrl)
                                        <img src="{{ $logoUrl }}" alt="Logo Preview" style="max-width: 200px;">
                                    @elseif($configs['logo'])
                                        <img src="{{ asset('uploads/settings/'.$configs['logo']) }}" alt="Logo Preview" style="max-width: 200px;">
                                    @endif
                                </div>
                                <label class="col-sm-2 col-form-label" for="logo">{{__('Logo')}}</label>
                                <input type="file" class="form-control" id="logo" wire:model="configs.logo">
                            </div>
                            <div class="col-12">
                                <div class="">
                                    @if ($logoWhiteUrl)
                                        <img src="{{ $logoWhiteUrl }}" alt="Logo Preview" style="max-width: 200px;">
                                    @elseif($configs['logo_white'])
                                        <img src="{{ asset('uploads/settings/'.$configs['logo_white']) }}" alt="Logo Preview" style="max-width: 200px;">
                                    @endif
                                </div>
                                <label class="col-sm-2 col-form-label" for="logo">{{__('Logo white')}}</label>
                                <input type="file" class="form-control" id="logo" wire:model="configs.logo_white">

                            </div>
                            <div class="col-12">
                                <div class="">
                                    @if ($logoSecondaryUrl)
                                        <img src="{{ $logoSecondaryUrl }}" alt="Logo Preview" style="max-width: 200px;">
                                    @elseif($configs['logo_secondary'])
                                        <img src="{{ asset('uploads/settings/'.$configs['logo_secondary']) }}" alt="Logo Preview" style="max-width: 200px;">
                                    @endif
                                </div>
                                <label class="col-sm-2 col-form-label" for="logo">{{__('Logo secondary')}}</label>
                                <input type="file" class="form-control" id="logo" wire:model="configs.logo_secondary">
                            </div>
                            <div class="col-12">
                                <div class="">
                                    @if ($logoThirdUrl)
                                        <img src="{{ $logoThirdUrl }}" alt="Logo Preview" style="max-width: 200px;">
                                    @elseif($configs['logo_third'])
                                        <img src="{{ asset('uploads/settings/'.$configs['logo_third']) }}" alt="Logo Preview" style="max-width: 200px;">
                                    @endif
                                </div>
                                <label class="col-sm-2 col-form-label" for="logo">{{__('Logo third')}}</label>
                                <input type="file" class="form-control" id="logo" wire:model="configs.logo_third">
                            </div>
                            <div class="col-12">
                                <div class="">
                                    @if ($watermarkUrl)
                                        <img src="{{ $watermarkUrl }}" alt="Logo Preview" style="max-width: 200px;">
                                    @elseif($configs['watermark'])
                                        <img src="{{ asset('uploads/settings/'.$configs['watermark']) }}" alt="Logo Preview" style="max-width: 200px;">
                                    @endif
                                </div>
                                <label class="col-sm-2 col-form-label" for="logo">{{__('Watermark')}}</label>
                                <input type="file" class="form-control" id="logo" wire:model="configs.watermark">
                            </div>
                            <div class="col-12">
                                <div class="">
                                    @if ($bannerUrl)
                                        <img src="{{ $bannerUrl }}" alt="Logo Preview" style="max-width: 200px;">
                                    @elseif($configs['banner_default'])
                                        <img src="{{ asset('uploads/settings/'.$configs['banner_default']) }}" alt="Logo Preview" style="max-width: 200px;">
                                    @endif
                                </div>
                                <label class="col-sm-2 col-form-label" for="banner">{{__('Banner default')}}</label>
                                <input type="file" class="form-control" id="banner" wire:model="configs.banner_default">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">{{__('Mail configuration')}}</h5>
                    </div>
                    <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">{{__('Mail driver')}}</label>
                                    <input type="text" class="form-control" id="app_name" placeholder="" wire:model="configs.mail_driver">
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">{{__('Mail host')}}</label>
                                    <input type="text" class="form-control" id="app_name" placeholder="" wire:model="configs.mail_host">
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">{{__('Mail port')}}</label>
                                    <input type="text" class="form-control" id="app_name" placeholder="" wire:model="configs.mail_port">
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">{{__('Mail username')}}</label>
                                    <input type="text" class="form-control" id="app_name" placeholder="" wire:model="configs.mail_username">
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">{{__('Mail password')}}</label>
                                    <input type="text" class="form-control" id="app_name" placeholder="" wire:model="configs.mail_password">
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">{{__('Mail encryption')}}</label>
                                    <input type="text" class="form-control" id="app_name" placeholder="" wire:model="configs.mail_encryption">
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">{{__('Mail from address')}}</label>
                                    <input type="text" class="form-control" id="app_name" placeholder="" wire:model="configs.mail_from_address">
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">{{__('Mail from name')}}</label>
                                    <input type="text" class="form-control" id="app_name" placeholder="" wire:model="configs.mail_from_name">
                                </div>
                            </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">{{__('Google Maps')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">{{__('API Key Google maps')}}</label>
                                <input type="text" class="form-control" id="app_name" placeholder="" wire:model="configs.google_map_api_key">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">{{__('Social login')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">{{__('Facebook App ID')}}</label>
                                <input type="text" class="form-control" id="app_name" placeholder="" wire:model="configs.facebook_app_id">
                            </div>
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">{{__('Facebook App Secret')}}</label>
                                <input type="text" class="form-control" id="app_name" placeholder="" wire:model="configs.facebook_app_secret">
                            </div>
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">{{__('Google App ID')}}</label>
                                <input type="text" class="form-control" id="app_name" placeholder="" wire:model="configs.google_app_id">
                            </div>
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">{{__('Google App Secret')}}</label>
                                <input type="text" class="form-control" id="app_name" placeholder="" wire:model="configs.google_app_secret">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="save">
                            {{__('Save')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
