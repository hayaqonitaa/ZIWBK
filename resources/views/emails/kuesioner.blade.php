<!DOCTYPE html>
<html>
<head>
    <title>Pengisian Kuesioner ZI-WBK dan WBBM Polban</title>
</head>
<body>
    <h1>Dear, {{ $pembagian->mahasiswa->nama }}</h1>
    <p>Anda telah dipilih untuk mengisi Kuesioner ZI-WBK Polban.</p>
    <p>
        Berikut link untuk pengisian kuesioner:
        <a href="{{ $pembagian->kuesioner->link_kuesioner }}">{{ $pembagian->kuesioner->link_kuesioner }}</a>
    </p>
    <p>Terima kasih atas partisipasi Anda!</p>
</body>
</html>
