<html>
<head>
  <title>Cetak Laporan Report</title>
  <style>
            #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #table td, #table th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #table tr:nth-child(even){background-color: #f2f2f2;}

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                background-color: #4CAF50;
                color: white;
            }
        </style>
</head>
<body>
    <h4 style="margin-bottom: 10px;">Data Laporan Report</h4>
  <?php echo $label ?><br>
  <table class="table" border="1" width="100%" style="margin-top: 10px;">
    <tr>
        <th>Tanggal</th>
        <th>Actual</th>
        <th>Target</th>
        <th>ACV</th>
        <th>Keterangan</th>
    </tr>
    <?php
        if(empty($report)){ // Jika data tidak ada
            echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
        }else{ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
            foreach($report as $data){ // Looping hasil data transaksi
                $tgl = date('d-m-Y', strtotime($data->tanggal)); // Ubah format tanggal jadi dd-mm-yyyy
                echo "<tr>";
                echo "<td style='width: 80px;'>".$tgl."</td>";
                echo "<td style='width: 100px;'>".$data->actual."</td>";
                echo "<td style='width: 300px;'>".$data->target."</td>";
                echo "<td style='width: 60px;'>".$data->acv."</td>";
                echo "<td style='width: 100px;'>".$data->keterangan."</td>";
                echo "</tr>";
            }
        }
    ?>
  </table>
     
</body>
</html>