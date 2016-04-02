<?php
$count = count($participants);
if($count == 0){
    $participants[] = array();
}
?>

<?php


?>

<script>
    var states = <?php echo json_encode($country_states)?>;
</script>

<div class="col-sm-12">
    <form id="form2" class="form-horizontal" data-toggle="validator" role="form">
        <input type="hidden" name="form_name" value="participants">
        <fieldset>
            <legend><i class="fa fa-group"></i> Participants</legend>
            <div class="col-xs-3"> <!-- required for floating -->

                <button id="btnAdd" class="btn btn-default">Add Participant</button>

                <!-- Nav tabs -->
                <ul id="tabs-participants" class="nav nav-tabs tabs-left">
                    <?php foreach($participants as $key=>$val): ?>
                        <?php $id=$key;$num=$key+1;?>
                        <li class="<?php if($id==0) echo "active" ?> tab-<?php echo $id ?>">
                            <a id="btnTab-<?php echo $num?>" href="#participant-<?php echo $num?>" data-toggle="tab" aria-expanded="true"><?php if(@$val['fullname']!=''){
echo $val['fullname'];
                                } else { ?>
                                    Participant <?php echo $num?>
                                <?php } ?></a>
                            <?php if($key > 0){ ?>
                            <span class="btnRemove" data-tabid="<?php echo $key?>"><i class="fa fa-remove"></i></span>
                            <?php } ?>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>

            <div class="col-xs-9">
                <!-- Tab panes -->
                <div class="tab-content">

                    <?php foreach($participants as $key=>$val): ?>
                    <?php
                    if($count == 0) $key=0;
                    ?>
                    <?php $id=$key;$num=$key+1;?>

                    <div data-tab-id="<?php echo @$key ?>" class="tab-pane <?php if($key==0) echo "active" ?> tab-pane-<?php echo $key?>" id="participant-<?php echo (int) @$num?>">
                        <div class="participant-tab-content">
                            <fieldset>

                                <!-- Form Name -->
                                <legend class="participant-tab-title">Participant <?php echo (int) @$num?></legend>

                                <p class="note">Fields with <span class="required">*</span> are required.</p>

                                <?php if($key==0): ?>
                                    <div id="ijoin-box" class="form-group">
                                        <div class="col-md-3">&nbsp;</div>
                                        <div class="col-md-7">
                                            <div class="checkbox">
                                                <label>
                                                    <input id="ijoin" type="checkbox" name="participants[<?php echo (int) @$key?>][ijoin]" value="1" <?php if(@$participants[$key]['ijoin']){ echo "checked"; }?>>I will join (Use contact information)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;?>

                                <!-- Radio buttons-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="participant_type">Registration Type *</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                        <?php foreach($participant_types as  $type):?>
                                            <div class="radio">
                                                <label><input required type="radio" name="participants[<?php echo (int) @$key?>][participant_type]" value="<?php echo $type['id'] ?>" <?php if(@$participants[$key]['participant_type'] == $type['id']){ echo "checked"; }?>><?php echo $type['name'] ?></label>
                                            </div>
                                        <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Radio buttons-->
								<!--
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="register_as">Register As *</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <div class="radio">
                                                <label><input required type="radio" name="participants[<?php echo (int) @$key?>][register_as]" value="participant" <?php if(@$participants[$key]['register_as']=='participant'){ echo "checked"; }?>>Participant</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="participants[<?php echo (int) @$key?>][register_as]" value="abstract" <?php if(@$participants[$key]['register_as']=='abstract'){ echo "checked"; }?>>Abstract</label>
                                            </div>
                                            <div class="radio ">
                                                <label><input type="radio" name="participants[<?php echo (int) @$key?>][register_as]" value="faculty" <?php if(@$participants[$key]['register_as']=='faculty'){ echo "checked"; }?>>Faculty</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								-->


                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="participants[<?php echo @$key ?>][fullname]">Full Name *</label>
                                    <div class="col-md-8">
                                        <input required id="participants[<?php echo @$key ?>][fullname]" name="participants[<?php echo (int) @$key?>][fullname]" type="text" class="form-control input-md" value="<?php echo @$participants[$key]['fullname'] ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="participants[<?php echo @$key ?>][id_number]">ID Number *</label>

                                    <div class="col-md-8">
                                        <div class="input-group">
                                        <span class="input-group-btn" style="min-width: 112px;">
                                          <select class="form-control" name="participants[<?php echo @$key ?>][id_type]" id="id">
                                              <option value="ktp" <?php echo (@$participants[$key]['id_type']=='ktp')?'selected':'' ?>>KTP</option>
                                              <option value="passport" <?php echo (@$participants[$key]['id_type']=='passport')?'selected':'' ?>>Passport</option>
                                          </select>
                                        </span>
                                        <span class="">
                                            <input required id="participants[<?php echo @$key ?>][id_number]" name="participants[<?php echo (int) @$key?>][id_number]" type="text" class="form-control input-md" value="<?php echo @$participants[$key]['id_number'] ?>">
                                        </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="participants[<?php echo @$key ?>][graduated_from]">Graduated From *</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="participants[<?php echo (int) @$key?>][graduated_from]">
                                            <option value=""> --- Select University --- </option>
                                            <option value="Universitas Andalas (UNAND), Padang" <?php echo (@$participants[$key]['graduated_from'])?'Universitas Andalas (UNAND), Padang' : '' ?>>Universitas Andalas (UNAND), Padang</option>
                                            <option value="Universitas Baiturahmah, Padang" <?php echo (@$participants[$key]['graduated_from'])?'Universitas Baiturahmah, Padang' : '' ?>>Universitas Baiturahmah, Padang</option>
                                            <option value="Universitas Diponegoro (UNDIP), Semarang" <?php echo (@$participants[$key]['graduated_from']=='Universitas Diponegoro (UNDIP), Semarang')?'selected' : '' ?>>Universitas Diponegoro (UNDIP), Semarang</option>
                                            <option value="Universitas Gadjah Mada (UGM), Yogyakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Gadjah Mada (UGM), Yogyakarta')?'selected' : '' ?>>Universitas Gadjah Mada (UGM), Yogyakarta</option>
                                            <option value="Universitas Hasanuddin (UNHAS), Makassar" <?php echo (@$participants[$key]['graduated_from']=='Universitas Hasanuddin (UNHAS), Makassar')?'selected' : '' ?>>Universitas Hasanuddin (UNHAS), Makassar</option>
                                            <option value="Universitas Indonesia (UI), Jakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Indonesia (UI), Jakarta')?'selected' : '' ?>>Universitas Indonesia (UI), Jakarta</option>
                                            <option value="Universitas Islam Indonesia (UII), Yogyakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Islam Indonesia (UII), Yogyakarta')?'selected' : '' ?>>Universitas Islam Indonesia (UII), Yogyakarta</option>
                                            <option value="Universitas Islam Sultan Agung, Semarang" <?php echo (@$participants[$key]['graduated_from']=='Universitas Islam Sultan Agung, Semarang')?'selected' : '' ?>>Universitas Islam Sultan Agung, Semarang</option>
                                            <option value="Universitas Islam Sumatera Utara (UISU), Medan" <?php echo (@$participants[$key]['graduated_from']=='Universitas Islam Sumatera Utara (UISU), Medan')?'selected' : '' ?>>Universitas Islam Sumatera Utara (UISU), Medan</option>
                                            <option value="Universitas Jenderal Achmad Yani (UNJANI), Cimahi" <?php echo (@$participants[$key]['graduated_from']=='Universitas Jenderal Achmad Yani (UNJANI), Cimahi')?'selected' : '' ?>>Universitas Jenderal Achmad Yani (UNJANI), Cimahi</option>
                                            <option value="Universitas Kristen Indonesia (UKI), Jakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Kristen Indonesia (UKI), Jakarta')?'selected' : '' ?>>Universitas Kristen Indonesia (UKI), Jakarta</option>
                                            <option value="Universitas Kristen Krida Wacana, Jakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Kristen Krida Wacana, Jakarta')?'selected' : '' ?>>Universitas Kristen Krida Wacana, Jakarta</option>
                                            <option value="Universitas Kristen Maranatha, Bandung" <?php echo (@$participants[$key]['graduated_from']=='Universitas Kristen Maranatha, Bandung')?'selected' : '' ?>>Universitas Kristen Maranatha, Bandung</option>
                                            <option value="Universitas Lambung Mangkurat (UNLAM), Banjarmasin" <?php echo (@$participants[$key]['graduated_from']=='Universitas Lambung Mangkurat (UNLAM), Banjarmasin')?'selected' : '' ?>>Universitas Lambung Mangkurat (UNLAM), Banjarmasin</option>
                                            <option value="Universitas Muhammadiyah Yogyakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Muhammadiyah Yogyakarta')?'selected' : '' ?>>Universitas Muhammadiyah Yogyakarta</option>
                                            <option value="Universitas Padjadjaran (UNPAD), Bandung" <?php echo (@$participants[$key]['graduated_from']=='Universitas Padjadjaran (UNPAD), Bandung')?'selected' : '' ?>>Universitas Padjadjaran (UNPAD), Bandung</option>
                                            <option value="Universitas Pembangunan Nasional Veteran (UPN) Jakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Pembangunan Nasional Veteran (UPN) Jakarta')?'selected' : '' ?>>Universitas Pembangunan Nasional Veteran (UPN) Jakarta</option>
                                            <option value="Universitas Riau (UNRI), Pekanbaru" <?php echo (@$participants[$key]['graduated_from']=='Universitas Riau (UNRI), Pekanbaru')?'selected' : '' ?>>Universitas Riau (UNRI), Pekanbaru</option>
                                            <option value="Universitas Sam Ratulangi, Manado" <?php echo (@$participants[$key]['graduated_from']=='Universitas Sam Ratulangi, Manado')?'selected' : '' ?>>Universitas Sam Ratulangi, Manado</option>
                                            <option value="Universitas Sebelas Maret (UNS), Surakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Sebelas Maret (UNS), Surakarta')?'selected' : '' ?>>Universitas Sebelas Maret (UNS), Surakarta</option>
                                            <option value="Universitas Sumatera Utara (USU), Medan" <?php echo (@$participants[$key]['graduated_from']=='Universitas Sumatera Utara (USU), Medan')?'selected' : '' ?>>Universitas Sumatera Utara (USU), Medan</option>
                                            <option value="Universitas Syiah Kuala, Banda Aceh" <?php echo (@$participants[$key]['graduated_from']=='Universitas Syiah Kuala, Banda Aceh')?'selected' : '' ?>>Universitas Syiah Kuala, Banda Aceh</option>
                                            <option value="Universitas Udayana (UNUD), Denpasar" <?php echo (@$participants[$key]['graduated_from']=='Universitas Udayana (UNUD), Denpasar')?'selected' : '' ?>>Universitas Udayana (UNUD), Denpasar</option>
                                            <option value="Universitas Abulyatama, Banda Aceh" <?php echo (@$participants[$key]['graduated_from']=='Universitas Abulyatama, Banda Aceh')?'selected' : '' ?>>Universitas Abulyatama, Banda Aceh</option>
                                            <option value="Universitas Airlangga, Surabaya" <?php echo (@$participants[$key]['graduated_from']=='Universitas Airlangga, Surabaya')?'selected' : '' ?>>Universitas Airlangga, Surabaya</option>
                                            <option value="Universitas Andalas (UNAND), Padang" <?php echo (@$participants[$key]['graduated_from']=='Universitas Andalas (UNAND), Padang')?'selected' : '' ?>>Universitas Andalas (UNAND), Padang</option>
                                            <option value="Universitas Brawijaya, Malang" <?php echo (@$participants[$key]['graduated_from']=='Universitas Brawijaya, Malang')?'selected' : '' ?>>Universitas Brawijaya, Malang</option>
                                            <!-- <option value="Universitas Gadjah Mada (UGM), Yogyakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Gadjah Mada (UGM), Yogyakarta')?'selected' : '' ?>>Universitas Gadjah Mada (UGM), Yogyakarta</option> -->
                                            <option value="Universitas Hang Tuah, Surabaya" <?php echo (@$participants[$key]['graduated_from']=='Universitas Hang Tuah, Surabaya')?'selected' : '' ?>>Universitas Hang Tuah, Surabaya</option>
                                            <option value="Universitas Indonesia (UI), Jakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Indonesia (UI), Jakarta')?'selected' : '' ?>>Universitas Indonesia (UI), Jakarta</option>
                                            <option value="Universitas Islam Al?Azhar (UNIZAR), Mataram" <?php echo (@$participants[$key]['graduated_from']=='Universitas Islam Al?Azhar (UNIZAR), Mataram')?'selected' : '' ?>>Universitas Islam Al?Azhar (UNIZAR), Mataram</option>
                                            <option value="Universitas Islam Bandung (UNISBA)" <?php echo (@$participants[$key]['graduated_from']=='Universitas Islam Bandung (UNISBA)')?'selected' : '' ?>>Universitas Islam Bandung (UNISBA)</option>
                                            <option value="Universitas Islam Malang" <?php echo (@$participants[$key]['graduated_from']=='Universitas Islam Malang')?'selected' : '' ?>>Universitas Islam Malang</option>
                                            <option value="Universitas Islam Negeri (UIN) Syarif Hidayatullah, Jakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Islam Negeri (UIN) Syarif Hidayatullah, Jakarta')?'selected' : '' ?>>Universitas Islam Negeri (UIN) Syarif Hidayatullah, Jakarta</option>
                                            <option value="Universitas Islam Sultan Agung, Semarang" <?php echo (@$participants[$key]['graduated_from']=='Universitas Islam Sultan Agung, Semarang')?'selected' : '' ?>>Universitas Islam Sultan Agung, Semarang</option>
                                            <option value="Universitas Jambi, Jambi" <?php echo (@$participants[$key]['graduated_from']=='Universitas Jambi, Jambi')?'selected' : '' ?>>Universitas Jambi, Jambi</option>
                                            <option value="Universitas Jember" <?php echo (@$participants[$key]['graduated_from']=='Universitas Jember')?'selected' : '' ?>>Universitas Jember</option>
                                            <option value="Universitas Jenderal Achmad Yani (UNJANI), Cimahi" <?php echo (@$participants[$key]['graduated_from']=='Universitas Jenderal Achmad Yani (UNJANI), Cimahi')?'selected' : '' ?>>Universitas Jenderal Achmad Yani (UNJANI), Cimahi</option>
                                            <option value="Universitas Jenderal Soedirman (UNSOED), Purwokerto" <?php echo (@$participants[$key]['graduated_from']=='Universitas Jenderal Soedirman (UNSOED), Purwokerto')?'selected' : '' ?>>Universitas Jenderal Soedirman (UNSOED), Purwokerto</option>
                                            <option value="Universitas Katolik Indonesia Atma Jaya, Jakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Katolik Indonesia Atma Jaya, Jakarta')?'selected' : '' ?>>Universitas Katolik Indonesia Atma Jaya, Jakarta</option>
                                            <option value="Universitas Kristen Maranatha, Bandung" <?php echo (@$participants[$key]['graduated_from']=='Universitas Kristen Maranatha, Bandung')?'selected' : '' ?>>Universitas Kristen Maranatha, Bandung</option>
                                            <option value="Universitas Kristen Maranatha, Bandung" <?php echo (@$participants[$key]['graduated_from']=='Universitas Kristen Maranatha, Bandung')?'selected' : '' ?>>Universitas Kristen Maranatha, Bandung</option>
                                            <option value="Universitas Lambung Mangkurat (UNLAM), Banjarmasin" <?php echo (@$participants[$key]['graduated_from']=='Universitas Lambung Mangkurat (UNLAM), Banjarmasin')?'selected' : '' ?>>Universitas Lambung Mangkurat (UNLAM), Banjarmasin</option>
                                            <option value="Universitas Lampung (UNILA), Bandar Lampung" <?php echo (@$participants[$key]['graduated_from']=='Universitas Lampung (UNILA), Bandar Lampung')?'selected' : '' ?>>Universitas Lampung (UNILA), Bandar Lampung</option>
                                            <option value="Universitas Malahayati, Bandar Lampung" <?php echo (@$participants[$key]['graduated_from']=='Universitas Malahayati, Bandar Lampung')?'selected' : '' ?>>Universitas Malahayati, Bandar Lampung</option>
                                            <option value="Universitas Mataram (UNRAM), Mataram" <?php echo (@$participants[$key]['graduated_from']=='Universitas Mataram (UNRAM), Mataram')?'selected' : '' ?>>Universitas Mataram (UNRAM), Mataram</option>
                                            <option value="Universitas Methodist Indonesia, Medan" <?php echo (@$participants[$key]['graduated_from']=='Universitas Methodist Indonesia, Medan')?'selected' : '' ?>>Universitas Methodist Indonesia, Medan</option>
                                            <option value="Universitas Muhammadiyah Jakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Muhammadiyah Jakarta')?'selected' : '' ?>>Universitas Muhammadiyah Jakarta</option>
                                            <option value="Universitas Muhammadiyah Malang" <?php echo (@$participants[$key]['graduated_from']=='Universitas Muhammadiyah Malang')?'selected' : '' ?>>Universitas Muhammadiyah Malang</option>
                                            <option value="Universitas Muhammadiyah Surakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Muhammadiyah Surakarta')?'selected' : '' ?>>Universitas Muhammadiyah Surakarta</option>
                                            <option value="Universitas Muhammadiyah Yogyakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Muhammadiyah Yogyakarta')?'selected' : '' ?>>Universitas Muhammadiyah Yogyakarta</option>
                                            <option value="Universitas Mulawarman (UNMUL), Samarinda" <?php echo (@$participants[$key]['graduated_from']=='Universitas Mulawarman (UNMUL), Samarinda')?'selected' : '' ?>>Universitas Mulawarman (UNMUL), Samarinda</option>
                                            <option value="Universitas Muslim Indonesia, Makassar" <?php echo (@$participants[$key]['graduated_from']=='Universitas Muslim Indonesia, Makassar')?'selected' : '' ?>>Universitas Muslim Indonesia, Makassar</option>
                                            <option value="Universitas Pelita Harapan (UPH), Jakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Pelita Harapan (UPH), Jakarta')?'selected' : '' ?>>Universitas Pelita Harapan (UPH), Jakarta</option>
                                            <option value="Universitas Pembangunan Nasional Veteran (UPN) Jakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Pembangunan Nasional Veteran (UPN) Jakarta')?'selected' : '' ?>>Universitas Pembangunan Nasional Veteran (UPN) Jakarta</option>
                                            <option value="Universitas Prima Indonesia, Medan" <?php echo (@$participants[$key]['graduated_from']=='Universitas Prima Indonesia, Medan')?'selected' : '' ?>>Universitas Prima Indonesia, Medan</option>
                                            <option value="Universitas Riau (UNRI), Pekanbaru" <?php echo (@$participants[$key]['graduated_from']=='Universitas Riau (UNRI), Pekanbaru')?'selected' : '' ?>>Universitas Riau (UNRI), Pekanbaru</option>
                                            <option value="Universitas Sam Ratulangi, Manado" <?php echo (@$participants[$key]['graduated_from']=='Universitas Sam Ratulangi, Manado')?'selected' : '' ?>>Universitas Sam Ratulangi, Manado</option>
                                            <option value="Universitas Sebelas Maret (UNS), Surakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Sebelas Maret (UNS), Surakarta')?'selected' : '' ?>>Universitas Sebelas Maret (UNS), Surakarta</option>
                                            <option value="Universitas Sriwijaya (UNSRI), Palembang" <?php echo (@$participants[$key]['graduated_from']=='Universitas Sriwijaya (UNSRI), Palembang')?'selected' : '' ?>>Universitas Sriwijaya (UNSRI), Palembang</option>
                                            <option value="Universitas Syiah Kuala, Banda Aceh" <?php echo (@$participants[$key]['graduated_from']=='Universitas Syiah Kuala, Banda Aceh')?'selected' : '' ?>>Universitas Syiah Kuala, Banda Aceh</option>
                                            <option value="Universitas Tadulako, Palu" <?php echo (@$participants[$key]['graduated_from']=='Universitas Tadulako, Palu')?'selected' : '' ?>>Universitas Tadulako, Palu</option>
                                            <option value="Universitas Tarumanegara (UNTAR), Jakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Tarumanegara (UNTAR), Jakarta')?'selected' : '' ?>>Universitas Tarumanegara (UNTAR), Jakarta</option>
                                            <option value="Universitas Trisakti, Jakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Trisakti, Jakarta')?'selected' : '' ?>>Universitas Trisakti, Jakarta</option>
                                            <option value="Universitas Udayana (UNUD), Denpasar" <?php echo (@$participants[$key]['graduated_from']=='Universitas Udayana (UNUD), Denpasar')?'selected' : '' ?>>Universitas Udayana (UNUD), Denpasar</option>
                                            <option value="Universitas Wijaya Kusuma Surabaya" <?php echo (@$participants[$key]['graduated_from']=='Universitas Wijaya Kusuma Surabaya')?'selected' : '' ?>>Universitas Wijaya Kusuma Surabaya</option>
                                            <option value="Universitas Yarsi, Jakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Yarsi, Jakarta')?'selected' : '' ?>>Universitas Yarsi, Jakarta</option>
                                            <option value="Universitas Airlangga, Surabaya Ilmu" <?php echo (@$participants[$key]['graduated_from']=='Universitas Airlangga, Surabaya Ilmu')?'selected' : '' ?>>Universitas Airlangga, Surabaya Ilmu</option>
                                            <option value="Universitas Airlangga, Surabaya" <?php echo (@$participants[$key]['graduated_from']=='Universitas Airlangga, Surabaya')?'selected' : '' ?>>Universitas Airlangga, Surabaya</option>
                                            <!-- <option value="Universitas Gadjah Mada (UGM), Yogyakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Gadjah Mada (UGM), Yogyakarta')?'selected' : '' ?>>Universitas Gadjah Mada (UGM), Yogyakarta</option>
                                            <option value="Universitas Gadjah Mada (UGM), Yogyakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Gadjah Mada (UGM), Yogyakarta')?'selected' : '' ?>>Universitas Gadjah Mada (UGM), Yogyakarta</option>
                                            <option value="Universitas Gadjah Mada (UGM), Yogyakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Gadjah Mada (UGM), Yogyakarta')?'selected' : '' ?>>Universitas Gadjah Mada (UGM), Yogyakarta</option>
                                            <option value="Universitas Gadjah Mada (UGM), Yogyakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Gadjah Mada (UGM), Yogyakarta')?'selected' : '' ?>>Universitas Gadjah Mada (UGM), Yogyakarta</option>
                                            <option value="Universitas Gadjah Mada (UGM), Yogyakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Gadjah Mada (UGM), Yogyakarta')?'selected' : '' ?>>Universitas Gadjah Mada (UGM), Yogyakarta</option>
                                            <option value="Universitas Gadjah Mada (UGM), Yogyakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Gadjah Mada (UGM), Yogyakarta')?'selected' : '' ?>>Universitas Gadjah Mada (UGM), Yogyakarta</option> -->
                                            <option value="Universitas Indonesia (UI), Jakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Indonesia (UI), Jakarta')?'selected' : '' ?>>Universitas Indonesia (UI), Jakarta</option>
                                            <option value="Universitas Padjadjaran (UNPAD), Bandung Ilmu" <?php echo (@$participants[$key]['graduated_from']=='Universitas Padjadjaran (UNPAD), Bandung Ilmu')?'selected' : '' ?>>Universitas Padjadjaran (UNPAD), Bandung Ilmu</option>
                                            <option value="Universitas Sebelas Maret (UNS), Surakarta" <?php echo (@$participants[$key]['graduated_from']=='Universitas Sebelas Maret (UNS), Surakarta')?'selected' : '' ?>>Universitas Sebelas Maret (UNS), Surakarta</option>
                                            <option value="Universitas Udayana (UNUD), Denpasar" <?php echo (@$participants[$key]['graduated_from']=='Universitas Udayana (UNUD), Denpasar')?'selected' : '' ?>>Universitas Udayana (UNUD), Denpasar</option>
                                            <option value="Universitas Airlangga, Surabaya Ilmu" <?php echo (@$participants[$key]['graduated_from']=='Universitas Airlangga, Surabaya Ilmu')?'selected' : '' ?>>Universitas Airlangga, Surabaya Ilmu</option>
                                            <option value="Universitas Brawijaya, Malang" <?php echo (@$participants[$key]['graduated_from']=='Universitas Brawijaya, Malang')?'selected' : '' ?>>Universitas Brawijaya, Malang</option>
                                            <option value="Universitas Diponegoro (UNDIP), Semarang Ilmu" <?php echo (@$participants[$key]['graduated_from']=='Universitas Diponegoro (UNDIP), Semarang Ilmu')?'selected' : '' ?>>Universitas Diponegoro (UNDIP), Semarang Ilmu</option>
                                            <!-- <option value="Universitas Gadjah Mada (UGM), Yogyakarta Ilmu" <?php echo (@$participants[$key]['graduated_from']=='Universitas Gadjah Mada (UGM), Yogyakarta Ilmu')?'selected' : '' ?>>Universitas Gadjah Mada (UGM), Yogyakarta Ilmu</option> -->
                                            <option value="Universitas Indonesia (UI), Jakarta Ilmu" <?php echo (@$participants[$key]['graduated_from']=='Universitas Indonesia (UI), Jakarta Ilmu')?'selected' : '' ?>>Universitas Indonesia (UI), Jakarta Ilmu</option>
                                            <option value="Universitas Padjadjaran (UNPAD), Bandung Ilmu" <?php echo (@$participants[$key]['graduated_from']=='Universitas Padjadjaran (UNPAD), Bandung Ilmu')?'selected' : '' ?>>Universitas Padjadjaran (UNPAD), Bandung Ilmu</option>
                                            <option value="Universitas Sumatera Utara (USU), Medan Ilmu" <?php echo (@$participants[$key]['graduated_from']=='Universitas Sumatera Utara (USU), Medan Ilmu')?'selected' : '' ?>>Universitas Sumatera Utara (USU), Medan Ilmu</option>
                                            <option value="Universitas Udayana (UNUD), Denpasar" <?php echo (@$participants[$key]['graduated_from']=='Universitas Udayana (UNUD), Denpasar')?'selected' : '' ?>>Universitas Udayana (UNUD), Denpasar</option>
                                            <option value="Lainnya" <?php echo (@$participants[$key]['graduated_from']=='Lainnya')?'selected' : '' ?>>Others</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="participants[<?php echo @$key ?>][email]">Email *</label>
                                    <div class="col-md-8">
                                        <input required id="participants[<?php echo @$key ?>][email]" name="participants[<?php echo (int) @$key?>][email]" value="<?php echo @$participants[$key]['email'] ?>" type="email" class="form-control input-md" data-error="Bruh, that email address is invalid">
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="participants[<?php echo @$key ?>][title]">Title</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">Prefix</span>
                                            <input id="participants[<?php echo @$key ?>][title]" type="text" class="form-control" name="participants[<?php echo (int) @$key?>][title_prefix]" value="<?php echo @$participants[$key]['title_prefix'] ?>">
                                            <span class="input-group-addon">Sufix</span>
                                            <input type="text" class="form-control" name="participants[<?php echo (int) @$key?>][title_sufix]" value="<?php echo @$participants[$key]['title_sufix'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="participants[<?php echo @$key ?>][certificate_name]">Name On Certificate</label>
                                    <div class="col-md-8">
                                        <input id="participants[<?php echo @$key ?>][certificate_name]" name="participants[<?php echo (int) @$key?>][certificate_name]" value="<?php echo @$participants[$key]['certificate_name'] ?>" type="text" class="form-control input-md" readonly>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="participants[<?php echo @$key ?>][country]">Country *</label>
                                    <div class="col-md-8">
                                        <select required class="form-control" id="participants[<?php echo @$key ?>][country]" name="participants[<?php echo (int) @$key?>][country]">
                                            <option></option>
                                            <?php foreach($countries as $country): ?>
                                                <option value="<?php echo $country['alpha2_code']?>" <?php if($country['alpha2_code'] == @$participants[$key]['country']) echo 'selected' ?>><?php echo $country['name']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="participants[<?php echo @$key ?>][state]">State / Province *</label>
                                    <div class="col-md-8">
                                        <?php
                                        // jika count > 0 maka ciptakan select
                                        if( count( @$country_states[$participants[$key]['country']] ) > 0 ): ?>
