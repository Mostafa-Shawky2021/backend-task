import axios from "axios";

const applyFilterBtn = document.getElementById('applyFilterBtn');
const dropdownFilter = document.getElementById('dropdownFilter');
const removeFilterBtn = document.getElementById('removeFilterBtn');

function handleFilter(){
    const dropDownValue = dropdownFilter.value 
    if(dropDownValue == 0) return false;

    window.location.href = `/employees?company=${dropDownValue}`

}

const  handleRemoveFilter = ()=> window.location.href = `/employees`;

applyFilterBtn?.addEventListener('click',handleFilter);
removeFilterBtn?.addEventListener('click',handleRemoveFilter);
