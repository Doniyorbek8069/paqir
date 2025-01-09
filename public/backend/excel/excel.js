var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table border="2px">{table}</table></body></html>'
        , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
    return function(table, name) {
        if (!table.nodeType)
        table = document.getElementById('myTable')
        var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
        window.location.href = uri + base64(format(template, ctx))
    }
    })()
    function excel()
    {

    var tab_text="<table>";
    var tab_text2="<table border='2px'><tr >";
    var tab_text3="<table ><tr >";
    var textRange; var j=0;
    tab = document.getElementById('idtable'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++)
    {
          if(tab.rows[j].id=='mal')
          tab_text=tab_text+tab_text3+tab.rows[j].innerHTML+"</tr>";
          else
          tab_text=tab_text+tab_text2+tab.rows[j].innerHTML+"</tr>";
    }

    tab_text=tab_text+"</table>";

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
          txtArea1.document.open("txt/html","replace");
          txtArea1.document.write(tab_text);
          txtArea1.document.close();
          txtArea1.focus();
          sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }
    else                 //other browser not tested on IE 11
    sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

    return (sa);
    }

    function excel3()
    {

    var tab_text="<table>";
    var tab_text2="<table border='2px'><tr >";
    var tab_text3="<table ><tr >";

    var textRange; var j=0;
    tab = document.getElementById('idtable'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++)
    {
          if(tab.rows[j].id=='mal')
            tab_text=tab_text+tab_text3+tab.rows[j].innerHTML+'<td>'+'</td>'+tab.rows[j].innerHTML+"</tr>";
          else
            tab_text=tab_text+tab_text2+tab.rows[j].innerHTML+'<td>'+'</td>'+tab.rows[j].innerHTML+"</tr>";
    }

    tab_text=tab_text+"</table>";

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
          txtArea1.document.open("txt/html","replace");
          txtArea1.document.write(tab_text);
          txtArea1.document.close();
          txtArea1.focus();
          sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }
    else                 //other browser not tested on IE 11
    sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));


    return (sa);
    }
    function searchtable(value1,value2) 
    {
        var input, filter, table, tr, td,td2, i, txtValue, txtValue2;
        input = document.getElementById(value1);
        filter = input.value.toUpperCase();
        table = document.getElementById(value2);
        tr = table.getElementsByTagName("tr");
        for (i = 1; i <tr.length; i++)
        {
            td = tr[i].getElementsByTagName("td")[1];
            td2 = tr[i].getElementsByTagName("td")[2];
            txtValue = td.textContent || td.innerText;
            txtValue2 = td2.textContent || td2.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1 ) 
            {
                tr[i].style.display = "";
            } 
            else if (txtValue2.toUpperCase().indexOf(filter) > -1 ) 
            {
                tr[i].style.display = "";
            }
            else
            {
                tr[i].style.display = "none";
            }
        }
    }


    function calculate()
    {
        var bloc = document.getElementsByClassName("form-control float-end");
        var dona = document.getElementsByClassName("form-control float-right");
        var karobka = document.querySelectorAll(".karobka");
        var sonlar = document.querySelectorAll(".sonlar");
        var numbers = document.querySelectorAll(".fs-6");

        for(var i=0;i<bloc.length;i++)
        {
            sonlar[i].value=Number(bloc[i].value)*Number(karobka[i].value)+Number(dona[i].value);
            numbers[i].innerHTML='Jami-'+sonlar[i].value;
        }
    }

        function category() {
        var id, table, tr, i;
        id = document.getElementById("myselect").value;
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        
        for (i = 1; i < tr.length; i++) {
            if(tr[i].id==id){
                tr[i].style.display="";
            }
            else{
                tr[i].style.display="none";
            }
            if(id==''){
                tr[i].style.display="";
            }
            
        }
    }
    function check(){
        var bloc = document.getElementsByClassName("form-control float-end");
        var dona = document.getElementsByClassName("form-control float-right");
        var karobka = document.querySelectorAll(".karobka");
        var amount = document.querySelectorAll(".amount");
        var sonlar = document.querySelectorAll(".sonlar");
        var numbers = document.querySelectorAll(".fs-6");

        for(var i=0;i<bloc.length;i++)
        {
            if(amount[i].value >= Number(bloc[i].value)*Number(karobka[i].value)+Number(dona[i].value))
            {
                sonlar[i].value=Number(bloc[i].value)*Number(karobka[i].value)+Number(dona[i].value);
                numbers[i].innerHTML='Jami-'+ sonlar[i].value;
            }
            else
            {
                bloc[i].value=0;
                dona[i].value=0;
                numbers[i].innerHTML='Jami-0';
            }
          
        }
        calculate();
    }

