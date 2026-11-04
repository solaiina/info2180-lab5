const doorbell= document.getElementById("lookup");
const input= document.getElementById("country");
const result = document.getElementById("result")

doorbell.addEventListener("click", function(){
    const read = input.value  
    fetch("world.php?country=" + read)
    .then(response => response.text())
    .then(data => result.innerHTML = data);
});