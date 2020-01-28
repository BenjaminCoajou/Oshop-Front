var app = {
  init: function() {
    var sortSelector = document.querySelector('.custom-select');
    sortSelector.addEventListener('change', app.onSortSelectChange);
  },
  onSortSelectChange: function(event) {
    // on déclenche la navigation vers la page triée
    window.location.href = event.target.value;
  }
};


document.addEventListener('DOMContentLoaded', app.init);