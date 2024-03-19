// counter
// $.fn.jQuerySimpleCounter = function (options) {
//   var settings = $.extend({
//     start: 0,
//     end: 100,
//     easing: 'swing',
//     duration: 400,
//     complete: ''
//   }, options);

//   var thisElement = $(this);

//   $({
//     count: settings.start
//   }).animate({
//     count: settings.end
//   }, {
//     duration: settings.duration,
//     easing: settings.easing,
//     step: function () {
//       var mathCount = Math.ceil(this.count);
//       thisElement.text(mathCount);
//     },
//     complete: settings.complete
//   });
// };


// $('#number1').jQuerySimpleCounter({
//   end: 51,
//   duration: 3000
// });
// $('#number2').jQuerySimpleCounter({
//   end: 29,
//   duration: 3000
// });
// $('#number3').jQuerySimpleCounter({
//   end: 58,
//   duration: 2000
// });
// $('#number4').jQuerySimpleCounter({
//   end: 6,
//   duration: 2500
// });




$(window).scroll(function () {
  if ($(window).scrollTop()<=1400) {
    $.fn.jQuerySimpleCounter = function (options) {
      var settings = $.extend({
        start: 0,
        end: 100,
        easing: 'swing',
        duration: 400,
        complete: ''
      }, options);
    
      var thisElement = $(this);
    
      $({
        count: settings.start
      }).animate({
        count: settings.end
      }, {
        duration: settings.duration,
        easing: settings.easing,
        step: function () {
          var mathCount = Math.ceil(this.count);
          thisElement.text(mathCount);
        },
        complete: settings.complete
      });
    };
    
    
    $('#number1').jQuerySimpleCounter({
      end: 2,
      duration: 3000
    });
    $('#number2').jQuerySimpleCounter({
      end: 14,
      duration: 3000
    });
    $('#number3').jQuerySimpleCounter({
      end: 58,
      duration: 2000
    });
    $('#number4').jQuerySimpleCounter({
      end: 14,
      duration: 2500
    });
  }
});

