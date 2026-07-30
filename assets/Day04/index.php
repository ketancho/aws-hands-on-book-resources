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
  $journals = array(
    array(
      "title" => "Day1",
      "learning" => "<皆さまの学びに書き換えてください> AWSアカウントの作成と、IAMユーザーの作成について学びました。◯◯についてはもっと理解を深めたい。",
      "image" => "./imgs/img01.png",
    ),
    array(
      "title" => "Day2",
      "learning" => "<皆さまの学びに書き換えてください> AWSアカウントを作成したときにやっておくべき設定について学びました。特に、△△は案件の中でも利用できそうに思えた。",
      "image" => "./imgs/img02.png",
    ),
    array(
      "title" => "Day3",
      "learning" => "<皆さまの学びに書き換えてください> Amazon VPCの基本について学びました。",
      "image" => "./imgs/img03.png",
    ),
    array(
      "title" => "Day4",
      "learning" => "<皆さまの学びに書き換えてください> Amazon EC2について学びました。",
      "image" => "./imgs/img04.png",
    )
  );
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
