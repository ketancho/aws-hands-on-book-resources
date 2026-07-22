<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AWS Learning Journal</title>

  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <style>
    body {
      background-color: #f5f7fb;
    }

    .page-title {
      font-weight: bold;
      color: #23303e;
      margin-bottom: 40px;
    }

    .journal-card {
      border: none;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      transition: transform 0.2s;
    }

    .journal-card:hover {
      transform: translateY(-4px);
    }

    .journal-image {
      height: 220px;
      object-fit: cover;
    }

    .journal-learning {
      color: #555;
    }
  </style>
</head>
<body>

<?php

$host = '<RDS インスタンスのエンドポイント>';
$dbname = 'aws_learning_journal';
$username = 'admin';
$password = '<RDS インスタンス作成時に設定したパスワード>';

try {

  $pdo = new PDO(
    "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
    $username,
    $password
  );

  $sql = "SELECT title, learning, image
          FROM journals
          ORDER BY id ASC";

  $statement = $pdo->query($sql);

  $journals = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

  echo "データベース接続に失敗しました。";
  exit;
}

?>

<div class="container py-5">
  <h1 class="text-center page-title">AWS Learning Journal</h1>
  <div class="row g-4">
    <?php foreach ($journals as $journal) : ?>
      <div class="col-md-6 col-lg-4">
        <div class="card journal-card h-100">
          <img src="<?php echo $journal['image']; ?>" class="card-img-top journal-image">
          <div class="card-body">
            <h5 class="card-title">
              <?php echo $journal['title']; ?>
            </h5>
            <p class="card-text journal-learning">
              <?php echo $journal['learning']; ?>
            </p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

</body>
</html>
