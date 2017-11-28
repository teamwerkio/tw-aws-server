var slider = document.getElementById("projectProgress");
var output = document.getElementById("progressOutput");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}