<div class="modal-body">
  <div class="row text-center">
    <div class="compassContainer">
      <img class="block_img" src="images/compass-logo.png" id="compassContainer"/>
    </div>
  </div>
  <div class="row text-center">
    <div class="col-lg-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Users</h3>
        </div>
        <div class="panel-body" id="users">
          <?php
          $sql = 'SELECT * FROM "User"';
          $stm = $db->prepare($sql);
          $stm->execute();
          $users = $stm->fetchAll();
          foreach ($users as $row) {
            if ($row["connected"]) {
              $class = "btn-success";
            }
            else{
              $class = "btn-primary";
            }
            echo "<a class='btn ".$class." btn-xs space-around' onclick='findThisBuddy(".$row["id"].")'>".$row["name"]."</a>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="row text-center">
    <div class="bs-component">
      <div class="col-lg-6 col-xs-6">
        <div class="panel panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Ori</h3>
          </div>
          <div class="panel-body" id="orientation"></div>
          <div class="panel-body" id="orientation2"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-xs-6">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Lat/Lon</h3>
        </div>
        <div class="panel-body" id="latlng"></div>
        <div class="panel-body" id="latlng2"></div>
      </div>
    </div>
  </div>
</div>
<script src="./js/script.js"></script>