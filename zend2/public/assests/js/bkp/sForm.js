;(function(e){function t(t,n){function a(e){var t={text:/^[a-zA-Z'][a-zA-Z-' ]+[a-zA-Z']?$/,email:/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i};return t[e.attr("type")].test(e.val())}function f(){if(o)return false;o=true;e.ajax({type:"POST",url:n.mailHandlerURL,data:{name:r.length?r.val():i.val().split("@")[0],email:i.val(),owner_email:n.ownerEmail,sitename:n.sitename||n.ownerEmail.split("@")[1]},success:function(e){o=false;t.trigger("reset");r.add(i).data({wtch:true})}})}var r=e(".name>input",t),i=e(".email>input",t),s=e('a[data-type="submit"]',t),o,u;n=e.extend({ownerEmail:"#",mailHandlerURL:"bat/MailHandler-sub.php"},n);s.click(function(){u=true;r.add(i).trigger("keyup");if(!e(".invalid",t).length)f();return false});t[t.on?"on":"bind"]("keyup",function(n){if(n.keyCode===13){r.add(i).data({wtch:true}).trigger("keyup");if(!e(".invalid",t).length){f();return false}else{e(".invalid",t).focus()}}});r.add(i).each(function(){var t=e(this),n=t.val();t.focus(function(){if(t.val()==n)t.val(""),t.parents("label").removeClass("invalid"),t.data({wtch:false})}).blur(function(){if(t.val()=="")t.val(n),t.parents("label").removeClass("invalid");else t.data({wtch:true}).trigger("keyup")})})[r.on?"on":"bind"]("keyup",function(t){var n=e(this);if(n.data("wtch"))n.parents("label")[a(n)?"removeClass":"addClass"]("invalid")})}e.fn.sForm=function(n){return this.each(function(){t(e(this),n)})}})(jQuery);