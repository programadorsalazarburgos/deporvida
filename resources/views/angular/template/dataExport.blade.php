    <ul class="dropdown-menu">
        <li><a href="#" onclick="$('#example-export').tableExport({type:'json',escape:'false'});">
        <img src="{{ asset('vendors/tableExport/icon/json.png') }}" width="24px" class="mrx"/>Exportar a Json</a>
        </li>
        <li><a href="#" onclick="$('#example-export').tableExport({type:'xml',escape:'false'});">
        <img src="{{ asset('vendors/tableExport/icon/xml.png') }}" width="24px" class="mrx"/>Exportar a Xml</a>
        </li>
        <li><a href="#" onclick="$('#example-export').tableExport({type:'sql'});">
        <img src="{{ asset('vendors/tableExport/icon/sql.png') }}" width="24px" class="mrx"/>Exportar a Sql</a>
        </li>
        <li class="divider">
        </li>
        <li><a href="#" onclick="$('#example-export').tableExport({type:'csv'});">
        <img src="{{ asset('vendors/tableExport/icon/csv.png') }}" width="24px" class="mrx"/>Exportar a csv</a>
        </li>
        <li><a href="#" onclick="$('#example-export').tableExport({type:'txt',escape:'false'});">
        <img src="{{ asset('vendors/tableExport/icon/txt.png') }}" width="24px" class="mrx"/>Exportar a TXT</a>
        </li>
        <li class="divider"></li>
        <li><a href="#" onclick="$('#example-export').tableExport({type:'excel',escape:'false'});">
        <img src="{{ asset('vendors/tableExport/icon/xls.png') }}" width="24px" class="mrx"/>Exportar a Excel</a>
        </li>
        <li><a href="#" onclick="$('#example-export').tableExport({type:'doc',escape:'false'});">
        <img src="{{ asset('vendors/tableExport/icon/word.png') }}" width="24px" class="mrx"/>Exportar a word </a>
        </li>
        <li><a href="#" onclick="$('#example-export').tableExport({type:'powerpoint',escape:'false'});">
        <img src="{{ asset('vendors/tableExport/icon/ppt.png') }}" width="24px" class="mrx"/>Exportar a powerpoint</a>
        </li>
        <li class="divider">
        </li>
        <li><a href="#" onclick="$('#example-export').tableExport({type:'pdf', pdfFontSize:'14', escape:'true'});">
        <img src="{{ asset('vendors/tableExport/icon/pdf.png') }}" width="24px" class="mrx"/>Exportar a Pdf</a>
        </li>
    </ul>