function bosish() 
{ 
    var y = document.getElementById("glavniy");  
    var x = document.getElementsByClassName("chek");
    if(y.checked==true)
    {
        for (let i = 0; i <  x.length; i++) 
        {
            x[i].checked =true;
        }
    }
    else
    {
        for (let i = 0; i < x.length; i++)
        {
            x[i].checked =false;
        }
    }

    calculatemoney();
}

function returncalculate()
{
    var sum =0; var valute=0;
    var sonlar = document.getElementsByClassName("form-control");
    var valutes = document.getElementsByClassName("valute");
    var price = document.getElementsByClassName("price");
    
    for (let i = 0; i <  sonlar.length; i++) 
    {
        if(valutes[i].value != 0)
        {
            valute += sonlar[i].value * price[i].value;
        }
        else
        {
            sum += sonlar[i].value * price[i].value;
        }
    }
    document.getElementById("sum").innerHTML = sum + '-Sum';
    document.getElementById("valute").innerHTML = valute + '-$';
}
    function ordercalculate(){
        var sum =0; var valutesum=0;

        var amount = document.getElementsByClassName("form-control float-end");
        var price = document.getElementsByClassName("form-control float-right");
        var valute = document.getElementsByClassName("form-control float-center");

        for(var i=0;i<amount.length;i++)
        {
            if(valute[i].value == 0)
            {
                sum = sum + amount[i].value * price[i].value;
            }
            else
            {
                valutesum = valutesum + amount[i].value * price[i].value;
            }
        }

        document.getElementById("sum").innerHTML = sum + '-Sum';
        document.getElementById("valute").innerHTML = valutesum + '-$';
    }
function requiredchange(id,value)
{
    var object = document.getElementById(id);
    object.required = false;
    
}
let product_detail_row = 0;

function deleterow(r, name, id)
{
    product_detail_row++;

    var table = document.getElementById("discount");
    var row = table.insertRow(product_detail_row);
    var cell0 = row.insertCell(0);
    var cell1 = row.insertCell(1);
    var cell2 = row.insertCell(2);
    cell0.innerHTML = product_detail_row;
    cell1.innerHTML = '<input type="hidden" value="'+id+'"  name="products['+product_detail_row+'][id]" required />'+'<b>'+ name +'</b>';
    cell2.innerHTML = '<button type="button" class="btn btn-danger" onclick="deleteRow2(this)"><i class="bi bi-trash"></i></button>';
    
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("myTable").deleteRow(i);
}

function deleteRow2(r)
{
    product_detail_row--;

    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("discount").deleteRow(i);
    
}

function daily(number)
{
    var totals = document.getElementsByClassName("total");
    var daily = document.getElementsByClassName("daily");

    for (let i = 0; i <  totals.length; i++) 
    {
        if(number !="")
            daily[i].innerHTML = Number(totals[i].value/number);
        else
            daily[i].innerHTML = 0;
    }  

}
let id = 0;

function add()
{
    html ='<div class="input-group mb-3" id="code'+id+'">';
    html +='<input type="text" class="form-control"  placeholder="Shtrix Kodi" aria-label="Recipient username" aria-describedby="basic-addon2"  name="codes['+id+'][code]"  required>';
    html +='<div class="input-group-append">';
    html +='<span class="input-group-text" id="basic-addon2"><button id="btn'+id+'" type="button" onclick="deleteinput('+id+')" title="Удалить" class="btn btn-danger float-end"><i class="bi bi-trash"></i></button></span>';
    html +='</div>';
    html +='</div>';
    console.log(id);
    $('#codes').append(html);
    id++;
}

function deleteinput(idd)
{
    document.getElementById("code" + idd).remove();
}

