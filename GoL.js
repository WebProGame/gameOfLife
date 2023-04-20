function gameUpload() {
    var pairsNeeded = document.getElementById("pairs-needed").value;
   
    var photosNeeded = pairsNeeded * 2;
    var rows, columns;
    if (photosNeeded === 40) {
      rows = columns = 16;
      timer1(8);
    } else if (photosNeeded === 60) {
      rows = 30;
      columns = 30;
      timer1(10);
    } else if (photosNeeded === 50) {
      rows = 4;
      columns = 6;
      timer1(12);
    } else {
      alert("Invalid table size");
      return;
    }
    

      var photosInGame = [
    
      ];
    
      var shiftPhotos = shuffle(photosInGame).slice(0, photosNeeded);
      var dupPhotos = shiftPhotos.slice(0, pairsNeeded);
      var matchedPairs = dupPhotos.concat(dupPhotos);
      var createTable = "";
      for (var i = 0; i < rows; i++) {
        createTable += "<tr>";
        for (var j = 0; j < columns; j++) {
          var imgLocation = i * columns + j;
          if (imgLocation < photosNeeded) {
            var photosrc = matchedPairs[imgLocation];
            createTable += "<td onclick='checkBlockCovered(this)'><img src='" + photosrc + "'></td>";
          } else {
            createTable += "<td></td>";
          }
        }
        createTable += "</tr>";
      }
      document.getElementById("mxnGrid").innerHTML = createTable;
    }
    
    function shuffle(array) {
      var current = array.length, temp, rand;
      while (0 !== current) {
        rand = Math.floor(Math.random() * current);
        current -= 1;
        temp = array[current];
        array[current] = array[rand];
        array[rand] = temp;
      }
      return array;
    }


var userClick1 = null;

function checkBlockCovered(cell) {
  var img = cell.getElementsByTagName("img")[0];
  cell.style.backgroundColor = "white";
  img.style.display = "block";

  if (userClick1 === null) {
    
    userClick1 = cell;
  } else {
   
    var imageClicked1st = userClick1.getElementsByTagName("img")[0];
    if (img.src === imageClicked1st.src) {
      
      userClick1.onclick = null;
      cell.onclick = null;
      
      
    } else {
      var delayT = (document.getElementById("time-To-See").value)*100;
     
      setTimeout(function() {
        imageClicked1st.style.display = "none";
        img.style.display = "none";
        userClick1.style.backgroundColor = "grey";
        cell.style.backgroundColor = "grey";
      }, delayT);
    }
    
    
    
    userClick1 = null;
  }
  
}

function timer1(pairsNumber) {
    var limittoTime = 0;
    if (pairsNumber === 8) {
       
      limittoTime = 120;
    } else if (pairsNumber === 10) {
      limittoTime = 150;
    } else if (pairsNumber === 12) {
      limittoTime = 180;
    } else {
      alert("Invalid table size");
      return;
    }
    var sectionTime = document.createElement("div");
    sectionTime.setAttribute("id", "timer");
    sectionTime.innerHTML = "<p> Time remaining: <span id='countdownTimer'>" + limittoTime + "</span> seconds</p>";
    document.body.appendChild(sectionTime);
    var countTime = document.getElementById("countdownTimer");
    var countTimeIN = setInterval(function() {
      limittoTime--;
      if (limittoTime < 0) {
        clearInterval(countTimeIN);
        alert("GameOver your time has finished and page will restart");
        sectionTime.remove();
        location.reload();
        sectionTime.remove();
      } else {
        countTime.innerHTML = limittoTime;
      }
    }, 1000);
  }