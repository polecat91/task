
(function(){

    'use strict'
    
    var ABOUT = {
        
        strTableRowSelector: '.table tbody tr',
        strConfirmSelector: '[data-toggle="confirmation"]',
        numTaskID: null,
        objDataTableRow: {},
        objDataTable: {},
        
        getTable: function() {
            return SCOPE.getDocument().find('.table');
        },
        getAddModal: function() {
            return SCOPE.getDocument().find('.task-item');
        },
        getAddBtn: function() {
            return SCOPE.getDocument().find('.setup-content .add-new-task');
        },
        getSaveBtn: function() {
            return this.getAddModal().find('.btn-success');
        },
        getCompactBtn: function() {
            return SCOPE.getDocument().find('.set-compact');
        },
        
        getLogOut: function() {
            return SCOPE.getDocument().find('.logout');
        },
        
        signOut: function() {
            AJAX_SignOut('', function(strResponse) {
                var signOut = JSON.parse(strResponse);
                if(signOut) {
                    location.reload();
                } else {
                    self.errorLogin("error logout");
                }
            });
        },
        
        saveTask: function() {
            var self = ABOUT,
                strTitle = $.trim(self.getAddModal().find('form input[name="title"]').val()),
                strDesc = $.trim(self.getAddModal().find('form textarea[name="description"]').val()),
                numSuccess = $.trim(self.getAddModal().find('form input[name="success"]:checked').val());

            if(!strTitle.length) {
                SCOPE.addNotify('Error', 'Cím megadása kötelező', true);
            } else if(!strDesc.length) {
                SCOPE.addNotify('Error', 'Leírás megadása kötelező', true);
            } else if(!$.isNumeric(numSuccess)) {
                SCOPE.addNotify('Error', 'Befejezett állapot megadása kötelező', true);
            } else {
                if(self.numTaskID) {
                    AJAX_ModifyTask(JSON.stringify({id: self.numTaskID, title: strTitle, desc: strDesc, success: numSuccess}), function(strResponse){
                        if(strResponse) {
                            var rowResponse = JSON.parse(strResponse);
                            if(rowResponse.isError) {
                                SCOPE.addNotify('Error', rowResponse.message, rowResponse.isError);
                            } else {
                                SCOPE.addNotify('Success', rowResponse.message, rowResponse.isError);
                                var objRow = ABOUT.objDataTable.row(self.objDataTableRow).data();
                                var strSuccess = (numSuccess != 0 ?
                                        '<span class="glyphicon glyphicon-ok" aria-hidden="true"><span style="color: transparent">1</span></span>':
                                        '<span class="glyphicon glyphicon-remove" aria-hidden="true"><span style="color: transparent">0</span></span>');
                                    objRow[2] = strTitle;
                                    objRow[3] = strDesc;
                                    objRow[4] = strSuccess;

                                ABOUT.objDataTable
                                    .row(self.objDataTableRow)
                                    .data( objRow )
                                    .draw();

                                self.numTaskID = null;
                                self.objDataTableRow = {};
                                self.getAddModal().find('form')[0].reset();
                                ABOUT.getAddModal().modal('hide');
                            }
                        }
                    });
                } else {
                    AJAX_AddTask(JSON.stringify({title: strTitle, desc: strDesc, success: numSuccess}), function(strResponse){
                        if(strResponse) {
                            var tblResponse = JSON.parse(strResponse);
                            self.reloadTable(tblResponse);
                            if(tblResponse.length > 0) {
                                SCOPE.addNotify('Success', 'Feladat mentése sikerült.', false);
                                self.getAddModal().find('form')[0].reset();
                                ABOUT.getAddModal().modal('hide');
                            } else if (tblResponse != true) {
                                SCOPE.addNotify('Error', 'Feladat mentése sikertelen.', true);
                            }
                        }
                    });
                }
            }
        },
        
        modifyTask: function(event) {
            if(!$(event.target).hasClass('remove-row') && !$(event.target).hasClass('remove-confirm')) {
                var self = ABOUT,
                    numID = $(this).find('td:eq(1)').html();

                if($.isNumeric(numID)) {
                    self.numTaskID = numID;
                    self.objDataTableRow = $(this);
                    AJAX_GetTask(JSON.stringify({id: numID}), function(strResponse) {
                        if(strResponse) {
                            var rowResponse = JSON.parse(strResponse);
                            if(rowResponse.isError) {
                                SCOPE.addNotify('Error', 'Hiba történt az adatok betöltése során. Kérem próbálja meg később.', true);
                            } else {
                                self.getAddModal().find('form input[name="title"]').val(rowResponse.title);
                                self.getAddModal().find('form textarea[name="description"]').val(rowResponse.description);
                                $('form input[name="success"]:eq(' + rowResponse.is_success + ')').prop("checked", true);
                                ABOUT.getAddModal().modal('show');
                            }
                        }
                    });
                }
            }
        },
        
        removeRow: function(objThis) {
            var self = this,
                numID = objThis.parents('tr').find('td:eq(1)').html();

            if($.isNumeric(numID)) {
                AJAX_RemoveTask(JSON.stringify({id: numID}), function(strResponse) {
                    if(strResponse) {
                        var rowResponse = JSON.parse(strResponse);
                        if(rowResponse.isError) {
                            SCOPE.addNotify('Error', rowResponse.message, rowResponse.isError);
                        } else {
                            SCOPE.addNotify('Succes', rowResponse.message, rowResponse.isError);
                                ABOUT.objDataTable
                                    .row( objThis.parents('tr') )
                                    .remove()
                                    .draw();
                        }
                    }
                });
            }
        },
        
        setCompact: function() {
            var self = ABOUT,
                strSuccess = '';

            AJAX_SetCompact(true, function(strResponse){
                console.log(strResponse);
                if(strResponse) {
                    var tblResponse = JSON.parse(strResponse);
                    self.toggleCompactBtn();
                    self.reloadTable(tblResponse);
                }
            });
        },
        
        reloadTable: function(tblResponse) {
            var self = this,
                strSuccess = '',
                strRemove = '<button class="btn btn-default remove-confirm" data-toggle="confirmation" data-popout="true" data-singleton="true"><i class="fa fa-times remove-row" aria-hidden="true"></i></button>'
            
            self.objDataTable
                .clear()
                .draw();
            $.each(tblResponse, function(numKey, rowResponse) {
                strSuccess = (rowResponse.is_success != 0 ?
                        '<span class="glyphicon glyphicon-ok" aria-hidden="true"><span style="color: transparent">1</span></span>':
                        '<span class="glyphicon glyphicon-remove" aria-hidden="true"><span style="color: transparent">0</span></span>');
                self.objDataTable.row.add([
                     strRemove
                    ,rowResponse.id
                    ,rowResponse.title
                    ,rowResponse.description
                    ,strSuccess
                    ,rowResponse.create_date
                ]).draw( false );
            });
        },

        toggleCompactBtn: function() {
            var self = this,
                objFa = self.getCompactBtn().find('.fa');

            if(self.getCompactBtn().hasClass('btn-success')) {
                self.getCompactBtn().removeClass('btn-success');
                self.getCompactBtn().addClass('btn-toolbar');
                objFa.removeClass('fa-eye');
                objFa.addClass('fa-eye-slash');
            } else {
                self.getCompactBtn().addClass('btn-success');
                self.getCompactBtn().removeClass('btn-toolbar');
                objFa.addClass('fa-eye');
                objFa.removeClass('fa-eye-slash');
            }
        },

        initDataTable: function() {
            ABOUT.objDataTable = ABOUT.getTable().DataTable( {
                columnDefs: [ {
                    orderable: false,
                    className: 'select-checkbox',
                    targets:   0
                } ],
                "aoColumns": [
                    { "bSearchable": false },
                    { "bSearchable": false },
                    null,
                    null,
                    { "bSearchable": false },
                    { "bSearchable": false }
                ],
                select: {
                    style:    'os',
                    selector: 'td:first-child'
                }
            });
        },
        
    };
    
    SCOPE.getDocument().ready(function() {
        ABOUT.initDataTable();
        
        ABOUT.getLogOut().click(function(){
            ABOUT.signOut();
        });
        
        ABOUT.getAddBtn().on("click", function() {
            ABOUT.getAddModal().modal('show');
        });
        ABOUT.getSaveBtn().on("click", ABOUT.saveTask);
        SCOPE.getDocument().on("click", ABOUT.strTableRowSelector, ABOUT.modifyTask);

        SCOPE.getDocument().on("click", ABOUT.strConfirmSelector, function() {
            var objThis = $(this),
                objRow = objThis.parents('tr'),
                numID = objThis.parents('tr').find('td:eq(1)').html(),
                strHtml = "<div class=\"text-center\">Biztos törölni szeretné a #" + numID + " sort?</div>";

            objRow.css({"background":"#c9302c"});
            bootbox.confirm({
                 message: strHtml
                ,closeButton: false
                ,buttons: {
                    confirm: {
                        label: 'Igen',
                        className: 'btn-danger'
                    },
                    cancel: {
                        label: 'Nem',
                        className: 'btn-toolbar'
                    }
                }
                ,callback: function(isConfirmed) {
                   if(isConfirmed === true) {
                       ABOUT.removeRow(objThis)
                   } else {
                       objRow.css({"background":"white"});
                   }
                }
            });
        });
        ABOUT.getAddModal().on('hidden.bs.modal', function () {
            ABOUT.numTaskID = null;
            ABOUT.objDataTableRow = {};
            ABOUT.getAddModal().find('form')[0].reset();
        });
        ABOUT.getCompactBtn().on("click", ABOUT.setCompact);
    });
    
})();