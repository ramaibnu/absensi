<div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12">
          <table id="tbmSertifikasi" class="table table-responsive table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
               <thead>
                    <tr>
                         <th style="text-align:center;width:1%;">NO.</th>
                         <th style="text-align:center;width:35%;">STATUS KONTRAK KERJA</th>
                         <th style="text-align:center;width:35%;">TANGGAL AWAL KONTRAK</th>
                         <th style="text-align:center;width:10%;">TANGGAL AKHIR KONTRAK</th>
                         <th style="text-align:center;width:9%;">PROSES</th>
                    </tr>
               </thead>
               <tbody>
                    <?php
                    if (!empty($kontrak)) {
                         $n = 1;
                         foreach ($kontrak as $list) {
                              echo "<tr>";
                              echo "<td class='align-middle' style='text-align:center;width:1%;'>" . $n++ . "</td>";
                              echo "<td class='align-middle' style='text-align:center;width:35%;'>" . $list['stat_perjanjian'] . "</td>";
                              echo "<td class='align-middle' style='text-align:center;width:10%;'>" . date("d-M-Y", strtotime($list['tgl_mulai'])) . "</td>";
                              echo "<td class='align-middle' style='text-align:center;width:10%;'>" . ($list['tgl_akhir'] == '1970-01-01' ? '-' : date("d-M-Y", strtotime($list['tgl_akhir']))) . "</td>";
                              echo "<td class='align-middle' style='text-align:center;width:9%;'>";
                              echo "<button type='button' id=" . $list['auth_kontrak_kary'] . " class='btn btn-danger btn-sm hapusKontrak'><i class='fas fa-trash'></i></button> ";
                              echo "</td>";
                              echo "<tr>";
                         }
                    } else {
                         echo  "<tr>";
                         echo "<td colspan='6' style='text-align:center;'> Tidak ada data</td>";
                         echo "</tr>";
                    }
                    ?>
               </tbody>
          </table>
     </div>
</div>