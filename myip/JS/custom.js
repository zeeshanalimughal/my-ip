// Toggle the box
let btn = document.getElementById("btn");
let box = document.querySelector('.wrapper-main');
btn.addEventListener("click", () => {
    box.classList.toggle("active");
    btn.classList.toggle("active");
    if (btn.classList.contains("active")) {
        btn.innerText = "Hide";
    } else {
        btn.innerText = "View";
    }
});





// Location script


// const map = document.querySelector(".map");
const flag = document.querySelector(".flag");

// Function to detect User Browser Name
function detectBrowser() { 
    if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) {
        return 'Opera';
    } else if(navigator.userAgent.indexOf("Chrome") != -1 ) {
        return 'Chrome';
    } else if(navigator.userAgent.indexOf("Safari") != -1) {
        return 'Safari';
    } else if(navigator.userAgent.indexOf("Firefox") != -1 ){
        return 'Firefox';
    } else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) {
        return 'IE';//crap
    } else {
        return 'Unknown';
    }
} 


// Function to detect User Window Version
function getOperatingSystemName(){
var OSName = "Unknown";
if (window.navigator.userAgent.indexOf("Windows NT 10.0")!= -1) return OSName="Windows 10";
if (window.navigator.userAgent.indexOf("Windows NT 6.3") != -1) return OSName="Windows 8.1";
if (window.navigator.userAgent.indexOf("Windows NT 6.2") != -1) return OSName="Windows 8";
if (window.navigator.userAgent.indexOf("Windows NT 6.1") != -1) return OSName="Windows 7";
if (window.navigator.userAgent.indexOf("Windows NT 6.0") != -1) return OSName="Windows Vista";
if (window.navigator.userAgent.indexOf("Windows NT 5.1") != -1) return OSName="Windows XP";
if (window.navigator.userAgent.indexOf("Windows NT 5.0") != -1) return OSName="Windows 2000";
if (window.navigator.userAgent.indexOf("Mac")            != -1) return OSName="Mac/iOS";
if (window.navigator.userAgent.indexOf("X11")            != -1) return OSName="UNIX";
if (window.navigator.userAgent.indexOf("Linux")          != -1) return OSName="Linux";
}
// $(".box").hide();
// $('.ip-heading').hide(); 
// $('.geo-heading').hide();



let d = new Date();
let local = d.toUTCString();
$.ajax({
// url: "https://geolocation-db.com/jsonp",
url: "http://ip-api.com/json",
jsonpCallback: "callback",
dataType: "json",
success: function( location ) {
    $(".ip-address").html("<b>My Ip:</b> "+location.query);
$('.ip1').html(
    "<br><b>Country:</b> &nbsp;&nbsp;"+location.country+
    "<br><b>City:</b> &nbsp;&nbsp;"+location.city+
    "<br><b>Timezone:</b> &nbsp;&nbsp;"+location.timezone+
    "<br><b>Region Name:</b> &nbsp;&nbsp;"+location.regionName+
    //"<br><b>Timezone:</b> &nbsp;&nbsp;"+location.timezone+
    //"<br><b>Currency:</b> &nbsp;&nbsp;"+location.currency+
    "<br><b>Postal:</b> &nbsp;&nbsp;"+location.zip+ 
    "<br><b>Longitude:</b> &nbsp;&nbsp;"+location.lon+ 
    "<br><b>Latitude:</b> &nbsp;&nbsp;"+location.lat);

    $(".ip2").html(
    "<br><b>ISP:</b> &nbsp;&nbsp;"+location.isp+ 
    "<br><b>AS:</b> &nbsp;&nbsp;"+location.as+ 
    "<br><b>Organization:</b> &nbsp;&nbsp;"+location.org+  
    "<br><b>Browser Name:</b> &nbsp;&nbsp;"+detectBrowser()+ 
    "<br><b>Window Version:</b> &nbsp;&nbsp;"+getOperatingSystemName()+
    "<br><b>System:</b> &nbsp;&nbsp;"+local+
    // "<br><b>Port:</b> &nbsp;&nbsp;"+window.location.port+
    "<br><b>Host Name:</b> &nbsp;&nbsp;"+window.location.hostname
    );

    // $('.ip-map').html(`<iframe src = "https://maps.google.com/maps?q=${location.latitude},${location.longitude}&hl=es;z=14&amp;output=embed" style="width: 1200px; height: 450px;"></iframe>`);

    $('.flag-box').html(`<img  src="https://www.countryflags.io/${location.countryCode}/shiny/64.png">
    `);
}
});	      

