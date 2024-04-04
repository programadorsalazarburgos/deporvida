<div class="twinList">
  <div class="pane">
    <select
      ng-options="value for value in data"
      ng-model="dataSet"
      multiple="multiple">
    </select>
  </div>
  <div class="divider">
    <button class="btn btn-primary" ng-click="addSelected()" title="Add Selected"><i class="glyphicon glyphicon-chevron-right"></i></button><br/>
    <button class="btn btn-warning" ng-click="removeSelected()" title="Remove Selected"><i class="glyphicon glyphicon-chevron-left"></i></button><br/>
    <br/><br/>
    <!-- <button class="btn btn-default" ng-click="selectAll()" title="Add All"><i class="glyphicon glyphicon-forward"></i></button><br/>
    <button class="btn btn-default" ng-click="deselectAll()" title="Remove All"><i class="glyphicon glyphicon-backward"></i></button><br/> -->
  </div>
  <div class="pane">
    <select
      ng-options="value for value in selected"
      ng-model="selectedSet"
      multiple="multiple">
    </select>
  </div>
  <div class="clearfix"></div><br>
</div>