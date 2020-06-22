<?php
//koneksi
session_start();
include("koneksi.php");

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SPK TOPSIS</title>
    <!--bootstrap-->
    <link href="tampilan/css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>

    <!--menu-->
    <nav class="navbar navbar-default navbar-custom">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">SPK Metode Topsis</a>
        </div>

        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="kriteria.php">Kriteria</a>
            </li>
            <li>
              <a href="alternatif.php">Alternatif</a>
            </li>
            <li>
              <a href="poin.php">Poin</a>
            </li>
            <li>
              <a href="nilmat.php">Nilai Matriks</a>
            </li>
            <li>
              <a href="hastop.php">Hasil Topsis</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!--tabel-tabel dan form-->
    <div class="container"> <!--container-->
      <div class="row"> <!--row-->
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading text-center">
              Nilai Matriks
            </div>

            <div class="panel-body">
              <!--form pengisian-->
              <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                  <div class="panel panel-default">
                    <div class="panel-heading text-center">
                      Alternatif
                    </div>

                    <div class="panel-body">
                      <div class="row">
                        <div class="col-lg-12">
                          <form class="form" action="tambahnilmat.php" method="post">
                            <div class="form-group">
                              <select class="form-control" name="alter">
                                <option>Nama Alternatif</option>
                                <?php
                                //ambil data dari database
                                $nama = $koneksi->query('SELECT * FROM tab_alternatif ORDER BY id_alternatif ASC');
                                while ($datalter = $nama->fetch_array())
                                {
                                  echo "<option value=\"$datalter[id_alternatif]\">$datalter[nama_alternatif]</option>\n";
                                }
                                ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <select class="form-control" name="krit">
                                <option>Nama Kriteria</option>
                                <?php
                                //ambil data dari database
                                $krit = $koneksi->query('SELECT * FROM tab_kriteria ORDER BY id_kriteria ASC');
                                while ($datakrit = $krit->fetch_array())
                                {
                                  echo "<option value=\"$datakrit[id_kriteria]\">$datakrit[nama_kriteria]</option>\n";
                                }
                                ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <select class="form-control" name="nilai">
                                <option>Nilai</option>
                                <?php
                                //ambil data dari database
                                $poin = $koneksi->query('SELECT * FROM tab_poin ORDER BY poin');
                                while ($datapoin = $poin->fetch_array())
                                {
                                  echo "<option value=\"$datapoin[id_poin]\">$datapoin[poin]</option>\n";
                                }
                                ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <button type="submit" class="btn btn-success">Proses</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              <!--tabel-tabel-->
              <div class="row">
                <!--tabel alternatif-->
                <div class="col-xs-6 col-md-4">
                  <div class="panel panel-default">
                    <div class="panel-heading text-center">
                      Tabel Alternatif
                    </div>

                    <div class="panel-body">
                      <div class="row">
                        <div class="col-lg-12">

                          <?php
                           $sql = $koneksi->query('SELECT * FROM tab_alternatif');
                           ?>
                          <table class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>ID Alternatif</th>
                                <th>Nama Alternatif</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              while ($row = $sql->fetch_array()) {
                                echo ("<tr><td align=\"center\">".$row[0]."</td>");
                                echo ("<td align=\"left\">".$row[1]."</td>");
                                echo "</tr>";
                              }
                               ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <!--tabel kriteria-->

                <div class="col-xs-6 col-md-4">
                  <div class="panel panel-default">
                    <div class="panel-heading text-center">
                      Tabel Kriteria
                    </div>

                    <div class="panel-body">
                      <div class="row">
                        <div class="col-lg-12">

                          <?php
                          $sql = $koneksi->query('SELECT * FROM tab_kriteria');
                           ?>
                          <table class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>ID Kriteria</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              while ($row = $sql->fetch_array()) {
                                echo ("<tr><td align=\"center\">".$row[0]."</td>");
                                echo ("<td align=\"left\">".$row[1]."</td>");
                                echo ("<td align=\"left\">".$row[2]."</td>");
                                echo "</tr>";
                              }
                               ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <!--tabel poin-->
                <div class="col-xs-6 col-md-4">
                  <div class="panel panel-default">
                    <div class="panel-heading text-center">
                      Tabel Poin
                    </div>

                    <div class="panel-body">
                      <div class="row">
                        <div class="col-lg-12">

                          <?php
                          $sql = $koneksi->query('SELECT * FROM tab_poin');
                          ?>
                          <table class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Id Poin</th>
                                <th>Poin</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              while ($row = $sql->fetch_array()) {
                                echo ("<tr><td align=\"center\">".$row[0]."</td>");
                                echo ("<td align=\"center\">".$row[1]."</td>");
                                echo "</tr>";
                              }
                               ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
        </div>
        </div> <!--row-->
        </div> <!--container-->

        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Tabel Pemberian Nilai
                </div>

                <div class="panel-body">
                  <?php
                  //pemanggilan data, matra dan pangkat
                  $sql = $koneksi->query("SELECT * FROM tab_topsis
                  JOIN tab_alternatif ON tab_topsis.id_alternatif=tab_alternatif.id_alternatif
                  JOIN tab_kriteria ON tab_topsis.id_kriteria=tab_kriteria.id_kriteria ORDER BY tab_topsis.id_kriteria ASC") or die (mysql_error());
                   ?>
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>ALTERNATIF</th>
                        <th>KRITERIA</th>
                        <th>NILAI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=1;
                      //menampilkan data
                      while ($row = $sql->fetch_array())
                      {
                        $nmkriteria   =$row['nama_kriteria'];
                        echo ("<tr><td align=\"center\">".$no."</td>");
                        echo ("<td align=\"left\">".$row[4]."</td>");
                        echo ("<td align=\"left\">".$nmkriteria."</td>");
                        echo ("<td align=\"left\">".$row[2]."</td>");
                        echo "</tr>";
                        $no++;
                      }
                       ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div> <!--row-->
        </div> <!--container-->

        <!--tabel penentuan nilai-->
        <div class="container"> <!--container-->
          <div class="row">
            <div class="col-lg-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Tabel Kriteria Harga
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th align="center">Sub Kriteria</th>
                        <th>Nilai</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>> Rp. 15 Jt</td>
                        <td>4</td>
                      </tr>
                      <tr>
                        <td>Rp. 10 Jt >= (Harga Laptop) <= Rp. 15 Jt</td>
                        <td>3</td>
                      </tr>
                      <tr>
                        <td>Rp. 5 Jt >= (Harga Laptop) < Rp. 10 Jt</td>
                        <td>2</td>
                      </tr>
                      <tr>
                        <td>< Rp. 5 Jt</td>
                        <td>1</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Tabel Kriteria Ukuran Layar
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th align="center">Sub Kriteria</th>
                        <th>Nilai</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>> 18 inci</td>
                        <td>4</td>
                      </tr>
                      <tr>
                        <td>15 inci >= (Ukuran Laptop) <= 18 inci</td>
                        <td>3</td>
                      </tr>
                      <tr>
                        <td>10 inci >= (Ukuran Laptop) < 15 inci</td>
                        <td>2</td>
                      </tr>
                      <tr>
                        <td>< 10 inci</td>
                        <td>1</td>
                      </tr> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Tabel Kriteria Processor
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th align="center">Sub Kriteria</th>
                        <th>Nilai</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Intel</td>
                        <td>4</td>
                      </tr>
                      <tr>
                        <td>AMD</td>
                        <td>3</td>
                      </tr>
                      <tr>
                        <td>Apple</td>
                        <td>2</td>
                      </tr>
                      <tr>
                        <td>Cyrix VIA</td>
                        <td>1</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Tabel Kriteria Kapasitas Memori
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th align="center">Sub Kriteria</th>
                        <th>Nilai</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>> 1 TerraByte</td>
                        <td>4</td>
                      </tr>
                      <tr>
                        <td>800 GigaByte >= (Memory Laptop) <= 1 TerraByte</td>
                        <td>3</td>
                      </tr>
                      <tr>
                        <td>500 GigaByte >= (Memory Laptop) < 800 GigaByte</td>
                        <td>2</td>
                      </tr>
                      <tr>
                        <td>< 500 Gigabyte</td>
                        <td>1</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Tabel Kriteria Type RAM
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th align="center">Sub Kriteria</th>
                        <th>Nilai</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Kingston</td>
                        <td>4</td>
                      </tr>
                      <tr>
                        <td>Team Elite</td>
                        <td>3</td>
                      </tr>
                      <tr>
                        <td>V-Gen</td>
                        <td>2</td>
                      </tr>
                      <tr>
                        <td>Corsair Vengeance</td>
                        <td>1</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Tabel Kapasitas Hardisk
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th align="center">Sub Kriteria</th>
                        <th>Nilai</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>> 1 TerraByte</td>
                        <td>4</td>
                      </tr>
                      <tr>
                        <td>500 GigaByte >= (Kapasitas Hardisk) <= 1 TerraByte</td>
                        <td>3</td>
                      </tr>
                      <tr>
                        <td>250 GigaByte >= (Kapasitas Hardisk) < 500 GigaByte</td>
                        <td>2</td>
                      </tr>
                      <tr>
                        <td>< 250 GigaByte</td>
                        <td>1</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Tabel Kriteria Bluetooth 
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th align="center">Sub Kriteria</th>
                        <th>Nilai</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>> LMP 8.x</td>
                        <td>4</td>
                      </tr>
                      <tr>
                        <td>LMP 6.x >= (Jenis Bluetooth) <= LMP 8.x</td>
                        <td>3</td>
                      </tr>
                      <tr>
                        <td>LMP 4.x >= (Jenis Bluetooth) < LMP 6.x</td>
                        <td>2</td>
                      </tr>
                      <tr>
                        <td>< LMP 4.x</td>
                        <td>1</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Tabel Kriteria Resolusi Layar
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th align="center">Sub Kriteria</th>
                        <th>Nilai</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>HD (1280 x 720)</td>
                        <td>4</td>
                      </tr>
                      <tr>
                        <td>FHD / Full HD (1920 x 1080)</td>
                        <td>3</td>
                      </tr>
                      <tr>
                        <td>QHD / Quad HD / 2K (2560 x 1440)</td>
                        <td>2</td>
                      </tr>
                      <tr>
                        <td>UHD / Ultra HD / 4K (3840 x 2160)</td>
                        <td>1</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Tabel Kapasitas Ketebalan Laptop
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th align="center">Sub Kriteria</th>
                        <th>Nilai</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>> 1.69 CentiMeter</td>
                        <td>4</td>
                      </tr>
                      <tr>
                        <td>1.61 CentiMeter >= (Tebal Laptop) <= 1.69 CentiMeter</td>
                        <td>3</td>
                      </tr>
                      <tr>
                        <td>1.45 CentiMeter >= (Tebal Laptop) < 1.61 CentiMeter</td>
                        <td>2</td>
                      </tr>
                      <tr>
                        <td>< 1.17 CentiMeter</td>
                        <td>1</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Tabel Kriteria Jenis Keyboard
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th align="center">Sub Kriteria</th>
                        <th>Nilai</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Mekanik</td>
                        <td>3</td>
                      </tr>
                      <tr>
                        <td>Semi Mekanik</td>
                        <td>2</td>
                      </tr>
                      <tr>
                        <td>Normal</td>
                        <td>1</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div><!--container-->

        <!--footer-->
        <footer class="text-center">
          <div class="footer-below">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <em>Politeknik Negeri Malang / </em>
                  <em>Teknologi Informasi / </em>
                  <em>D4 - Teknologi Informatika / </em>
                  <em>Bashori Try Subchan Fadhory / </em>
                  <em>D4 TI 3G / 1741720096 / 06</em>
                </div>
              </div>
            </div>
          </div>
        </footer>

        <!--plugin-->
        <script src="tampilan/js/bootstrap.min.js"></script>

  </body>
</html>
