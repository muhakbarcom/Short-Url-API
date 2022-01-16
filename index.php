<?php
// if $POST['shortlink'] is not empty
if (isset($_POST['shortlink'])) {
  //  https://api.shrtco.de/v2/shorten?url=
  $shortlink = $_POST['shortlink'];
  $url = "https://api.shrtco.de/v2/shorten?url=$shortlink";
  $shortlink = file_get_contents($url);
  $shortlink = json_decode($shortlink, true);
}

// if $POST['info'] is not empty
if (isset($_POST['info'])) {
  //  https://api.shrtco.de/v2/info?code=
  $info = $_POST['info'];
  // remove word 'https://shrtco.de/' from $info
  $info = str_replace('https://shrtco.de/', '', $info);
  $url = "https://api.shrtco.de/v2/info?code=$info";
  $info = file_get_contents($url);
  $info = json_decode($info, true);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>API Shortlink</title>
  <!-- bootstrap 5 cdn -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>

<body>
  <!-- shortlink layout -->
  <div class="container">
    <!-- card bootstrap-->
    <div class="card col-8 mx-auto mt-5">
      <div class="card-header">
        <h3>API Link Shortener</h3>
        <p class="text-muted">Endpoint 1</p>
      </div>
      <div class="card-body">
        <h5 class="card-title">Perpendek Link Anda</h5>
        <div class="row">
          <div class="col-md-12">
            <hr>
            <form action="index.php" method="post">
              <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                  <div class="form-group">
                    <p class="text-muted">Contoh : http://blog.muhakbar.com/2021/12/uts-semester-5-d3-mi-3a-poltekpos.html</p>
                    <div class="input-group">
                      <input type="text" class="form-control bg-light text-dark" name="shortlink" id="shortlink" placeholder="Masukan Link.." style="outline: none;">
                      <!-- bootstrap 5 search box dark with font awesome -->
                      <div class=" input-group-append">
                        <button class="btn btn-outline-dark" type="submit">
                          <i class="fas fa-paper-plane"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <!-- if $POST -->
            <?php if (isset($_POST['shortlink'])) : ?>
              <div class="row">
                <div class="col-md-12">
                  <hr>
                  <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Link Anda</h4>
                    <p>
                      <!-- copyable text -->
                      <a href="<?= $shortlink['result']['full_short_link'] ?>" class="text-dark" target="_blank"><?= $shortlink['result']['full_short_link'] ?></a>
                    </p>
                  </div>
                </div>
              </div>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
    <div class="card col-8 mx-auto mt-5">
      <div class="card-header">
        <h3>API Link Shortener</h3>
        <p class="text-muted">Endpoint 2</p>
      </div>
      <div class="card-body">
        <h5 class="card-title">Cek Info Shortlink Link</h5>
        <div class="row">
          <div class="col-md-12">
            <hr>
            <form action="index.php" method="post">
              <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                  <div class="form-group">
                    <p class="text-muted">Contoh : https://shrtco.de/Dx5m3K</p>
                    <div class="input-group">
                      <input type="text" class="form-control bg-light text-dark" name="info" id="info" placeholder="Masukan shortLink.." style="outline: none;">
                      <!-- bootstrap 5 search box dark with font awesome -->
                      <div class=" input-group-append">
                        <button class="btn btn-outline-dark" type="submit">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <!-- if $POST -->
            <?php if (isset($_POST['info'])) : ?>
              <div class="row">
                <div class="col-md-12">
                  <hr>
                  <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Info Shortlink</h4>
                    <!-- table -->
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                          <td>
                            Code :
                          </td>
                          <td><?= $info['result']['code']; ?></td>
                        </tr>
                        <tr>
                          <td>
                            URL :
                          </td>
                          <td><?= $info['result']['url']; ?></td>
                        </tr>
                        <tr>
                          <td>
                            Password Protected :
                          </td>
                          <td><?php
                              if ($info['result']['password_protected'] == true) {
                                echo "Yes";
                              } else {
                                echo "No";
                              }
                              ?></td>
                        </tr>
                        <tr>
                          <td>
                            Blocked :
                          </td>
                          <td><?php
                              if ($info['result']['blocked'] == true) {
                                echo "Yes";
                              } else {
                                echo "No";
                              }
                              ?></td>
                        </tr>
                        <tr>
                          <td>
                            Created :
                          </td>
                          <td><?php
                              if ($info['result']['created'] == true) {
                                echo $info['result']['created'];
                              } else {
                                echo "Null";
                              }
                              ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                <?php endif; ?>
                </div>
              </div>
          </div>
        </div>
</body>

</html>