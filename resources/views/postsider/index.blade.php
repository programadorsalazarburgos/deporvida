<div ng-controller="SiderCrtl">

<style type="text/css">
  #chartdiv {
  width: 100%;
  height: 500px;
}             

#chartdivmonitores {
  width: 100%;
  height: 500px;
  font-size: 11px;
}

.amcharts-pie-slice {
  transform: scale(1);
  transform-origin: 50% 50%;
  transition-duration: 0.3s;
  transition: all .3s ease-out;
  -webkit-transition: all .3s ease-out;
  -moz-transition: all .3s ease-out;
  -o-transition: all .3s ease-out;
  cursor: pointer;
  box-shadow: 0 0 30px 0 #000;
}

.amcharts-pie-slice:hover {
  transform: scale(1.1);
  filter: url(#shadow);
}               

#chartdivusuarios {
  width: 100%;
  height: 500px;
}       
</style>
<div class="container">
  <div class="row">
    
<div id="card-stats">
      <div class="row">
        <div class="col s12 m6 l3" style=" width: 230px;  height: 92px;">
          <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text">
            <div class="padding-4">
              <div class="col s7 m7">
                <i class="material-icons background-round mt-5">perm_identity</i>
                <p>Beneficiarios</p>
            </div>
            <div class="col s5 m5 center-align">
                <h3 class="mb-0">23.499</h3>
                <p class="no-margin">Total</p>
                <p></p>
            </div>
        </div>
    </div>
</div>
<div class="col s12 m6 l3" style=" width: 230px;  height: 92px;">
  <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text">
    <div class="padding-4">
      <div class="col s7 m7">
        <i class="material-icons background-round mt-5">perm_identity</i>
        <p>Monitores</p>
    </div>
    <div class="col s5 m5 right-align">
        <h3 class="mb-0">627</h3>
        <p class="no-margin">Total</p>
    </div>
</div>
</div>
</div>
<div class="col s12 m6 l3" style=" width: 230px;  height: 92px;">
  <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text">
    <div class="padding-4">
      <div class="col s7 m7">
        <i class="material-icons background-round mt-5">perm_identity</i>
        <p>Metodólogos</p>
    </div>
    <div class="col s5 m5 right-align">
        <h3 class="mb-0">42</h3>
        <p class="no-margin">Total</p>
    </div>
</div>
</div>
</div>
<div class="col s12 m6 l3" style=" width: 230px;  height: 92px;">
  <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text">
    <div class="padding-4">
      <div class="col s7 m7">
        <i class="material-icons background-round mt-5">directions_bike</i>
        <p>Disciplinas</p>
    </div>
    <div class="col s5 m5 right-align">
        <h3 class="mb-0">26</h3>
        <p class="no-margin">Total</p>
    </div>
</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div><br>
  <div deckgrid class="deckgrid" source="programas">
    <div class="a-card">
     <a ng-href="#/descripcion/@{{card.id}}">
        <img src="" data-ng-src="@{{card.image}}">
      </a>
      <h5></h5>
    </div>
  </div>



<div class="divider"></div>
<div class="clearfix"></div><br>
</div>
</div>



<div class="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="portlet box">
                <div class="portlet-header">
                <h5><strong>BENEFICIARIOS</strong></h5>
<div id="chartdiv"></div>     
</div>
</div>
</div>
        <div class="col-lg-12">
            <div class="portlet box">
                <div class="portlet-header">
                  <h5><strong>DISCIPLINAS</strong></h5>
<div id="chartdivmonitores"></div>               
  
</div>
</div>
</div>

<div class="col-lg-12">
            <div class="portlet box">
                <div class="portlet-header">
                  <h5><strong>ALIMENTADORES</strong></h5>
<div id="chartdivusuarios"></div>               
  
</div>
</div>
</div>
</div>
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


</div>
