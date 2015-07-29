jQuery(document).ready(function($) {
  var MAX_BULLET_COUNT = 10;
  var $calendar = $('.widget_archives_calendar .calendar-archives');
  $calendar.find('.postcount .count-number').each(function(idx, countNumber) {
    // Replace a month's postcount numeric value with bullets, up to
    // MAX_BULLET_COUNT
    var count = Math.min(parseInt(countNumber.textContent, 10), MAX_BULLET_COUNT);
    var bullets = $.map(new Array(count), function() { return "&#x25cf;"; });
    $(countNumber).html(bullets.join(' '));
  });
});
