!function(){"use strict";var t={strTableRowSelector:".table tbody tr",strConfirmSelector:'[data-toggle="confirmation"]',numTaskID:null,objDataTableRow:{},objDataTable:{},getTable:function(){return SCOPE.getDocument().find(".table")},getAddModal:function(){return SCOPE.getDocument().find(".task-item")},getAddBtn:function(){return SCOPE.getDocument().find(".setup-content .add-new-task")},getSaveBtn:function(){return this.getAddModal().find(".btn-success")},getCompactBtn:function(){return SCOPE.getDocument().find(".set-compact")},getLogOut:function(){return SCOPE.getDocument().find(".logout")},signOut:function(){AJAX_SignOut("",function(t){JSON.parse(t)?location.reload():self.errorLogin("error logout")})},saveTask:function(){var e=t,a=$.trim(e.getAddModal().find('form input[name="title"]').val()),o=$.trim(e.getAddModal().find('form textarea[name="description"]').val()),n=$.trim(e.getAddModal().find('form input[name="success"]:checked').val());a.length?o.length?$.isNumeric(n)?e.numTaskID?AJAX_ModifyTask(JSON.stringify({id:e.numTaskID,title:a,desc:o,success:n}),function(s){if(s){var r=JSON.parse(s);if(r.isError)SCOPE.addNotify("Error",r.message,r.isError);else{SCOPE.addNotify("Success",r.message,r.isError);var i=t.objDataTable.row(e.objDataTableRow).data(),d=0!=n?'<span class="glyphicon glyphicon-ok" aria-hidden="true"><span style="color: transparent">1</span></span>':'<span class="glyphicon glyphicon-remove" aria-hidden="true"><span style="color: transparent">0</span></span>';i[2]=a,i[3]=o,i[4]=d,t.objDataTable.row(e.objDataTableRow).data(i).draw(),e.numTaskID=null,e.objDataTableRow={},e.getAddModal().find("form")[0].reset(),t.getAddModal().modal("hide")}}}):AJAX_AddTask(JSON.stringify({title:a,desc:o,success:n}),function(a){if(a){var o=JSON.parse(a);e.reloadTable(o),o.length>0?(SCOPE.addNotify("Success","Feladat mentése sikerült.",!1),e.getAddModal().find("form")[0].reset(),t.getAddModal().modal("hide")):1!=o&&SCOPE.addNotify("Error","Feladat mentése sikertelen.",!0)}}):SCOPE.addNotify("Error","Befejezett állapot megadása kötelező",!0):SCOPE.addNotify("Error","Leírás megadása kötelező",!0):SCOPE.addNotify("Error","Cím megadása kötelező",!0)},modifyTask:function(e){if(!$(e.target).hasClass("remove-row")&&!$(e.target).hasClass("remove-confirm")){var a=t,o=$(this).find("td:eq(1)").html();$.isNumeric(o)&&(a.numTaskID=o,a.objDataTableRow=$(this),AJAX_GetTask(JSON.stringify({id:o}),function(e){if(e){var o=JSON.parse(e);o.isError?SCOPE.addNotify("Error","Hiba történt az adatok betöltése során. Kérem próbálja meg később.",!0):(a.getAddModal().find('form input[name="title"]').val(o.title),a.getAddModal().find('form textarea[name="description"]').val(o.description),$('form input[name="success"]:eq('+o.is_success+")").prop("checked",!0),t.getAddModal().modal("show"))}}))}},removeRow:function(e){var a=e.parents("tr").find("td:eq(1)").html();$.isNumeric(a)&&AJAX_RemoveTask(JSON.stringify({id:a}),function(a){if(a){var o=JSON.parse(a);o.isError?SCOPE.addNotify("Error",o.message,o.isError):(SCOPE.addNotify("Succes",o.message,o.isError),t.objDataTable.row(e.parents("tr")).remove().draw())}})},setCompact:function(){var e=t;AJAX_SetCompact(!0,function(t){if(t){var a=JSON.parse(t);e.toggleCompactBtn(),e.reloadTable(a)}})},reloadTable:function(t){var e=this,a="";e.objDataTable.clear().draw(),$.each(t,function(t,o){a=0!=o.is_success?'<span class="glyphicon glyphicon-ok" aria-hidden="true"><span style="color: transparent">1</span></span>':'<span class="glyphicon glyphicon-remove" aria-hidden="true"><span style="color: transparent">0</span></span>',e.objDataTable.row.add(['<button class="btn btn-default remove-confirm" data-toggle="confirmation" data-popout="true" data-singleton="true"><i class="fa fa-times remove-row" aria-hidden="true"></i></button>',o.id,o.title,o.description,a,o.create_date]).draw(!1)})},toggleCompactBtn:function(){var t=this,e=t.getCompactBtn().find(".fa");t.getCompactBtn().hasClass("btn-success")?(t.getCompactBtn().removeClass("btn-success"),t.getCompactBtn().addClass("btn-toolbar"),e.removeClass("fa-eye"),e.addClass("fa-eye-slash")):(t.getCompactBtn().addClass("btn-success"),t.getCompactBtn().removeClass("btn-toolbar"),e.addClass("fa-eye"),e.removeClass("fa-eye-slash"))},initDataTable:function(){t.objDataTable=t.getTable().DataTable({columnDefs:[{orderable:!1,className:"select-checkbox",targets:0}],aoColumns:[{bSearchable:!1},{bSearchable:!1},null,null,{bSearchable:!1},{bSearchable:!1}],select:{style:"os",selector:"td:first-child"}})}};SCOPE.getDocument().ready(function(){t.initDataTable(),t.getLogOut().click(function(){t.signOut()}),t.getAddBtn().on("click",function(){t.getAddModal().modal("show")}),t.getSaveBtn().on("click",t.saveTask),SCOPE.getDocument().on("click",t.strTableRowSelector,t.modifyTask),SCOPE.getDocument().on("click",t.strConfirmSelector,function(){var e=$(this),a=e.parents("tr"),o='<div class="text-center">Biztos törölni szeretné a #'+e.parents("tr").find("td:eq(1)").html()+" sort?</div>";a.css({background:"#c9302c"}),bootbox.confirm({message:o,closeButton:!1,buttons:{confirm:{label:"Igen",className:"btn-danger"},cancel:{label:"Nem",className:"btn-toolbar"}},callback:function(o){!0===o?t.removeRow(e):a.css({background:"white"})}})}),t.getAddModal().on("hidden.bs.modal",function(){t.numTaskID=null,t.objDataTableRow={},t.getAddModal().find("form")[0].reset()}),t.getCompactBtn().on("click",t.setCompact),t.getAddModal().find("form").submit(function(){return!1})})}();