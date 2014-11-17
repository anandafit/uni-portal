// moment.js language configuration
// language : russian (ru)
// author : Viktorminator : https://github.com/Viktorminator
// Author : Menelion ElensÃºle : https://github.com/Oire

(function (factory) {
  if (typeof define === 'function' && define.amd) {
    define(['moment'], factory); // AMD
  } else if (typeof exports === 'object') {
    module.exports = factory(require('../moment')); // Node
  } else {
    factory(window.moment); // Browser global
  }
}(function (moment) {
  function plural(word, num) {
    var forms = word.split('_');
    return num % 10 === 1 && num % 100 !== 11 ? forms[0] : (num % 10 >= 2 && num % 10 <= 4 && (num % 100 < 10 || num % 100 >= 20) ? forms[1] : forms[2]);
  }

  function relativeTimeWithPlural(number, withoutSuffix, key) {
    var format = {
      'mm': 'Ð¼Ð¸Ð½ÑƒÑ‚Ð°_Ð¼Ð¸Ð½ÑƒÑ‚Ñ‹_Ð¼Ð¸Ð½ÑƒÑ‚',
      'hh': 'Ñ‡Ð°Ñ_Ñ‡Ð°ÑÐ°_Ñ‡Ð°ÑÐ¾Ð²',
      'dd': 'Ð´ÐµÐ½ÑŒ_Ð´Ð½Ñ_Ð´Ð½ÐµÐ¹',
      'MM': 'Ð¼ÐµÑÑÑ†_Ð¼ÐµÑÑÑ†Ð°_Ð¼ÐµÑÑÑ†ÐµÐ²',
      'yy': 'Ð³Ð¾Ð´_Ð³Ð¾Ð´Ð°_Ð»ÐµÑ‚'
    };
    if (key === 'm') {
      return withoutSuffix ? 'Ð¼Ð¸Ð½ÑƒÑ‚Ð°' : 'Ð¼Ð¸Ð½ÑƒÑ‚Ñƒ';
    }
    else {
      return number + ' ' + plural(format[key], +number);
    }
  }

  function monthsCaseReplace(m, format) {
    var months = {
        'nominative': 'ÑÐ½Ð²Ð°Ñ€ÑŒ_Ñ„ÐµÐ²Ñ€Ð°Ð»ÑŒ_Ð¼Ð°Ñ€Ñ‚_Ð°Ð¿Ñ€ÐµÐ»ÑŒ_Ð¼Ð°Ð¹_Ð¸ÑŽÐ½ÑŒ_Ð¸ÑŽÐ»ÑŒ_Ð°Ð²Ð³ÑƒÑÑ‚_ÑÐµÐ½Ñ‚ÑÐ±Ñ€ÑŒ_Ð¾ÐºÑ‚ÑÐ±Ñ€ÑŒ_Ð½Ð¾ÑÐ±Ñ€ÑŒ_Ð´ÐµÐºÐ°Ð±Ñ€ÑŒ'.split('_'),
        'accusative': 'ÑÐ½Ð²Ð°Ñ€Ñ_Ñ„ÐµÐ²Ñ€Ð°Ð»Ñ_Ð¼Ð°Ñ€Ñ‚Ð°_Ð°Ð¿Ñ€ÐµÐ»Ñ_Ð¼Ð°Ñ_Ð¸ÑŽÐ½Ñ_Ð¸ÑŽÐ»Ñ_Ð°Ð²Ð³ÑƒÑÑ‚Ð°_ÑÐµÐ½Ñ‚ÑÐ±Ñ€Ñ_Ð¾ÐºÑ‚ÑÐ±Ñ€Ñ_Ð½Ð¾ÑÐ±Ñ€Ñ_Ð´ÐµÐºÐ°Ð±Ñ€Ñ'.split('_')
      },

      nounCase = (/D[oD]? *MMMM?/).test(format) ?
        'accusative' :
        'nominative';

    return months[nounCase][m.month()];
  }

  function monthsShortCaseReplace(m, format) {
    var monthsShort = {
        'nominative': 'ÑÐ½Ð²_Ñ„ÐµÐ²_Ð¼Ð°Ñ€_Ð°Ð¿Ñ€_Ð¼Ð°Ð¹_Ð¸ÑŽÐ½ÑŒ_Ð¸ÑŽÐ»ÑŒ_Ð°Ð²Ð³_ÑÐµÐ½_Ð¾ÐºÑ‚_Ð½Ð¾Ñ_Ð´ÐµÐº'.split('_'),
        'accusative': 'ÑÐ½Ð²_Ñ„ÐµÐ²_Ð¼Ð°Ñ€_Ð°Ð¿Ñ€_Ð¼Ð°Ñ_Ð¸ÑŽÐ½Ñ_Ð¸ÑŽÐ»Ñ_Ð°Ð²Ð³_ÑÐµÐ½_Ð¾ÐºÑ‚_Ð½Ð¾Ñ_Ð´ÐµÐº'.split('_')
      },

      nounCase = (/D[oD]? *MMMM?/).test(format) ?
        'accusative' :
        'nominative';

    return monthsShort[nounCase][m.month()];
  }

  function weekdaysCaseReplace(m, format) {
    var weekdays = {
        'nominative': 'Ð²Ð¾ÑÐºÑ€ÐµÑÐµÐ½ÑŒÐµ_Ð¿Ð¾Ð½ÐµÐ´ÐµÐ»ÑŒÐ½Ð¸Ðº_Ð²Ñ‚Ð¾Ñ€Ð½Ð¸Ðº_ÑÑ€ÐµÐ´Ð°_Ñ‡ÐµÑ‚Ð²ÐµÑ€Ð³_Ð¿ÑÑ‚Ð½Ð¸Ñ†Ð°_ÑÑƒÐ±Ð±Ð¾Ñ‚Ð°'.split('_'),
        'accusative': 'Ð²Ð¾ÑÐºÑ€ÐµÑÐµÐ½ÑŒÐµ_Ð¿Ð¾Ð½ÐµÐ´ÐµÐ»ÑŒÐ½Ð¸Ðº_Ð²Ñ‚Ð¾Ñ€Ð½Ð¸Ðº_ÑÑ€ÐµÐ´Ñƒ_Ñ‡ÐµÑ‚Ð²ÐµÑ€Ð³_Ð¿ÑÑ‚Ð½Ð¸Ñ†Ñƒ_ÑÑƒÐ±Ð±Ð¾Ñ‚Ñƒ'.split('_')
      },

      nounCase = (/\[ ?[Ð’Ð²] ?(?:Ð¿Ñ€Ð¾ÑˆÐ»ÑƒÑŽ|ÑÐ»ÐµÐ´ÑƒÑŽÑ‰ÑƒÑŽ)? ?\] ?dddd/).test(format) ?
        'accusative' :
        'nominative';

    return weekdays[nounCase][m.day()];
  }

  return moment.lang('ru', {
    months : monthsCaseReplace,
    monthsShort : monthsShortCaseReplace,
    weekdays : weekdaysCaseReplace,
    weekdaysShort : "Ð²Ñ_Ð¿Ð½_Ð²Ñ‚_ÑÑ€_Ñ‡Ñ‚_Ð¿Ñ‚_ÑÐ±".split("_"),
    weekdaysMin : "Ð²Ñ_Ð¿Ð½_Ð²Ñ‚_ÑÑ€_Ñ‡Ñ‚_Ð¿Ñ‚_ÑÐ±".split("_"),
    monthsParse : [/^ÑÐ½Ð²/i, /^Ñ„ÐµÐ²/i, /^Ð¼Ð°Ñ€/i, /^Ð°Ð¿Ñ€/i, /^Ð¼Ð°[Ð¹|Ñ]/i, /^Ð¸ÑŽÐ½/i, /^Ð¸ÑŽÐ»/i, /^Ð°Ð²Ð³/i, /^ÑÐµÐ½/i, /^Ð¾ÐºÑ‚/i, /^Ð½Ð¾Ñ/i, /^Ð´ÐµÐº/i],
    longDateFormat : {
      LT : "HH:mm",
      L : "DD.MM.YYYY",
      LL : "D MMMM YYYY Ð³.",
      LLL : "D MMMM YYYY Ð³., LT",
      LLLL : "dddd, D MMMM YYYY Ð³., LT"
    },
    calendar : {
      sameDay: '[Ð¡ÐµÐ³Ð¾Ð´Ð½Ñ Ð²] LT',
      nextDay: '[Ð—Ð°Ð²Ñ‚Ñ€Ð° Ð²] LT',
      lastDay: '[Ð’Ñ‡ÐµÑ€Ð° Ð²] LT',
      nextWeek: function () {
        return this.day() === 2 ? '[Ð’Ð¾] dddd [Ð²] LT' : '[Ð’] dddd [Ð²] LT';
      },
      lastWeek: function () {
        switch (this.day()) {
          case 0:
            return '[Ð’ Ð¿Ñ€Ð¾ÑˆÐ»Ð¾Ðµ] dddd [Ð²] LT';
          case 1:
          case 2:
          case 4:
            return '[Ð’ Ð¿Ñ€Ð¾ÑˆÐ»Ñ‹Ð¹] dddd [Ð²] LT';
          case 3:
          case 5:
          case 6:
            return '[Ð’ Ð¿Ñ€Ð¾ÑˆÐ»ÑƒÑŽ] dddd [Ð²] LT';
        }
      },
      sameElse: 'L'
    },
    relativeTime : {
      future : "Ñ‡ÐµÑ€ÐµÐ· %s",
      past : "%s Ð½Ð°Ð·Ð°Ð´",
      s : "Ð½ÐµÑÐºÐ¾Ð»ÑŒÐºÐ¾ ÑÐµÐºÑƒÐ½Ð´",
      m : relativeTimeWithPlural,
      mm : relativeTimeWithPlural,
      h : "Ñ‡Ð°Ñ",
      hh : relativeTimeWithPlural,
      d : "Ð´ÐµÐ½ÑŒ",
      dd : relativeTimeWithPlural,
      M : "Ð¼ÐµÑÑÑ†",
      MM : relativeTimeWithPlural,
      y : "Ð³Ð¾Ð´",
      yy : relativeTimeWithPlural
    },

    // M. E.: those two are virtually unused but a user might want to implement them for his/her website for some reason

    meridiem : function (hour, minute, isLower) {
      if (hour < 4) {
        return "Ð½Ð¾Ñ‡Ð¸";
      } else if (hour < 12) {
        return "ÑƒÑ‚Ñ€Ð°";
      } else if (hour < 17) {
        return "Ð´Ð½Ñ";
      } else {
        return "Ð²ÐµÑ‡ÐµÑ€Ð°";
      }
    },

    ordinal: function (number, period) {
      switch (period) {
        case 'M':
        case 'd':
        case 'DDD':
          return number + '-Ð¹';
        case 'D':
          return number + '-Ð³Ð¾';
        case 'w':
        case 'W':
          return number + '-Ñ';
        default:
          return number;
      }
    },

    week : {
      dow : 1, // Monday is the first day of the week.
      doy : 7  // The week that contains Jan 1st is the first week of the year.
    }
  });
}));