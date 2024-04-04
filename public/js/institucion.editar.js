  $(function()
  {
      $('form').submit(function(e)
        {
            e.preventDefault();
            $.ajax(
            {
              url:base+'/institucioneseducativas/editar_registro',
              type:'POST',
              data:$(this).serialize(),
              success:function()
              {
                  swal("Guardado!", "Finalizado.", "success");
              }
            })
        });
  })