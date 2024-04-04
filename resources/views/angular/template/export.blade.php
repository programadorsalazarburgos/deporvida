                        <div id='oculto' style='display:none;'>

                                <h4 class="mtl box-heading">Installation</h4><pre>&#x3C;script type=&#x22;text/javascript&#x22; src=&#x22;tableExport.js&#x22;&#x3E;
&#x3C;script type=&#x22;text/javascript&#x22; src=&#x22;jquery.base64.js&#x22;&#x3E;</pre>
                                <h4 class="mtl box-heading">PDF Export</h4><pre>&#x3C;script type=&#x22;text/javascript&#x22; src=&#x22;jspdf/libs/sprintf.js&#x22;&#x3E;
&#x3C;script type=&#x22;text/javascript&#x22; src=&#x22;jspdf/jspdf.js&#x22;&#x3E;
&#x3C;script type=&#x22;text/javascript&#x22; src=&#x22;jspdf/libs/base64.js&#x22;&#x3E;</pre>
                                <h4 class="mtl box-heading">Usage</h4><pre>onclick=&#x22;$('#example-export').tableExport({type:'json',escape:'false'});&#x22;
onclick=&#x22;$('#example-export').tableExport({type:'xml',escape:'false'});&#x22;
onclick=&#x22;$('#example-export').tableExport({type:'sql',escape:'false'});&#x22;
onclick=&#x22;$('#example-export').tableExport({type:'csv',escape:'false'});&#x22;
onclick=&#x22;$('#example-export').tableExport({type:'txt',escape:'false'});&#x22;
onclick=&#x22;$('#example-export').tableExport({type:'excel',escape:'false'});&#x22;
onclick=&#x22;$('#example-export').tableExport({type:'doc',escape:'false'});&#x22;
onclick=&#x22;$('#example-export').tableExport({type:'powerpoint',escape:'false'});&#x22;
onclick=&#x22;$('#example-export').tableExport({type:'pdf', pdfFontSize:'14', escape:'false'});&#x22;</pre>
                                <h4 class="mtl box-heading">Options</h4><pre>separator: ','
ignoreColumn: [2,3],
tableName:'yourTableName'
type:'csv'
pdfFontSize:14
pdfLeftMargin:20
escape:'true'
htmlContent:'false'
consoleLog:'false'</pre>

    </div>
