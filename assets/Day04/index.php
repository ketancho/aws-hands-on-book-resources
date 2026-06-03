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
      margin-bottom: 40px;
    }

    .post-card {
      border: none;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      transition: transform 0.2s;
    }

    .post-card:hover {
      transform: translateY(-4px);
    }

    .post-image {
      height: 220px;
      object-fit: cover;
    }

    .post-learning {
      color: #555;
    }
  </style>
</head>
<body>

<?php
  $posts = array(
    array(
      "title" => "Day1",
      "learning" => "AWS アカウントの作成と、IAM ユーザーの作成について学んだ。",
      "image" => "./imgs/img01.png",
    ),
    array(
      "title" => "Day2",
      "learning" => "AWS アカウントを作成したときにやっておくべき設定について学んだ。",
      "image" => "./imgs/img02.png",
    ),
    array(
      "title" => "Day3",
      "learning" => "Amazon VPC について学んだ。xxxxxx",
      "image" => "./imgs/img03.png",
    ),
    array(
      "title" => "Day4",
      "learning" => "Amazon EC2 について学んだ。インスタンスを起動し、接続や、各種インストールを行った。",
      "image" => "./imgs/img04.png",
    )
  );
?>

<div class="container py-5">

  <h1 class="text-center page-title">AWS Learning Journal</h1>

  <div class="row g-4">

    <?php foreach ($posts as $post) : ?>

    <div class="col-md-6 col-lg-4">

      <div class="card post-card h-100">

        <img src="<?php echo $post['image']; ?>"
             class="card-img-top post-image">

        <div class="card-body">
          <h5 class="card-title">
            <?php echo $post['title']; ?>
          </h5>

          <p class="card-text post-learning">
            <?php echo $post['learning']; ?>
          </p>
        </div>

      </div>
    </div>

    <?php endforeach; ?>

  </div>
</div>

</body>
</html>
