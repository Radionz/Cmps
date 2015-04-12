<div class="modal-body">
  <div class="row">
    <form class="form-horizontal" id="form" role="form" data-toggle="validator">
      <fieldset>
        <legend class="text-center">On ne s'est jamais vu je crois, quel est votre nom ?</legend>
        <div class="form-group">
          <div class="col-lg-4 col-lg-offset-4">
            <input type="text" class="form-control text-center" id="inputNom" placeholder="Entrez votre nom" required data-remote="validator.php" data-errors="errors: {data-remote: 'Ce pseudo est pris, désolé.', required: 'Veuillez entrer un nom.'}">
          </div>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <div class="col-lg-4 col-lg-offset-4 text-center">
            <button type="submit" class="btn btn-primary">Trouver mes coupains</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>
<script type="text/javascript">
$('#form').validator().on('submit', function (e) {
  if (e.isDefaultPrevented()) {
    // handle the invalid form...
  } else {
    $.post('request_login.php', {login: $('#inputNom').val}, function(data) {
      alert(data);
    }).done(function() {
      location.reload(true);
    });
  }
});
</script>