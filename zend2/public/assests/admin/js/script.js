$(document).ready(function() {
  $(".various").fancybox({
    fitToView: true,
    width: get_width('various'),
    height: get_height('various'),
    autoSize: false,
    closeClick: true,
    closeBtn: true,
    padding : 10,
    openEffect: 'fadeIn',
    closeEffect: 'fadeOut',
    dataType: 'html',
    headers: {'X-fancyBox': true}
  });
});
function get_width(cls) {
  $return = '90%';
  $("." + cls).each(function() {
    width = $(this).attr('width');
    if (width) {
      $return = width;
    }
  });
  return $return;
}

function get_height(cls) {
  $return = '50%';
  $("." + cls).each(function() {
    height = $(this).attr('height');
    if (height) {
      $return = height;
    }
  });
  return $return;
}