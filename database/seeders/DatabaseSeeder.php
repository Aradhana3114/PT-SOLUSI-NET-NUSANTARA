<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@solusikoneksianda.com'],
            ['name' => 'Admin', 'password' => Hash::make('password')]
        );

        $setting = SiteSetting::current();
        $setting->update([
            'site_name' => 'PT Solusi Nusantara',
            'site_description' => '<p><strong>PT Solusi Nusantara</strong> adalah penyedia solusi konektivitas dan jaringan yang membantu kebutuhan internet bisnis maupun rumah Anda.</p>'
                .'<p>Kami menyediakan layanan internet broadband, instalasi jaringan, dan maintenance dengan dukungan teknisi berpengalaman serta solusi yang dapat disesuaikan.</p>'
                .'<p><strong>Layanan yang kami tawarkan:</strong></p><ul><li>Internet broadband yang cepat dan stabil</li><li>Instalasi jaringan untuk rumah, kantor, dan bisnis</li><li>Maintenance dan perawatan jaringan berkala</li></ul>'
                .'<p>Dengan layanan yang responsif dan berorientasi pada kualitas, kami siap membantu memastikan koneksi dan jaringan Anda tetap optimal.</p>',
            'email' => 'info@solusikoneksianda.com',
            'phone' => '6281295312290',
            'address' => 'Pesona Kahuripan 2 Gg Tulip IX Blok B13 No.26. RT/RW : 002/026. Kel/Desa : Cikahuripan. Kecamatan : Klapanunggal',
            'maps_url' => 'https://www.google.com/maps/place/SMK+AK+Nusa+Bangsa/@-6.5534166,106.7719699,17z/data=!3m1!4b1!4m6!3m5!1s0x2e69c386205f18f9:0xaf869d94c5b9c42a!8m2!3d-6.5534166!4d106.7745448!16s%2Fg%2F11h06m5kf?entry=ttu&g_ep=EgoyMDI2MTEwMS4wIKXMDSoASAFQAw%3D%3D',
            'latitude' => -6.5534166,
            'longitude' => 106.7745448,
            'facebook' => 'https://www.facebook.com/',
            'instagram' => 'https://www.instagram.com/',
            'tiktok' => 'https://www.tiktok.com/',
        ]);

        $serviceCatalog = [
            [
                'name' => 'Paket WiFi Rumah 20 Mbps',
                'wifi_name' => 'NEXLINK-WIFI-20M',
                'speed_mbps' => 20,
                'price' => 250000,
                'monthly_fee' => 250000,
                'short_description' => 'Koneksi internet cepat dan stabil untuk kebutuhan rumah, kantor, dan bisnis.',
                'description' => '<p>Kami menyediakan layanan internet broadband yang cepat, stabil, dan sesuai kebutuhan konektivitas Anda.</p><h3>Keunggulan Layanan</h3><ul><li>Koneksi stabil</li><li>Paket sesuai kebutuhan</li><li>Dukungan teknis responsif</li></ul>',
            ],
            [
                'name' => 'Paket WiFi Keluarga 50 Mbps',
                'wifi_name' => 'NEXLINK-WIFI-50M',
                'speed_mbps' => 50,
                'price' => 450000,
                'monthly_fee' => 450000,
                'short_description' => 'Solusi instalasi jaringan yang rapi, aman, dan siap digunakan.',
                'description' => '<p>Kami membantu merancang dan memasang jaringan untuk rumah, kantor, maupun bisnis dengan pengerjaan yang rapi dan terukur.</p><h3>Cakupan Instalasi</h3><ul><li>Jaringan LAN dan Wi-Fi</li><li>Penarikan kabel jaringan</li><li>Konfigurasi perangkat jaringan</li></ul>',
            ],
            [
                'name' => 'Paket WiFi Bisnis 100 Mbps',
                'wifi_name' => 'NEXLINK-BUSINESS-100M',
                'speed_mbps' => 100,
                'price' => 750000,
                'monthly_fee' => 750000,
                'short_description' => 'Perawatan jaringan untuk menjaga koneksi tetap optimal dan minim gangguan.',
                'description' => '<p>Kami menyediakan layanan maintenance untuk memantau, merawat, dan menangani gangguan jaringan secara berkala.</p><h3>Layanan Maintenance</h3><ul><li>Pengecekan perangkat jaringan</li><li>Perbaikan gangguan koneksi</li><li>Optimasi dan perawatan berkala</li></ul>',
            ],
        ];

        foreach ($serviceCatalog as $order => $service) {
            Service::updateOrCreate(['slug' => Str::slug($service['name'])], [
                ...$service,
                'sort_order' => $order + 1,
                'is_active' => true,
            ]);
        }

        Service::whereNotIn('slug', collect($serviceCatalog)->pluck('name')->map(fn (string $name): string => Str::slug($name)))->delete();

        $serviceDetails = [
            [
                'name' => 'Pembuatan Website',
                'description' => 'Website profesional untuk memperkuat kehadiran digital bisnis Anda.',
                'detail_description' => '<p>Kami membuat website profesional, cepat, responsif, dan mudah dikelola untuk membantu bisnis tampil lebih terpercaya di dunia digital.</p><h3>Solusi Website</h3><ul><li>Company profile</li><li>Landing page</li><li>Toko online</li><li>Website custom sesuai kebutuhan</li></ul>',
            ],
            [
                'name' => 'Pembuatan Aplikasi',
                'description' => 'Aplikasi web dan mobile untuk mendukung proses bisnis Anda.',
                'detail_description' => '<p>Kami mengembangkan aplikasi yang aman, mudah digunakan, dan disesuaikan dengan alur kerja bisnis Anda.</p><h3>Solusi Aplikasi</h3><ul><li>Aplikasi web dan mobile</li><li>Sistem informasi</li><li>Dashboard bisnis</li><li>Aplikasi custom</li></ul>',
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'Desain antarmuka yang menarik dan pengalaman pengguna yang nyaman.',
                'detail_description' => '<p>Kami merancang pengalaman digital yang intuitif agar pengguna lebih mudah memahami dan menggunakan website atau aplikasi Anda.</p><h3>Layanan UI/UX</h3><ul><li>User research</li><li>Wireframe</li><li>User flow</li><li>Prototype</li><li>Desain antarmuka</li></ul>',
            ],
            [
                'name' => 'Desain Grafis',
                'description' => 'Solusi visual untuk membangun identitas dan komunikasi brand Anda.',
                'detail_description' => '<p>Kami membantu brand Anda tampil konsisten dan profesional melalui desain visual yang kreatif dan sesuai karakter bisnis.</p><h3>Layanan Desain</h3><ul><li>Logo dan branding</li><li>Banner dan poster</li><li>Konten media sosial</li><li>Materi promosi</li></ul>',
            ],
        ];

        $galleryItems = [
            ['title' => 'Website Company Profile Internet', 'description' => 'Tampilan website company profile untuk memperkenalkan layanan internet broadband.', 'image' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1200&q=85'],
            ['title' => 'Dashboard Layanan Internet', 'description' => 'Dashboard informasi layanan dan pemantauan koneksi internet pelanggan.', 'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=85'],
            ['title' => 'Instalasi Jaringan', 'description' => 'Proses instalasi jaringan internet yang rapi dan profesional.', 'image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1200&q=85'],
            ['title' => 'Teknisi Maintenance Jaringan', 'description' => 'Dukungan teknisi dalam menjaga koneksi internet tetap stabil.', 'image' => 'https://images.unsplash.com/photo-1581092921461-eab62e97a780?auto=format&fit=crop&w=1200&q=85'],
        ];

        foreach ($galleryItems as $order => $item) {
            Gallery::updateOrCreate(['title' => $item['title']], [
                ...$item,
                'sort_order' => $order + 1,
                'is_active' => true,
            ]);
        }

        Gallery::whereNotIn('title', collect($galleryItems)->pluck('title'))->delete();

        $tags = collect(['Travel', 'Project', 'Technology', 'Life style', 'Design'])
            ->mapWithKeys(fn ($n) => [$n => Tag::firstOrCreate(['slug' => Str::slug($n)], ['name' => $n])]);

        $articles = [
            [
                'post_name' => 'GoTo dan Indosat Luncurkan Sahabat-AI, LLM Open Source Berbahasa Indonesia',
                'title' => 'GoTo dan Indosat Luncurkan Sahabat-AI, LLM Open Source Berbahasa Indonesia',
                'content' => '<p>PT GoTo Gojek Tokopedia Tbk (GOTO) bersama PT Indosat Ooredoo Hutchison Tbk resmi meluncurkan teknologi kecerdasan buatan atau Artificial Intelligence (AI) bernama "Sahabat-AI" dalam gelaran Indonesia AI Day, Kamis, 14 November 2024.</p><p>Sahabat-AI merupakan platform Large Language Model (LLM) open-source pertama di Indonesia. LLM ini dikembangkan untuk memahami bahasa alami dan membantu masyarakat mengakses teknologi digital dengan cara yang lebih mudah, aman, dan relevan dengan kebutuhan lokal.</p><p>Kehadiran teknologi ini menjadi langkah penting bagi perkembangan ekosistem digital Indonesia. Dengan dukungan bahasa Indonesia dan berbagai bahasa daerah, Sahabat-AI diharapkan dapat digunakan oleh pelajar, pelaku usaha, pengembang aplikasi, serta institusi pemerintahan.</p><p>Pemanfaatan AI juga membuka peluang baru dalam bidang pendidikan, layanan pelanggan, kesehatan, dan produktivitas bisnis. Namun, pengembangannya tetap perlu memperhatikan keamanan data, etika, serta penggunaan teknologi yang bertanggung jawab.</p><p>Melalui kolaborasi antara perusahaan teknologi, komunitas, dan masyarakat, inovasi seperti Sahabat-AI dapat terus dikembangkan agar memberikan manfaat nyata serta membantu mempercepat transformasi digital di Indonesia.</p>',
                'tag' => 'Technology', 'date' => '2024-11-14 09:00:00',
                'title_image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'post_name' => 'Profil Magelang Setories, Juara Program Akselerator GoTo yang Tawarkan Inovasi Pertanian Organik',
                'title' => 'GoTo Impact Foundation mengumumkan 4 pemenang program Catalyst Changemakers Ecosystem (CCE 3.0). Ada nama Magelang Setories.',
                'content' => '<p>Magelang Setories, inovator agribisnis berkelanjutan, terpilih sebagai salah satu pemenang program Catalyst Changemakers Ecosystem (CCE) 3.0 yang diadakan GoTo Impact Foundation (GIF), sebuah program akselerator untuk mendukung usaha yang memberikan dampak positif.</p><p>Inisiatif ini berawal dari kepedulian terhadap potensi pertanian organik di Magelang. Para petani dan pengelola usaha lokal bekerja sama menghasilkan produk pangan yang sehat, berkualitas, dan tetap menjaga keseimbangan lingkungan.</p><p>Selain mengembangkan produk, Magelang Setories juga membantu memperkuat kapasitas petani melalui pendampingan, edukasi, dan pemanfaatan teknologi. Pendekatan tersebut membuat proses produksi menjadi lebih terukur sekaligus meningkatkan nilai jual hasil pertanian.</p><p>Dukungan dari program akselerator digunakan untuk memperluas jaringan pemasaran, memperbaiki proses bisnis, dan membangun hubungan yang lebih kuat dengan konsumen. Dengan cara ini, produk lokal dapat menjangkau pasar yang lebih luas tanpa kehilangan identitasnya.</p><p>Kisah Magelang Setories menunjukkan bahwa inovasi tidak selalu harus dimulai dari teknologi yang rumit. Pemanfaatan sumber daya lokal, kolaborasi, dan komitmen terhadap keberlanjutan dapat menciptakan perubahan yang berarti bagi masyarakat.</p>',
                'tag' => 'Project', 'date' => '2024-11-14 10:00:00',
                'title_image' => 'https://images.unsplash.com/photo-1494947665470-20322015e3b8?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'post_name' => 'Second divided from form fish beast made every of seas all gathered us saying he our',
                'title' => 'Second divided from form fish beast made every of seas all gathered us saying he our',
                'content' => '<p>Perkembangan teknologi internet telah mengubah cara masyarakat bekerja, belajar, dan berkomunikasi. Koneksi yang cepat dan stabil kini menjadi kebutuhan penting bagi rumah tangga, sekolah, maupun pelaku usaha.</p><p>Di balik koneksi internet yang lancar terdapat infrastruktur jaringan yang dirancang dengan perencanaan matang. Mulai dari pemilihan perangkat, penarikan kabel, konfigurasi jaringan, hingga pengujian kualitas koneksi, setiap tahap harus dilakukan secara teliti.</p><p>Jaringan yang baik tidak hanya mengutamakan kecepatan, tetapi juga keamanan dan kestabilan. Perangkat perlu ditempatkan pada lokasi yang sesuai, sementara sistem harus dipantau secara berkala untuk mendeteksi gangguan sebelum berdampak lebih besar.</p><p>Bagi perusahaan, jaringan internet yang andal dapat meningkatkan produktivitas tim. Karyawan dapat mengakses aplikasi kerja, melakukan rapat daring, dan bertukar data tanpa hambatan yang mengganggu aktivitas operasional.</p><p>Karena itu, pemilihan penyedia layanan dan teknisi jaringan yang berpengalaman merupakan investasi penting. Dengan perencanaan dan perawatan yang tepat, infrastruktur jaringan dapat mendukung pertumbuhan bisnis dalam jangka panjang.</p>',
                'tag' => 'Travel', 'date' => '2024-11-15 08:00:00',
                'title_image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1200&q=85',
            ],
        ];

        foreach ($articles as $row) {
            $article = Article::updateOrCreate(['slug' => Str::slug(Str::limit($row['title'], 80, ''))], [
                'post_name' => $row['post_name'],
                'title' => $row['title'],
                'content' => $row['content'],
                'title_image' => $row['title_image'],
                'meta_title' => $row['title'],
                'meta_keyword' => $row['title'],
                'meta_description' => $row['title'],
                'is_active' => true,
                'published_at' => $row['date'],
            ]);
            $article->tags()->syncWithoutDetaching([$tags[$row['tag']]->id]);
        }
    }
}
