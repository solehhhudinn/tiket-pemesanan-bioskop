<?php

namespace Database\Seeders;

use App\Models\Movie;
use Cron\MinutesField;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::create([
            'title' => 'Si Juki The Movie',
            'poster' => 'img/si-juki-poster.jpg',
            'description' => 'Di tengah kondisi keuangan keluarga yang sulit, Si Juki menemukan sebuah peta harta karun peninggalan nenek moyangnya. Bersama Profesor Juned, Babeh dan Emak, Si Juki memulai petualangan berburu harta karun di sebuah pulau misterius. Sebelum melaut, Juki bertemu dan dibantu oleh seorang pemburu harta karun wanita bernama Susi. Dalam petualangannya, mereka harus menghadapi berbagai rintangan mulai dari segerombolan bajak laut yang dikenal sebagai bajak laut Badai, monster, pasukan monyet, hingga kutukan yang dapat menyebabkan bencana luar biasa. Berhasilkah Si Juki mendapatkan harta karun tersebut?',
            'trailer_url' => 'https://www.youtube.com/embed/fWmB3acKpHE',
            'director' => 'Faza Meonk',
            'starring' => 'Indro Warkop, Indra Jegel, Rigen Rakelna',
            'censor_rating' => 'SU',
            'genre' => 'Family',
            'language' => 'Bahasa Indonesia',
            'subtitle' => 'None',
            'duration' => 107,
            'status' =>  Movie::STATUS_NOW_PLAYING
        ]);

        Movie::create([
            'title' => 'Ipar Paling Maut',
            'poster' => 'img/ipar-poster.jpg',
            'description' => 'Cinta datang tak pernah bisa ditebak, NISA dipinang oleh dosen muda dari kampusnya, ARIS, laki-laki cerdas yang punya pesona luar biasa. Pernikahan mereka bagai pernikahan negeri dongeng, sempurna, apalagi dengan kelahiran putri mereka, RAYA. Sayangnya, seperti juga cinta masalah datang tanpa diduga. Ibu Nisa tiba-tiba menitipkan putri keduanya, Rani, untuk tinggal bersama Aris dan Nisa. Rani tadinya menjaga jarakdengan Aris, tapi perlahan, celahhubunganterlarang terbuka. Dibelakang Nisa, Aris mengkhianati pernikahandenganadikkandung istrinya sendiri.',
            'trailer_url' => 'https://www.youtube.com/embed/5qRWqIlUIrM', // Replace with actual trailer URL
            'director' => 'Hanung Bramantyo',
            'starring' => 'Michelle Ziudith, Davina Karamoy,  Deva Mahenra',
            'censor_rating' => '13+',
            'genre' => 'Drama',
            'language' => 'Bahasa Indonesia',
            'subtitle' => 'None',
            'duration' => 131,
            'status' => Movie::STATUS_NOW_PLAYING
        ]);

        Movie::create([
            'title' => 'Dilan 1993',
            'poster' => 'img/dilan-poster.jpg',
            'description' => 'Tahun 1983, setelah satu setengah tahun tinggal di Timor Timur, Dilan kembali ke Bandung. Dilan pun kembali bertemu dengan teman-teman lamanya di SD tempat dulu dia sekolah. Tapi, ternyata ada murid baru pindahan dari Semarang, namanya Mei Lien, gadis keturunan Tionghoa.Ini mungkin buku tentang cinta monyet biasa, yang banyak dialami manusia normal di dunia. Tak ada cinta-cintaan karena masih SD, tapi Mei Lien telah membuat Dilan jadi belajar bahasa Mandarin dan tertarik membaca buku yang membahas tentang China. Bandung masih sunyi waktu itu. Zaman di mana Dilan juga mengalami adanya peristiwa Penembakan Misterius, meletusnya Gunung Galunggung, dan Gerhana Matahari Total. Setidaknya sebagian besar memang begitu, menjadi rasa syukur untuk kenangan yang disimpan di dalam hati bagaikan kutipan hikmah di hari ini: "Inilah bumi, tempat pencarian abadi mengetahui diri sendiri, menemukan hal ajaib yang tersembunyi di dalam diri dan Tuhan di saat sunyi."',
            'trailer_url' => 'https://www.youtube.com/embed/-TqgMfZg4Po', // Replace with actual trailer URL
            'director' => 'Fajar Bustomi',
            'starring' => 'Muhammad Adhiyat, Malea Emma Tjandrawidjaja, Ira Wibowo',
            'censor_rating' => 'SU',
            'genre' => 'Drama',
            'language' => 'Bahasa Indonesia',
            'subtitle' => 'None',
            'duration' => 116,
            'status' => Movie::STATUS_NOW_PLAYING
        ]);

        Movie::create([
            'title' => 'Inside Out 2',
            'poster' => 'img/inside-out-poster.jpg',
            'description' => 'Disney and Pixar’s “Inside Out 2” menelusuri kembali benak Riley yang sudah remaja saat headquarter mengalami pembongkaran mendadak untuk memberi ruang bagi sesuatu yang sama sekali tidak terduga: Emosi baru! Joy, Sadness, Anger, Fear, dan Disgust, yang telah lama menjalankan operasinya dengan sukses, tidak yakin bagaimana perasaan mereka ketika Anxiety muncul. Dan sepertinya dia tidak sendirian.
Maya Hawke mengisi suara untuk Anxiety, bersama Amy Poehler sebagai Joy, Phyllis Smith sebagai Sadness, Lewis Black sebagai Anger, Tony Hale sebagai Fear, dan Liza Lapira sebagai Disgust. Disutradarai oleh Kelsey Mann dan diproduksi oleh Mark Nielsen, “Inside Out 2” rilis di bioskop pada musim panas 2024.',
            'trailer_url' => 'https://www.youtube.com/embed/UrGBfMN7Qag', // Replace with actual trailer URL
            'director' => 'Kelsey Mann',
            'starring' => 'Amy Poehler, Maya Hawke',
            'censor_rating' => 'SU',
            'genre' => 'Animation',
            'language' => 'English',
            'subtitle' => 'Bahasa Indonesia',
            'duration' => 96,
            'status' => Movie::STATUS_NOW_PLAYING
        ]);

        Movie::create([
            'title' => 'A Quiet Place: Day One',
            'poster' => 'img/quiet-place-poster.jpg',
            'description' => 'Kisah awal mula kehancuran. Hari pertama kenapa dunia menjadi sunyi!Sam (Lupita Nyong o) berusaha selamat dari invasi makhluk asing dengan pendengaran ultrasonik yang menyerang New York.',
            'trailer_url' => 'https://www.youtube.com/embed/YPY7J-flzE8', // Replace with actual trailer URL
            'director' => 'Michael Sarnoski',
            'starring' => 'Joseph Quinn, Djimon Hounsou',
            'censor_rating' => '13+',
            'genre' => 'Horror',
            'language' => 'English',
            'subtitle' => 'Bahasa Indonesia',
            'duration' => 99,
            'status' => Movie::STATUS_NOW_PLAYING
        ]);

        Movie::create([
            'title' => 'Sengkolo Malam Satu Suro',
            'poster' => 'img/sengkolo-poster.jpg',
            'description' => 'brahim (Donny Alamsyah), seorang pemandi jenazah yang kehilangan keluarganya dalam kejadian mengerikan, berhenti dari pekerjaannya. Ketika keluarga kaya di kampungnya mati misterius, warga percaya itu ilmu hitam. Tidak ada pemandi yang mau memandikan mereka, hingga Pak Kades (Fauzan Nasrul) meminta bantuan Ibrahim. Meskipun enggan, Ibrahim akhirnya setuju. Setelah setahun, dia menemukan petunjuk tentang kematian keluarganya dan menghadapi kejahatan yang menunggunya di rumah terkutuk itu. Akankah dia bisa melawan iblis dengan imannya yang hilang?',
            'trailer_url' => 'https://www.youtube.com/embed/mB8DCB42w8E', // Replace with actual trailer URL
            'director' => 'Hanny R Saputra',
            'starring' => 'Donny Alamsyah, Fauzan Nasrul',
            'censor_rating' => '13+',
            'genre' => 'Horror',
            'language' => 'Bahasa Indonesia',
            'subtitle' => 'None',
            'duration' => 100,
            'status' => Movie::STATUS_NOW_PLAYING
        ]);

        Movie::create([
            'title' => 'My Boo',
            'poster' => 'img/my-boo-poster.jpg',
            'description' => 'Joe, seorang gamer, mewarisi rumah berhantu beserta hantu penghuninya. Namun, baik manusia maupun hantu tidak mau pergi dari rumah itu. Akhirnya Joe dan para hantu memutuskan untuk bekerjasama untuk menjalankan wahana rumah berhantu untuk menarik pengunjung demi mendapatkan uang. Seiring berjalannya waktu Joe mendapati hantu-hantu yang ada di sana sangat menawan, terutama Anong, yang membuatnya tertarik. Akankah dua orang dari dua dunia yang berbeda ini bisa mengatasi perbedaan mereka dan bisa bersama?',
            'trailer_url' => 'https://www.youtube.com/embed/9k80tULQVKA', // Replace with actual trailer URL
            'director' => 'S. Khomkrit Treewimol',
            'starring' => 'Maylada Susri, Sutthirak Subvijitra',
            'censor_rating' => '17+',
            'genre' => 'Comedy',
            'language' => 'Thailand',
            'subtitle' => 'Bahasa Indonesia',
            'duration' => 125,
            'status' => Movie::STATUS_NOW_PLAYING
        ]);

        Movie::create([
            'title' => 'Crayon Shinchan The Movie: Battle OF Supernatural Powers',
            'poster' => 'img/shincan-poster.jpg',
            'description' => '“Pada tahun 20 dan 23 akan jatuh dua cahaya dari langit. Satu cahaya akan berwarna gelap dan cahaya lainnya akan berwarna putih terang.. Cahaya gelap memiliki kekuatan super yang akan mengganggu kedamaian dan membawa kerusuhan pada dunia”. Kemudian, pada musim panas 2023, dua cahaya mendekat dari angkasa. Cahaya putih terang mengenai Shinnosuke, yang sedang menunggu makan malamnya. Tubuh Shinnosuke diisi oleh kekuatan misterius. Pada saat Shinnosuke menggunakan kekuatannya pada mainan, mainan tersebut mengapung di udara! pada saat itulah lahir Esper Shinnosuke. Di sisi lain, seorang pemuda terkena cahaya gelap dan menjadi esper gelap yang bernama Hiriya Mitsuru. Pekerjaan paruh waktunya tidak berjalan dengan baik, idola kesukaannya akan menikah, dan bahkan ia dikejar oleh polisi akibat kesalahpahaman. Ia berniat untuk balas dendam kepada dunia setelah mendapatkan kekuatannya. Hiriya yang akan membuat kerusakan di dunia vs Shinnosuke. Tirai pertempuran kini terbuka pada pertempuran besar kekuatan supranatural, dimana “semuanya adalah “Shin” (artinya baru) - dimensi!”. Musim panas kali ini, cahaya Shinnosuke akan menyinari wajah keputusasaan akan membuat perasaanmu berdebar!!',
            'trailer_url' => 'https://www.youtube.com/embed/ens8gsL3Zs4', // Replace with actual trailer URL
            'director' => 'Hitoshi One',
            'starring' => 'Yumiko Kobayashi, Miki Narahashi',
            'censor_rating' => 'SU',
            'genre' => 'Animation',
            'language' => 'Japanese',
            'subtitle' => 'Bahasa Indonesia',
            'duration' => 94,
            'status' => Movie::STATUS_NOW_PLAYING
        ]);

        Movie::create([
            'title' => 'Jurnal Risa By Risa Saraswati',
            'poster' => 'img/jurnalisa-poster.jpg',
            'description' => 'Kamera dokumenter merekam sebuah perjalanan mengerikan tim Jurnal Risa dalam upaya menyelamatkan bintang tamu mereka, Prinsa, yang diikuti oleh hantu yang paling mereka takuti, Samex; hantu yang selalu mendatangi siapapun yang menyebut namanya.',
            'trailer_url' => 'https://www.youtube.com/embed/oQKG8HMTscg', // Replace with actual trailer URL
            'director' => 'Rizal Mantovani',
            'starring' => 'Risa Saraswati, Ranggana Purwana, Indy Ratna Pratiwi',
            'censor_rating' => '13+',
            'genre' => 'Horror',
            'language' => 'Indonesia',
            'subtitle' => 'None',
            'duration' => 92,
            'status' => Movie::STATUS_UPCOMING
        ]);

        Movie::create([
            'title' => 'Laura',
            'poster' => 'img/laura-poster.jpg',
            'description' => 'Laura, selebgram ceria yang sangat disayangi oleh teman dan keluarganya, harus berjuang ketika hidupnya yang penuh warna mendadak menjadi hitam putih setelah ia lumpuh karena kecelakaan yang disebabkan sang kekasih, Jojo.',
            'trailer_url' => 'https://www.youtube.com/embed/pN0qpTztWvE', // Replace with actual trailer URL
            'director' => 'Hanung Bramantyo',
            'starring' => 'Amanda Rawles, Kevin Ardilova, Carissa Perusset',
            'censor_rating' => 'TBC',
            'genre' => 'Drama',
            'language' => 'Indonesia',
            'subtitle' => 'None',
            'duration' => 92,
            'status' => Movie::STATUS_UPCOMING
        ]);
    }
}


