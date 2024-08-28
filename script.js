$(document).ready(function () {
  $(".productButton").click(function () {
    $(".dropbox").toggleClass("activeBox");
    $(".fa-plus").toggleClass("fa-minus");
  });
  $(".fa-bars").click(function () {
    $(".sideNav").css("width", "250px");
  });
  $(".fa-close").click(function () {
    $(".sideNav").css("width", "0");
  });
});

function destroy_session() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "destroy_session.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      location.href = location.href;
    }
  };
  xhr.send();
}

function placeorder() {
  var animation = bodymovin.loadAnimation({
    container: document.getElementById("animation-container"),

    path: "./animations/order.json",

    renderer: "svg",
    loop: true,

    autoplay: true,

    name: "order placed animation",
  });
}
