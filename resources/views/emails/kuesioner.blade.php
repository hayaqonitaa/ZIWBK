<!DOCTYPE html>
<html>
<head>
    <title>Pengiriman Kuesioner</title>
</head>
<body>
    <h1>Dear, {{ $pembagian->mahasiswa->nama }}</h1>
    <p>Anda telah dipilih untuk mengisi Kuesioner ZI-WBK Polban "{{ $pembagian->kuesioner->judul }}".</p>
    <p>
        Berikut link untuk pengisian kuesioner:
        <a href="{{ $pembagian->kuesioner->link_kuesioner }}">{{ $pembagian->kuesioner->link_kuesioner }}</a>
    </p>
    <p>Terima kasih atas partisipasi Anda!</p>
</body>
</html>
