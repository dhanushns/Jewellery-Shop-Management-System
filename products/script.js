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

let products = "diamond gold silver platinum";
let category = "chains chain earrings earring rings ring bracelets bracelet";
let key_product;
let key_category;
function search(key) {
  let text = key.split(" ");
  for (var i = 0; i < text.length; i++) {
    let pattern = RegExp(text[i], "gi");
    key_product = products.match(pattern);
    if (key_product != null) break;
  }
  if (key_product !== null) {
    for (var i = 0; i < text.length; i++) {
      let pattern = RegExp(text[i], "gi");
      key_category = category.match(pattern);
      if (key_category != null) {
        if (key_category[0] === "chain") key_category[0] = "chains";
        else if (key_category[0] === "earring") key_category[0] = "earrings";
        else if (key_category[0] === "ring") key_category[0] = "rings";
        else if (key_category[0] === "bracelet") key_category[0] = "bracelets";
      }
    }
  }

  if (key_product !== null && key_category !== null) {
    getData(key_product[0], key_category[0]);
  }
}

async function getData(product, category) {
  console.log(category);
  try {
    const response = await fetch(product + "_products.php");
    const text = await response.text();
    const parse = new DOMParser();
    const doc = parse.parseFromString(text, "text/html");
    const sourceDiv = doc.getElementById(category);
    if (sourceDiv) {
      document.getElementById("result").innerHTML += sourceDiv.innerHTML;
    } else {
      document.getElementById("no-data").style.display = "block";
    }
  } catch (error) {
    document.getElementById("no-data").style.display = "block";
  }
}

function toggle_fav_btn(event, session_value, loc) {
  if (loc === 1) {
    if (session_value === 1) {
      var btn_1 = document.getElementById(event.target.id).style;
      var btn_2 = document.getElementById("modal_fav_" + event.target.id).style;
      console.log(btn_1.color);
      if (btn_1.color === "rgb(216, 216, 216)") {
        console.log("Done");
        btn_1.color = "#9c03be";
        btn_2.color = "#9c03be";
      } else {
        btn_1.color = "#d8d8d8";
        btn_2.color = "#d8d8d8";
      }
    }
  } else {
    if (session_value === 1) {
      var id = event.target.id.slice(10, event.target.id.length);
      var btn_1 = document.getElementById(id).style;
      var btn_2 = document.getElementById(event.target.id).style;
      if (btn_1.color === "rgb(216, 216, 216)") {
        btn_1.color = "#9c03be";
        btn_2.color = "#9c03be";
      } else {
        btn_1.color = "#d8d8d8";
        btn_2.color = "#d8d8d8";
      }
    }
  }
}

function toggle_cart_btn(event, session_value) {
  if (session_value === 1) {
    let id = event.currentTarget.id;
    let child_id = document.getElementById(id).children[1].id;
    let btn_ele = document.getElementById(id).children[0].id;
    document.getElementById(child_id).style.display = "block";
    setTimeout(() => {
      document.getElementById(child_id).style.display = "none";
      let cookie = document.cookie.split(";");
      cookie.forEach((element) => {
        if (element.trim() === "cart=true") {
          console.log("Item Added");
        }
      });
      document.getElementById(id).disabled = true;
      document.getElementById(btn_ele).innerHTML = "Added to cart";
    }, 1000);
  }
}

function destroy_session() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../destroy_session.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      location.href = location.href;
    }
  };
  xhr.send();
}
