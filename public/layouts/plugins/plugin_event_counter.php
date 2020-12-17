<div id="clockdiv">
  <div>
    <span class="days"></span>
    <div class="smalltext"><?php echo read_xmls('/site/frontend/counter/days')?></div>
  </div>
  <div>
    <span class="hours"></span>
    <div class="smalltext"><?php echo read_xmls('/site/frontend/counter/hours')?></div>
  </div>
  <div>
    <span class="minutes"></span>
    <div class="smalltext"><?php echo read_xmls('/site/frontend/counter/minutes')?></div>
  </div>
  <div>
    <span class="seconds"></span>
    <div class="smalltext"><?php echo read_xmls('/site/frontend/counter/seconds')?></div>
  </div>
  <div class="button_reg">
    <span class="seconds"><a href="./?page=page_254811"><?php echo read_xmls('/site/frontend/counter/btnreg')?></a></span>
    <div class="smalltext"><?php echo read_xmls('/site/frontend/counter/btnregmsg')?></div>
  </div>
</div>

<script>
function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);
  var daysSpan = clock.querySelector('.days');
  var hoursSpan = clock.querySelector('.hours');
  var minutesSpan = clock.querySelector('.minutes');
  var secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    var t = getTimeRemaining(endtime);

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}
//03-08-2018

//var deadline = new Date(Date.parse(new Date()) + 45 * 24 * 60 * 60 * 1000);
var deadline = 'Wed Oct 03 2018 08:00:00 GMT+0300 (Arabian Standard Time)';

initializeClock('clockdiv', deadline);

</script>
