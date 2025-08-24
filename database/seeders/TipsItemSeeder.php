<?php

namespace Database\Seeders;

use App\Models\TipsItem;
use Illuminate\Database\Seeder;

class TipsItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tips = [
            [
                'image_url' => 'https://pbs.twimg.com/media/GzFjjgTbIAAFoUi.jpg',
                'judul' => 'Dari Unggas hingga Sapi Perah, Industrial Lectures 2025 Kupas Tren Peternakan',
                'author' => 'Satria',
                'konten' => '<p><strong>Fapet UGM, Yogyakarta</strong> — Fakultas Peternakan UGM menggelar Industrial Lectures 2025 untuk membahas tren peternakan dari unggas hingga sapi perah. Acara ini bertujuan memperkenalkan perkembangan industri ternak nasional dan global.</p><h3>1. Wawasan Ahli dan Keterlibatan Profesional</h3><p>Acara menghadirkan profesional dari perusahaan ternak terkemuka untuk berbagi pengetahuan tentang peluang bisnis dan tren di sektor poultry.</p><h3>2. Peran Insinyur Peternakan</h3><p>Ditekankan peran penting insinyur peternakan dalam transformasi sektor untuk mencapai Indonesia Emas 2045 melalui inovasi dan kolaborasi.</p>',
                'kategori' => [1, 4],
                'kategori_detail' => 'Bisnis Peternakan',
            ],
            [
                'image_url' => 'https://i0.wp.com/www.poultryindonesia.com/wp-content/uploads/2025/07/IMG-20250701-WA0004.jpg?fit=1600%2C1200&ssl=1',
                'judul' => 'Seminar Nasional ILDEX Indonesia 2025: Dorong Inovasi Peternakan Ayam Petelur dan Konsumsi Telur Nasional',
                'author' => 'Poultry Indonesia',
                'konten' => '<p><strong>Poultry Indonesia, Jakarta</strong> — Seminar Nasional ILDEX Indonesia 2025 fokus mendorong inovasi di peternakan ayam petelur dan meningkatkan konsumsi telur nasional untuk ketahanan pangan.</p><h3>1. Inovasi Peternakan</h3><p>Diskusi tentang teknologi baru untuk meningkatkan produktivitas ayam petelur dan efisiensi produksi telur.</p><h3>2. Konsumsi Telur Nasional</h3><p>Strategi kampanye untuk meningkatkan konsumsi telur sebagai sumber protein murah dan bergizi bagi masyarakat.</p>',
                'kategori' => [1, 4],
                'kategori_detail' => 'Bisnis Peternakan',
            ],
            [
                'image_url' => 'https://pbs.twimg.com/media/GzFRaCAW8AAM0qu.jpg',
                'judul' => 'Kementan Perkuat Perencanaan Program Peternakan dan Kesehatan Hewan 2025',
                'author' => 'Agung Suganda',
                'konten' => '<p><strong>Kementan, Jakarta</strong> — Kementerian Pertanian memperkuat perencanaan program peternakan dan kesehatan hewan 2025 untuk meningkatkan produktivitas dan ketahanan pangan nasional.</p><h3>1. Perencanaan Anggaran</h3><p>Fokus pada penyusunan RKA-KL 2025 untuk program berkualitas dan akuntabel.</p><h3>2. Tantangan dan Prioritas</h3><p>Menghadapi pemulihan PMK dan krisis pangan global dengan program nutrisi seperti Makan Bergizi dan Minum Susu.</p>',
                'kategori' => [1, 2],
                'kategori_detail' => 'Kesehatan Ternak',
            ],
            [
                'image_url' => 'https://infobanknews.com/wp-content/uploads/2025/07/WhatsApp-Image-2025-07-03-at-18.42.31-1-1024x682.jpeg',
                'judul' => 'Indo Livestock 2025 Usung Inovasi Teknologi Peternakan, Kementan-Napindo Teken LoI',
                'author' => 'Infobank News',
                'konten' => '<p><strong>Infobank, Surabaya</strong> — Indo Livestock 2025 menampilkan inovasi teknologi peternakan, dengan penandatanganan LoI antara Kementan dan Napindo untuk penguatan industri.</p><h3>1. Kolaborasi dan Dukungan</h3><p>LoI mendukung Indo Livestock 2026 di Jakarta untuk meningkatkan investasi dan kerjasama.</p><h3>2. Kampanye Gizi</h3><p>Peluncuran Gerakan SDTI untuk promosi nutrisi melalui susu, daging, telur, dan ikan.</p>',
                'kategori' => [1, 4],
                'kategori_detail' => 'Bisnis Peternakan',
            ],
            [
                'image_url' => 'https://i0.wp.com/www.poultryindonesia.com/wp-content/uploads/2025/07/WhatsApp-Image-2025-07-02-at-19.31.46_f93374de.jpg?fit=1600%2C720&ssl=1',
                'judul' => 'Pameran Internasional Peternakan Terbesar di Indonesia, Indo Livestock 2025 Expo & Forum Kembali Digelar',
                'author' => 'Poultry Indonesia',
                'konten' => '<p><strong>Poultry Indonesia, Surabaya</strong> — Indo Livestock 2025, pameran peternakan terbesar di Indonesia, kembali digelar untuk menampilkan inovasi global di sektor ternak.</p><h3>1. Skala Acara</h3><p>Menghadirkan 300 peserta dari 15 negara dengan fokus pada teknologi peternakan.</p><h3>2. Manfaat bagi Industri</h3><p>Forum untuk pertukaran informasi dan sinergi pengembangan peternakan nasional.</p>',
                'kategori' => [1, 4],
                'kategori_detail' => 'Bisnis Peternakan',
            ],
            [
                'image_url' => 'https://pbs.twimg.com/media/Gy4FbjAbgAAhNFn.jpg',
                'judul' => 'Kuatkan Peternakan Nasional, Napindo & Kementan Teken LoI Di Indo Livestock 2025',
                'author' => 'RM ID',
                'konten' => '<p><strong>RM ID, Surabaya</strong> — Napindo dan Kementan menandatangani LoI di Indo Livestock 2025 untuk memperkuat peternakan nasional melalui sinergi dan inovasi.</p><h3>1. Signifikansi LoI</h3><p>Komitmen untuk industri peternakan modern dan kompetitif.</p><h3>2. Peluncuran SDTI</h3><p>Gerakan sosialisasi nutrisi untuk anak Indonesia melalui protein hewani.</p>',
                'kategori' => [1, 4],
                'kategori_detail' => 'Bisnis Peternakan',
            ],
            [
                'image_url' => 'https://pbs.twimg.com/media/GyhmnHeaoAANL4B.jpg',
                'judul' => 'Fakultas Peternakan UGM Tampilkan Inovasi Unggulan di Indo Livestock Expo & Forum 2025',
                'author' => 'Agussalim',
                'konten' => '<p><strong>Fapet UGM, Surabaya</strong> — Fapet UGM menampilkan inovasi seperti telur bebas kandang dan pakan berkualitas di Indo Livestock 2025 untuk kemajuan peternakan nasional.</p><h3>1. Produk Inovatif</h3><p>Termasuk Fapet Egg dan pakan dari limbah poultry.</p><h3>2. Kolaborasi Industri</h3><p>Platform untuk memperluas kerjasama dengan industri peternakan.</p>',
                'kategori' => [1, 3],
                'kategori_detail' => 'Perawatan Ternak',
            ],
            [
                'image_url' => 'https://pbs.twimg.com/media/GyjFDacbUAAj72j.jpg',
                'judul' => 'Tren Industri Perunggasan di 2025',
                'author' => 'AviNews',
                'konten' => '<p><strong>AviNews, Jakarta</strong> — Tren peternakan unggas 2025 fokus pada teknologi, keberlanjutan, dan data-driven untuk efisiensi dan kesejahteraan hewan.</p><h3>1. Pengambilan Keputusan Berbasis Data</h3><p>Penggunaan AI dan sensor untuk monitoring kesehatan ternak.</p><h3>2. Kesejahteraan Hewan</h3><p>Standar lebih tinggi dengan teknologi pintar untuk kondisi optimal.</p>',
                'kategori' => [1, 4],
                'kategori_detail' => 'Bisnis Peternakan',
            ],
            [
                'image_url' => 'https://pbs.twimg.com/media/Gyi5XVVbAAA2xXa.jpg',
                'judul' => 'Prodi Baru Peternakan Berbasis AI Pertama di Indonesia Resmi di Buka di Jalur SNBT dengan Daya Tampung 50',
                'author' => 'Admin Fapet',
                'konten' => '<p><strong>Fapet UB, Malang</strong> — Prodi Industri Peternakan Cerdas berbasis AI pertama di Indonesia dibuka di Fapet UB dengan kuota 50 mahasiswa.</p><h3>1. Integrasi Teknologi</h3><p>Menggabungkan ilmu peternakan dengan AI dan IoT.</p><h3>2. Tujuan Program</h3><p>Menyiapkan lulusan untuk peternakan 4.0 dan ketahanan pangan.</p>',
                'kategori' => [1, 4],
                'kategori_detail' => 'Bisnis Peternakan',
            ],
            [
                'image_url' => 'https://jatimnow.com/uploads/images/2/2024/11/21/pers-conference-indo-livestock-2025-expo-forum-foto-rizky-jatimnow-com-1_1698.jpg',
                'judul' => 'Kabar Peternakan Saat Ini: Peluang dan Isu Terbaru',
                'author' => 'BroilerX',
                'konten' => '<p><strong>BroilerX, Jakarta</strong> — Sektor peternakan Indonesia menghadapi peluang dan tantangan, dengan proyeksi produksi ayam broiler melebihi 3,7 juta ton di 2025.</p><h3>1. Tantangan Utama</h3><p>Wabah PMK dan ketergantungan impor pakan menjadi isu kunci.</p><h3>2. Inovasi Teknologi</h3><p>Penggunaan IoT untuk smart farming mengurangi biaya operasional.</p>',
                'kategori' => [1, 2],
                'kategori_detail' => 'Kesehatan Ternak',
            ],
            [
                'image_url' => 'https://pbs.twimg.com/media/GyiT97VagAEcJNg.jpg',
                'judul' => 'Indo Livestock 2025: Wadah Bersinergi untuk Penguatan Peternakan dan Kesehatan Hewan',
                'author' => 'SINDOnews',
                'konten' => '<p><strong>SINDOnews, Surabaya</strong> — Indo Livestock 2025 menjadi wadah sinergi untuk penguatan peternakan dan kesehatan hewan melalui kolaborasi berbagai pihak.</p><h3>1. Dukungan Sektor</h3><p>Acara mendukung pengembangan usaha peternakan nasional.</p><h3>2. Koordinasi Kesehatan</h3><p>Fokus pada pencegahan penyakit untuk produktivitas ternak.</p>',
                'kategori' => [1, 2],
                'kategori_detail' => 'Kesehatan Ternak',
            ],
            [
                'image_url' => 'https://jatimnow.com/uploads/images/2/2024/11/21/pers-conference-indo-livestock-2025-expo-forum-foto-rizky-jatimnow-com-1_1698.jpg',
                'judul' => 'Indo Livestock 2025 Siap Digelar di Surabaya, Hadirkan Inovasi Global Peternakan-Perikanan',
                'author' => 'Jatimnow',
                'konten' => '<p><strong>Jatimnow, Surabaya</strong> — Indo Livestock 2025 akan digelar di Surabaya, menampilkan inovasi global di peternakan dan perikanan dengan 250 perusahaan dari 15 negara.</p><h3>1. Partisipasi Internasional</h3><p>Termasuk paviliun dari China, Korea, dan Eropa.</p><h3>2. Tujuan Acara</h3><p>Meningkatkan produktivitas dan ketahanan pangan nasional.</p>',
                'kategori' => [1, 4],
                'kategori_detail' => 'Bisnis Peternakan',
            ],
            [
                'image_url' => 'https://pbs.twimg.com/media/GyTQeJZa4AQwELw.jpg',
                'judul' => 'Sektor Peternakan akan Tumbuh Positif Tahun 2025 Seiring Membaiknya Ekonomi',
                'author' => 'Vinnilya Huanggrio',
                'konten' => '<p><strong>Investor.id, Jakarta</strong> — Sektor peternakan diproyeksikan tumbuh positif di 2025 seiring pemulihan ekonomi dan program pemerintah seperti makan bergizi gratis.</p><h3>1. Faktor Pendukung</h3><p>Dukungan program swasembada pangan dan peningkatan daya beli masyarakat.</p><h3>2. Dampak Program</h3><p>Meningkatkan konsumsi daging dan populasi ternak nasional.</p>',
                'kategori' => [1, 4],
                'kategori_detail' => 'Bisnis Peternakan',
            ],
            [
                'image_url' => 'https://pbs.twimg.com/media/GyTQeJca4AIg0TL.jpg',
                'judul' => 'UB Faculty of Animal Science Showcases Innovation and Strengthens Collaboration at Indolivestock 2025',
                'author' => 'Admin Fapet',
                'konten' => '<p><strong>Fapet UB, Surabaya</strong> — Fapet UB menampilkan inovasi pakan berbasis lokal dan sistem monitoring AI di Indolivestock 2025 untuk kolaborasi industri.</p><h3>1. Inovasi Ditampilkan</h3><p>Teknologi pakan berkelanjutan dan prodi baru Smart Livestock Industry.</p><h3>2. Kerjasama Akademik</h3><p>Memperkuat kolaborasi dengan industri dan pemerintah untuk peternakan berkelanjutan.</p>',
                'kategori' => [1, 4],
                'kategori_detail' => 'Bisnis Peternakan',
            ],
            [
                'image_url' => 'https://pbs.twimg.com/media/GywgsbPacAALmxx.jpg',
                'judul' => 'Target 4 Tahun Tercapai dalam 1 Tahun, Pertanian Indonesia Cetak Sejarah Baru',
                'author' => 'Ditjen PKH',
                'konten' => '<p><strong>Ditjen PKH, Jakarta</strong> — Pertanian Indonesia mencetak sejarah dengan mencapai target 4 tahun dalam 1 tahun, memperkuat peternakan dan ketahanan pangan.</p><h3>1. Pencapaian Cepat</h3><p>Surplus produksi daging ayam dan telur, serta ekspor ke mancanegara.</p><h3>2. Dampak Nasional</h3><p>Mendorong swasembada pangan dan kesejahteraan peternak rakyat.</p>',
                'kategori' => [1, 4],
                'kategori_detail' => 'Bisnis Peternakan',
            ],
        ];

        foreach ($tips as $tip) {
            TipsItem::create($tip);
        }
    }
}