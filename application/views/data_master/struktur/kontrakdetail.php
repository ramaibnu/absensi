<div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12">
          <table id="tbmKontrakDetail" class="table table-striped table-bordered table-hover text-black text-nowrap" style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
               <thead>
                    <tr>
                         <td style="width:1%;text-align:center;">NO.</td>
                         <td style="width:59%;font-style:bold;">NO. Kontrak</td>
                         <td style="width:20%;font-style:bold;">Tgl. Aktif</td>
                         <td style="width:20%;font-style:bold;">Tgl. Expired</td>
                    </tr>
               </thead>
               <tbody>
                    <?php

                    if (!empty($kontrak_per)) {
                         $n = 1;
                         foreach ($kontrak_per as $list) {
                              echo "<tr>";
                              echo "<td style='ext-align:center;width:1%;'>" . $n++ . "</td>";
                              echo "<td style='ext-align:center;width:59%;'>" . $list['no_kontrak_perusahaan'] . "</td>";
                              echo "<td style='ext-align:center;width:20%;'>" . date('d-M-Y', strtotime($list['tgl_mulai_kontrak'])) . "</td>";
                              echo "<td style='ext-align:center;width:20%;'>" . date('d-M-Y', strtotime($list['tgl_akhir_kontrak'])) . "</td>";
                              echo "<tr>";
                         }
                    } else {
                         echo  "<tr>";
                         echo "<td colspan='4' style='text-align:center;'> Tidak ada data</td>";
                         echo "</tr>";
                    }

                    ?>
               </tbody>
          </table>

          <hr>
     </div>
</div>