function calculatecode()
{
    var codes = document.getElementsByClassName("input-group mb-3");
    id =  codes.length;
    console.log(codes);
}
function calculatemoney()
{
    var sum = 0; var valutesum = 0;
    var cash = 0;
    var card = 0;
    var p2p = 0;

    var data = document.getElementsByClassName("chek");
    var sums = document.getElementsByClassName("sum");
    var valute = document.getElementsByClassName("valute");
    var type = document.getElementsByClassName("type");
    
    for (let i = 0; i <  data.length; i++) 
    {
        if(data[i].checked == true)
        {
            sum = sum + Number(sums[i].value);
            valutesum = valutesum + Number(valute[i].value);

            if(Number(type[i].value) == 1)
            {
                cash = cash + Number(sums[i].value);
            }

            if(Number(type[i].value) == 2)
            {
                card = card + Number(sums[i].value);
            }

            if(Number(type[i].value) == 3)
            {
                p2p = p2p + Number(sums[i].value);
            }
        }
    }

    document.getElementById("sum").innerHTML ='Jami ' + numberformatter(sum) + '-Sum';
    document.getElementById("cash").innerHTML ='Naqd ' + numberformatter(cash) + '-Sum';
    document.getElementById("card").innerHTML ='Plastik ' + numberformatter(card) + '-Sum';
    document.getElementById("p2p").innerHTML ='P2P ' + numberformatter(p2p) + '-Sum';

    document.getElementById("valute").innerHTML = valutesum + '-$';
}

function changefunction()
{
    var Newamount = document.getElementsByClassName("form-control float-right");
    var old = document.getElementsByClassName("old");
    var changes = document.querySelectorAll(".fs-6");

    for(var i=0;i<old.length;i++){
        if(Number(Newamount[i].value) > Number(old[i].value))
            changes[i].innerHTML='Kam-'+ (Number(Newamount[i].value) - Number(old[i].value));
        else if(Number(Newamount[i].value) < Number(old[i].value))
            changes[i].innerHTML='Ko`p-'+ (Number(old[i].value) - Number(Newamount[i].value));
        else if(Number(Newamount[i].value) == Number(old[i].value))
            changes[i].innerHTML='';
    }
}

function checksum()
{
    var data = document.getElementsByClassName("form-control");
    var sum = document.getElementById("sum").value;
    var total = 0;
    for(var i=0;i<data.length;i++)
    {
        total = total + Number(data[i].value)
    }

    if(sum == total)
    {
        document.getElementById("submit").disabled = false;
    }
    else
    {
        document.getElementById("submit").disabled = true;
    }

    document.getElementById("text").innerHTML = numberformatter(total);
}


function numberformatter(x) 
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function calculate()
{
    var dona = document.getElementsByClassName("form-control float-right");
    var narxlar = document.getElementsByClassName("form-control float-center");
    var total = 0;

    for(var i=0;i<dona.length;i++)
    {
        total = total + Number(dona[i].value) * Number(narxlar[i].value);
    }
    
    document.getElementById("text").innerHTML = 'Jami Summa: ' + numberformatter(total);
}

function disableButton()
{
    var btn = document.getElementById('btn');
    btn.disabled = true;
    btn.innerText = 'Posting...'
}

function calculateincome()
{
    var bloc = document.getElementsByClassName("form-control float-end");
    var dona = document.getElementsByClassName("form-control float-right");
    var karobka = document.querySelectorAll(".karobka");
    var sonlar = document.querySelectorAll(".sonlar");
    var numbers = document.querySelectorAll(".fs-6");
    var narxlar = document.getElementsByClassName("form-control float-center");
    var total = 0;

    for(var i=0;i<bloc.length;i++)
    {
        sonlar[i].value=Number(bloc[i].value)*Number(karobka[i].value)+Number(dona[i].value);
        total = total + (Number(bloc[i].value) * Number(karobka[i].value) + Number(dona[i].value)) * Number(narxlar[i].value);
        numbers[i].innerHTML='Jami-'+sonlar[i].value;
    }
    
    document.getElementById("text").innerHTML = 'Jami Summa: ' + numberformatter(total);
}

function seprator(input) {
    let nums = input.value.replace(/,/g, '');
    if (!nums || nums.endsWith('.')) return;
    input.value = parseFloat(nums).toLocaleString();
  }