/**
 * ShortURL: Bijective conversion between natural numbers (IDs) and short strings
 *
 * ShortURL.encode() takes an ID and turns it into a short string
 * ShortURL.decode() takes a short string and turns it into an ID
 *
 * Features:
 * + large alphabet (51 chars) and thus very short resulting strings
 * + proof against offensive words (removed 'a', 'e', 'i', 'o' and 'u')
 * + unambiguous (removed 'I', 'l', '1', 'O' and '0')
 *
 * Example output:
 * 123456789 <=> pgK8p
 *
 * Source: https://github.com/delight-im/ShortURL (Apache License 2.0)
 */

var ___ts_crypt = new function() {

   var _alphabet = '23456789bcdfghjkmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ-_/';
   var _base = _alphabet.length;

   this.shorturl_encode = function(num) {
      var str = '';
      while (num > 0) {
         str = _alphabet.charAt(num % _base) + str;
         num = Math.floor(num / _base);
      }
      return str;
   };

   this.shorturl_decode = function(str) {
      var num = 0;
      for (var i = 0; i < str.length; i++) {
         num = num * _base + _alphabet.indexOf(str.charAt(i));
      }
      return num;
   };

   this.base64_encode = function(data) {
      //  discuss at: http://phpjs.org/functions/base64_encode/
      // original by: Tyler Akins (http://rumkin.com)
      // improved by: Bayron Guevara
      // improved by: Thunder.m
      // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
      // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
      // improved by: Rafał Kukawski (http://kukawski.pl)
      // bugfixed by: Pellentesque Malesuada
      //   example 1: base64_encode('Kevin van Zonneveld');
      //   returns 1: 'S2V2aW4gdmFuIFpvbm5ldmVsZA=='
      //   example 2: base64_encode('a');
      //   returns 2: 'YQ=='

      var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
      var o1, o2, o3, h1, h2, h3, h4, bits, i = 0;
      var ac = 0, enc = '', tmp_arr = [];

      if (!data) {
         return data;
      }

      do { // pack three octets into four hexets
         o1 = data.charCodeAt(i++);
         o2 = data.charCodeAt(i++);
         o3 = data.charCodeAt(i++);

         bits = o1 << 16 | o2 << 8 | o3;

         h1 = bits >> 18 & 0x3f;
         h2 = bits >> 12 & 0x3f;
         h3 = bits >> 6 & 0x3f;
         h4 = bits & 0x3f;

         // use hexets to index into b64, and append result to encoded string
         tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
      } while (i < data.length);

      enc = tmp_arr.join('');

      var r = data.length % 3;

      return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
   };

   this.base64_decode = function(data) {
      //  discuss at: http://phpjs.org/functions/base64_decode/
      // original by: Tyler Akins (http://rumkin.com)
      // improved by: Thunder.m
      // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
      // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
      //    input by: Aman Gupta
      //    input by: Brett Zamir (http://brett-zamir.me)
      // bugfixed by: Onno Marsman
      // bugfixed by: Pellentesque Malesuada
      // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
      //   example 1: base64_decode('S2V2aW4gdmFuIFpvbm5ldmVsZA==');
      //   returns 1: 'Kevin van Zonneveld'
      //   example 2: base64_decode('YQ===');
      //   returns 2: 'a'

      var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
      var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
              ac = 0,
              dec = '',
              tmp_arr = [];

      if (!data) {
         return data;
      }

      data += '';

      do { // unpack four hexets into three octets using index points in b64
         h1 = b64.indexOf(data.charAt(i++));
         h2 = b64.indexOf(data.charAt(i++));
         h3 = b64.indexOf(data.charAt(i++));
         h4 = b64.indexOf(data.charAt(i++));

         bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

         o1 = bits >> 16 & 0xff;
         o2 = bits >> 8 & 0xff;
         o3 = bits & 0xff;

         if (h3 === 64) {
            tmp_arr[ac++] = String.fromCharCode(o1);
         } else if (h4 === 64) {
            tmp_arr[ac++] = String.fromCharCode(o1, o2);
         } else {
            tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
         }
      } while (i < data.length);

      dec = tmp_arr.join('');

      return dec.replace(/\0+$/, '');
   }
};