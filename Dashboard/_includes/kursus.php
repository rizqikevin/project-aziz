<?php
$id = $_GET['id'] ?? null;

// Fungsi untuk mengubah URL YouTube menjadi embed URL
function youtube_embed_url($url) {
  preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|shorts\/))([^\?&]+)/', $url, $matches);
  return isset($matches[1]) ? 'https://www.youtube.com/embed/' . $matches[1] : null;
}

  $kursus_list = [
    1 => [
      'judul' => 'Matematika',
      'modul' => [
        [
          'judul_modul' => 'Bilangan',
          'materi' => [
            [
              'judul' => 'Bilangan Bulat',
              'konten' => 'Mengenal bilangan bulat dan operasinya.',
              'video' => 'https://youtu.be/cQAwIhfC6Dg?si=-dwBwEW33LUorp9U',
              'referensi' => 'https://www.google.com/search?q=bilangan+bulat'
            ],
            [
              'judul' => 'FPB dan KPK',
              'konten' => 'Faktor Persekutuan Terbesar dan Kelipatan Persekutuan Terkecil.',
              'video' => 'https://youtu.be/QCdDN1T1vdQ?si=eHG6KZlyEvOcM4kw',
              'referensi' => 'https://www.google.com/search?q=fpb+dan+kpk'
            ],
            [
              'judul' => 'Eksponen',
              'konten' => 'bilangan berpangkat.',
              'video' => 'https://youtu.be/AlrOq3W7IZ4?si=j-E4Sw1_U_7f8pVU',
              'referensi' => 'https://www.bing.com/search?q=bilangan+berpangkat.'
            ],
            [
              'judul' => 'logaritma',
              'konten' => 'mengenal algoritma.',
              'video' => 'https://youtu.be/t5r8-4frZUI?si=QOI8NtZcNnnOd4nF',
              'referensi' => 'https://www.tempo.co/sains/arti-algoritma-pengertian-fungsi-dan-jenis-jenisnya-80349'
            ],
            [
              'judul' => 'aljabar',
              'konten' => 'mengenal tentang aljabar',
              'video' => 'https://youtu.be/eW7LZDdXhLo?si=9O1oqkPAAL04-kqr',
              'referensi' => 'https://www.bing.com/search?q=aljabar.'
            ],
            [
              'judul' => 'umum',
              'konten' => 'mengenal tentang aljabar',
              'video' => 'https://youtu.be/xWA4AKKUQPU?si=eJgJxIn3vgBQG8WW',
              'referensi' => 'https://www.bing.com/search?q=aljabar.'
            ],
             [
              'judul' => 'pitagoras',
              'konten' => 'Segitiga sama siku',
              'video' => 'https://youtu.be/IOxRkDZ04xM?si=WR7YQ-PCJsDAQtSG',
              'referensi' => 'https://www.bing.com/search?q=aljabar.'
            ],
           [
              'judul' => 'statistika',
              'konten' => 'distribusi prequensi',
              'video' => 'https://youtu.be/zT4Pk6m0KtQ?si=SLWGF2T3QDLruIDP',
              'referensi' => 'https://www.bing.com/search?q=aljabar.'
            ],
            [
              'judul' => 'bilangan berpangkat',
              'konten' => 'berpangkatan',
              'video' => 'https://youtu.be/OWKpJHCKOsU?si=n-y9n8zSSUUZCBqy',
              'referensi' => 'https://www.bing.com/search?q=aljabar.'
            ],  
          ]
        ],
      ],
    ],
    2 => [
      'judul' => 'Bahasa Indonesia',
      'modul' => [
        [
          'judul_modul' => 'Membaca',
          'materi' => [
            [
              'judul' => 'Teks Narasi',
              'konten' => 'Belajar membuat dan memahami teks narasi.',
              'video' => 'https://youtu.be/CfhmEyvUKTo?si=--tNa3dR4SIZ0yk7',
              'referensi' => 'https://www.google.com/search?q=teks+narasi'
            ],
            [
              'judul' => 'Teks Deskripsi',
              'konten' => 'Mengenal teks deskripsi dan ciri-cirinya.',
              'video' => 'https://youtu.be/RUgCoxZx3gY?si=Cv-SLjWZH5AS-Mpd',
              'referensi' => 'https://www.google.com/search?q=teks+deskripsi'
            ],         
            ['judul'=>'Video Pembelajaran Teks Narasi','konten'=>'Penjelasan lengkap SMP','video'=>'https://www.youtube.com/watch?v=jPprGavOKbQ','referensi'=>'Google: teks narasi SMP'],
            ['judul'=>'Teks Narasi SMP/SMA','konten'=>'Struktur & jenis narasi','video'=>'https://www.youtube.com/watch?v=1qKL4SKtdXE','referensi'=>'Google: teks narasi struktur'],
            ['judul'=>'Materi Teks Narasi K13','konten'=>'Metode Kurikulum 13','video'=>'https://www.youtube.com/watch?v=qre6oTl6Ph8','referensi'=>'Google: teks narasi K13'],
            ['judul'=>'Teks Deskripsi SMP','konten'=>'Pengertian dan ciri teks deskripsi','video'=>'https://www.youtube.com/watch?v=5PlX5FxrVVg','referensi'=>'Google: teks deskripsi'],
            ['judul'=>'Teks Deskripsi lengkap','konten'=>'Tujuan, struktur, contoh','video'=>'https://www.youtube.com/watch?v=WqWcMd0u_9E','referensi'=>'Google: teks deskripsi contoh'],
          ]
        ],
      ],
    ],
    3 => [
      'judul' => 'Biologi',
      'modul' => [
        [
          'judul_modul' => 'Sel dan Jaringan',
          'materi' => [
            [
              'judul' => 'Struktur Sel',
              'konten' => 'Memahami bagian-bagian sel dan fungsinya.',
              'video' => 'https://youtu.be/OB5-pA0IpfM?si=aswfsihcumSnz50n',
              'referensi' => 'https://www.google.com/search?q=struktur+sel'
            ],
            [
              'judul' => 'Jaringan Tumbuhan',
              'konten' => 'Mengenal jaringan pada tumbuhan.',
              'video' => 'https://youtu.be/f7uAhLJba6g?si=sYygPmqosuPDuBhK',
              'referensi' => 'https://www.google.com/search?q=jaringan+tumbuhan'
            ],
            ['judul'=>'Sel Hewan & Tumbuhan SMP','konten'=>'Perbedaan sel hewan dan tumbuhan','video'=>'https://www.youtube.com/watch?v=PwQ1mOk4Hvw','referensi'=>'IPA Kelas 7 struktur sel'] ,
            ['judul'=>'Sel Hewan dan Tumbuhan Kurikulum Merdeka','konten'=>'Kelompok organel sel dan fungsi','video'=>'https://www.youtube.com/watch?v=qwGtfOdMSG0','referensi'=>'Sel Hewan & Tumbuhan SMP'] ,
            ['judul'=>'Pengenalan Sel & Mikroskop','konten'=>'Dasar pengenalan sel dengan mikroskop','video'=>'https://www.youtube.com/watch?v=qXmotChjh6o','referensi'=>'Pengenalan Sel IPA SMP'] ,
            
            ['judul'=>'Jaringan Penguat & Pengangkut','konten'=>'Jaringan penguat dan pembuluh tumbuhan','video'=>'https://www.youtube.com/watch?v=9KnD_ASSAMA','referensi'=>'Jaringan tumbuhan part‑4'] ,
            ['judul'=>'Sel Pada Hewan & Tumbuhan','konten'=>'Animasi struktur sel lengkap','video'=>'https://www.youtube.com/watch?v=XGcYeoYPVJ8','referensi'=>'Sel hewan dan tumbuhan SMA/SMP'] ,
            ['judul'=>'Struktur dan Fungsi Sel & Membran','konten'=>'Animasi membran plasma dan nukleus','video'=>'https://www.youtube.com/watch?v=hATgNv_I0fI','referensi'=>'Komponen membran sel animasi 3D'],
            ['judul'=>'Sel sebagai Unit Kehidupan','konten'=>'Fungsi sel sebagai unit struktural dan fungsional','video'=>'https://www.youtube.com/watch?v=vLKrEnm2wTs','referensi'=>'Sel sebagai unit kehidupan kelas 7'],

            ['judul'=>'Jaringan Tumbuhan – Part 1','konten'=>'Jenis & fungsi jaringan tumbuhan (akar, batang, daun)','video'=>'https://www.youtube.com/watch?v=pPrgEx9Vs0k','referensi'=>'Part‑1 Jaringan Tumbuhan'] ,
            ['judul'=>'Jaringan Tumbuhan – Part 2','konten'=>'Lanjutan: organ tumbuhan & jaringan utama','video'=>'https://www.youtube.com/watch?v=wp_gqiR2M88','referensi'=>'Part‑2 Jaringan Tumbuhan'] ,
            ['judul'=>'Jaringan Tumbuhan SMP (Akar, Batang, Daun)','konten'=>'Struktur dan fungsi tiap jaringan utama','video'=>'https://www.youtube.com/watch?v=IaxFz_hC4C8','referensi'=>'Struktur dan Fungsi Jaringan Tumbuhan'] ,
            ['judul'=>'Jaringan pada Tumbuhan SMP','konten'=>'Jaringan meristem, penguat, dasar, pengangkut','video'=>'https://www.youtube.com/watch?v=Q-Q-uupkZE4','referensi'=>'Jaringan pada Tumbuhan IPA kelas VII'] ,
            ['judul'=>'Animasi Struktur dan Fungsi Tumbuhan','konten'=>'Animasi edukatif jaringan tumbuhan','video'=>'https://www.youtube.com/watch?v=EztxwW0uD9I','referensi'=>'Animasi Kartun IPA SMP'] ,
            ['judul'=>'Struktur & Fungsi Jaringan Tumbuhan','konten'=>'Penjelasan lengkap jaringan dewasa dan meristem','video'=>'https://www.youtube.com/watch?v=AdwB0XmIBUg','referensi'=>'Materi Kelas 8 BAB 3'] ,

          ]
        ],
      ],
    ],
    4 => [
      'judul' => 'Kimia',
      'modul' => [
        [
          'judul_modul' => 'Dasar Kimia',
          'materi' => [
            [
              'judul' => 'Atom dan Molekul',
              'konten' => 'Memahami struktur atom dan molekul.',
              'video' => 'https://youtu.be/KaAipzqkDdg?si=RpFhyJu4aFGl4DjE',
              'referensi' => 'https://www.google.com/search?q=struktur+atom+molekul'
            ],
            [
              'judul' => 'Tabel Periodik',
              'konten' => 'Belajar tentang tabel periodik unsur.',
              'video' => 'hhttps://youtu.be/gDaSgHlqUH0?si=lAt4xooZjBI0lzi7',
              'referensi' => 'https://www.google.com/search?q=tabel+periodik'
            ],
            ['judul'=>'Struktur Atom – Teori Dalton hingga Bohr','konten'=>'Perkembangan teori atom dari Dalton ke Bohr','video'=>'https://www.youtube.com/watch?v=azVIDJ3Wdt4','referensi'=>'Google: teori atom'] ,
            ['judul'=>'Struktur Atom & SPU Part‑1','konten'=>'Pengenalan struktur atom dan sistem periodik unsur','video'=>'https://www.youtube.com/watch?v=Iezzz0jtuNo','referensi'=>'SPU dan atom kelas 10'] ,
            ['judul'=>'Struktur Atom Part 1 – Cerdas Kimia','konten'=>'Dasar proton, neutron, elektron','video'=>'https://www.youtube.com/watch?v=GMjqiaAp0cc','referensi'=>'Primagama Indonesia'] ,
            ['judul'=>'Struktur Atom – Pengertian dan Contoh','konten'=>'Organisasi inti atom dan elektron','video'=>'https://www.youtube.com/watch?v=QFMcypgdc8A','referensi'=>'Periodic Videos edukasi'] ,
            ['judul'=>'Struktur Atom – Cerdas Kimia','konten'=>'Konfigurasi elektron, isotop, isoton, isobar','video'=>'https://www.youtube.com/watch?v=KaAipzqkDdg','referensi'=>'Cerdas Kimia'] ,
            ['judul'=>'Struktur Atom – Part 2','konten'=>'Notasi atom dan ion (part 2)','video'=>'https://www.youtube.com/watch?v=3nrmPf6TrCI','referensi'=>'Konsep simbol & ion'] ,
            ['judul'=>'Struktur Atom & SPU (2)','konten'=>'Lanjutan sistem periodik dan konfigurasi','video'=>'https://www.youtube.com/watch?v=pD3wmt9b7Cs','referensi'=>'Teori atom lanjutan'] ,
            
          ]
        ],
      ],
    ],
    5 => [
      'judul' => 'Fisika',
      'modul' => [
        [
          'judul_modul' => 'Mekanika',
          'materi' => [
            [
              'judul' => 'Gerak Lurus',
              'konten' => 'Memahami konsep gerak lurus dan rumusnya.',
              'video' => 'https://youtu.be/3YCRAse9irs?si=q-sj8drygUiV-Bij',
              'referensi' => 'https://www.google.com/search?q=gerak+lurus'
            ],
            [
              'judul' => 'Hukum Newton',
              'konten' => 'Mempelajari hukum Newton tentang gerak.',
              'video' => 'https://youtu.be/RKQ4LDHV6KM?si=uFOlpJkRu_oKi-ec',
              'referensi' => 'https://www.google.com/search?q=hukum+newton'
            ],
            
            ['judul'=>'Gerak Lurus Beraturan – GLB Part 1','konten'=>'Rumus kecepatan dan jarak konstan','video'=>'https://www.youtube.com/watch?v=Y8odGzf2JlU','referensi'=>'Google: GLB fisika SMP'] ,
            ['judul'=>'Konsep Dasar GLB','konten'=>'Kecepatan tetap tanpa percepatan','video'=>'https://www.youtube.com/watch?v=IdKOZPjQHCY','referensi'=>'GLB dasar diagram'] ,
            ['judul'=>'GLB – Part 2 SMP','konten'=>'Soal & grafik gerak lurus','video'=>'https://www.youtube.com/watch?v=Uf1kwxJPZ2w','referensi'=>'LeGurules GLB'] ,
            ['judul'=>'GLBB – Gerak Lurus Berubah Beraturan','konten'=>'Percepatan konstan dan grafiknya','video'=>'https://www.youtube.com/watch?v=eVkfzpEHFMU','referensi'=>'LeGurules GLBB'] ,
            ['judul'=>'GLBB Soal dan Pembahasan','konten'=>'Contoh soal GLBB kelas 8','video'=>'https://www.youtube.com/watch?v=C75j11W97qo','referensi'=>'YouTube: Kak Hasan GLBB'] ,
            ['judul'=>'GLB & GLBB – Materi SMP','konten'=>'Penjelasan kombinasi GLB & GLBB','video'=>'https://www.youtube.com/watch?v=2LZuLqVH_04','referensi'=>'Video kurikulum merdeka'] ,
            ['judul'=>'Gerak Lurus – Jarak & Perpindahan','konten'=>'Membedakan jarak vs perpindahan','video'=>'https://www.youtube.com/watch?v=l6e0X2N1rwM','referensi'=>'Materi GLB dan GLBB'] ,
            ['judul'=>'Grafik GLB – Perpindahan vs Waktu','konten'=>'Interpretasi grafik GLB','video'=>'https://www.youtube.com/watch?v=bbocnqMrqeQ','referensi'=>'Animasi GLB dasar'] ,
            ['judul'=>'Grafik GLBB – Percepatan vs Waktu','konten'=>'Grafik GLBB dan perubahan kecepatan','video'=>'https://www.youtube.com/watch?v=FljRjSluZSk','referensi'=>'YouTube: Contoh soal GLBB'] ,
            ['judul'=>'GLB & GLBB Interaktif','konten'=>'Video interaktif materi gerak lurus','video'=>'https://www.youtube.com/watch?v=NAhpIij5BJs','referensi'=>'Ruangbelajar fisika'] ,



          ]
        ],
      ],
    ],
    6 => [
      'judul' => 'Sosiologi',
      'modul' => [
        [
          'judul_modul' => 'Pengantar Sosiologi',
          'materi' => [
            [
              'judul' => 'Pengertian Sosiologi',
              'konten' => 'Mengenal definisi dan ruang lingkup sosiologi.',
              'video' => 'https://youtu.be/VY3Cp608osA?si=aQkqpS0ODJs0uAg4',
              'referensi' => 'https://www.google.com/search?q=pengertian+sosiologi'
            ],
            [
              'judul' => 'Struktur Sosial',
              'konten' => 'Memahami struktur sosial masyarakat.',
              'video' => 'https://youtu.be/-Yt-VW_GfxE?si=1OUXai5pduHzzeaR',
              'referensi' => 'https://www.google.com/search?q=struktur+sosial'
            ],

          ]
        ],
      ],
    ],
    7 => [
      'judul' => 'Bahasa Sunda',
      'modul' => [
        [
          'judul_modul' => 'Dasar Bahasa Sunda',
          'materi' => [
            [
              'judul' => 'Kosakata Dasar',
              'konten' => 'Mempelajari kosakata dasar bahasa Sunda.',
              'video' => 'https://youtu.be/lDipv_DybKg?si=wv2x_KbFcftb880G',
              'referensi' => 'https://www.google.com/search?q=kosakata+bahasa+sunda'
            ],
            [
              'judul' => 'Kalimat Sederhana',
              'konten' => 'Membuat kalimat sederhana dalam bahasa Sunda.',
              'video' => 'https://youtu.be/PsPQhPcEpI4?si=nwCXxa5xP0P34llu',
              'referensi' => 'https://www.google.com/search?q=kalimat+sederhana+bahasa+sunda'
            ],

          ['judul'=>'100 Kosa Kata Sunda Sehari-hari','konten'=>'Belajar 100 kosa kata Sunda dasar.','video'=>'https://www.youtube.com/watch?v=vaVguOkiquQ','referensi'=>'Belajar Bahasa Sunda Sehari‑hari'] ,
          ['judul'=>'Bahasa Sunda Halus dan Contoh Kalimat','konten'=>'Kosa kata halus beserta kalimat contohnya.','video'=>'https://www.youtube.com/watch?v=YTM_8hK9otA','referensi'=>'Bahasa Sunda Halus & Kalimat'] ,
          ['judul'=>'Pelafalan Huruf e, é dan eu','konten'=>'Cara pelafalan vokal dalam Bahasa Sunda.','video'=>'https://www.youtube.com/watch?v=RKQVq3QYymE','referensi'=>'Pelafalan Sunda'] ,
          ['judul'=>'A I U E O EU – Vokal Sunda Dasar','konten'=>'Latihan vokal Bahasa Sunda.','video'=>'https://www.youtube.com/watch?v=Tios1H3-YHo','referensi'=>'Huruf vokal Sunda'] ,
          ['judul'=>'Kosa Kata dari Huruf C – Bagian 1','konten'=>'Kumpulan kata dimulai huruf C dalam Bahasa Sunda.','video'=>'https://www.youtube.com/watch?v=fvwKldYY6ZI','referensi'=>'Kosakata huruf C'] ,
          ['judul'=>'Kosakata Sunda Kelas I SD','konten'=>'Pelajaran kosakata dasar untuk kelas 1 SD.','video'=>'https://www.youtube.com/watch?v=i3KavnJxBTs','referensi'=>'Bahasa Sunda Kelas 1'] ,
          ['judul'=>'Kosa Kata Kelas II SD – Nyusun Kalimah','konten'=>'Menata kalimat dari kosakata Sunda.','video'=>'https://www.youtube.com/watch?v=EaU5N3S5jao','referensi'=>'Bahasa Sunda Kelas 2'] ,
          ['judul'=>'Kosakata Sunda Kelas II SD','konten'=>'Kosakata umum untuk kelas 2 SD.','video'=>'https://www.youtube.com/watch?v=YJzYwZR1G-A','referensi'=>'Kosakata Sunda Dasar'] ,
          ['judul'=>'100 Kata Sunda – versi lainnya','konten'=>'Belajar kosa kata Sunda sehari-hari.','video'=>'https://www.youtube.com/watch?v=vaVguOkiquQ','referensi'=>'Kosa Kata Bahasa Sunda'] ,
          ['judul'=>'Bahasa Sunda “Saya” & Contoh Kalimat','konten'=>'Kata ganti orang pertama dan contoh penggunaannya.','video'=>'https://www.youtube.com/watch?v=Ex4AJO-UrHA','referensi'=>'Kosa Kata Sunda Saya'] ,

          ['judul'=>'Bahasa Sunda “Kamu” & Contoh Kalimat','konten'=>'Kata ganti orang kedua & contoh kalimat.','video'=>'https://www.youtube.com/watch?v=SlJFrYKn0Ko','referensi'=>'Kosa Kata Kamu Sunda'] ,
          ['judul'=>'Tips Belajar Bahasa Sunda Sehari-hari','konten'=>'Cara cepat belajar bahasa Sunda.','video'=>'https://www.youtube.com/watch?v=I-0-4bJ7h9o','referensi'=>'Tips belajar Sunda'] ,
          ['judul'=>'Belajar Bahasa Sunda Kelas I SD Tema 5','konten'=>'Tema pengalaman & kosakata sato.','video'=>'https://www.youtube.com/watch?v=1UTeNCeYFQM','referensi'=>'Tema Bahasa Sunda SD'] ,
          ['judul'=>'Kosa Kata Sunda – Animasi Edukasi','konten'=>'Animasi kosa kata dasar Sunda.','video'=>'https://www.youtube.com/watch?v=i3KavnJxBTs','referensi'=>'Video edukasi Sunda SD'] ,
          ['judul'=>'Mikaweruh Kecap Sunda untuk SD','konten'=>'Kosakata dasar untuk siswa SD.','video'=>'https://www.youtube.com/watch?v=Ut0bK8x2fSw','referensi'=>'Bahasa Sunda SD'] ,
          ['judul'=>'Kosa Kata “Sunda” & Kalimat','konten'=>'Latihan membuat kalimat sederhana.','video'=>'https://www.youtube.com/watch?v=fvwKldYY6ZI','referensi'=>'Kosakata Sunda huruf C'] ,
          ['judul'=>'Pelafalan Vokal & Konsonan Sunda','konten'=>'Latihan bunyi huruf Sunda.','video'=>'https://www.youtube.com/watch?v=PpLXj1ee-74','referensi'=>'Huruf vokal Sunda'] ,
          ['judul'=>'Pangalaman Pikareuseupeun (Tema 5)','konten'=>'Kosakata pengalaman menarik.','video'=>'https://www.youtube.com/watch?v=1UTeNCeYFQM','referensi'=>'Tema pengalaman kelas 1'] ,
          ['judul'=>'Kosakata Hewan & Tumbuhan Sunda','konten'=>'Contoh kosakata alam.','video'=>'https://www.youtube.com/watch?v=i3KavnJxBTs','referensi'=>'Kosakata tumbuhan Sunda'] ,

          ]
        ],
      ],
    ],
    8 => [
      'judul' => 'Ekonomi',
      'modul' => [
        [
          'judul_modul' => 'Dasar Ekonomi',
          'materi' => [
            [
              'judul' => 'Pengertian Ekonomi',
              'konten' => 'Mengenal ilmu ekonomi dan fungsinya.',
              'video' => 'https://youtu.be/_44pe9_iu14?si=1ey5ZikRzLY-vAcU',
              'referensi' => 'https://www.google.com/search?q=pengertian+ekonomi'
            ],
            [
              'judul' => 'Permintaan dan Penawaran',
              'konten' => 'Dasar konsep permintaan dan penawaran.',
              'video' => 'https://youtu.be/JYp70RQnDwM?si=Ba8g3RMYsSwm6zwR',
              'referensi' => 'https://www.google.com/search?q=permintaan+dan+penawaran'
            ],
  ['judul'=>'Permintaan dan Penawaran – Ekonomi SMA','konten'=>'Pengertian dasar permintaan & penawaran','video'=>'https://www.youtube.com/watch?v=JYp70RQnDwM','referensi'=>'Google: permintaan dan penawaran ekonomi'] ,
  ['judul'=>'Permintaan & Penawaran (Bab 4 Ekonomi)','konten'=>'Pembahasan lengkap kurva permintaan & penawaran','video'=>'https://www.youtube.com/watch?v=nF0QZ-lBMlc','referensi'=>'Ekonomi Kelas X bab 4'] ,
  ['judul'=>'Menghitung Fungsi Permintaan & Penawaran','konten'=>'Langkah menghitung fungsi ekonomi kelas 10','video'=>'https://www.youtube.com/watch?v=lztdpZaksmk','referensi'=>'Fungsi permintaan penawaran'] ,
  ['judul'=>'Menghitung Fungsi Permintaan & Penawaran I','konten'=>'Prosedur dan soal contoh','video'=>'https://www.youtube.com/watch?v=YQCEtVxYScQ','referensi'=>'Khatulistiwa Mengajar'] ,
  ['judul'=>'Materi Permintaan, Penawaran, & Keseimbangan','konten'=>'Interaksi permintaan-penawaran & keseimbangan pasar','video'=>'https://www.youtube.com/watch?v=q7uAqwmliqw','referensi'=>'Sosial Edcent'] ,
  ['judul'=>'Ekonomi Kelas X – Penawaran','konten'=>'Pembahasan hukum penawaran dan kurva','video'=>'https://www.youtube.com/watch?v=kQe5GxiByKY','referensi'=>'Ekonomi SMA Penawaran'] ,
  ['judul'=>'Teori Permintaan & Penawaran (Pengantar Ekonomi)','konten'=>'Dasar teori permintaan dan penawaran','video'=>'https://www.youtube.com/watch?v=yxyDhi1DMM0','referensi'=>'Pengantar Ekonomi teori permintaan'] ,
  ['judul'=>'Permintaan & Penawaran Uang – Inflasi','konten'=>'Permintaan uang & inflasi kelas XI','video'=>'https://www.youtube.com/watch?v=AvYsIoV5hh4','referensi'=>'Ekonomi keuangan inflasi'] ,
  ['judul'=>'Permintaan & Penawaran IPS Kelas 7','konten'=>'Dasar permintaan & penawaran untuk SMP','video'=>'https://www.youtube.com/watch?v=KVUIhMj0WPo','referensi'=>'IPS kelas 7 permintaan penawaran'] ,
  ['judul'=>'Permintaan, Penawaran, Pasar & Harga (IPS)','konten'=>'Konsep harga pasar dan keseimbangan','video'=>'https://www.youtube.com/watch?v=RAMWKyuAUhA','referensi'=>'IPS Kelas 7 bab pasar'] ,
  ['judul'=>'Teori Kurva Permintaan dan Pembuatannya','konten'=>'Cara membuat & menjelaskan kurva permintaan','video'=>'https://www.youtube.com/watch?v=BUs_tWfYIBs','referensi'=>'Teori kurva permintaan IPS'] ,
  ['judul'=>'Permintaan & Penawaran Materi IPS Kurikulum Merdeka','konten'=>'Materi lengkap Ekonomi IPS Kurikulum Merdeka','video'=>'https://www.youtube.com/watch?v=SSKXsUHNNTU','referensi'=>'IPS Kurikulum Merdeka permintaan penawaran']


          ]
        ],
      ],
    ],
    9 => [
      'judul' => 'Sejarah',
      'modul' => [
        [
          'judul_modul' => 'Sejarah Indonesia',
          'materi' => [
            [
              'judul' => 'Kerajaan Nusantara',
              'konten' => 'Mengenal kerajaan-kerajaan di Nusantara.',
              'video' => 'https://youtu.be/S7GVz-YGWrY?si=nQZvP9QtgfzdJ1EM',
              'referensi' => 'https://www.google.com/search?q=kerajaan+nusantara'
            ],
            [
              'judul' => 'Perjuangan Kemerdekaan',
              'konten' => 'Sejarah perjuangan kemerdekaan Indonesia.',
              'video' => 'https://youtu.be/Wxfa8gCHlow?si=EF9y-IXwEynFTKYd',
              'referensi' => 'https://www.google.com/search?q=perjuangan+kemerdekaan+indonesia'
            ],

            ['judul'=>'Pengertian Sejarah','konten'=>'Definisi & ruang lingkup sejarah','video'=>'https://www.youtube.com/watch?v=OHiloppf82Q','referensi'=>'SMKN2 Jayapura: Pengertian Sejarah'] ,
            ['judul'=>'Masa Praaksara Indonesia','konten'=>'Kehidupan manusia purba & kebudayaan awal','video'=>'https://www.youtube.com/watch?v=-UCcrUFijcY','referensi'=>'Siti Nuryani: Masa Praaksara'] ,
            ['judul'=>'Kedatangan Bangsa Eropa','konten'=>'Para penjajah Eropa masuk ke Nusantara','video'=>'https://www.youtube.com/watch?v=eiOQx-UTFdk','referensi'=>'Dinasti Ranti: Kedatangan Eropa'] ,
            ['judul'=>'Lahirnya Pergerakan Nasional','konten'=>'Organisasi kelahiran nasionalisme Indonesia','video'=>'https://www.youtube.com/watch?v=2fHYCYYKdjA','referensi'=>'Kita Pintar: Pergerakan Nasional'] ,
            ['judul'=>'Terbentuknya Negara Indonesia','konten'=>'Proklamasi & pembentukan negara Indonesia','video'=>'https://www.youtube.com/watch?v=gVKQUm7Fypk','referensi'=>'Halo Edukasi: Negara Indonesia'] ,
            ['judul'=>'Perjuangan Kemerdekaan','konten'=>'Diplomasi & perjuangan mempertahankan kemerdekaan','video'=>'https://www.youtube.com/watch?v=8ovizFpWH8U','referensi'=>'Arsip Nasional RI: Perjuangan RI'] ,
            ['judul'=>'Sejarah Indonesia Singkat','konten'=>'Ringkasan sejarah Nusantara hingga kemerdekaan','video'=>'https://www.youtube.com/watch?v=UelElSP-pAk','referensi'=>'Mr Frestea: Sejarah Singkat'] ,
            ['judul'=>'Tokoh Nasional & Kemerdekaan','konten'=>'Pahlawan kemerdekaan Indonesia','video'=>'https://www.youtube.com/watch?v=WzfFvYmILiU','referensi'=>'Donal Manalu: Tokoh Nasional'] ,
            ['judul'=>'Perumusan Teks Proklamasi','konten'=>'Proses penulisan Proklamasi 17 Agustus 1945','video'=>'https://www.youtube.com/watch?v=FY7l1B7ZlNY','referensi'=>'Donal Manalu: Teks Proklamasi'] ,
            ['judul'=>'Pengantar Ilmu Sejarah','konten'=>'Cara berpikir sejarah: diakronik, sinkronik','video'=>'https://www.youtube.com/watch?v=dStoWl_FyTQ','referensi'=>'Erlangga Inspirasi: Ilmu Sejarah'] ,
            ['judul'=>'Kekuasaan Inggris di Indonesia','konten'=>'Pendudukan Inggris (1811‑1816)','video'=>'https://www.youtube.com/watch?v=irwhFaqwB_U','referensi'=>'Dinasti Ranti: Inggris di Indonesia'] ,
            ['judul'=>'Historiografi & Penulisan Sejarah','konten'=>'Metode penulisan sejarah ilmiah','video'=>'https://www.youtube.com/watch?v=jl79Xi7f8KY','referensi'=>'Eduraya Teknologi: Historiografi'] ,


          ]
        ],
      ],
    ],
    10 => [
      'judul' => 'TIK',
      'modul' => [
        [
          'judul_modul' => 'Dasar TIK',
          'materi' => [
            [
              'judul' => 'Pengantar Komputer',
              'konten' => 'Memahami dasar komputer dan komponennya.',
              'video' => 'https://youtu.be/Kq1PqZHAJmY?si=SYZ5o_jjFhAMypdA',
              'referensi' => 'https://www.google.com/search?q=pengantar+komputer'
            ],
            [
              'judul' => 'Internet dan Jaringan',
              'konten' => 'Dasar tentang internet dan jaringan komputer.',
              'video' => 'https://youtu.be/WPhjxoVDygk?si=XVjfx2iGMvM8TFPo',
              'referensi' => 'https://www.google.com/search?q=internet+dan+jaringan'
            ],
            ['judul'=>'Jaringan Komputer & Internet – SMP Kelas 8','konten'=>'Dasar jaringan komputer dan internet','video'=>'https://www.youtube.com/watch?v=uW0uzfg5grA','referensi'=>'Pengantar jaringan komputer – Pelajar Hebat'] ,
            ['judul'=>'Informatika Kelas 7: Jaringan & Internet','konten'=>'Pengenalan jaringan komputer untuk SMP','video'=>'https://www.youtube.com/watch?v=owtUBkTXIiw','referensi'=>'Informatika SMP jaringan komputer'] ,
            ['judul'=>'Pengantar Jaringan Komputer – Elemen JKI','konten'=>'Dasar jaringan dan internet untuk kelas 7','video'=>'https://www.youtube.com/watch?v=9ulvZMzljqs','referensi'=>'Elemen JKI – Kelas 7'] ,
            ['judul'=>'Animasi Pengantar Komputer & Jaringan','konten'=>'Animasi tentang komputer dan internet','video'=>'https://www.youtube.com/watch?v=eAYfby_kOLY','referensi'=>'Media Pembelajaran TKJ'] ,
            ['judul'=>'Model Jaringan Komputer (Part 1)','konten'=>'Topologi & model jaringan komputer','video'=>'https://www.youtube.com/watch?v=HjbN4HSms4U','referensi'=>'Pembelajaran berpikir komputasional'] ,
            ['judul'=>'Konsep Dasar Jaringan Komputer','konten'=>'Jenis jaringan, komponen & topologi','video'=>'https://www.youtube.com/watch?v=mWZcLpuCQos','referensi'=>'Network Fundamental'] ,
            ['judul'=>'Jaringan Komputer & Internet – SMA/SMK','konten'=>'Materi SMA tentang internet & jaringan','video'=>'https://www.youtube.com/watch?v=LHTiIyTmn1Y','referensi'=>'Informatika Kelas XII'] ,
            ['judul'=>'Jaringan Komputer & Internet – Kelas XI','konten'=>'Jaringan komputer & cara koneksi internet','video'=>'https://www.youtube.com/watch?v=3MmZe5r8fpk','referensi'=>'Informatika Kelas XI'] ,
            ['judul'=>'Tutorial Dasar Jaringan Komputer (Part 1)','konten'=>'Belajar jaringan komputer dari nol','video'=>'https://www.youtube.com/watch?v=dUxyZe1zsWQ','referensi'=>'Tutorial Jaringan Dasar'] ,
            ['judul'=>'Belajar Dasar Jaringan Komputer – Part 2','konten'=>'Lanjutan materi jaringan komputer dasar','video'=>'https://www.youtube.com/watch?v=2tWCf7AEe8c','referensi'=>'Part 2 Jaringan Komputer'] ,
            ['judul'=>'Materi Internet, Intranet, Jaringan Komputer','konten'=>'Perbedaan internet dan intranet','video'=>'https://www.youtube.com/watch?v=vPtt3cR_XJ0','referensi'=>'Materi TIK jaringan SMP/SMK'] ,
            ['judul'=>'Jaringan Komponen – Dasar Teknik Jaringan','konten'=>'Komponen jaringan komputer dan telekomunikasi','video'=>'https://www.youtube.com/watch?v=_yiW4VyKRc8','referensi'=>'Portal Kawan Belajar TKJ'] ,


          ]
        ],
      ],
    ],
    11 => [
      'judul' => 'Pertanian',
      'modul' => [
        [
          'judul_modul' => 'Teknologi Pertanian',
          'materi' => [
            [
              'judul' => 'Pengantar Pertanian Modern',
              'konten' => 'Konsep pertanian modern dan penerapannya.',
              'video' => 'https://youtu.be/0cGDOSW4W28?si=8-5PV4YNUxzgl6Rz',
              'referensi' => 'https://www.google.com/search?q=pertanian+modern'
            ],
            [
              'judul' => 'Teknik Budidaya Tanaman',
              'konten' => 'Cara budidaya tanaman yang efektif.',
              'video' => 'https://youtu.be/XK52-F8387E?si=kKnwoZKbiTIzaxhY',
              'referensi' => 'https://www.google.com/search?q=budidaya+tanaman'
            ],
          ]
        ],
      ],
    ],
    12 => [
      'judul' => 'Perikanan',
      'modul' => [
        [
          'judul_modul' => 'Budidaya Ikan',
          'materi' => [
            [
              'judul' => 'Pengantar Budidaya Ikan',
              'konten' => 'Dasar-dasar budidaya ikan air tawar.',
              'video' => 'https://youtu.be/UiL9DpVVyQ0?si=J9fmq7UClsMXVaGD',
              'referensi' => 'https://www.google.com/search?q=budidaya+ikan+air+tawar'
            ],
            [
              'judul' => 'Teknik Pemeliharaan',
              'konten' => 'Teknik pemeliharaan ikan agar sehat dan produktif.',
              'video' => 'https://youtu.be/5WtPZ8GcRhk?si=CEQt1UL3C221vcPh',
              'referensi' => 'https://www.google.com/search?q=teknik+pemeliharaan+ikan'
            ],
          ]
        ],
      ],
    ],
    
    13 => [
      'judul' => 'Inggris',
      'modul' => [
        [
          'judul_modul' => 'Bahasa inggris',
          'materi' => [
            ['judul'=>'Basic English Grammar Course for Beginners','konten'=>'Grammar dasar lengkap level pemula','video'=>'https://www.youtube.com/watch?v=FI2OKNMWGc4','referensi'=>'Esther’s English Grammar Course'] ,
            ['judul'=>'Improve English Grammar in One Hour','konten'=>'Ringkasan grammar: preposisi, tenses, articles','video'=>'https://www.youtube.com/watch?v=QXVzmzhxWWc','referensi'=>'Video grammar cepat'] ,
            ['judul'=>'Complete English Grammar – Full Course 2024','konten'=>'Grammar lengkap dalam 4 jam','video'=>'https://www.youtube.com/watch?v=aOsILFNgtIo','referensi'=>'Complete Grammar 2024'] ,
            ['judul'=>'Learn All the Tenses in English','konten'=>'Pembahasan semua tenses dengan contoh','video'=>'https://www.youtube.com/watch?v=O9S70oJAivI','referensi'=>'English tenses course'] ,
            ['judul'=>'How to Use Have Been, Has Been & Had Been','konten'=>'Penggunaan tense perfect continuous','video'=>'https://www.youtube.com/watch?v=6gfpUgsAvEg','referensi'=>'Grammar specific tense'] ,
            ['judul'=>'Everyday English Conversation Practice (30 Menit)','konten'=>'Latihan percakapan sehari-hari untuk pemula','video'=>'https://www.youtube.com/watch?v=henIVlCPVIY','referensi'=>'Percakapan sehari-hari'] ,
            ['judul'=>'Learn English Conversation for Beginners','konten'=>'Dialog sederhana pemula + teks & audio','video'=>'https://www.youtube.com/watch?v=QONzSMqxzWU','referensi'=>'Basic conversation practice'] ,
            ['judul'=>'Can You Understand this Real Conversation?','konten'=>'Latihan memahami percakapan native level B2–C1','video'=>'https://www.youtube.com/watch?v=IB8JiCnk09s','referensi'=>'Advanced conversation listening'] ,
            ['judul'=>'Embedded Questions in English','konten'=>'Belajar membuat embedded questions (grammar)','video'=>'https://www.youtube.com/watch?v=QY3LXeUgmE4','referensi'=>'Grammar embedded questions'] ,
            ['judul'=>'How to Make Embedded Questions in English','konten'=>'Phrasal verb conversation dan pertanyaan terselip','video'=>'https://www.youtube.com/watch?v=3XZISddiZFQ','referensi'=>'Conversation grammar tips'] ,
            ['judul'=>'English Listening Practice – Native Conversation','konten'=>'Simulasi dialog asli untuk listening','video'=>'https://www.youtube.com/watch?v=wlaseUOlpWM','referensi'=>'Native speaker listening'] ,
            ['judul'=>'Learn English Conversation – Level 1','konten'=>'Basic conversational English DVD style','video'=>'https://www.youtube.com/watch?v=7oOX48NOyTQ','referensi'=>'Beginner conversation DVD'] ,
          ]
        ],
      ],
    ],
  ];