<select required id="participants[<?php echo @$key ?>][state]" name="participants[<?php echo (int) @$key?>][state]" class="form-control">
<option val=""></option>
    <?php foreach( $country_states[$participants[$key]['country']] as $state):?>
        <option val="<?php echo $state ?>" <?php echo ($state == @$participants[$key]['state'] )? 'selected':''; ?>><?php echo $state ?></option>
    <?php endforeach; ?>
</select>
                                        <?php else:?>
                                        <input id="participants[<?php echo @$key ?>][state]" name="participants[<?php echo (int) @$key?>][state]" value="<?php echo @$participants[$key]['state'] ?>" type="text" class="form-control input-md" placeholder=""">
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="participants[<?php echo @$key ?>][city]">City *</label>
                                    <div class="col-md-8">
                                        <input required id="participants[<?php echo @$key ?>][city]" name="participants[<?php echo (int) @$key?>][city]" value="<?php echo @$participants[$key]['city'] ?>" type="text" class="form-control input-md">
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="participants[<?php echo @$key ?>][address]">Address</label>
                                    <div class="col-md-8">
                                        <input id="participants[<?php echo @$key ?>][address]" name="participants[<?php echo (int) @$key?>][address]" value="<?php echo @$participants[$key]['address']?>" type="text" class="form-control input-md">
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="participants[<?php echo @$key ?>][phone]">Phone</label>
                                    <div class="col-md-5">
                                        <input id="participants[<?php echo @$key ?>][phone]" name="participants[<?php echo (int) @$key?>][phone]" value="<?php echo @$participants[$key]['phone']?>" type="text" class="form-control input-md">
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="participants[<?php echo @$key ?>][fax]">Fax</label>
                                    <div class="col-md-5">
                                        <input id="participants[<?php echo @$key ?>][fax]" name="participants[<?php echo (int) @$key?>][fax]" value="<?php echo @$participants[$key]['fax']?>" type="text" class="form-control input-md">
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="participants[<?php echo @$key ?>][mobile]">Mobile *</label>
                                    <div class="col-md-5">
                                        <input required id="participants[<?php echo @$key ?>][mobile]" name="participants[<?php echo (int) @$key?>][mobile]" value="<?php echo @$participants[$key]['mobile']?>" type="text" class="form-control input-md">
                                    </div>
                                </div>

                            </fieldset>
                            
                        </div>
                        <!-- / participant tab content -->

                    </div>

                    <?php endforeach; ?>

                </div>
            </div>

            <div class="clearfix"></div>
        </fieldset>

    </form>
</div>


<script>
    $(document).ready(function(){

        function removeTab(id)
        {
            $('li.tab-' + id).remove();
            $('div.tab-pane-' + id).remove();
			var prevId = 0;
			if(id > 0 ) {
				prevId = id-1;
			} 
			
			$('#tabs-participants li.tab-'+prevId+' a').tab('show');
        }

        $('#btnAdd').click(function(e){
            e.preventDefault();

            var nextTab = $('#tabs-participants li').size()+1;
            var nextId = $('#tabs-participants li').size();
            // create the tab
            $('<li class="tab-'+nextId+'"><a id="btnTab-'+nextTab+'" href="#participant-'+nextTab+'" data-toggle="tab">Participant '+nextTab+'</a><span class="btnRemove" data-tabid="'+nextId+'"><i class="fa fa-remove"></i></span></li>').appendTo('#tabs-participants');
            $("#wizard").smartWizard('fixHeight');

            // create the tab content
            $('<div data-tab-id="'+nextId+'" class="tab-pane tab-pane-'+nextId+'" id="participant-'+nextTab+'"></div>').appendTo('.tab-content');
            var newElem = $('.participant-tab-content').first().clone();

            newElem.find('legend.participant-tab-title').html('Participant ' + nextTab);//ganti title
            newElem.find('#ijoin-box').remove();
            newElem.find('input').each(function(){//ganti input names
                //rename Ids
                if( $(this).attr("id") ) $(this).attr("id", $(this).attr("id").replace($(this).attr("id").match(/\[[0-9]+\]/), "["+nextId+"]"));
                //rename names
                $(this).attr("name", $(this).attr("name").replace($(this).attr("name").match(/\[[0-9]+\]/), "["+nextId+"]"));
                $(this).prop('checked', false);
            });
            newElem.find('input[type=text]').each(function() {//ganti input names
                $(this).val('');
            });
            newElem.find('input[type=email]').each(function() {//ganti input names
                $(this).val('');
            });
            newElem.find('select').each(function() {//ganti select names
                if( $(this).attr("id") ) $(this).attr("id", $(this).attr("id").replace($(this).attr("id").match(/\[[0-9]+\]/), "["+nextId+"]"));
                $(this).attr("name", $(this).attr("name").replace($(this).attr("name").match(/\[[0-9]+\]/), "["+nextId+"]"));
                $(this).val('');
            });
            newElem.find('div[id$="][hiddenCompanyForm]"]').each(function(){
                if( $(this).attr("id") ) $(this).attr("id", $(this).attr("id").replace($(this).attr("id").match(/\[[0-9]+\]/), "["+nextId+"]"));
            });

            newElem.appendTo('#participant-'+nextTab);

            // make the new tab active
            $('#tabs-participants a:last').tab('show');


            // run jquery validation on new inputs
            $("input[name$='][participant_type]']").each(function() {
                $(this).rules('add', {
                    required: true,
                    messages: {
                        required: "Please select registration type"
                    }
                });
            });

        });

        var ijoin;
        $(document).off('change', '#ijoin');
        $(document).on('change', '#ijoin', function(){
            window.ijoin = $(this);
            if(this.checked) {
                $.ajax({
                    url: "/eventreg/register/getSessionContact?event_id=" + event_id,
                    context: document.body,
                    dataType: 'json'
                }).done(function( data ) {
                    var tabId = window.ijoin.closest('.tab-pane').data('tab-id');
                    if(data.fullname) $('input[name="participants['+tabId+'][fullname]"]').val(data.fullname);
                    if(data.email) $('input[name="participants['+tabId+'][email]"]').val(data.email);
                    if(data.mobile) $('input[name="participants['+tabId+'][mobile]"]').val(data.mobile);
                    if(data.phone) $('input[name="participants['+tabId+'][phone]"]').val(data.phone);
                    if(data.fax) $('input[name="participants['+tabId+'][fax]"]').val(data.fax);
                    $('input[name="participants['+tabId+'][fullname]"]').trigger('change');
                });
            } else {

            }
        });
        $('#ijoin').trigger('change');

		// deletes participant
        $(document).off('click', '.btnRemove');
        $(document).on('click', '.btnRemove', function(e){
            e.stopPropagation();
            e.preventDefault();
            var tabId = $(this).data('tabid');
            var name = $(this).prev().html();
            if(confirm('Are you sure you want to remove '+name+'?')) {
                removeTab(tabId);
            }
        });


        // fix height
		/* gak perlu karena sudah otomatis
        $(document).on( 'click', 'a[data-toggle="tab"]', function (e) {
            $("#wizard").smartWizard('fixHeight');
        });
		*/


        // show/hide company form
		$(document).off('keyup change','#company_name');
        $(document).on('keyup change','#company_name', function(){
            if($(this).val() != ''){
                $('#hiddenCompanyForm').show(0,null,function(){
                    $("#wizard").smartWizard('fixHeight');
                });
            } else {
                $('#hiddenCompanyForm').hide(0,null,function(){
                    $("#wizard").smartWizard('fixHeight');
                });
            }
        });

        // ketik di full name, tab dan certname berubah
		$(document).off('keyup change', 'input[name$="][fullname]"]');
        $(document).on('keyup change', 'input[name$="][fullname]"]', function(){
            var id=$(this).attr('name').match(/\[([0-9]+)\]/)[1];
            var num = parseInt(id) +1;
            console.log('#btnTab-' + num);
            $('#btnTab-' + num).html($(this).val());
            var prefix = $('input[name="participants['+id+'][title_prefix]"]').val();
            var sufix = $('input[name="participants['+id+'][title_sufix]"]').val();
            var fullname = $(this).val();
            var certname = prefix + ' ' + fullname +' '+ sufix;
            $('input[name="participants['+id+'][certificate_name]"]').val(certname);
        });

		var tmp_fullname = $('input[name="participants[0][fullname]"]').val();

		$(document).off('keyup', 'input[name$="][fullname]"]');
        $(document).on('keyup', 'input[name$="][fullname]"]', function(){
			console.log('full name changed');
			if(tmp_fullname != $(this).val()){
				$('#ijoin').attr('checked', false);
			}
        });

        // change di prefix
		$(document).off('keyup change', 'input[name$="][title_prefix]"]');
        $(document).on('keyup change', 'input[name$="][title_prefix]"]', function(){
            var id=$(this).attr('name').match(/\[([0-9]+)\]/)[1];
            var num = parseInt(id) +1;
            // current cert name
            var prefix = $(this).val();
            var sufix = $('input[name="participants['+id+'][title_sufix]"]').val();
            var fullname = $('input[name="participants['+id+'][fullname]"]').val();
            var certname = prefix + ' ' + fullname +' '+ sufix;
            $('input[name="participants['+id+'][certificate_name]"]').val(certname);
        });

        // change di sufix
		$(document).off('keyup change', 'input[name$="][title_sufix]"]');
        $(document).on('keyup change', 'input[name$="][title_sufix]"]', function(){
            var id=$(this).attr('name').match(/\[([0-9]+)\]/)[1];
            var num = parseInt(id) +1;
            // current cert name
            var prefix = $('input[name="participants['+id+'][title_prefix]"]').val();
            var sufix = $(this).val();
            var fullname = $('input[name="participants['+id+'][fullname]"]').val();
            var certname = prefix + ' ' + fullname +' '+ sufix;
            $('input[name="participants['+id+'][certificate_name]"]').val(certname);
        });
		$(document).off('change keyup','select[name$="][country]"]');
        $(document).on('change keyup','select[name$="][country]"]',function(){
            var id=$(this).attr('name').match(/\[([0-9]+)\]/)[1];
            var num = parseInt(id) +1;
            var countryId = $(this).val();
            if(typeof states[countryId] !== 'undefined' && states[countryId].length){
                // ganti input dengan select
                $('[name^="participants['+id+']"]').filter('[name$="[state]"]').replaceWith('<select class="form-control" name="participants['+id+'][state]"></select>');
                var opt ='<option value=""> - Please select state - </option>';
                states[countryId].forEach(function(entry) {
                    //populate states into select options
                    if(entry) opt += '<option value="'+entry+'">'+entry+'</option>';
                });
                $('select[name^="participants['+id+']"]').filter('select[name$="[state]"]').html(opt);
            } else {
                // kembalikan input
                $('[name^="participants['+id+']"]').filter('[name$="[state]"]').replaceWith('<input class="form-control input-md" type="text" name="participants['+id+'][state]" />');

            }
        });

        $(document).off('change','select[name$="][state]"]');
        $(document).on('change','select[name$="][state]"]',function(){
            var id=$(this).attr('name').match(/\[([0-9]+)\]/)[1];

            var num = parseInt(id) +1;
            var state = $(this).val();
            var countryId = $('select[name="participants['+id+'][country]"]').val();
            $('input[name^="participants['+id+']"]').filter('input[name$="[city]"]').attr('placeholder', 'Loading...');
            $.ajax({
                url: "/country/getCities?countryId=" + countryId + '&state=' + state,
                context: document.body,
                dataType: 'json'
            }).done(function(data) {
                if(data.cities.length > 0){
                    // ganti input dengan select
                    $('[name^="participants['+id+']"]').filter('[name$="[city]"]').replaceWith('<select class="form-control" name="participants['+id+'][city]"></select>');
                    var opt ='<option> - Please select city -</option>';
                    data.cities.forEach(function(entry) {
                        //populate states into select options
                        if(entry) opt += '<option value="'+entry.city+'">'+entry.city+'</option>';
                    });
                    $('select[name^="participants['+id+']"]').filter('select[name$="[city]"]').html(opt);
                } else {
                    //kembalikan ke input
                    $('[name^="participants['+id+']"]').filter('[name$="[city]"]').replaceWith('<input class="form-control input-md" type="text" name="participants['+id+'][city]" />');
                }
            });
        });


        // show company form
		$(document).off('change keyup', 'input[id$="][company_name]"]');
        $(document).on('change keyup', 'input[id$="][company_name]"]', function(){
            var id=$(this).attr('name').match(/\[([0-9]+)\]/)[1];
            if($(this).val() != ''){
                $('div[id$="['+id+'][hiddenCompanyForm]"]').show(0,null,function(){
                    $("#wizard").smartWizard('fixHeight');
                });
            } else {
                $('div[id$="['+id+'][hiddenCompanyForm]"]').hide(0,null,function(){
                    $("#wizard").smartWizard('fixHeight');
                });
            }
        });
    });

</script>

<script>
    // jquery validate
$(document).ready(function(){
    $('form#form2').validate({
        ignore: "", // validates hidden inputs
        // diperlukan bootstrap
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            //console.log(error);
            //console.log(element);
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else if(element.closest('.input-group').length) {
                error.appendTo(element.closest('.input-group'));
            } else {
                error.insertAfter(element);
            }
        }

    });
/*
    // the following method must come AFTER .validate()
    $("input[name$='][participant_type]']").each(function() {
        $(this).rules('add', {
            required: true
        });
    });
*/

});
</script>