<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Str;

class RealWorldDummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create([
            'name' => 'Admin Utama',
            'email' => 'admin@wargapost.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        $data = [
            ['category' => 'Lingkungan', 'title' => 'Kota Panas, Solusi Hijau Terlupakan', 'content' => "Peningkatan suhu di kawasan perkotaan menjadi isu yang semakin terasa dalam beberapa tahun terakhir. Minimnya ruang terbuka hijau memperparah kondisi ini.\n\nPenanaman pohon dan pengembangan taman kota menjadi solusi sederhana namun efektif. Selain menurunkan suhu, ruang hijau juga meningkatkan kualitas hidup masyarakat.\n\nKesadaran kolektif diperlukan agar lingkungan kota tetap layak huni di masa depan."],
            ['category' => 'Teknologi', 'title' => 'AI Bukan Ancaman, Tapi Tantangan Adaptasi', 'content' => "Kehadiran kecerdasan buatan mengubah cara manusia bekerja dan berinteraksi. Banyak pekerjaan menjadi lebih cepat dan efisien.\n\nNamun, tanpa kemampuan adaptasi, teknologi ini justru bisa menjadi hambatan. Penting bagi generasi muda untuk terus mengembangkan skill baru.\n\nDengan pendekatan yang tepat, AI bisa menjadi alat bantu yang powerful."],
            ['category' => 'Pendidikan', 'title' => 'Belajar Tidak Lagi Terbatas di Ruang Kelas', 'content' => "Perkembangan teknologi membuka akses belajar yang lebih luas. Kini, siapa saja bisa belajar kapan saja melalui platform digital.\n\nNamun, disiplin dan konsistensi tetap menjadi faktor utama keberhasilan. Tanpa itu, kemudahan akses justru tidak dimanfaatkan secara maksimal.\n\nPendidikan modern menuntut kemandirian lebih tinggi dari peserta didik."],
            ['category' => 'Opini', 'title' => 'Produktif atau Sekadar Terlihat Sibuk?', 'content' => "Banyak orang merasa produktif hanya karena terlihat sibuk sepanjang hari. Padahal, tidak semua aktivitas memberikan hasil nyata.\n\nFokus pada prioritas dan hasil jauh lebih penting dibanding sekadar banyaknya aktivitas. Manajemen waktu menjadi kunci utama.\n\nProduktivitas sejati adalah tentang hasil, bukan sekadar usaha."],
            ['category' => 'Olahraga', 'title' => 'Olahraga Ringan, Dampak Besar untuk Kesehatan', 'content' => "Tidak semua orang punya waktu untuk olahraga berat. Namun, aktivitas ringan seperti jogging atau jalan kaki sudah cukup memberikan manfaat.\n\nKonsistensi menjadi kunci utama dalam menjaga kebugaran tubuh. Bahkan 30 menit sehari bisa memberikan perubahan signifikan.\n\nMulai dari hal kecil jauh lebih baik daripada tidak sama sekali."],
            ['category' => 'Berita', 'title' => 'Cuaca Ekstrem Kembali Terjadi di Sejumlah Wilayah', 'content' => "Perubahan iklim menyebabkan pola cuaca menjadi semakin sulit diprediksi. Hujan deras dan panas ekstrem terjadi dalam waktu berdekatan.\n\nBeberapa wilayah bahkan mengalami dampak langsung seperti banjir dan kekeringan. Kondisi ini membutuhkan perhatian serius.\n\nMasyarakat diimbau untuk selalu waspada terhadap perubahan cuaca."],
            ['category' => 'Budaya', 'title' => 'Tradisi Lama, Nilai yang Tak Lekang Waktu', 'content' => "Di tengah modernisasi, banyak tradisi mulai ditinggalkan. Padahal, di dalamnya terdapat nilai kehidupan yang sangat berharga.\n\nMelestarikan budaya bukan berarti menolak perubahan, melainkan menjaga identitas. Generasi muda memiliki peran penting dalam hal ini.\n\nBudaya adalah akar yang menjaga kita tetap berdiri."],
            ['category' => 'Ekonomi', 'title' => 'Digitalisasi Dorong UMKM Naik Kelas', 'content' => "UMKM kini semakin berkembang dengan bantuan teknologi digital. Penjualan tidak lagi terbatas pada pasar lokal.\n\nMedia sosial dan marketplace menjadi sarana utama dalam memperluas jangkauan. Hal ini membuka peluang besar bagi pelaku usaha kecil.\n\nAdaptasi menjadi kunci untuk bertahan dan berkembang."],
            ['category' => 'Psikologi', 'title' => 'Overthinking: Musuh Diam-Diam Produktivitas', 'content' => "Berpikir berlebihan sering kali membuat seseorang sulit mengambil keputusan. Hal ini dapat menghambat produktivitas sehari-hari.\n\nBelajar mengelola pikiran menjadi hal penting untuk menjaga kesehatan mental. Fokus pada hal yang bisa dikontrol adalah langkah awal.\n\nTidak semua hal harus dipikirkan terlalu dalam."],
            ['category' => 'Lifestyle', 'title' => 'Hidup Sederhana, Pikiran Lebih Tenang', 'content' => "Gaya hidup sederhana membantu seseorang mengurangi tekanan dalam hidup. Fokus pada kebutuhan, bukan keinginan.\n\nDengan begitu, energi bisa dialihkan ke hal yang lebih bermakna. Minimalisme menjadi pilihan banyak orang saat ini.\n\nHidup tidak harus rumit untuk bisa bahagia."],
            ['category' => 'Transportasi', 'title' => 'Transportasi Publik Semakin Diminati', 'content' => "Kesadaran masyarakat terhadap efisiensi mulai meningkat. Banyak yang beralih ke transportasi umum.\n\nSelain menghemat biaya, langkah ini juga membantu mengurangi kemacetan. Dukungan infrastruktur menjadi faktor penting.\n\nTransportasi publik adalah masa depan mobilitas kota."],
            ['category' => 'Sosial', 'title' => 'Media Sosial: Mendekatkan atau Menjauhkan?', 'content' => "Media sosial memudahkan komunikasi tanpa batas. Namun, di sisi lain juga bisa menciptakan jarak secara emosional.\n\nInteraksi langsung tetap memiliki nilai yang tidak tergantikan. Keseimbangan menjadi hal yang penting.\n\nGunakan teknologi, jangan sampai dikendalikan olehnya."],
            ['category' => 'Kuliner', 'title' => 'Kuliner Lokal Mulai Mendapat Tempat Kembali', 'content' => "Makanan tradisional kini kembali diminati. Banyak inovasi dilakukan tanpa menghilangkan cita rasa asli.\n\nHal ini menjadi peluang bagi pelaku usaha kuliner. Sekaligus menjaga warisan budaya tetap hidup.\n\nKuliner bukan sekadar makanan, tapi identitas."],
            ['category' => 'Sains', 'title' => 'Energi Terbarukan Jadi Harapan Masa Depan', 'content' => "Krisis energi mendorong penelitian terhadap sumber energi alternatif. Matahari dan angin menjadi fokus utama.\n\nTeknologi terus dikembangkan untuk meningkatkan efisiensi. Ini menjadi langkah penting menuju keberlanjutan.\n\nMasa depan bergantung pada energi yang kita pilih hari ini."],
            ['category' => 'Hiburan', 'title' => 'Konten Digital Semakin Mendominasi Hiburan', 'content' => "Platform digital kini menjadi sumber hiburan utama. Film, musik, hingga podcast dapat diakses dengan mudah.\n\nPerubahan ini menggeser kebiasaan konsumsi masyarakat. Kreator konten memiliki peluang besar untuk berkembang.\n\nEra hiburan kini berada di genggaman."],
            ['category' => 'Kesehatan', 'title' => 'Kurang Tidur Berdampak pada Kinerja Harian', 'content' => "Banyak orang mengabaikan pentingnya tidur cukup. Padahal, hal ini sangat berpengaruh pada konsentrasi dan kesehatan.\n\nKurang tidur dapat menurunkan produktivitas dan meningkatkan risiko penyakit. Istirahat yang cukup sangat penting.\n\nTubuh butuh waktu untuk memulihkan diri."],
            ['category' => 'Politik', 'title' => 'Transparansi Jadi Tuntutan Utama Masyarakat', 'content' => "Masyarakat kini semakin kritis terhadap kebijakan publik. Transparansi menjadi hal yang sangat penting.\n\nAkses informasi yang terbuka mendorong akuntabilitas. Hal ini memperkuat sistem demokrasi.\n\nKepercayaan publik dibangun dari keterbukaan."],
            ['category' => 'Startup', 'title' => 'Startup Lokal Mulai Tunjukkan Taringnya', 'content' => "Banyak startup lokal mulai berkembang pesat. Inovasi menjadi faktor utama dalam persaingan.\n\nDukungan ekosistem juga membantu pertumbuhan ini. Peluang masih terbuka luas di berbagai sektor.\n\nIde sederhana bisa menjadi solusi besar."],
            ['category' => 'Gaming', 'title' => 'Industing Game Jadi Peluang Karier Baru', 'content' => "Game bukan lagi sekadar hiburan. Banyak peluang karier muncul di industri ini.\n\nMulai dari developer hingga content creator. Industri ini terus berkembang pesat.\n\nHobi bisa berubah menjadi profesi."],
            ['category' => 'Kampus', 'title' => 'Mahasiswa Dituntut Lebih Aktif dan Adaptif', 'content' => "Dunia perkuliahan tidak hanya soal akademik. Soft skill menjadi faktor penting.\n\nOrganisasi dan pengalaman lapangan sangat membantu. Mahasiswa perlu aktif mencari peluang.\n\nKampus adalah tempat membangun masa depan."],
            ['category' => 'Organisasi', 'title' => 'Pengalaman Organisasi Bentuk Karakter', 'content' => "Berorganisasi melatih kepemimpinan dan kerja sama. Hal ini tidak selalu didapat di kelas.\n\nPengalaman ini sangat berharga untuk dunia kerja. Tantangan yang dihadapi membentuk mental.\n\nBelajar tidak hanya dari teori."],
            ['category' => 'Internet', 'title' => 'Akses Internet Jadi Kebutuhan Utama', 'content' => "Internet kini menjadi bagian penting kehidupan. Hampir semua aktivitas bergantung padanya.\n\nNamun, masih ada kesenjangan akses di beberapa daerah. Hal ini perlu menjadi perhatian.\n\nAkses merata berarti peluang yang merata."],
            ['category' => 'Inovasi', 'title' => 'Inovasi Kecil, Dampak Besar', 'content' => "Tidak semua inovasi harus besar. Perubahan kecil bisa memberikan dampak signifikan.\n\nYang terpenting adalah konsistensi dalam pengembangan. Ide sederhana bisa berkembang.\n\nInovasi adalah tentang solusi."],
            ['category' => 'Global', 'title' => 'Dunia Semakin Terhubung Tanpa Batas', 'content' => "Globalisasi membuat dunia terasa lebih kecil. Informasi dapat diakses dengan cepat.\n\nHal ini membuka peluang sekaligus tantangan. Persaingan menjadi semakin ketat.\n\nAdaptasi menjadi kunci bertahan."],
            ['category' => 'Energi', 'title' => 'Hemat Energi, Langkah Kecil untuk Dampak Besar', 'content' => "Penggunaan energi yang berlebihan menjadi masalah global. Kesadaran untuk hemat energi perlu ditingkatkan.\n\nLangkah sederhana seperti mematikan listrik saat tidak digunakan sudah membantu. Kebiasaan kecil bisa berdampak besar.\n\nPerubahan dimulai dari diri sendiri."],
        ];

        foreach ($data as $item) {
            $category = Category::firstOrCreate(
                ['name' => $item['category']],
                [
                    'slug' => Str::slug($item['category']),
                    'color' => sprintf('#%06X', mt_rand(0, 0xFFFFFF))
                ]
            );

            Article::create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => $item['title'],
                'content' => $item['content'],
                'status' => 'approved',
                'view_count' => rand(100, 5000),
                'featured' => rand(0, 10) > 8,
                'spotlight' => rand(0, 10) > 7,
                'created_at' => now()->subDays(rand(0, 30)),
            ]);
        }
    }
}
