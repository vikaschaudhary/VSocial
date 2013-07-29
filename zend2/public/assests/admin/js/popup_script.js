$(document).ready(function() {
  $("#delete-no").on('click', function() {
    close_fancybox();
  });
});

function close_fancybox(reload) {
  if (reload == true) {
    reload_parent();
  }
  parent.$.fancybox.close();
}

function reload_parent() {
  var selfUrl = unescape(parent.window.location.pathname);
  parent.location.reload(true);
  parent.window.location.replace(selfUrl);
  parent.window.location.href = selfUrl;
}