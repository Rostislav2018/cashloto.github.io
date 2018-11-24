function addBigLoader(e) {
  $(e).find('.big-loader').remove();
  $(e).css('position', 'relative');
  var w = $(e).outerWidth();
  var h = $(e).outerHeight();
  var iw = 81;
  if (h < 100) {
    iw = h - 20;
  }
  if (iw < 0) {
    iw = 0;
  }
  var p = Math.round((h - iw)/2);
  h -= p;
  var html = '<div class="big-loader" style="width: '+w+'px; height: '+h+'px; padding-top: '+p+'px;">';
  html += '<img src="/images/ajax-loader-big.gif" style="width: '+iw+'px;" />';
  html += '</div>';
  $(e).append(html);
}
function deleteBigLoader(e) {
  $(e).find('.big-loader').remove();
}

function suffix(count, s1, s2, s3) {
  count = count + '';
  if (count != '') {
    count = count.split(/(.)/);
    if (count.length) {
      var s = [];
      for (var i = 0; i < count.length; i++) {
        if(count[i] != '') {
          s[s.length] = count[i];
        }
      }
      if(s.length) {
        s = s.reverse();
        if(s.length == 1) {
          s[1] = 0;
        }
        if (s[0] == 1 && s[1] != 1) {
          return s1;
        }
        if (s[0] > 1 && s[0] < 5 && s[1] != 1) {
          return s2;
        }
      }
    }
  }
  return s3;
}

function dump(arr, level) {
  var dumped_text = '';
  if (!level) {
    level = 0;
  }
  var level_padding = '';
  for (var j = 0; j < level + 1; j++) {
    level_padding += '    ';
  }
  if (typeof(arr) == 'object') {
    // Array/Hashes/Objects
    for (var item in arr) {
      var value = arr[item];
      if (typeof(value) == 'object') {
        //If it is an array,
        dumped_text += level_padding + "'" + item + "' ...\n";
        dumped_text += dump(value, level+1);
      } else {
        dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
      }
    }
  } else {
    // Stings/Chars/Numbers etc.
    dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
  }
  return dumped_text;
}

function _esc(str) {
  return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function number_format(number, decimals, dec_point, thousands_sep) {
  var i, j, kw, kd, km;
  if (isNaN(decimals = Math.abs(decimals))) {
    decimals = 2;
  }
  if (dec_point == undefined) {
    dec_point = '.';
  }
  if (thousands_sep == undefined) {
    thousands_sep = ' ';
  }
  i = parseInt(number = (+number || 0).toFixed(decimals)) + '';
  if((j = i.length) > 3) {
    j = j % 3;
  } else {
    j = 0;
  }
  km = (j ? i.substr(0, j) + thousands_sep : '');
  kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
  kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : '');
  return km + kw + kd;
}


function _ajaxHtml(p) {
  var e = 'Сбой сервера';
  $.ajax({
    url: p.url,
    data: p.data || null,
    type: p.type || 'post',
    dataType: 'json',
    success: function(json) {
      if (json && json.error !== undefined) {
        if (json.error != '') {
          e = json.error;
        } else {
          if (json.html !== undefined) {
            p.success(json.html);
            return true;
          }
        }
      }
      if (p.error) {
        p.error(e);
      }
    },
    error: function() {
      if (p.error) {
        p.error(e);
      }
    }
  });
}

function _ajaxJson(p) {
  var e = 'Сбой сервера';
  $.ajax({
    url: p.url,
    data: p.data || null,
    type: p.type || 'post',
    dataType: 'json',
    success: function(json) {
      if (json && json.error !== undefined) {
        if (json.error != '') {
          e = json.error;
        } else {
          p.success(json);
          return true;
        }
      }
      if (p.error) {
        p.error(e);
      }
    },
    error: function() {
      if (p.error) {
        p.error(e);
      }
    }
  });
}

var Base64 = {
    // private property
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
    // public method for encoding
    encode: function(input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;
        input = Base64._utf8_encode(input);
        while (i < input.length) {
            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);
            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;
            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }
            output = output + this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) + this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
        }
        return output;
    },
    // public method for decoding
    decode: function(input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;
        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
        while (i < input.length) {
            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));
            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;
            output = output + String.fromCharCode(chr1);
            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }
        }
        output = Base64._utf8_decode(output);
        return output;
    },
    // private method for UTF-8 encoding
    _utf8_encode: function(string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";
        for (var n = 0; n < string.length; n++) {
            var c = string.charCodeAt(n);
            if (c < 128) {
                utftext += String.fromCharCode(c);
            } else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            } else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }
        }
        return utftext;
    },
    // private method for UTF-8 decoding
    _utf8_decode: function(utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;
        while (i < utftext.length) {
            c = utftext.charCodeAt(i);
            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            } else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            } else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }
        }
        return string;
    }
}

$(function() {
  $('.selectall').on('focus', function() {
    var $this = $(this);
    if ($this.prop('disabled') || $this.prop('readonly')) {
      return false;
    }
    $this.select();
    // Work around Chrome's little problem
    $this.mouseup(function() {
      // Prevent further mouseup intervention
      $this.unbind("mouseup");
      return false;
    });
  });
  $('.num-float').on('change keyup', function() {
    var _val = $(this).val();
    _val = _val.replace(',', '.');
    _val = _val.replace(/[^0-9.]/, '');
    $(this).val(_val);
  });
  $('.num-int').on('change keyup', function() {
    var _val = $(this).val();
    _val = _val.replace(/[^0-9]/, '');
    $(this).val(_val);
  });
});


function initTinymceEditor(p) {
  p.toolbar1 = p.toolbar1 !== undefined ? p.toolbar1 : "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect";
  p.toolbar2 = p.toolbar2 !== undefined ? p.toolbar2 : "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor";
  p.toolbar3 = p.toolbar3 !== undefined ? p.toolbar3 : "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak";

  var options = {
    script_url: '/js/tinymce/tinymce.gzip.php',
    plugins: [
      "advlist,autolink,link,image,lists,charmap,print,preview,hr,anchor,pagebreak,spellchecker,responsivefilemanager",
      "searchreplace,wordcount,visualblocks,visualchars,code,fullscreen,insertdatetime,media,nonbreaking",
      "table,contextmenu,directionality,emoticons,template,textcolor,paste,textcolor,colorpicker,textpattern"
    ],
    toolbar1: p.toolbar1,
    toolbar2: p.toolbar2,
    toolbar3: p.toolbar3,
    menubar: false,
    language : 'ru',
    toolbar_items_size: 'small',
    relative_urls: false,
    height: (p.height - 118)
  }

  if (p.block_formats !== undefined) {
    options.block_formats = p.block_formats;
  }
  if (p.body_id !== undefined) {
    options.body_id = p.body_id;
  }
  if (p.content_css !== undefined) {
    options.content_css = p.content_css;
  }

  $(p.selector).tinymce(options);
}