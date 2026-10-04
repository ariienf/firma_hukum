<?php
// =====================================================================
//  DATA AKUN STAF (BACKEND) - DISIMPAN DI KODE, BUKAN DI DATABASE
//  Inilah "database aktor backend di dalam coding" sesuai rancangan.
//  Password disimpan sebagai HASH bcrypt (bukan teks polos).
//  Semua contoh di bawah memakai password: sap12345
//
//  Cara membuat hash baru (jalankan sekali di PHP):
//     echo password_hash('passwordbaru', PASSWORD_DEFAULT);
//  lalu tempel hasilnya ke kolom 'password' di bawah.
// =====================================================================

return [
    // ----- Administrator -----
    'admin' => [
        'kode'     => 'AD01',
        'nama'     => 'Administrator',
        'role'     => 'administrator',
        'password' => '$2y$10$8T/FWaT0NIwz4xBCwNHs5u8vchJebrQo9xzrGnG7d9kHTp/ArBLSe',
    ],
    // ----- Paralegal -----
    'paralegal1' => [
        'kode'     => 'PL01',
        'nama'     => 'Misbahul Fazri, S.H',
        'role'     => 'paralegal',
        'password' => '$2y$10$YumdCq9x4F.nbECFjUWpWexEPV7WdfAsoXNHD4JCRQRFBH8XzWvB.',
    ],
    // ----- Managing Partner -----
    'mp1' => [
        'kode'     => 'MP01',
        'nama'     => 'Subhan Aziz, S.H., M.H.',
        'role'     => 'managing_partner',
        'password' => '$2y$10$uDKweQuzvRG35auiHmrHeuZlCQV.e57h9WB0MIv2fs.5Ow1rBoM.K',
    ],
    // ----- Lawyer -----
    'lawyer2' => [
        'kode'     => 'LW01',
        'nama'     => 'Achmad Tadzudin, S.H.',
        'role'     => 'lawyer',
        'password' => '$2y$10$uWvTYoVFdsGaemkacpSvLero/MliH8.Uy5.VxK8QSwKa94fw0ovHy',
    ],
    'lawyer3' => [
        'kode'     => 'LW02',
        'nama'     => 'Ade Akbar Mubarok, S.H.I.',
        'role'     => 'lawyer',
        'password' => '$2y$10$vRsB3lrV84tzhkIRwlnPpe8CGmvd4CPHv.rF/4G9dr8pfGqR/L2xa',
    ],
    // Tambah staf lain cukup dengan menyalin blok di atas.
];
