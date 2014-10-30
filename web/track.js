
//Получаем id реферала
var a = window.location.href.match(/a=([^&]+)/);

if (a) {    
    setCookie('refId', a[1], { expires: 3000000 });
    refId = a[1];    
    var name = 'Переход';
    var data = 'a='+refId+'&name='+name;
    sendPost('http://<url>/transaction/create', data);
    
} else {
    var refId = getCookie('refId');
}






var affiliate = {}

affiliate.goal = function(name) {    
    var data = 'a='+refId+'&name='+name;
    sendPost('http://<url>/transaction/create', data);
}













/*
 * Set Cookie
 */
function setCookie(name, value, options) {
    options = options || {};

    var expires = options.expires;

    if (typeof expires == "number" && expires) {
      var d = new Date();
      d.setTime(d.getTime() + expires*1000);
      expires = options.expires = d;
    }
    if (expires && expires.toUTCString) { 
          options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + "=" + value;

    for(var propName in options) {
      updatedCookie += "; " + propName;
      var propValue = options[propName];    
      if (propValue !== true) { 
        updatedCookie += "=" + propValue;
       }
    }

    document.cookie = updatedCookie;
}

/*
 * Get Cookie
 */
function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
      "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

/*
 * Send POST data
 */
function sendPost(url, data){
    
    var request = new XMLHttpRequest();
    request.open('POST', url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);
    
}