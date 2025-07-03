<?php
require_once 'db.php';

$slug = $_GET['slug'] ?? null;

if (!$slug) {
    http_response_code(400);
    echo "Parameter slug tidak ditemukan.";
    exit;
}

$stmt = $conn->prepare("SELECT * FROM artikel_seru88 WHERE url = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    http_response_code(404);
    echo "Artikel tidak ditemukan.";
    exit;
}

$row = $result->fetch_assoc();

$title = $row['title'];
$desc = $row['meta_desc'];
$image = $row['image_url'];
$content = $row['content'];
?>
<!doctype html>
<html ⚡ lang="id">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($title) ?> | Seru88</title>
  <link rel="canonical" href="https://<?= $_SERVER['HTTP_HOST'] ?>/?slug=<?= urlencode($slug) ?>" />
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
  <meta name="description" content="<?= htmlspecialchars($desc) ?>">
  <meta name="robots" content="index, follow, max-image-preview:large">

  <script async src="https://cdn.ampproject.org/v0.js"></script>

  <meta property="og:title" content="<?= htmlspecialchars($title) ?> | Seru88" />
  <meta property="og:description" content="<?= htmlspecialchars($desc) ?>" />
  <meta property="og:url" content="https://<?= $_SERVER['HTTP_HOST'] ?>/?slug=<?= urlencode($slug) ?>" />
  <meta property="og:type" content="article" />
  <meta property="og:image" content="<?= htmlspecialchars($image) ?>" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= htmlspecialchars($title) ?> | Seru88" />
  <meta name="twitter:description" content="<?= htmlspecialchars($desc) ?>" />
  <meta name="twitter:image" content="<?= htmlspecialchars($image) ?>" />

  <style amp-boilerplate>
    body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}
    @-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}
    @keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}
  </style>
  <noscript><style amp-boilerplate>body{-webkit-animation:none;animation:none}</style></noscript>

  <style amp-custom>
    body { font-family: Arial, sans-serif; padding: 16px; max-width: 700px; margin: auto; background: #fff; color: #111; }
    h1, h2 { color: #024c92; }
    .time { font-size: 14px; color: gray; margin-bottom: 20px; }
    amp-img { max-width: 100%; }
    article p { line-height: 1.6; }
    footer { font-size: 14px; color: #777; margin-top: 40px; text-align: center; }
  </style>

  <script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "NewsArticle",
    "mainEntityOfPage":{
      "@type":"WebPage",
      "@id":"https://<?= $_SERVER['HTTP_HOST'] ?>/?slug=<?= urlencode($slug) ?>"
    },
    "headline": "<?= htmlspecialchars($title) ?> | Seru88",
    "image": {
      "@type": "ImageObject",
      "url": "<?= htmlspecialchars($image) ?>"
    },
    "datePublished": "<?= date('c', strtotime($row['created_at'])) ?>",
    "dateModified": "<?= date('c', strtotime($row['created_at'])) ?>",
    "author": {
      "@type":"Organization",
      "name": "Seru88"
    },
    "publisher": {
      "@type": "Organization",
      "name": "Seru88",
      "logo": {
        "@type": "ImageObject",
        "url": "https://via.placeholder.com/200x60?text=Seru88"
      }
    },
    "description": "<?= htmlspecialchars($desc) ?>"
  }
  </script>
</head>

<body>
  <article>
    <h1><?= htmlspecialchars($title) ?></h1>
    <div class="time">🕒 Ditulis oleh <strong>Seru88 Editorial</strong> • <?= date('d M Y', strtotime($row['created_at'])) ?> • Estimasi baca: ±8 menit</div>
    <amp-img src="<?= htmlspecialchars($image) ?>" width="1280" height="720" layout="responsive" alt="<?= htmlspecialchars($title) ?>"></amp-img>
    <?= $content ?>
  </article>

  <footer>
    &copy; <?= date('Y') ?> Seru88. Artikel hanya untuk edukasi & informasi.
  </footer>
</body>
</html>
