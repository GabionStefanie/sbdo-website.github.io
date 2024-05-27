
document.addEventListener('DOMContentLoaded', function() {
const PLevel = document.getElementById('PLevel');

PLevel.addEventListener('input', function() {
    if( PLevel.value.length > 2){
      PLevel.value = PLevel.value.slice(0, 2);


    }
});


});