// Validasi ID kursus
if (!$id || !isset($kursus_list[$id])) {
  echo "<p>Kursus tidak ditemukan. <a href='index.php'>Kembali</a></p>";
  exit;
}

$kursus = $kursus_list[$id];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <!-- Favicon -->
  <link href="../../assets/img/sma12logo.png" rel="icon" />
  <title><?= htmlspecialchars($kursus['judul']) ?> – BelajarKu</title>
  <style>
    body { font-family: 'Segoe UI', sans-serif; background:#f9fafb; margin:0; padding:0; }
    header { background:#4f46e5; padding:1rem; color:white; }
    .container { max-width: 900px; margin:2rem auto; background:white; padding:2rem; box-shadow:0 2px 10px rgba(0,0,0,0.05); border-radius:8px; }
    h2 { margin-top: 0; color:#333; }
    .modul { margin-bottom: 2rem; }
    .modul h3 { background:#e0e7ff; padding:0.5rem 1rem; border-radius:6px; color:#3730a3; }
    .materi { margin-top:1rem; padding-left:1rem; }
    .materi-item { margin-bottom: 2rem; }
    .materi-item h4 { margin-bottom:0.3rem; color:#1e40af; }
    .materi-item p { color:#555; margin-bottom:1rem; line-height:1.4; }
    iframe { width: 100%; height: 360px; border:none; border-radius:8px; margin-bottom:1rem; }
    a { color: #4f46e5; text-decoration:none; }
    a:hover { text-decoration:underline; }
    hr { border: none; border-top: 1px solid #ddd; margin: 2rem 0; }
    footer { text-align:center; padding:1rem; color:#777; font-size:0.9rem; margin-top:3rem; }
  </style>
</head>
<body>
<header>
  <h1><?= htmlspecialchars($kursus['judul']) ?></h1>
</header>
<div class="container">
  <p>Berikut materi lengkap untuk kursus <strong><?= htmlspecialchars($kursus['judul']) ?></strong>:</p>

  <?php foreach ($kursus['modul'] as $modul): ?>
    <div class="modul">
      <h3><?= htmlspecialchars($modul['judul_modul']) ?></h3>
      <div class="materi">
        <?php foreach ($modul['materi'] as $bagian): ?>
          <div class="materi-item">
            <h4><?= htmlspecialchars($bagian['judul']) ?></h4>
            <p><?= htmlspecialchars($bagian['konten']) ?></p>
            <?php
              $embed_url = youtube_embed_url($bagian['video']);
              if ($embed_url):
            ?>
              <iframe src="<?= htmlspecialchars($embed_url) ?>" allowfullscreen></iframe>
            <?php else: ?>
              <p><a href="<?= htmlspecialchars($bagian['video']) ?>" target="_blank" rel="noopener noreferrer">Tonton Video</a></p>
            <?php endif; ?>
            <p>Referensi: <a href="<?= htmlspecialchars($bagian['referensi']) ?>" target="_blank" rel="noopener noreferrer"><?= $bagian['referensi'] ?></a></p>
          </div>
        <?php endforeach; ?>
      </div>
      <hr />
    </div>
  <?php endforeach; ?>

  <p><a href="index.php">← Kembali ke Beranda</a></p>
</div>
<footer>&copy; <?= date('Y') ?> BelajarKu.</footer>
</body>
</html>
