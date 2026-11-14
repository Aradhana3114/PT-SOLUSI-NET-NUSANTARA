<?php

namespace App\Filament\Pages;

use App\Filament\Support\ImageUpload;
use App\Models\SiteSetting;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use UnitEnum;

class ManageSettings extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string|UnitEnum|null $navigationGroup = 'Konfigurasi';

    protected static ?string $navigationLabel = 'Settings';

    protected static ?string $title = 'Pengaturan Website';

    protected static ?string $slug = 'settings';

    protected string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(SiteSetting::current()->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Settings')->tabs([
                    Tab::make('Profile')->schema([
                        TextInput::make('site_name')->label('Nama Website')->required(),
                        RichEditor::make('site_description')->label('Deskripsi Website'),
                        FileUpload::make('logo')
                            ->label('Logo Website')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                            ->maxSize(10240)
                            ->imagePreviewHeight('120')
                            ->openable()
                            ->downloadable(),
                    ]),
                    Tab::make('Gambar Beranda')->schema([
                        ImageUpload::make('hero_image', 'settings/home')->label('Gambar Banner Utama'),
                        ImageUpload::make('about_image', 'settings/home')->label('Gambar Bagian Tentang Kami'),
                        ImageUpload::make('cta_image', 'settings/home')->label('Gambar Bagian Ajakan Kontak'),
                    ]),
                    Tab::make('Kontak')->schema([
                        TextInput::make('email')->email(),
                        TextInput::make('phone')->label('Phone (format 62xxx)'),
                        Textarea::make('address')->label('Alamat')->rows(3),
                        TextInput::make('maps_url')->label('Maps (URL)')->url(),
                        TextInput::make('latitude')->label('Latitude (peta di halaman Kontak)')
                            ->numeric()->minValue(-90)->maxValue(90)
                            ->helperText('Contoh: -6.5971470. Di Google Maps klik kanan titik lokasi, lalu klik angka koordinat untuk menyalin.'),
                        TextInput::make('longitude')->label('Longitude (peta di halaman Kontak)')
                            ->numeric()->minValue(-180)->maxValue(180)
                            ->helperText('Contoh: 106.8060390'),
                    ]),
                    Tab::make('Media Sosial')->schema([
                        TextInput::make('facebook')->label('Facebook')->url(),
                        TextInput::make('instagram')->url(),
                        TextInput::make('tiktok')->label('TikTok')->url(),
                    ]),
                ])->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();
        SiteSetting::current()->update($state);

        Notification::make()
            ->title('Pengaturan tersimpan')
            ->body('Perubahan berhasil disimpan.')
            ->icon('heroicon-o-check-circle')
            ->iconColor('success')
            ->success()
            ->send();
    }
}
