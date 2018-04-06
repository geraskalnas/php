function openUrl(url) {//for redirect to selected URL.
  //var x = document.createElement("IMG");
  var x = document.getElementById('i');
  //document.write();
  x.style.display = 'block';  
  //x.setAttribute("src", "img/loading.gif");
  //x.setAttribute("width", "304");
  //x.setAttribute("height", "228");
  //x.setAttribute("alt", "The Pulpit Rock");
  //document.body.appendChild(x);
  window.location.href=url;
}