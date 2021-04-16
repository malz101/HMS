<div id="assign-popup" class="hero-section formPopup hero-card">
    <button id='close-btn' class="btn-filled grey w-button btn-cancel">Close</button>
    <div class="">
      <h2>Assign Issue to Maintenace Personnel</h2>
      <h3>Available Maintenace Personnel</h3>
      <?php foreach($data['mtnpersonnels'] as $mtn):?>
        <div id="mtn-info-panel" class="hero-card">
            <h5><?php echo ($mtn->getFirstName()." ".$mtn->getLastName())?></h5>
            <ul class="mtn-info-list">
                <li><p>ID: <?php echo $mtn->getID() ?></p></li>
                <li><p>Tele: <?php echo $mtn->getTele()?></p></li>
                <li><p>Email: <?php echo $mtn->getEmail()?></p></li>
                <li><p>Affiliation <?php echo $mtn->getAffliation()?></p></li>
                <li><p>Skills Description: <?php echo $mtn->getSkillsDesc()?></p></li>
            </ul>
            <button id="<?php echo $mtn->getID()?>" class="btn-filled blue w-button assign-btn">Assign</button>
        </div>
      <?php endforeach ?>

      </div>
    </div>
</div>

