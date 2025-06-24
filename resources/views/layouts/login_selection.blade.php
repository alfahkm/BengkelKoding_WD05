<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login | Poliklinik Wong Mumet</title>

  <!-- Google Font: Source Sans Pro -->
  @include('layouts.lib.ext_css')

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #0d47a1;
      color: #333;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    header {
      background-color: #0d47a1;
      color: white;
      padding: 2rem 1rem;
      text-align: center;
      font-weight: 700;
      font-size: 2rem;
      user-select: none;
    }

    header small {
      display: block;
      font-weight: 400;
      font-size: 1rem;
      color: #cfd8dc;
      margin-top: 0.5rem;
    }

    main {
      flex-grow: 1;
      background-color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem;
    }

    .container {
      max-width: 900px;
      width: 100%;
      display: flex;
      gap: 4rem;
      flex-wrap: wrap;
      justify-content: center;
    }

    .card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
      padding: 2rem;
      flex: 1 1 300px;
      max-width: 400px;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      transition: transform 0.3s ease;
      cursor: pointer;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
    }

    .icon {
      background-color: #1976d2;
      color: white;
      border-radius: 8px;
      padding: 1rem;
      font-size: 2rem;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card h2 {
      margin: 0 0 1rem 0;
      font-weight: 700;
      font-size: 1.5rem;
      color: #0d47a1;
    }

    .card p {
      flex-grow: 1;
      font-size: 1rem;
      color: #555;
      margin-bottom: 1.5rem;
    }

    .card a {
      color: #1976d2;
      font-weight: 600;
      text-decoration: none;
      font-size: 1rem;
      transition: color 0.3s ease;
    }

    .card a:hover {
      color: #0d47a1;
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
  <header>
    Poliklinik Wong Mumet
    <small>Sistem Temu Janji Pasien - Dokter<br />Bimbingan Karir 2023 Bidang Web</small>
  </header>
  <main>
    <div class="container">
      <div class="card" onclick="window.location.href='/login?type=pasien'" style="cursor:pointer;">
        <div class="icon"><i class="fas fa-user"></i></div>
        <h2>Registrasi Sebagai Pasien</h2>
        <p>Apabila Anda adalah seorang Pasien, silahkan Registrasi terlebih dahulu untuk melakukan pendaftaran sebagai Pasien!</p>
        <a href="/login?type=pasien">Klik Link Berikut &rarr;</a>
      </div>
      <div class="card" onclick="window.location.href='/login?type=dokter'" style="cursor:pointer;">
        <div class="icon"><i class="fas fa-user"></i></div>
        <h2>Login Sebagai Dokter</h2>
        <p>Apabila Anda adalah seorang Dokter, silahkan Login terlebih dahulu untuk memulai melayani Pasien!</p>
        <a href="/login?type=dokter">Klik Link Berikut &rarr;</a>
      </div>
    </div>
  </main>
</body>

</html>
