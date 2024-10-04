<?php

namespace App\Livewire\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;
use Carbon\Carbon;

class Show extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $listeners = [
        'SettingsShowChange',
        'SettingsShowRender' => 'render',
    ];

    public $configs; // Variable de estado para almacenar los valores ingresados en el formulario
    public $logo_width = 160;
    public $logo_height = 85;
    public $favicon_width = 50;
    public $favicon_height = 50;
    public $newLogo;
    public $newFavicon;
    public $watermark_width = 400;
    public $watermark_height = 400;
    public $banner_width = 1920;
    public $banner_height = 550;

    public function hydrate()
    {
        $this->emit('SettingsShowHydrate');
    }

    public function SettingsShowChange($value, $key)
    {
        $this->$key = $value;
    }

    public function mount()
    {
        $this->loadConfigs();
    }

    public function loadConfigs()
    {
        $existingConfigs = Setting::all();
        $this->configs = [];

        foreach ($existingConfigs as $config) {
            $this->configs[$config->name] = $config->val;
        }

        // Agregar registros de ejemplo si el arreglo está vacío
        if (empty($this->configs)) {
            //General
            $this->configs['app_name'] = '';
            $this->configs['logo'] = '';
            $this->configs['favicon'] = '';
            $this->configs['logo_white'] = '';
            $this->configs['logo_secondary'] = '';
            $this->configs['logo_third'] = '';
            $this->configs['watermark'] = '';
            $this->configs['banner_default'] = '';
            $this->configs['subtitle'] = '';
            $this->configs['description'] = '';
            //Mail
            $this->configs['mail_driver']='';
            $this->configs['mail_host']='';
            $this->configs['mail_port']='';
            $this->configs['mail_username']='';
            $this->configs['mail_password']='';
            $this->configs['mail_encryption']='';
            $this->configs['mail_from_address']='';
            $this->configs['mail_from_name']='';
            //Google Maps
            $this->configs['google_map_api_key']='';
            $this->configs['facebook_app_id']='';
            $this->configs['facebook_app_secret']='';
            $this->configs['google_app_id']='';
            $this->configs['google_app_secret']='';
            // Agregar más registros de ejemplo según sea necesario
        }
    }

    public function updatedNewLogo()
    {
        $this->validate([
            'newLogo' => 'image|max:2048', // Agrega las validaciones necesarias para la imagen del logo
        ]);
    }

    public function updatedNewFavicon()
    {
        $this->validate([
            'newFavicon' => 'image|max:2048', // Agrega las validaciones necesarias para la imagen del favicon
        ]);
    }

    public function save()
    {
        foreach ($this->configs as $name => $val) {
            if ($name === 'logo' || $name === 'favicon'||$name === 'logo_white'||$name === 'watermark'||$name === 'logo_secondary'||$name === 'logo_third'|$name === 'banner_default') {
                if ($val instanceof \Livewire\TemporaryUploadedFile) {
                    $fileName = Str::random(40) . '.' . $val->getClientOriginalExtension();
                    $filePath = 'uploads/settings/' . $fileName;
                    $image = Image::make($val);
                    if ($name === 'logo'||$name === 'logo_white'||$name === 'logo_secondary'||$name === 'logo_third') {
//                        $image->resize($this->logo_width, $this->logo_height);
                    } elseif ($name === 'favicon') {
                        $image->resize($this->favicon_width, $this->favicon_height);
                    }
//                    elseif ($name === 'watermark') {
////                        $image->resize($this->watermark_width, $this->watermark_height);
//                    }
                    elseif ($name === 'banner_default') {
                        $image->resize($this->banner_width, $this->banner_height);
                    }
                    $image->save(public_path($filePath), 50);
                    $oldFileName = Setting::where('name', $name)->value('val');
                    Setting::updateOrCreate(['name' => $name], ['val' => $fileName]);
                    if ($oldFileName && $oldFileName !== $fileName) {
                        File::delete(public_path('uploads/settings/' . $oldFileName));
                    }
                    $this->configs[$name] = $fileName;

                }
            } else {
                Setting::updateOrCreate(['name' => $name], ['val' => $val]);
                $this->configs[$name] = $val;
            }
        }
        $this->emitTo('settings.show', 'render');
        $this->emit('alert', __('Updated Setting!'), '#show');
        $this->emit('SettingsShowRender');
    }
    public function render()
    {
        $logoUrl = $this->configs['logo'] && $this->configs['logo'] instanceof \Livewire\TemporaryUploadedFile
            ? $this->configs['logo']->temporaryUrl()
            : null;
        $logoSecondaryUrl = $this->configs['logo_secondary'] && $this->configs['logo_secondary'] instanceof \Livewire\TemporaryUploadedFile
            ? $this->configs['logo_secondary']->temporaryUrl()
            : null;
        $logoThirdUrl = $this->configs['logo_third'] && $this->configs['logo_third'] instanceof \Livewire\TemporaryUploadedFile
            ? $this->configs['logo_third']->temporaryUrl()
            : null;
        $logoWhiteUrl = $this->configs['logo_white'] && $this->configs['logo_white'] instanceof \Livewire\TemporaryUploadedFile
            ? $this->configs['logo_white']->temporaryUrl()
            : null;
        $watermarkUrl = $this->configs['watermark'] && $this->configs['watermark'] instanceof \Livewire\TemporaryUploadedFile
            ? $this->configs['watermark']->temporaryUrl()
            : null;
        $bannerUrl = $this->configs['banner_default'] && $this->configs['banner_default'] instanceof \Livewire\TemporaryUploadedFile
            ? $this->configs['banner_default']->temporaryUrl()
            : null;
        $faviconUrl = $this->configs['favicon'] && $this->configs['favicon'] instanceof \Livewire\TemporaryUploadedFile
            ? $this->configs['favicon']->temporaryUrl()
            : null;
        return view('livewire.settings.show', compact('logoUrl', 'faviconUrl','logoWhiteUrl','watermarkUrl','logoSecondaryUrl','logoThirdUrl','bannerUrl'));
    }


}
