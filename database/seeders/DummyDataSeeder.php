<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;
use App\Models\ArticleLike;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Create Users
        $users = [];
        
        $users[] = User::firstOrCreate(
            ['email' => 'author1@example.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'bio' => 'Jurnalis lepas yang tertarik dengan teknologi dan budaya lokal.',
            ]
        );

        $users[] = User::firstOrCreate(
            ['email' => 'author2@example.com'],
            [
                'name' => 'Siti Aminah',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'bio' => 'Pengamat sosial dan pendidikan dari Yogyakarta.',
            ]
        );

        $users[] = User::firstOrCreate(
            ['email' => 'reader@example.com'],
            [
                'name' => 'Ahmad Pembaca',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'bio' => 'Hanya seseorang yang suka membaca berita terbaru.',
            ]
        );

        // Fetch existing categories or create them if seeding hasn't run
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $categoriesArray = [
                ['name' => 'Politik', 'slug' => 'politik', 'color' => '#dc2626'],
                ['name' => 'Teknologi', 'slug' => 'teknologi', 'color' => '#2563eb'],
                ['name' => 'Sosial', 'slug' => 'sosial', 'color' => '#16a34a'],
                ['name' => 'Hiburan', 'slug' => 'hiburan', 'color' => '#9333ea'],
                ['name' => 'Olahraga', 'slug' => 'olahraga', 'color' => '#ca8a04'],
            ];

            foreach ($categoriesArray as $catData) {
                Category::create($catData);
            }
            $categories = Category::all();
        }

        // 3. Create Articles
        $articlesData = [
            [
                'title' => 'Inovasi Kendaraan Listrik Karya Anak Bangsa Siap Bersaing di Pasar Global',
                'content' => "Perkembangan teknologi kendaraan listrik di Indonesia semakin menunjukkan taringnya. Sebuah tim peneliti dari universitas ternama di Bandung baru saja meluncurkan purwarupa mobil listrik kompak yang efisien dan ramah lingkungan.\n\nMobil yang diberi nama 'Nusantara EV-1' ini digadang-gadang mampu menempuh jarak 300 kilometer dalam sekali pengisian daya penuh yang hanya membutuhkan waktu 4 jam.\n\nKementerian Perindustrian menyambut baik inovasi ini dan berjanji akan memberikan dukungan penuh agar mobil listrik ini bisa diproduksi secara massal dalam 2 tahun ke depan.",
                'category_index' => 1, // Teknologi
                'user_index' => 0, // Budi
                'status' => 'approved',
                'view_count' => rand(100, 1500),
                'featured' => true,
                'spotlight' => false,
            ],
            [
                'title' => 'Pentingnya Ruang Terbuka Hijau di Tengah Padatnya Ibukota',
                'content' => "Polusi udara dan suhu panas yang ekstrem belakangan ini menyadarkan kita akan pentingnya keberadaan Ruang Terbuka Hijau (RTH) di kota-kota besar.\n\nRTH tidak hanya sekadar 'paru-paru' kota, tetapi juga menjadi tempat interaksi sosial yang sehat bagi warga. Data terbaru menunjukkan bahwa proporsi RTH di beberapa kota besar masih di bawah target standar organisasi kesehatan dunia (WHO).\n\nSudah saatnya pemerintah daerah memprioritaskan alih fungsi lahan-lahan kosong yang tak terpakai menjadi taman-taman kota yang tertata dengan baik.",
                'category_index' => 2, // Sosial
                'user_index' => 1, // Siti
                'status' => 'approved',
                'view_count' => rand(500, 3000),
                'featured' => false,
                'spotlight' => true,
            ],
            [
                'title' => 'Timnas U-20 Catatkan Sejarah Baru di Kancah Asia',
                'content' => "Sebuah kebanggaan bagi seluruh rakyat Indonesia setelah Tim Nasional U-20 berhasil menembus babak final turnamen Piala Asia setelah mengalahkan rival bebuyutannya dengan skor tipis 2-1.\n\nPerjuangan tidak mudah, tertinggal lebih dulu di babak pertama, skuad Garuda Muda mampu membalikkan keadaan di menit-menit akhir pertandingan.\n\nKemenangan ini diharapkan menjadi pelecut semangat untuk prestasi yang lebih tinggi di kancah dunia.",
                'category_index' => 4, // Olahraga
                'user_index' => 0, // Budi
                'status' => 'approved',
                'view_count' => rand(2000, 8000),
                'featured' => true,
                'spotlight' => true,
            ],
            [
                'title' => 'Festival Film Independen Sukses Digelar Secara Virtual',
                'content' => "Meskipun sempat ada keraguan, Festival Film Independen tahun ini yang diselenggarakan sepenuhnya secara daring justru mencatatkan rekor penonton terbanyak dalam sejarah penyelenggaraannya.\n\nLebih dari 50 karya sineas muda dari seluruh penjuru negeri ditayangkan selama satu minggu penuh. Berbagai tema unik diangkat, mulai dari mitologi lokal hingga kritik sosial terhadap budaya modern.\n\nIni membuktikan bahwa kreativitas tidak terbatasi oleh jarak dan medium tayang.",
                'category_index' => 3, // Hiburan
                'user_index' => 1, // Siti
                'status' => 'approved',
                'view_count' => rand(300, 900),
                'featured' => false,
                'spotlight' => false,
            ],
            [
                'title' => 'Draf RUU Pendidikan Terbaru Picu Perdebatan di Kalangan Akademisi',
                'content' => "Revisi Undang-Undang Pendidikan yang baru saja diajukan ke dewan perwakilan menuai pro dan kontra. Beberapa akademisi menilai ada pasal-pasal yang berpotensi mengurangi kebebasan mimbar akademik, sementara pihak pemerintah berkeras bahwa perubahan tersebut diperlukan untuk standarisasi mutu.\n\nDiskusi publik terus diadakan di berbagai kampus untuk mengkritisi draf tersebut secara konstruktif sebelum dilanjutkan ke sidang paripurna.",
                'category_index' => 0, // Politik
                'user_index' => 1, // Siti
                'status' => 'pending',
                'view_count' => 0,
                'featured' => false,
                'spotlight' => false,
            ],
        ];

        $createdArticles = [];
        foreach ($articlesData as $data) {
            $catId = $categories[$data['category_index']]->id ?? $categories->first()->id;
            
            $article = Article::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'category_id' => $catId,
                'user_id' => $users[$data['user_index']]->id,
                'status' => $data['status'],
                'view_count' => $data['view_count'],
                'featured' => $data['featured'],
                'spotlight' => $data['spotlight'],
                'created_at' => now()->subDays(rand(1, 14))->subHours(rand(1, 23)),
            ]);
            $createdArticles[] = $article;
        }

        // 4. Create Likes & Comments
        $approvedArticles = collect($createdArticles)->where('status', 'approved');

        foreach ($approvedArticles as $article) {
            // Random Likes
            foreach ($users as $user) {
                if (rand(1, 10) > 4) { // 60% chance to like
                    ArticleLike::create([
                        'article_id' => $article->id,
                        'user_id' => $user->id,
                    ]);
                }
            }

            // Random Comments
            if (rand(1, 10) > 3) {
                $comment1 = Comment::create([
                    'article_id' => $article->id,
                    'user_id' => $users[rand(0, 2)]->id,
                    'body' => 'Sangat informatif. Terima kasih sudah berbagi!',
                    'created_at' => now()->subDays(rand(1, 5)),
                ]);

                // Reply to comment
                if (rand(1, 10) > 5) {
                    Comment::create([
                        'article_id' => $article->id,
                        'user_id' => $users[rand(0, 2)]->id,
                        'parent_id' => $comment1->id,
                        'body' => 'Setuju sekali. Pembahasannya sangat mendalam.',
                        'created_at' => now()->subDays(rand(0, 1)),
                    ]);
                }
            }
            
            if (rand(1, 10) > 5) {
                Comment::create([
                    'article_id' => $article->id,
                    'user_id' => $users[1]->id,
                    'body' => 'Wah, saya baru tahu tentang hal ini. Artikel yang bagus!',
                    'created_at' => now()->subHours(rand(1, 12)),
                ]);
            }
        }
    }
}
