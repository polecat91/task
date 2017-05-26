
(function(){

    'use strict'
    
    var SIGN = {
        
        getLoginForm: function() {
            return SCOPE.getDocument().find('.form-login');
        },
        getLoginEmail: function() {
            return this.getLoginForm().find('.login-email');
        },
        getLoginPassword: function() {
            return this.getLoginForm().find('.login-password');
        },
        getLoginBtn: function() {
            return this.getLoginForm().find('.login-button');
        },

        getSignUpForm: function() {
            return SCOPE.getDocument().find('.form-sign-up');
        },
        getSignUpUser: function() {
            return this.getSignUpForm().find('.sign-up-username');
        },
        getSignUpEmail: function() {
            return this.getSignUpForm().find('.sign-up-email');
        },
        getSignUpPassword: function() {
            return this.getSignUpForm().find('.sign-up-password');
        },
        getSignUpRePassword: function() {
            return this.getSignUpForm().find('.sign-up-re-password');
        },
        getSetSignUpBtn: function() {
            return this.getSignUpForm().find('.sign-button');
        },

        signUp: function() {
            var self = this,
                strUser = $.trim(self.getSignUpUser().val()),
                strEmail = $.trim(self.getSignUpEmail().val()),
                strPassword = self.getSignUpPassword().val(),
                strRePassword = self.getSignUpRePassword().val();

            if(strPassword !== strRePassword) {
                SCOPE.addNotify('Error', 'A két jelszó nem térhet el.', true);
            } else if(!self.isValidEmail(strEmail)) {
                SCOPE.addNotify('Error', 'Érvénytelen email cím.', true);
            } else if(strUser && strEmail && strPassword && strRePassword) {
                var strDo = JSON.stringify({
                     username: strUser
                    ,email: strEmail
                    ,password: strPassword
                    ,re_password: strRePassword
                });
                AJAX_SignUp(strDo, function(strResponse) {
                    if(strResponse) {
                        var rowResponse = JSON.parse(strResponse);
                        if(rowResponse.isError) {
                            SCOPE.addNotify('Error', rowResponse.message, rowResponse.isError);
                        } else {
                            SCOPE.addNotify('Success', rowResponse.message, rowResponse.isError);
                            SCOPE.addNotify('Success', 'Belépés folyamatban.<br />Kis türelmet.', false);
                            setTimeout(function() {
                                location.reload();
                            }, 2200);
                        }
                    }
                });
            }
        },

        signIn: function() {
            var self = this,
                strEmail = $.trim(self.getLoginEmail().val()),
                strPassword = self.getLoginPassword().val();

            if(self.isValidEmail(strEmail) && strPassword) {
                var strDo = JSON.stringify({
                    "email":strEmail,
                    "password":strPassword
                });
                AJAX_Login(strDo, function(strResponse) {
                    var isLogin = JSON.parse(strResponse);
                    if(isLogin) {
                        location.reload();
                    } else {
                        SCOPE.addNotify('Error', 'Hibás email cím és/vagy jelszó.', true);
                    }
                });
            } else {
                var strError = '';
                if(!self.isValidEmail(strEmail)) {
                    strError = 'Invalid email address';
                }
                SCOPE.addNotify('Error', strError, true);
            }
        
        },
        isValidEmail: function(strEmail) {
            if(strEmail) {
                var strRegExp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return strRegExp.test(strEmail);
            } else {
                return false;
            }
        },
    };
    
    SIGN.getLoginForm().submit(function(){
        SIGN.signIn();
        return false;
    });

    SIGN.getSignUpForm().submit(function(){
        SIGN.signUp();
        return false;
    });
    
})();