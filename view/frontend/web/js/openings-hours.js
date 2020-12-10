define([
    'uiComponent',
    'underscore',
    'ko',
    'moment',
    'jquery'

], function (Component, ko, _,moment,$) {
    'use strict';

    return Component.extend({
        defaults: {
            // default options
            // options passed into the component override these
        },
        // jscs:disable requireCamelCaseOrUpperCaseIdentifiers
        /**
         * @override
         */
        initialize: function (config) {

           this.openingstime=config.openingstimedata;
           this.configtimeformat=config.timeformat;

           return this._super();
        },
 
        show: function () {
            // event.preventDefault();
            $(".openings-content-wrapper").slideToggle('slow');

        },
        
        getOpeningStatus: function (openingtime,closingtime) {
            if(this.configtimeformat == 24 ){
                var format = 'H:mm'
            }else{
                format = 'h:mm A'
            }
            
            var now = moment();
            var opentime = moment(openingtime, format);
            var closetime = moment(closingtime, format);
            console.log(closetime);
            if (now.isBetween(opentime, closetime)){
                return true;
            }
            return false;
            
        },
    });
});
