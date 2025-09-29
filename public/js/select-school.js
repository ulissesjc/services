document.addEventListener('DOMContentLoaded', function() {
    var citySelect = document.getElementById('city');
    var schoolSelect = document.getElementById('schoolName');
    var allSchools = window.allSchools || [];

    var selectedSchoolId = schoolSelect.dataset.selectedSchoolId;

    function loadSchools(city, selectedSchoolId = null) {
        schoolSelect.innerHTML = '<option value="" selected disabled>Selecione uma escola</option>';

        if(city) {
            var schoolsForCity = allSchools.filter(school => school.city === city);

            schoolsForCity.forEach(function(school){
                var option = new Option(school.name, school.id)
                if (selectedSchoolId && String(school.id) === selectedSchoolId) {
                    option.selected = true;
                }
                schoolSelect.add(option);
            });
        }
    }

    citySelect.addEventListener('change', function() {
        loadSchools(this.value);
    });

    if(citySelect.value) {
        loadSchools(citySelect.value, selectedSchoolId);
    }
});
