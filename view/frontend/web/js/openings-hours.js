define([
    'uiComponent',
    'underscore',

    'jquery',
    'ko',

], function ($, ko,_) {
    'use strict';

    return Component.extend({
        defaults: {
            // default options
            // options passed into the component override these
        },

        dayNames: function () {
            var weekday = new Array(7);
            weekday[0] = "Sunday";
            weekday[1] = "Monday";
            weekday[2] = "Tuesday";
            weekday[3] = "Wednesday";
            weekday[4] = "Thursday";
            weekday[5] = "Friday";
            weekday[6] = "Saturday";
        

            return weekday;

        },

        getOpeningStatus: function () {
            var date = new Date();
            var weekday = [];
            weekday[0] = "Sunday";
            weekday[1] = "Monday";
            weekday[2] = "Tuesday";
            weekday[3] = "Wednesday";
            weekday[4] = "Thursday";
            weekday[5] = "Friday";
            weekday[6] = "Saturday";

            var currentDay = weekday[date.getDay()];

            var currentTimeHours = date.getHours();
            currentTimeHours = currentTimeHours < 10 ? "0" + currentTimeHours : currentTimeHours;
            var currentTimeMinutes = date.getMinutes();
            var timeNow = currentTimeHours + "" + currentTimeMinutes;

            var currentDayID = "#" + currentDay; //gets todays weekday and turns it into id
            $(currentDayID).toggleClass("today"); //this works at hightlighting today

            var openTimeSplit = $(currentDayID).children('.opens').text().split(":");

            var openTimeHours = openTimeSplit[0];
            openTimeHours = openTimeHours < 10 ? "0" + openTimeHours : openTimeHours;

            var openTimeMinutes = openTimeSplit[1];
            var openTimex = openTimeSplit[0] + openTimeSplit[1];

            var closeTimeSplit = $(currentDayID).children('.closes').text().split(":");

            var closeTimeHours = closeTimeSplit[0];
            closeTimeHours = closeTimeHours < 10 ? "0" + closeTimeHours : closeTimeHours;

            var closeTimeMinutes = closeTimeSplit[1];
            var closeTimex = closeTimeSplit[0] + closeTimeSplit[1];

            if (timeNow >= openTimex && timeNow <= closeTimex) {
                return 'open';
            } else {
                return 'closed';
            }
        }
    });
});
