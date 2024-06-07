<table class="table table-striped table-bordered table-hover text-black text-nowrap"
    style="width:100%;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
    <thead>
        <tr>
            <th style="text-align:center;">No.</th>
            <th style="text-align:center;">Nama Lengkap</th>
            <th style="text-align:center;">Hubungan</th>
            <th style="text-align:center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if (!empty($keluarga)) { 
            $allEmpty = true;
            if (!empty($keluarga['nama_pasangan'])) {
        ?>
        <tr>
            <td style="text-align:center;">1</td>
            <td style="text-align:center;">
                <?= $keluarga['nama_pasangan'] ?></td>
            <td style="text-align:center;">
                <?= $keluarga['jk_pasangan'] == 'L' ? 'Suami' : 'Istri' ?></td>
            <td style="text-align:center;">
                <button type="button" id="<?= $keluarga['id_personal'] . ',' . 0 ?>" class="tooltips detailKeluarga btn btn-success btn-sm" title="Detail"><i
                        class="fas fa-info-circle"></i></button>
                <button type="button" id="<?= $keluarga['id_personal'] . ',' . 0 ?>" class="tooltips editKeluarga btn btn-warning btn-sm" title="Edit"><i
                        class="fas fa-edit"></i></button>
                <button type="button" id="<?= $keluarga['id_personal'] . ',' . 0 ?>" value="<?= $keluarga['nama_pasangan'] ?>" class="tooltips hapusKeluarga btn btn-danger btn-sm" title="Hapus"><i
                        class="fas fa-trash"></i></button>
            </td>
        </tr>
        <?php }
        for  ($i = 1; $i <= 10; $i++) {
            if (!empty($keluarga['nama_anak_'.$i])) {
                $allEmpty = false;
                break;
            }
        }
        if ($allEmpty && empty($keluarga['nama_pasangan'])) {
        ?>
        <tr>
            <td colspan="4" style="text-align:center;">Data Tidak
                Ditemukan</td>
        </tr>
        <?php
        } elseif (!$allEmpty) {
            if (empty($keluarga['nama_pasangan'])) {
                $no = 0;
            } else {
                $no = 1;
            }
            for  ($i = 1; $i <= 10; $i++) {
                if ($keluarga['nama_anak_'.$i] != null) {
                    $no++;        
        ?>
        <tr>
            <td style="text-align:center;"><?= $no ?></td>
            <td style="text-align:center;">
                <?= $keluarga['nama_anak_'.$i] ?></td>
            <td style="text-align:center;">Anak ke <?= $i ?></td>
            <td style="text-align:center;">
                <button type="button" id="<?= $keluarga['id_personal'] . ',' . $i ?>" class="tooltips detailKeluarga btn btn-success btn-sm" title="Detail"><i
                        class="fas fa-info-circle"></i></button>
                <button type="button" id="<?= $keluarga['id_personal'] . ',' . $i ?>" class="tooltips editKeluarga btn btn-warning btn-sm" title="Edit"><i
                        class="fas fa-edit"></i></button>
                <button type="button" id="<?= $keluarga['id_personal'] . ',' . $i ?>" value="<?= $keluarga['nama_anak_'.$i] ?>" class="tooltips hapusKeluarga btn btn-danger btn-sm" title="Hapus"><i
                        class="fas fa-trash"></i></button>
            </td>
        </tr>
        <?php }
            }
        }
        } else { ?>
        <tr>
            <td colspan="4" style="text-align:center;">Data Tidak
                Ditemukan</td>
        </tr>
        <?php } ?>
    </tbody>

</table>