'use strict'

var SCOPE;

(function(){
    SCOPE = {
        
        strEmailRegEx: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
        strPhoneRegEx: /^(1\s|1|)?((\(\d{3}\))|\d{3})(\-|\s)?(\d{3})(\-|\s)?(\d{4})$/,
        strPasswordRegEx: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,}$/, //one digit|one lower case|one upper case|8 from the mentioned characters
        
        getWindow: function() {
            return $(window);
        },
        getDocument: function() {
			return $(document);
        },
        getHtml: function() {
            return $('html');
        },
        getHead: function() {
            return this.getHtml().find('head');
        },
        getHeadTitle: function() {
            return $('title');
        },
        getBody: function() {
            return this.getHtml().find('body');
        },
        getFooter: function() {
            return this.getHtml().find('footer');
        },
        
        validate: {
            email: function(strEmail) {
                if(SCOPE.strEmailRegEx.test(strEmail) || strEmail.length === 0) {
                    return true;
                } else {
                    SCOPE.addNotify('Error', 'Invalid email address: ' + strEmail, true);
                    return false;
                }
            },
            phone: function(strPhone) {
//                if(strPhone.match(SCOPE.strPhoneRegEx) || strPhone.length === 0) {
                    return true;
//                } else {
//                    SCOPE.addNotify('Error', 'Invalid phone number: ' + strPhone, true);
//                    return false;
//                }
            },
            password: function(strPassword) {
                if(SCOPE.strPasswordRegEx.test(strPassword) || strPassword.length === 0) {
                    return true;
                } else {
                    SCOPE.addNotify('Error', "Invalid password. Contain at least:\n- one digit\n- one lower case\n- one upper case\n- and 8 from the mentioned characters", true);
                    return false;
                }
            },
            emptyRequire: function(objForm) {
                var isEmptyRequire = false;

                $(objForm).each(function() {
                    if($(this).is('[required]') && $(this).val().length === 0) {
                        if(!isEmptyRequire) {
                            isEmptyRequire = $(this).parents('.form-group').find('.control-label').text();
                        }
                    }
                });

                return isEmptyRequire;

            }
        },
        
        addNotify: function(strTitle, strMessage, isError) {
            if(strMessage) {
//                strTitle = (strTitle ? strTitle : "Success");
                var strType = (!isError ? "success" : "error");
                new PNotify({
                    title: strTitle,
                    text: strMessage,
                    type: strType,
                    styling: 'bootstrap3'
                });
            } else if(strMessage && isTestServer) {
                console.log('Notify message invalid or empty message!');
            }
        },
    };
    
})();