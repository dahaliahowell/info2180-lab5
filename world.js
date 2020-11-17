window.onload = function() {

    var searchBtn = document.getElementById("lookup");
    var searchBtnCities = document.getElementById("lookup-cities");
    var httpRequest;
  
    searchBtn.addEventListener('click', function(element) {
      element.preventDefault();
  
      httpRequest = new XMLHttpRequest();
      var country = document.querySelector('#country').value;
  
      var url = "http://localhost:8888/info2180-lab5/world.php?country=" + country;
      httpRequest.onreadystatechange = sendResult;
      httpRequest.open('GET', url);
      httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      httpRequest.send('name=' + encodeURIComponent(country));
    });

    searchBtnCities.addEventListener('click', function(element) {
        element.preventDefault();
    
        httpRequest = new XMLHttpRequest();
        var country = document.querySelector('#country').value;
    
        var url = "http://localhost:8888/info2180-lab5/world.php?country=" + country + "&context=cities";
        httpRequest.onreadystatechange = sendResult;
        httpRequest.open('GET', url);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.send('name=' + encodeURIComponent(country));
      });
  
    function sendResult() {
      if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status === 200) {
          var response = httpRequest.responseText;
          document.getElementById("result").innerHTML = response;
        } else {
          alert('There was a problem with the request.');
        }
      }
    }
  
};