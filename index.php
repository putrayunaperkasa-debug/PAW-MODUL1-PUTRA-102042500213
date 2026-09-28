<?php
$produk = [
    ["nama" => "Monitor rog 27 Inch",     "kategori" => "Monitor",   "harga" => 2800000, "stok" => 5],
    ["nama" => "Laptop loq", "kategori" => "Laptop",    "harga" => 9500000, "stok" => 2],
    ["nama" => "Mouse Logitech",      "kategori" => "Aksesoris", "harga" => 350000,  "stok" => 11],
    ["nama" => "Keyboard Ajazz",    "kategori" => "Aksesoris", "harga" => 550000,  "stok" => 0],
    ["nama" => "Headset Rexus",      "kategori" => "Audio",     "harga" => 1200000, "stok" => 3],
    ["nama" => "Flashdisk Adata 128GB",      "kategori" => "Storage",   "harga" => 75000,   "stok" => 0],
];


$persenDiskon = 10;        
$batasDiskon  = 1000000;   

function rupiah($angka) {
    return "Rp" . number_format($angka, 0, ",", ".");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cia Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0b1a33;
            --muted: #5b6b8a;
            --bg: #f2f5fb;
            --surface: #ffffff;
            --line: #dde5f3;
            --navy: #0f2557;
            --navy-dark: #0a1a3f;
            --navy-deep: #07122b;
            --royal: #1e3a8a;
            --sky: #bfdbfe;
            --chip-bg: #e3ebfb;
            --amber-bg: #fef3c7;
            --amber: #b45309;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: "Plus Jakarta Sans", "Segoe UI", Arial, sans-serif;
            background: var(--bg);
            color: var(--ink);
            line-height: 1.5;
        }

        .container { max-width: 1040px; margin: 0 auto; padding: 0 20px; }

        header {
            position: sticky; top: 0; z-index: 10;
            background: rgba(255, 255, 255, .88);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--line);
        }
        .navbar { display: flex; justify-content: space-between; align-items: center; gap: 15px; padding: 14px 20px; }
        .logo { font-size: 20px; font-weight: 800; letter-spacing: -.02em; color: var(--navy); }
        .logo::before {
            content: ""; display: inline-block; width: 12px; height: 12px;
            border-radius: 4px; background: var(--navy); margin-right: 8px;
            box-shadow: 5px 5px 0 var(--sky);
        }
        nav a {
            margin-left: 6px; padding: 8px 14px; border-radius: 999px;
            font-size: 14px; font-weight: 600; color: var(--muted); text-decoration: none;
            transition: background .2s, color .2s;
        }
        nav a:hover { background: var(--chip-bg); color: var(--navy); }

        .hero {
            position: relative; overflow: hidden;
            background: linear-gradient(135deg, var(--navy-deep) 0%, var(--navy) 55%, var(--royal) 100%);
            color: #fff; border-radius: 28px; padding: 64px 44px; margin: 28px 0;
        }
        .hero::before, .hero::after { content: ""; position: absolute; border-radius: 50%; pointer-events: none; }
        .hero::before { width: 320px; height: 320px; right: -80px; top: -110px; background: rgba(147, 197, 253, .18); }
        .hero::after  { width: 200px; height: 200px; right: 90px; bottom: -110px; background: rgba(255, 255, 255, .08); }
        .hero > * { position: relative; z-index: 1; }
        .hero small, .hero p { color: #c3d3f0; }
        .hero small { font-weight: 600; font-size: 13px; letter-spacing: .04em; }
        .hero h1 { font-size: clamp(32px, 6vw, 52px); font-weight: 800; letter-spacing: -.03em; line-height: 1.1; margin: 10px 0 12px; max-width: 14ch; }
        .hero p { margin-bottom: 26px; max-width: 46ch; font-size: 16px; }
        .btn-hero {
            display: inline-block; background: var(--sky); color: var(--navy-dark);
            padding: 13px 26px; border-radius: 999px; font-weight: 700; text-decoration: none;
            transition: background .2s, transform .2s;
        }
        .btn-hero:hover { background: #dbeafe; transform: translateY(-2px); }

        .catalog-head { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 12px; margin: 48px 0 22px; }
        .catalog-head small { color: var(--royal); font-weight: 700; font-size: 13px; }
        .catalog-head h2 { font-size: 28px; font-weight: 800; letter-spacing: -.02em; color: var(--navy-dark); }
        .total {
            background: var(--surface); border: 1px solid var(--line);
            padding: 8px 16px; border-radius: 999px; font-size: 14px; color: var(--muted);
        }
        .total strong { color: var(--navy); }

        .grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; }

        .card {
            background: var(--surface); border: 1px solid var(--line);
            border-radius: 22px; padding: 24px; display: flex; flex-direction: column;
            transition: transform .2s ease, border-color .2s, box-shadow .2s;
        }
        .card:hover { transform: translateY(-5px); border-color: #a9bde6; box-shadow: 0 12px 30px -14px rgba(15, 37, 87, .4); }
        .card:has(button:disabled) { background: #f8faff; }
        .card:has(button:disabled) h3,
        .card:has(button:disabled) .harga { color: #7f8db0; }

        .kategori {
            display: inline-block; font-size: 12px; font-weight: 600;
            background: var(--chip-bg); color: var(--royal);
            padding: 3px 10px; border-radius: 999px;
        }
        .badge {
            background: var(--amber-bg); color: var(--amber);
            padding: 3px 10px; border-radius: 999px;
            font-size: 12px; font-weight: 700; margin-left: 6px;
        }
        .card h3 { font-size: 19px; font-weight: 700; letter-spacing: -.01em; margin: 16px 0 16px; color: var(--navy-dark); }
        .coret { color: #93a0bd; text-decoration: line-through; font-size: 14px; min-height: 21px; }
        .harga { font-size: 24px; font-weight: 800; letter-spacing: -.02em; color: var(--navy); margin-bottom: 16px; }

        .info {
            display: flex; justify-content: space-between; align-items: center;
            border-top: 1px dashed var(--line); padding-top: 14px; margin-top: auto;
            font-size: 14px; color: var(--muted);
        }
        .status { padding: 4px 12px; border-radius: 999px; font-size: 12px; font-weight: 700; }
        .tersedia { background: #dcfce7; color: #15803d; }
        .habis { background: #fee2e2; color: #b91c1c; }

        button {
            width: 100%; margin-top: 16px; padding: 13px; border: none; border-radius: 14px;
            background: var(--navy); color: #fff; font: inherit; font-size: 15px; font-weight: 700;
            cursor: pointer; transition: background .2s, opacity .2s;
        }
        button:hover { background: var(--navy-deep); opacity: .92; }
        button:disabled { background: #e4e9f4; color: #93a0bd; cursor: not-allowed; opacity: 1; }

        a:focus-visible, button:focus-visible { outline: 3px solid #3b62d9; outline-offset: 3px; }

        footer {
            margin-top: 72px; padding: 28px 0; text-align: center;
            font-size: 14px; color: var(--muted);
            background: var(--surface); border-top: 1px solid var(--line);
        }

        @media (max-width: 900px) {
            .grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 600px) {
            .grid { grid-template-columns: 1fr; }
            .hero { padding: 40px 24px; border-radius: 22px; }
            .navbar { flex-direction: column; gap: 8px; }
            nav a { margin: 0 2px; }
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            * { transition: none !important; }
        }
    </style>
</head>
<body>

<header>
    <div class="container navbar">
        <div class="logo">Cia Store</div>
        <nav>
            <a href="#home">Home</a>
            <a href="#products">Products</a>
            <a href="#about">About</a>
        </nav>
    </div>
</header>

<main class="container">

    <section class="hero" id="home">
        <small>CIA STORE</small>
        <h1>Simple Tech Store.</h1>
        <p>Temukan berbagai perangkat dan aksesoris teknologi untuk kebutuhanmu.</p>
        <a href="#products" class="btn-hero">Lihat Produk</a>
    </section>

    <section id="products">
        <div class="catalog-head">
            <div>
                <small>OUR PRODUCTS</small>
                <h2>Katalog Produk</h2>
            </div>
            <div class="total">Total Produk: <strong><?= count($produk) ?></strong></div>
        </div>

        <div class="grid">
            <?php foreach ($produk as $p): ?>
                <?php               
                if ($p["harga"] >= $batasDiskon) {
                    $diskon = true;
                    $hargaAkhir = $p["harga"] - ($p["harga"] * $persenDiskon / 100);
                } else {
                    $diskon = false;
                    $hargaAkhir = $p["harga"];
                }

                if ($p["stok"] > 0) {
                    $status = "Tersedia";
                    $kelasStatus = "tersedia";
                    $teksTombol = "Beli Sekarang";
                    $atributTombol = "";
                } else {
                    $status = "Stok Habis";
                    $kelasStatus = "habis";
                    $teksTombol = "Stok Habis";
                    $atributTombol = "disabled";
                }
                ?>
                <article class="card">
                    <div>
                        <span class="kategori"><?= $p["kategori"] ?></span>
                        <?php if ($diskon): ?><span class="badge">DISKON <?= $persenDiskon ?>%</span><?php endif; ?>
                    </div>

                    <h3><?= $p["nama"] ?></h3>

                    <div class="coret"><?= $diskon ? rupiah($p["harga"]) : "" ?></div>
                    <div class="harga"><?= rupiah($hargaAkhir) ?></div>

                    <div class="info">
                        <span>Stok: <?= $p["stok"] ?></span>
                        <span class="status <?= $kelasStatus ?>"><?= $status ?></span>
                    </div>

                    <button <?= $atributTombol ?>><?= $teksTombol ?></button>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

</main>

<footer id="about">&copy; <?= date("Y") ?> Cia Store. Semua hak dilindungi.</footer>

</body>
</html>