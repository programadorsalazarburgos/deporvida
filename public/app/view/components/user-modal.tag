<user-modal>

<div id="user-modal-tag" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div if={ready} class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div if={!ready} class="text-center">
          Cargando, Espere un momento por favor ....
        </div>
      <div if={ready} class="media">
        <div class="media-left">
         <!-- <img class="media-object user-modal-pic" src="uploads/{model.foto}" alt="">-->
        </div>
      <div class="media-body">
        <dl>
          <dt>Nombre</dt>
          <dd></dd>

        </dl>
       </div>
      </div>
     </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>

<!--<style>
  .user-modal-pic{width: 220px;}
</style>
-->
  <script>

  var self = this;
  console.log( opts.id );

  getDataFromServer();

function getDataFromServer(){
  $.post('/cuentaxcobrar/obtener/' + opts.id, function(r){
     self.model = r;
     console.log(self)
     self.ready = true;
     self.update();
  }, 'json')
}


  this.on('mount', function(){
    $("#user-modal-tag").modal();

  })

  </script>

</user-modal>