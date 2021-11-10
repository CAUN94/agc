var Alert = new CustomAlert();
function CustomAlert(){

  this.render = function(name){
      //Show Modal
      popUpBoxName = 'popUp'+name
      let popUpBox = document.getElementById(popUpBoxName);
      popUpBox.style.display = "block";
      //Close Modal
      closeModal = 'closeModal'+name
      document.getElementById(closeModal).innerHTML = '<button onclick="Alert.ok(`'+name+'`)">OK</button>';
  }
    
  this.ok = function(name){
    popUpBoxName = 'popUp'+name
    document.getElementById(popUpBoxName).style.display = "none";
  }
}


// Shuffle Image from Equipo
function shuffle(a) {
  var j, x, i;
  for (i = a.length - 1; i > 0; i--) {
      j = Math.floor(Math.random() * (i + 1));
      x = a[i];
      a[i] = a[j];
      a[j] = x;
  }
  return a;
}

var list = document.getElementsByClassName('team-pictures')[0];
function shuffleNodes() {
  var nodes = list.children, i = 0;
  nodes = shuffle(Array.from(nodes))
  while(i < nodes.length) {
      list.appendChild(nodes[i]);
      i++;
  }
}
shuffleNodes()

// Filter Professional
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("team-picture");
  icon = document.getElementsByClassName("team-service");
  for (i = 0; i < icon.length; i++) {
    w3RemoveClass(icon[i], "active");
    // w3RemoveClass(x[i], "show");
    if (icon[i].className.indexOf(c) > -1) w3AddClass(icon[i], "active");
  }
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    // w3RemoveClass(icon[i], "active");
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }

}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}

