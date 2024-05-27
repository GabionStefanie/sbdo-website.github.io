document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('MH');
    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
    const noneCheckbox = form.querySelector('input[value="None"]');
    
    
    function checkNoneValidity() {
        const otherCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox !== noneCheckbox);
        const noneChecked = noneCheckbox.checked;
        const otherChecked = otherCheckboxes.some(checkbox => checkbox.checked);
        noneCheckbox.disabled = otherChecked;
        
      
        if (noneChecked && otherChecked) {
            noneCheckbox.checked = false;
        }
    }
    
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('input', checkNoneValidity);
    });
    
    
    checkNoneValidity();
});