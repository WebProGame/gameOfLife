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
  if (cell.getAttribute("data-covered") === "false") {
    cell.setAttribute("data-covered", "true");
    cell.style.backgroundColor = "blue";
    setTimeout(function() {
      // check cells around clicked cell
      var cellsAround = getAdjacentCells(cell);
      var hasBlueNeighbor = false;
      for (var i = 0; i < cellsAround.length; i++) {
        var adjCell = cellsAround[i];
        if (adjCell.style.backgroundColor === "blue") {
          hasBlueNeighbor = true;
          break;
        }
      }
      if (!hasBlueNeighbor) {
        cell.setAttribute("data-covered", "false");
        cell.style.backgroundColor = "";
      } else {
        // check if this cell has 3 covered neighbors
        var coveredNeighbors = 0;
        cellsAround.forEach(function(adjCell) {
          if (adjCell.getAttribute("data-covered") === "true") {
            coveredNeighbors++;
          }
        });
        if (coveredNeighbors === 3) {
          cellsAround.push(cell); // include clicked cell in the list
          cellsAround.forEach(function(adjCell) {
            adjCell.setAttribute("data-covered", "false");
            adjCell.style.backgroundColor = "";
          });
        }
      }
    }, 1000);
  } else {
    // cell is already covered, do nothing
  }
}


function getAdjacentCells(cell) {
  var row = cell.parentNode.rowIndex;
  var col = cell.cellIndex;
  var adjacentCells = [];

  for (var i = row - 1; i <= row + 1; i++) {
    for (var j = col - 1; j <= col + 1; j++) {
      if (i >= 0 && i < cell.parentNode.parentNode.rows.length && 
          j >= 0 && j < cell.parentNode.parentNode.rows[i].cells.length &&
          (i !== row || j !== col)) {
        adjacentCells.push(cell.parentNode.parentNode.rows[i].cells[j]);
      }
    }
  }

  return adjacentCells;
}


function changeRandomCell() {
  var tableCells = document.querySelectorAll("#mxnGrid td[data-covered='false']");
  if (tableCells.length > 0) {
    var randomIndex = Math.floor(Math.random() * tableCells.length);
    var randomCell = tableCells[randomIndex];
    randomCell.setAttribute("data-covered", "true");
    randomCell.style.backgroundColor = "blue";
  }
}
function animateBlueCells() {
  var cells = document.querySelectorAll("#mxnGrid td[data-covered='true'][style*='background-color: blue']");
  var cellsToMove = [];
  cells.forEach(function(cell) {
    var row = cell.parentNode.rowIndex;
    var col = cell.cellIndex;
    if (row + 1 < document.getElementById("mxnGrid").rows.length) {
      var nextCell = document.getElementById("mxnGrid").rows[row + 1].cells[col];
      if (nextCell.getAttribute("data-covered") === "false") {
        cell.setAttribute("data-covered", "false");
        cell.style.backgroundColor = "";
        nextCell.setAttribute("data-covered", "true");
        nextCell.style.backgroundColor = "blue";
        cellsToMove.push(nextCell);
      }
    } else {
      cell.setAttribute("data-covered", "false");
      cell.style.backgroundColor = "";
    }
  });
  if (cellsToMove.length > 0) {
    setTimeout(function() {
      animateBlueCells();
    }, 1000);
  }
}